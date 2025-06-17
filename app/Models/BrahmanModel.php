<?php

namespace App\Models;

use CodeIgniter\Model;

class BrahmanModel extends Model
{
    protected $table = 'tbl_admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'status', 'image', 'aadhaar_image', 'aadhaar_no', 'address', 'city', 'state', 'pincode'];

    public function getBrahmanList()
    {
        return $this->select('id, name, status, image, aadhaar_image, aadhaar_no, address, city, state, pincode')
                    ->orderBy('id', 'DESC')
                    ->findAll();
    }
}
