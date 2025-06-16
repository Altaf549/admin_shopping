<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'category_id',
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

    public function findByCategory($categoryId)
    {
        return $this->where('category_id', $categoryId)->findAll();
    }

    public function getFeaturedProducts($limit = 5)
    {
        return $this->orderBy('created_at', 'DESC')->limit($limit)->findAll();
    }
}
