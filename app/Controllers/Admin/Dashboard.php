<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Admin Dashboard',
            'page' => 'dashboard'
        ];
        
        return view('admin/dashboard', $data);
    }
}
