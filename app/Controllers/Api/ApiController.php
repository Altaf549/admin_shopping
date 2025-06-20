<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use App\Models\BrahmanModel;

class ApiController extends BaseController
{
    use ResponseTrait;
    
    public function getActiveBrahmans()
    {
        $brahmanModel = new \App\Models\BrahmanModel();
        $userModel = new \App\Models\UserModel();
        try {
            $uniqcode = $this->request->getPost('uniqcode');
            $result = $userModel->activeUser($uniqcode);
            if($result['status'] != UserModel::ERROR_SUCCESS) {
                return $this->respond([
                    'status' => 'Error',
                    'message' => 'User Not Found',
                    'data' => []
                ]);
            }
            $brahmans = $brahmanModel->getActiveBrahmans();
            
            if (empty($brahmans)) {
                return $this->respond([
                    'status' => 'success',
                    'message' => 'No active brahmans found',
                    'data' => []
                ]);
            }
            
            return $this->respond([
                'status' => 'success',
                'message' => 'Active brahmans retrieved successfully',
                'data' => $brahmans
            ]);
            
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    public function login()
    {
        $apiModel = new \App\Models\UserModel();
        try {
            // Validate request
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]'
            ];
            
            if (!$this->validate($rules)) {
                return $this->failValidation($this->validator->getErrors());
            }
            
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
           
            $result = $apiModel->validateUser($email, $password);
            
            switch ($result['status']) {
                case UserModel::ERROR_SUCCESS:
                    // Get all user details except password
                    $userDetails = array_filter($result['data'], function($key) {
                        return $key !== 'password';
                    }, ARRAY_FILTER_USE_KEY);
                    
                    return $this->respond([
                        'status' => 'success',
                        'message' => 'Login successful',
                        'data' => $userDetails
                    ]);
                    break;
                
                case UserModel::ERROR_USER_NOT_FOUND:
                    return $this->fail('Invalid email address');
                    break;
                
                case UserModel::ERROR_USER_INACTIVE:
                    return $this->fail('Account is inactive. Please contact support.');
                    break;
                
                case UserModel::ERROR_INVALID_PASSWORD:
                    return $this->fail('Invalid password');
                    break;
                
                default:
                    return $this->fail('Invalid credentials');
            }
            
        } catch (\Throwable $e) {
            log_message('error', 'API Login Error: ' . $e->getMessage());
            return $this->fail('Internal server error. Please try again later.');
        }
    }

    /**
     * Admin login
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function adminLogin()
    {
        $apiModel = new \App\Models\BrahmanModel();
        try {
            // Validate request
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]'
            ];
            
            if (!$this->validate($rules)) {
                return $this->failValidation($this->validator->getErrors());
            }
            
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            
            $result = $apiModel->validateAdmin($email, $password);
            
            switch ($result['status']) {
                case BrahmanModel::ERROR_SUCCESS:
                    // Get all admin details except password
                    $adminDetails = array_filter($result['data'], function($key) {
                        return $key !== 'password';
                    }, ARRAY_FILTER_USE_KEY);
                    
                    return $this->respond([
                        'status' => 'success',
                        'message' => 'Admin login successful',
                        'data' => $adminDetails
                    ]);
                    break;
                
                case BrahmanModel::ERROR_USER_NOT_FOUND:
                    return $this->fail('Invalid email address');
                    break;
                
                case BrahmanModel::ERROR_USER_INACTIVE:
                    return $this->fail('Account is inactive. Please contact support.');
                    break;
                
                case BrahmanModel::ERROR_INVALID_PASSWORD:
                    return $this->fail('Invalid password');
                    break;
                
                default:
                    return $this->fail('Invalid credentials');
            }
            
        } catch (\Throwable $e) {
            log_message('error', 'API Admin Login Error: ' . $e->getMessage());
            return $this->fail('Internal server error. Please try again later.');
        }
    }
}
