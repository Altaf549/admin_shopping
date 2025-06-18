<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\EventModel;

class Event extends Controller
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        $eventModel = new \App\Models\EventModel();
        $currentPage = $this->request->getGet('page_events') ?? 1;
        $search = $this->request->getGet('search') ?? null;
        
        // Get the data first to ensure pager is initialized
        $events = $eventModel->getEventList($currentPage, $search);
        
        // Add search query to pager if it exists
        if ($search) {
            $eventModel->pager->addQuery('search', $search);
        }
        
        $data = [
            'events' => $eventModel->paginate(10, 'events'),
            'pager' => $eventModel->pager,
            'total' => $eventModel->getEventsCount($search),
            'title' => 'Events Management',
            'page' => 'event',
            'search' => $search
        ];
        return view('admin/event.php', $data);
    }

    public function toggleStatus($id, $status)
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please login first.']);
        }

        try {
            $model = new EventModel();
            $event = $model->find($id);

            if (!$event) {
                return $this->response->setJSON(['success' => false, 'message' => 'Event not found.']);
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

        $model = new EventModel();
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
            $uploadPath = 'uploads/events';
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            $imageName = $image->getRandomName();
            $image->move($uploadPath, $imageName);
            $data['image'] = $data['image'] = base_url($uploadPath . '/' . $imageName);
        } else {
            // If no image is uploaded, set image to null
            $data['image'] = null;
        }

        try {
            $model->insert($data);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Event created successfully',
                'event' => $model->find($model->getInsertID())
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to create event: ' . $e->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please login first.']);
        }

        $model = new EventModel();
        $event = $model->find($id);

        if (!$event) {
            return $this->response->setJSON(['success' => false, 'message' => 'Event not found.']);
        }

        return $this->response->setJSON([
            'success' => true,
            'event' => $event
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

        $model = new EventModel();
        $id = $this->request->getPost('id');
        $event = $model->find($id);

        if (!$event) {
            return $this->response->setJSON(['success' => false, 'message' => 'Event not found.']);
        }

        $data = $this->request->getPost();
        
        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid()) {
            // Delete old image if exists
            if ($event['image']) {
                $oldImagePath = $event['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            // Create uploads directory if it doesn't exist
            $uploadPath = 'uploads/events';
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            $imageName = $image->getRandomName();
            $image->move($uploadPath, $imageName);
            $data['image'] = $uploadPath . '/' . $imageName;
        } else {
            // Keep existing image if no new image is uploaded
            $data['image'] = $event['image'];
        }

        try {
            $model->update($id, $data);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Event updated successfully',
                'event' => $model->find($id)
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update event: ' . $e->getMessage()
            ]);
        }
    }
}
