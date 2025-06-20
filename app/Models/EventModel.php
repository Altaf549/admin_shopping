<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'tbl_event';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'type', 'status', 'image', 'uniqcode'];

    protected $perPage = 10;

    public function getEventList($page = 1, $search = null)
    {
        $this->select('id, name, description, type, status, image')
             ->orderBy('id', 'DESC');
        
        if ($search) {
            $this->like('name', $search)
                ->orLike('description', $search)
                ->orLike('type', $search);
        }
        
        return $this->paginate($this->perPage, 'events', $page);
    }

    public function getEventsCount($search = null)
    {
        $builder = $this->select('id');
        
        if ($search) {
            $builder->like('name', $search)
                    ->orLike('description', $search)
                    ->orLike('type', $search);
        }
        
        return $builder->countAllResults();
    }

    public function getActiveEvents()
    {
        return $this->where('status', 'active')
                    ->where('type', 'event')
                   ->orderBy('id', 'DESC')
                   ->findAll();
    }

    public function getActivePujas()
    {
        return $this->where('status', 'active')
                    ->where('type', 'puja')
                   ->orderBy('id', 'DESC')
                   ->findAll();
    }
}
