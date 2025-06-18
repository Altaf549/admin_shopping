<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'phone', 'status', 'image'];

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
}
