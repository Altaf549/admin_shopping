<?php

namespace App\Filters;

use CodeIgniter\Filter\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        if (!$session->has('logged_in') || !$session->get('is_admin')) {
            return redirect()->to('/login')->with('error', 'You must be logged in as an admin to access this page');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing to do here
    }
}
