<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TermsConditionModel;

class TermsCondition extends BaseController
{
    protected $termsConditionModel;

    public function __construct()
    {
        $this->termsConditionModel = new TermsConditionModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Terms & Conditions',
            'termsCondition' => $this->termsConditionModel->getTermsCondition(),
            'page' => 'terms_condition'
        ];

        return view('admin/terms_condition', $data);
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

        $this->termsConditionModel->saveTermsCondition($data);

        return redirect()->back()->with('success', 'Terms & Conditions updated successfully');
    }
}
