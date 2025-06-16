<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'username',
        'email',
        'password_hash',
        'is_admin',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = '';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function findByUsername(string $username)
    {
        return $this->where('username', $username)->first();
    }

    public function findByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }

    public function createAdminUser($data)
    {
        $data['is_admin'] = 1;
        return $this->insert($data);
    }
}
