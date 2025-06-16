<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\OrderModel;

class Orders extends Controller
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    public function index()
    {
        $orders = $this->orderModel->getOrdersWithDetails();
        
        $data = [
            'title' => 'Order Management',
            'page' => 'orders',
            'orders' => $orders,
            'statusOptions' => [
                'pending' => 'Pending',
                'processing' => 'Processing',
                'shipped' => 'Shipped',
                'delivered' => 'Delivered',
                'cancelled' => 'Cancelled'
            ]
        ];
        
        return view('admin/orders/index', $data);
    }

    public function view($orderId)
    {
        $order = $this->orderModel->getOrderDetails($orderId);
        
        if (!$order) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Order not found');
        }
        
        $data = [
            'title' => 'View Order #' . $orderId,
            'page' => 'orders',
            'order' => $order
        ];
        
        return view('admin/orders/view', $data);
    }

    public function updateStatus($orderId)
    {
        $status = $this->request->getPost('status');
        
        if (!$status) {
            return redirect()->back()->with('error', 'Status is required');
        }

        $this->orderModel->updateOrderStatus($orderId, $status);
        
        return redirect()->back()->with('success', 'Order status updated successfully');
    }
}
