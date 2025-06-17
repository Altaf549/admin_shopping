<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\BrahmanModel;

class Brahman extends Controller
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        $brahmanModel = new \App\Models\BrahmanModel();
        $currentPage = $this->request->getGet('page_brahmans') ?? 1;
        $search = $this->request->getGet('search') ?? null;
        
        // Get the data first to ensure pager is initialized
        $brahmans = $brahmanModel->getBrahmanList($currentPage, $search);
        
        // Add search query to pager if it exists
        if ($search) {
            $brahmanModel->pager->addQuery('search', $search);
        }
        
        $data = [
            'brahmans' => $brahmanModel->paginate(10, 'brahmans'),
            'pager' => $brahmanModel->pager,
            'total' => $brahmanModel->getBrahmansCount($search),
            'title' => 'Brahman Details',
            'page' => 'brahman',
            'search' => $search
        ];
        return view('admin/brahman.php', $data);
    }

    public function toggleStatus($id, $status)
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please login first.']);
        }

        try {
            $model = new BrahmanModel();
            $brahman = $model->find($id);

            if (!$brahman) {
                return $this->response->setJSON(['success' => false, 'message' => 'Brahman not found.']);
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
