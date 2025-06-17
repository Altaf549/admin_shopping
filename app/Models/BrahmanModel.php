<?php

namespace App\Models;

use CodeIgniter\Model;

class BrahmanModel extends Model
{
    protected $table = 'tbl_admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'phone', 'status', 'image', 'aadhaar_image', 'aadhaar_no', 'address', 'city', 'state', 'pincode'];

    protected $perPage = 10;

    public function getBrahmanList($page = 1, $search = null)
    {
        $builder = $this->select('id, name, phone, status, image, aadhaar_image, aadhaar_no, address, city, state, pincode')
                        ->orderBy('id', 'DESC');
        
        if ($search) {
            $builder->like('name', $search)
                    ->orLike('phone', $search)
                    ->orLike('aadhaar_no', $search)
                    ->orLike('address', $search)
                    ->orLike('city', $search)
                    ->orLike('state', $search)
                    ->orLike('pincode', $search);
        }
        
        return $builder->paginate($this->perPage, 'brahmans', $page);
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
}
