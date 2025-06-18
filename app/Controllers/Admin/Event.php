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
}
