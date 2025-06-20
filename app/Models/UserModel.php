<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['uniqcode', 'name', 'email', 'phone', 'status', 'image', 'password'];

    const ERROR_USER_EXISTS = 'USER_EXISTS';

    const ERROR_USER_NOT_FOUND = 'USER_NOT_FOUND';
    const ERROR_USER_INACTIVE = 'USER_INACTIVE';
    const ERROR_INVALID_PASSWORD = 'INVALID_PASSWORD';
    const ERROR_SUCCESS = 'SUCCESS';

    protected $perPage = 10;

    public function getUserList($page = 1, $search = null)
    {
        $this->select('id, name, email, phone, status, image')
             ->orderBy('id', 'DESC');
        
        if ($search) {
            $this->like('name', $search)
                ->orLike('email', $search)
                ->orLike('phone', $search);
        }
        
        return $this->paginate($this->perPage, 'users', $page);
    }

    public function getUsersCount($search = null)
    {
        $builder = $this->select('id');
        
        if ($search) {
            $builder->like('name', $search)
                    ->orLike('email', $search)
                    ->orLike('phone', $search);
        }
        
        return $builder->countAllResults();
    }
    
    /**
     * Validate user credentials
     * @param string $credential User email or phone
     * @param string $password User password
     */
    public function validateCredentials($credential, $password)
    {
        $user = $this->where(['email' => $credential])
                     ->orWhere(['phone' => $credential])
                     ->first();

        if (!$user) {
            return self::ERROR_USER_NOT_FOUND;
        }

        if ($user['status'] !== 'active') {
            return self::ERROR_USER_INACTIVE;
        }

        if (!password_verify($password, $user['password'])) {
            return self::ERROR_INVALID_PASSWORD;
        }

        return self::ERROR_SUCCESS;
    }

    /**
     * Register a new user
     * @param array $userData User data containing name, email, phone, password
     * @return array Result with status and message
     */
    public function registerUser($userData)
    {
        // Check if user already exists
        $existingUser = $this->where(['email' => $userData['email']])
                            ->orWhere(['phone' => $userData['phone']])
                            ->first();

        if ($existingUser) {
            return [
                'status' => 'error',
                'message' => 'User already exists with this email or phone number'
            ];
        }

        // Hash the password
        $userData['password'] = md5($userData['password']);
        $userData['status'] = 'active';

        // Insert new user
        if ($this->insert($userData)) {
            $user = $this->where('email', $userData['email'])
                     ->first();
            return [
                'status' => 'success',
                'message' => 'User registered successfully',
                'data' => $user
            ];
        }

        return [
            'status' => 'error',
            'message' => 'Failed to register user',
            'data' => []
        ];
    }

    /**
    * @param string $credentialType Type of credential (email or phone)
    * @return array Validation result
    */
    public function validateUser($credential, $password, $credentialType)
    {
        // Check if the credential exists based on type
        $user = $this->where($credentialType, $credential)
                     ->first();

        if (!$user) {
            return [
                'status' => self::ERROR_USER_NOT_FOUND,
                'message' => 'Invalid credentials'
            ];
        }

        // Verify password
        if (md5($password) !== $user['password']) {
            return [
                'status' => self::ERROR_INVALID_PASSWORD,
                'message' => 'Invalid password'
            ];
        }

        // Check if user is active
        if ($user['status'] !== 'active') {
            return [
                'status' => self::ERROR_USER_INACTIVE,
                'message' => 'Account is inactive'
            ];
        }
        // Return user data on success
        return [
            'status' => self::ERROR_SUCCESS,
            'data' => $user
        ];
    }

    public function activeUser($uniqcode) {
        // First check if the uniqcode exists
        $user = $this->where('uniqcode', $uniqcode)
            ->where('status', 'active')
            ->first();

        if (!$user) {
            return [
                'status' => self::ERROR_USER_NOT_FOUND
            ];
        }
        // Return user data on success
        return [
            'status' => self::ERROR_SUCCESS,
        ];
    }
}
