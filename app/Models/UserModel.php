<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'phone', 'status', 'image'];

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
     * @param string $email User email
     * @param string $password User password
     * @return array Validation result
     */
    public function validateUser($email, $password)
    {
        // First check if the email exists
        $user = $this->where('email', $email)
                    ->first();

        if (!$user) {
            return [
                'status' => self::ERROR_USER_NOT_FOUND,
                'message' => 'User not found'
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
