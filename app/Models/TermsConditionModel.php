<?php

namespace App\Models;

use CodeIgniter\Model;

class TermsConditionModel extends Model
{
    protected $table = 'tbl_terms_condition';
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

    public function getTermsCondition()
    {
        return $this->first();
    }

    public function saveTermsCondition($data)
    {
        $termsCondition = $this->getTermsCondition();
        
        if ($termsCondition) {
            return $this->update($termsCondition['id'], $data);
        }
        
        return $this->insert($data);
    }
}
