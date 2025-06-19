<?php

namespace App\Models;

use CodeIgniter\Model;

class PrivacyPolicyModel extends Model
{
    protected $table = 'tbl_privacy_policy';
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

    public function getPrivacyPolicy()
    {
        return $this->first();
    }

    public function savePrivacyPolicy($data)
    {
        $privacyPolicy = $this->getPrivacyPolicy();
        
        if ($privacyPolicy) {
            return $this->update($privacyPolicy['id'], $data);
        }
        
        return $this->insert($data);
    }
}
