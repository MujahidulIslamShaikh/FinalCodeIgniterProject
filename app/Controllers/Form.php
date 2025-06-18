<?php


namespace app\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Config\View;

class Form extends BaseController
{

    public function index()
    {
        if (!session()->get('user')) {
            return redirect()->to('/login-user');
        }
        return view('index');
    }
    public function listApi()
    {
        return view('user_list_api');
    }
    public function formreturn()
    {
        if (!session()->get('user')) {
            return redirect()->to('/login-user');
        }
        return view('/form');
    }

    public function submit()
    {
        $name = $this->request->getPost('username');
        $role = $this->request->getPost('role');
        $cont_num = $this->request->getPost('cont_num');
        // return "You Submitted : " . esc($name). esc($email) . esc($role);

        if (empty($name)) {
            return "Name is required !";
        }

        $userModel = new UserModel();

        $userModel->insert([
            'name' => $name,
            'role' => $role,
            'cont_num' => $cont_num
        ]);

        // return 'User saved :  ' . esc($name) . esc($role);


        // Redirect to user_list page
        return redirect()->to('/user_list');
    }

    public function list()
    {
        if (!session()->get('user')) return redirect()->to('/login-user');
        $userModel = new UserModel();
        // $data['db_table_user_data'] = $userModel->findAll();
        // $data = [
        //     'products' => $userModel->paginate(3,'users'),
        //     'pager' => $userModel->pager
        // ]; 
        $search = $this->request->getGet('q'); // Get query from input

        if ($search) {
            $userModel->like('name', $search)
                ->orLike('role', $search)
                ->orLike('cont_num', $search);
        }

        $data = [
            'products' => $userModel->paginate(4, 'users'),
            'pager' => $userModel->pager,
            'search' => $search
        ];


        return view('user_list', $data);
    }

    public function delete_user($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to('/user_list');
    }


    public function edit_user($id)
    {
        $userModel = new userModel();
        $data['user'] = $userModel->find($id);
        return view('edit_user', $data);
    }

    public function update_user($id)
    {
        $name = $this->request->getPost('username');
        $role = $this->request->getPost('role');
        $cont_num = $this->request->getPost('cont_num');

        $userModel = new userModel();

        $userModel->update($id, [
            'name' => $name,
            'role' => $role,
            'cont_num' => $cont_num
        ]);

        return redirect()->to('/user_list');
    }
}
