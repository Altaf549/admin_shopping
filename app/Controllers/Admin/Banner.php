<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\BannerModel;

class Banner extends Controller
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        $bannerModel = new \App\Models\BannerModel();
        $currentPage = $this->request->getGet('page_banners') ?? 1;
        $search = $this->request->getGet('search') ?? null;
        
        // Get the data first to ensure pager is initialized
        $banners = $bannerModel->getBannerList($currentPage, $search);
        
        // Add search query to pager if it exists
        if ($search) {
            $bannerModel->pager->addQuery('search', $search);
        }
        
        // Get all banners first
        $banners = $bannerModel->paginate(10, 'banners');
        
        // Add full URL to image paths for banners only if they are relative paths
        foreach ($banners as &$banner) {
            if ($banner['image'] && !preg_match('#^https?://#', $banner['image'])) {
                $banner['image'] = base_url($banner['image']);
            }
        }

        $data = [
            'banners' => $banners,
            'pager' => $bannerModel->pager,
            'total' => $bannerModel->getBannersCount($search),
            'title' => 'Banner Management',
            'page' => 'banner',
            'search' => $search
        ];
        return view('admin/banner.php', $data);
    }

    public function toggleStatus($id, $status)
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please login first.']);
        }

        try {
            $model = new BannerModel();
            $banner = $model->find($id);

            if (!$banner) {
                return $this->response->setJSON(['success' => false, 'message' => 'Banner not found.']);
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

    public function create()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please login first.']);
        }

        if ($this->request->getMethod() !== 'post') {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request method']);
        }

        $model = new BannerModel();
        $data = $this->request->getPost();
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        
        for ($i = 0; $i < 30; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        $data['uniqcode'] = $randomString;

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid()) {
            // Create uploads directory if it doesn't exist
            $uploadPath = 'uploads/banners';
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            $imageName = $image->getRandomName();
            $image->move($uploadPath, $imageName);
            // Store relative path in database
            $data['image'] = $uploadPath . '/' . $imageName;
        } else {
            // If no image is uploaded, set image to null
            $data['image'] = null;
        }

        try {
            $model->insert($data);
            $newBanner = $model->find($model->getInsertID());
            // Add full URL to image path for response only if it's not already a URL
            if ($newBanner['image'] && !preg_match('#^https?://#', $newBanner['image'])) {
                $newBanner['image'] = base_url($newBanner['image']);
            }
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Banner created successfully',
                'banner' => $newBanner
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to create banner: ' . $e->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please login first.']);
        }

        $model = new BannerModel();
        $banner = $model->find($id);

        if (!$banner) {
            return $this->response->setJSON(['success' => false, 'message' => 'Banner not found.']);
        }

        // Add full URL to image path if it exists
        if ($banner['image'] && !preg_match('#^https?://#', $banner['image'])) {
            $banner['image'] = base_url($banner['image']);
        }

        return $this->response->setJSON([
            'success' => true,
            'banner' => $banner
        ]);
    }

    public function update()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please login first.']);
        }

        if ($this->request->getMethod() !== 'post') {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request method']);
        }

        $model = new BannerModel();
        $id = $this->request->getPost('id');
        $banner = $model->find($id);

        if (!$banner) {
            return $this->response->setJSON(['success' => false, 'message' => 'Banner not found.']);
        }

        $data = $this->request->getPost();
        
        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid()) {
            // Delete old image if exists
            if ($banner['image']) {
                $oldImagePath = $banner['image'];
                // Remove base_url if it exists
                if (strpos($oldImagePath, base_url()) === 0) {
                    $oldImagePath = substr($oldImagePath, strlen(base_url()));
                }
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            // Create uploads directory if it doesn't exist
            $uploadPath = 'uploads/banners';
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            $imageName = $image->getRandomName();
            $image->move($uploadPath, $imageName);
            // Store relative path in database
            $data['image'] = $uploadPath . '/' . $imageName;
        }

        try {
            $model->update($id, $data);
            $updatedBanner = $model->find($id);
            // Add full URL to image path for response only if it's not already a URL
            if ($updatedBanner['image'] && !preg_match('#^https?://#', $updatedBanner['image'])) {
                $updatedBanner['image'] = base_url($updatedBanner['image']);
            }
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Banner updated successfully',
                'banner' => $updatedBanner
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update banner: ' . $e->getMessage()
            ]);
        }
    }
}
