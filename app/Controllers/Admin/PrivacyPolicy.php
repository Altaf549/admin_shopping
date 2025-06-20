<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PrivacyPolicyModel;

class PrivacyPolicy extends BaseController
{
    protected $privacyPolicyModel;

    public function __construct()
    {
        $this->privacyPolicyModel = new PrivacyPolicyModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Privacy Policy',
            'privacyPolicy' => $this->privacyPolicyModel->getPrivacyPolicy(),
            'page' => 'privacy_policy'
        ];

        return view('admin/privacy_policy', $data);
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

        $this->privacyPolicyModel->savePrivacyPolicy($data);

        return redirect()->back()->with('success', 'Privacy Policy updated successfully');
    }
}
