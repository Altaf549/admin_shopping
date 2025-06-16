<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
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
        
        $userModel = new UserModel();
        
        // Get form data
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        // Find user in database
        $user = $userModel->where('username', $username)->first();
        
        if ($user) {
            // Check if password matches (MD5 hash)
            $md5Password = md5($password);
            
            if ($md5Password === $user['password_hash']) {
                
                // Set session data
                $sessionData = [
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'is_admin' => $user['is_admin'],
                    'logged_in' => true
                ];
                
                // Set session
                $this->session->set($sessionData);
                
                // Verify session was set
                $sessionCheck = $this->session->get();
                
                // Redirect to admin dashboard for admin users
                if ($user['is_admin']) {
                    return redirect()->to('/admin/dashboard');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid username or password');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid username or password');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
