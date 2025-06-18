<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\UserModel;

class User extends Controller
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        $userModel = new \App\Models\UserModel();
        $currentPage = $this->request->getGet('page_users') ?? 1;
        $search = $this->request->getGet('search') ?? null;
        
        // Get the data first to ensure pager is initialized
        $users = $userModel->getUserList($currentPage, $search);
        
        // Add search query to pager if it exists
        if ($search) {
            $userModel->pager->addQuery('search', $search);
        }
        
        $data = [
            'users' => $userModel->paginate(10, 'users'),
            'pager' => $userModel->pager,
            'total' => $userModel->getUsersCount($search),
            'title' => 'User Details',
            'page' => 'users',
            'search' => $search
        ];
        return view('admin/users.php', $data);
    }

    public function toggleStatus($id, $status)
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please login first.']);
        }

        try {
            $model = new UserModel();
            $user = $model->find($id);

            if (!$user) {
                return $this->response->setJSON(['success' => false, 'message' => 'User not found.']);
            }

            // Update status directly with the provided status
            $model->update($id, ['status' => $status]);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Status updated successfully'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ]);
        }
    }
}
