<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
    protected $table = 'tbl_banner';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'subtitle', 'image', 'button_text', 'button_link', 'status', 'uniqcode'];

    protected $perPage = 10;

    public function getBannerList($page = 1, $search = null)
    {
        $this->select('id, title, subtitle, image, button_text, button_link, status')
             ->orderBy('id', 'DESC');
        
        if ($search) {
            $this->like('title', $search)
                ->orLike('subtitle', $search)
                ->orLike('button_text', $search)
                ->orLike('button_link', $search);
        }
        
        return $this->paginate($this->perPage, 'banners', $page);
    }

    public function getBannersCount($search = null)
    {
        $builder = $this->select('id');
        
        if ($search) {
            $builder->like('title', $search)
                    ->orLike('subtitle', $search)
                    ->orLike('button_text', $search)
                    ->orLike('button_link', $search);
        }
        
        return $builder->countAllResults();
    }

    public function getActiveBanners()
    {
        return $this->where('status', 'active')
                   ->orderBy('id', 'DESC')
                   ->findAll();
    }
}
