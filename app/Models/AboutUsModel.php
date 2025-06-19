<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutUsModel extends Model
{
    protected $table = 'tbl_about_us';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['uniqcode', 'description'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function getAboutUs()
    {
        return $this->first();
    }

    public function saveAboutUs($data)
    {
        $aboutUs = $this->getAboutUs();
        
        if ($aboutUs) {
            return $this->update($aboutUs['id'], $data);
        }
        
        return $this->insert($data);
    }
}
