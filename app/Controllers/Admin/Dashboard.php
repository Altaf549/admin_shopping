<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        $data = [
            'title' => 'Admin Dashboard',
            'page' => 'dashboard'
        ];
        
        return view('admin/dashboard', $data);
    }
}
