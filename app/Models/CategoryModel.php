<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'name',
        'description',
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

    public function getCategoriesWithProductCount()
    {
        return $this->select('categories.*, COUNT(products.id) as product_count')
            ->join('products', 'products.category_id = categories.id', 'left')
            ->groupBy('categories.id')
            ->orderBy('categories.name')
            ->findAll();
    }

    public function getCategoryWithProducts($categoryId)
    {
        return $this->select('categories.*, COUNT(products.id) as product_count')
            ->join('products', 'products.category_id = categories.id', 'left')
            ->where('categories.id', $categoryId)
            ->groupBy('categories.id')
            ->first();
    }
}
