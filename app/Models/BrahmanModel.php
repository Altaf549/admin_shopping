<?php

namespace App\Models;

use CodeIgniter\Model;

class BrahmanModel extends Model
{
    protected $table = 'tbl_admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'phone', 'status', 'image', 'aadhaar_image', 'aadhaar_no', 'address', 'city', 'state', 'pincode', 'email', 'password', 'uniqcode'];

    const ERROR_USER_EXISTS = 'USER_EXISTS';

    protected $perPage = 10;

    const ERROR_USER_NOT_FOUND = 'USER_NOT_FOUND';
    const ERROR_USER_INACTIVE = 'USER_INACTIVE';
    const ERROR_INVALID_PASSWORD = 'INVALID_PASSWORD';
    const ERROR_SUCCESS = 'SUCCESS';


    public function getBrahmanList($page = 1, $search = null)
    {
        $this->select('id, name, phone, status, image, aadhaar_image, aadhaar_no, address, city, state, pincode')
             ->orderBy('id', 'DESC');
        
        if ($search) {
            $this->like('name', $search)
                ->orLike('phone', $search)
                ->orLike('aadhaar_no', $search)
                ->orLike('address', $search)
                ->orLike('city', $search)
                ->orLike('state', $search)
                ->orLike('pincode', $search);
        }
        
        return $this->paginate($this->perPage, 'brahmans', $page);
    }

    public function getActiveBrahmans()
    {
        return $this->select('id, name, phone, status, image, aadhaar_image, aadhaar_no, address, city, state, pincode')
                    ->where('status', 'active')
                    ->orderBy('id', 'DESC')
                    ->findAll();
    }

    public function getBrahmansCount($search = null)
    {
        $builder = $this->select('id');

        if ($search) {
            $builder->like('name', $search)
                    ->orLike('phone', $search)
                    ->orLike('aadhaar_no', $search)
                    ->orLike('address', $search)
                    ->orLike('city', $search)
                    ->orLike('state', $search)
                    ->orLike('pincode', $search);
        }
        
        return $builder->countAllResults();
    }

    /**
     * Register a new admin
     * @param array $adminData Admin data containing name, email, phone, password
     * @return array Result with status and message
     */
    public function registerAdmin($adminData)
    {
        // Check if admin already exists
        $existingAdmin = $this->where(['email' => $adminData['email']])
                            ->orWhere(['phone' => $adminData['phone']])
                            ->first();

        if ($existingAdmin) {
            return [
                'status' => 'error',
                'message' => 'Admin already exists with this email or phone number'
            ];
        }

        // Hash the password
        $adminData['password'] = md5($adminData['password']);
        $adminData['status'] = 'inactive';

        // Insert new admin
        if ($this->insert($adminData)) {
            $admin = $this->where('email', $adminData['email'])
                        ->first();
            return [
                'status' => 'success',
                'message' => 'Admin registered successfully',
                'data' => $admin
            ];
        }

        return [
            'status' => 'error',
            'message' => 'Failed to register admin',
            'data' => []
        ];
    }

    /**
     * Validate admin credentials
     * @param string $credential Admin email or phone
     * @param string $password Admin password
     * @param string $credentialType Type of credential (email or phone)
     * @return array Validation result
     */
    public function validateAdmin($credential, $password, $credentialType)
    {
        // Check if the credential exists based on type
        $admin = $this->where($credentialType, $credential)
                     ->first();
                     
        if (!$admin) {
            return [
                'status' => self::ERROR_USER_NOT_FOUND,
                'message' => 'Invalid credentials'
            ];
        }

        // Verify password
        if (md5($password) !== $admin['password']) {
            return [
                'status' => self::ERROR_INVALID_PASSWORD,
                'message' => 'Invalid password'
            ];
        }

        // Return admin data on success
        return [
            'status' => self::ERROR_SUCCESS,
            'data' => $admin
        ];
    }
}
