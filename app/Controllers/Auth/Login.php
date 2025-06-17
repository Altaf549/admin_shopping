<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\StaffModel;
use CodeIgniter\Session\Session;

class Login extends BaseController
{
    /**
     * @var Session
     */
    protected $session;
    
    public function __construct()
    {
        $this->session = \Config\Services::session();
        helper(['url', 'form']);
    }

    public function index()
    {
        return view('auth/login');
    }

    public function authenticate()
    {
        // Enable detailed error reporting for debugging
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        $staffModel = new StaffModel();
        
        // Get form data
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        // Authenticate staff member
        $staff = $staffModel->authenticate($email, $password);
        
        if ($staff) {
            if($staff['status'] == 'active') {
                // Set session data
                $sessionData = [
                    'staff_id' => $staff['id'],
                    'email' => $staff['email'],
                    'logged_in' => true
                ];
                
                // Set session
                $this->session->set($sessionData);
                
                // Redirect to admin dashboard
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->back()->with('error', 'Admin Not Aprrove');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid username or password');
        }
        
        return redirect()->back()->with('error', 'Invalid username or password');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
