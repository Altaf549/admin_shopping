<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use App\Models\BrahmanModel;
use App\Models\EventModel;
use App\Models\AboutUsModel;

class ApiController extends BaseController
{
    use ResponseTrait;

    public function getActiveBanners()
    {
        $bannerModel = new \App\Models\BannerModel();
        try {
            $banners = $bannerModel->getActiveBanners();
            
            if (empty($banners)) {
                return $this->respond([
                    'status' => 'Success',
                    'message' => 'No active banners found',
                    'data' => []
                ]);
            }
            
            return $this->respond([
                'status' => 'Success',
                'message' => 'Active banners retrieved successfully',
                'data' => $banners
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'status' => 'Error',
                'message' => 'An error occurred: ' . $e->getMessage(),
                'data' => []
            ]);
        }
    }

    public function getActivePujas()
    {
        $eventModel = new \App\Models\EventModel();
        try {
            $events = $eventModel->getActivePujas();
            
            if (empty($events)) {
                return $this->respond([
                    'status' => 'Success',
                    'message' => 'No active events found',
                    'data' => []
                ]);
            }
            return $this->respond([
                'status' => 'Success',
                'message' => 'Active pujas retrieved successfully',
                'data' => $events
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'status' => 'Error',
                'message' => 'An error occurred: ' . $e->getMessage(),
                'data' => []
            ]);
        }
    }
    
    public function register()
    {
        $userModel = new \App\Models\UserModel();
        $data = $this->request->getPost();
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        
        for ($i = 0; $i < 30; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        // Get request data from POST form
        $data = [
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'password' => $this->request->getPost('password'),
            'uniqcode' => $randomString
        ];
        
        // Validate required fields
        $requiredFields = ['email', 'phone', 'password'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                return $this->respond([
                    'status' => 'error',
                    'message' => "Missing required field: $field"
                ], 400);
            }
        }

        // Validate email format
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->respond([
                'status' => 'error',
                'message' => 'Invalid email format'
            ], 400);
        }

        // Validate phone number format (assuming Indian format)
        if (!preg_match('/^[0-9]{10}$/', $data['phone'])) {
            return $this->respond([
                'status' => 'error',
                'message' => 'Invalid phone number format'
            ], 400);
        }

        // Register the user
        $result = $userModel->registerUser($data);

        return $this->respond($result);
    }

    public function registerAdmin()
    {
        $adminModel = new \App\Models\BrahmanModel();
        $data = $this->request->getPost();
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        
        for ($i = 0; $i < 30; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        
        // Get request data from POST form
        $data = [
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'password' => $this->request->getPost('password'),
            'uniqcode' => $randomString
        ];
        
        // Validate required fields
        $requiredFields = ['email', 'phone', 'password', 'uniqcode'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                return $this->respond([
                    'status' => 'error',
                    'message' => "Missing required field: $field"
                ], 400);
            }
        }

        // Validate email format
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->respond([
                'status' => 'error',
                'message' => 'Invalid email format'
            ], 400);
        }

        // Validate phone number format (assuming Indian format)
        if (!preg_match('/^[0-9]{10}$/', $data['phone'])) {
            return $this->respond([
                'status' => 'error',
                'message' => 'Invalid phone number format'
            ], 400);
        }

        // Register the admin
        $result = $adminModel->registerAdmin($data);

        return $this->respond($result);
        
        // Validate required fields
        $requiredFields = ['email', 'phone', 'password'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                return $this->respond([
                    'status' => 'error',
                    'message' => "Missing required field: $field"
                ], 400);
            }
        }

        // Validate email format
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->respond([
                'status' => 'error',
                'message' => 'Invalid email format'
            ], 400);
        }

        // Validate phone number format (assuming Indian format)
        if (!preg_match('/^[0-9]{10}$/', $data['phone'])) {
            return $this->respond([
                'status' => 'error',
                'message' => 'Invalid phone number format'
            ], 400);
        }

        // Register the user
        $result = $userModel->registerUser($data);

        return $this->respond($result);
    }

    public function getCompanyPolicy()
    {
        $aboutUsModel = new \App\Models\AboutUsModel();
        $termsConditionModel = new \App\Models\TermsConditionModel();
        $privacyPolicyModel = new \App\Models\PrivacyPolicyModel();
        try {
            $type = $this->request->getPost('type');
            if($type == null) {
                return $this->respond([
                    'status' => 'Success',
                    'message' => 'No about us content found',
                    'data' => []
                ]);
            }
            switch($type) {
                case 'About Us': 
                    $aboutUs = $aboutUsModel->getAboutUs();
                    break;
                case 'Terms & condition' : 
                    $aboutUs = $termsConditionModel -> getTermsCondition();
                    break;
                case 'Privacy & policy' : 
                    $aboutUs = $privacyPolicyModel -> getPrivacyPolicy();
                    break;
            }
            
            if (empty($aboutUs)) {
                return $this->respond([
                    'status' => 'Success',
                    'message' => 'No about us content found',
                    'data' => []
                ]);
            }
            
            return $this->respond([
                'status' => 'Success',
                'message' => 'content retrieved successfully',
                'data' => $aboutUs
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'status' => 'Error',
                'message' => 'An error occurred: ' . $e->getMessage(),
                'data' => []
            ]);
        }
    }

    public function getActiveEvents()
    {
        $eventModel = new \App\Models\EventModel();
        try {
            $events = $eventModel->getActiveEvents();
            if (empty($events)) {
                return $this->respond([
                    'status' => 'Success',
                    'message' => 'No active events found',
                    'data' => []
                ]);
            }
            return $this->respond([
                'status' => 'Success',
                'message' => 'Active events retrieved successfully',
                'data' => $events
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'status' => 'Error',
                'message' => 'An error occurred: ' . $e->getMessage(),
                'data' => []
            ]);
        }
    }

    public function getActiveBrahmans()
    {
        $brahmanModel = new \App\Models\BrahmanModel();
        try {
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
            $credential = $this->request->getPost('credential');
            $password = $this->request->getPost('password');

            // Validate credential
            if (empty($credential)) {
                return $this->failValidation(['credential' => 'Credential is required']);
            }
            
            // Validate password
            if (empty($password)) {
                return $this->failValidation(['password' => 'Password is required']);
            }

            // Determine if credential is email or phone
            $isEmail = filter_var($credential, FILTER_VALIDATE_EMAIL);
            $credentialType = $isEmail ? 'email' : 'phone';

            // Validate password length
            if (strlen($password) < 8) {
                return $this->failValidation(['password' => 'Password must be at least 8 characters']);
            }

            $result = $apiModel->validateAdmin($credential, $password, $credentialType);
            
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
            $credential = $this->request->getPost('credential');
            $password = $this->request->getPost('password');

            // Validate credential
            if (empty($credential)) {
                return $this->failValidation(['credential' => 'Credential is required']);
            }
            
            // Validate password
            if (empty($password)) {
                return $this->failValidation(['password' => 'Password is required']);
            }

            // Determine if credential is email or phone
            $isEmail = filter_var($credential, FILTER_VALIDATE_EMAIL);
            $credentialType = $isEmail ? 'email' : 'phone';

            // Validate password length
            if (strlen($password) < 8) {
                return $this->failValidation(['password' => 'Password must be at least 8 characters']);
            }

            $result = $apiModel->validateAdmin($credential, $password, $credentialType);
            
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
