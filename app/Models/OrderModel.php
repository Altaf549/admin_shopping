<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'user_id',
        'total_amount',
        'status',
        'shipping_address',
        'payment_method',
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

    public function getOrdersWithDetails($status = null)
    {
        $builder = $this->select('orders.*, users.username, users.email')
            ->join('users', 'users.id = orders.user_id')
            ->orderBy('orders.created_at', 'DESC');

        if ($status !== null) {
            $builder->where('orders.status', $status);
        }

        return $builder->findAll();
    }

    public function getOrderDetails($orderId)
    {
        return $this->select('orders.*, users.username, users.email')
            ->join('users', 'users.id = orders.user_id')
            ->where('orders.id', $orderId)
            ->first();
    }

    public function updateOrderStatus($orderId, $status)
    {
        return $this->update($orderId, ['status' => $status]);
    }
}
