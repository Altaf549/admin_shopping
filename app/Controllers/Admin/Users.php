<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Users extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $users = $this->userModel->findAll();
        
        $data = [
            'title' => 'User Management',
            'page' => 'users',
            'users' => $users
        ];
        
        return view('admin/users/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add New User',
            'page' => 'users'
        ];
        
        return view('admin/users/create', $data);
    }

    public function store()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'is_admin' => $this->request->getPost('is_admin') ? 1 : 0
        ];

        $this->userModel->insert($data);
        
        return redirect()->to('/admin/users')->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }
        
        $data = [
            'title' => 'Edit User',
            'page' => 'users',
            'user' => $user
        ];
        
        return view('admin/users/edit', $data);
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);
        
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'is_admin' => $this->request->getPost('is_admin') ? 1 : 0
        ];

        if ($this->request->getPost('password')) {
            $data['password_hash'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);
        
        return redirect()->to('/admin/users')->with('success', 'User updated successfully');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        
        return redirect()->to('/admin/users')->with('success', 'User deleted successfully');
    }
}
