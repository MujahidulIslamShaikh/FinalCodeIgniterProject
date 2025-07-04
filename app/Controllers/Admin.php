<?php


namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{
    public function login()
    {
        return view('/admin/login');
    }

    public function checkLogin()
    {
        $username = $this->request->getPost('username');
        $pass = $this->request->getPost('pass');

        $adminModel = new AdminModel();
        $admin = $adminModel->where('username', $username)->first();

        if ($admin && $admin['pass'] == $pass) {
            session()->set('isAdminLoggedIn', true);
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function dashboard()
    {
        if (!session()->get('isAdminLoggedIn')) return redirect()->to('/admin/login');
        return view('admin/dashboard');
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }
   
}
