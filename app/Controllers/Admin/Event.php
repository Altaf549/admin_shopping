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
        
        // Get all events first
        $events = $eventModel->paginate(10, 'events');
        
        // Add full URL to image paths for events only if they are relative paths
        foreach ($events as &$event) {
            if ($event['image'] && !preg_match('#^https?://#', $event['image'])) {
                $event['image'] = base_url($event['image']);
            }
        }

        $data = [
            'events' => $events,
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
        $helperPath = APPPATH . 'Helpers/StringHelper.php';
        require_once $helperPath;
        $data['uniqcode'] = \randomString();

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
            // Store relative path in database
            $data['image'] = $uploadPath . '/' . $imageName;
        } else {
            // If no image is uploaded, set image to null
            $data['image'] = null;
        }

        try {
            $model->insert($data);
            $newEvent = $model->find($model->getInsertID());
            // Add full URL to image path for response only if it's not already a URL
            if ($newEvent['image'] && !preg_match('#^https?://#', $newEvent['image'])) {
                $newEvent['image'] = base_url($newEvent['image']);
            }
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Event created successfully',
                'event' => $newEvent
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

        // Add full URL to image path if it exists
        if ($event['image'] && !preg_match('#^https?://#', $event['image'])) {
            $event['image'] = base_url($event['image']);
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
                // Remove base_url if it exists
                if (strpos($oldImagePath, base_url()) === 0) {
                    $oldImagePath = substr($oldImagePath, strlen(base_url()));
                }
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
            $updatedEvent = $model->find($id);
            // Add full URL to image path for response only if it's not already a URL
            if ($updatedEvent['image'] && !preg_match('#^https?://#', $updatedEvent['image'])) {
                $updatedEvent['image'] = base_url($updatedEvent['image']);
            }
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Event updated successfully',
                'event' => $updatedEvent
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update event: ' . $e->getMessage()
            ]);
        }
    }
}
