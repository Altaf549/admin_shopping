<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AboutUsModel;

class AboutUs extends BaseController
{
    protected $aboutUsModel;

    public function __construct()
    {
        $this->aboutUsModel = new AboutUsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'About Us',
            'aboutUs' => $this->aboutUsModel->getAboutUs(),
            'page' => 'about-us'
        ];

        return view('admin/about_us', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'description' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $helperPath = APPPATH . 'Helpers/StringHelper.php';
        require_once $helperPath;
        $uniqcode = \randomString();
        $data = [
            'uniqcode' => $uniqcode,
            'description' => $this->request->getPost('description'),
        ];

        $this->aboutUsModel->saveAboutUs($data);

        return redirect()->back()->with('success', 'About Us content updated successfully');
    }
}
