<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table = 'tbl_staff';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['uniqcode', 'password', 'email', 'status'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function authenticate($email, $password)
    {
        // Get staff member by email
        $staff = $this->where('email', $email)->first();
        if ($staff) {
            // Verify password (assuming MD5 hash)
            if (md5($password) === $staff['password']) {
                return $staff;
            }
        }
        
        return null;
    }
}
