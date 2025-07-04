<?php


namespace App\Controllers;

use App\Models\SignupModel;
use PHPUnit\Util\Json;
use ReturnTypeWillChange;

class Auth extends BaseController
{
    // ========== Signup Section =================================
    public function signup_user()
    {
        return view('/signupView');
    }
    public function loginuserlist()
    {
        $model = new SignupModel();
        return view('/LoginUserListView', ['Login_user_list' => $model->findAll()]);
    }
    public function dosignup_user()
    {
        $username = $this->request->getPost('username');
        $useremail = $this->request->getPost('email');
        $pass = $this->request->getPost('pass');
        if (strlen($useremail) < 3 || strlen($pass) < 4) {
            return redirect()->back()->with('error', 'Username or password too short');
        }

        $signupModel = new SignupModel();
        $existing = $signupModel->where('email', $useremail)->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Email already taken');
        }

        $signupModel->insert([
            'username' => $username,
            'email' => $useremail,
            'pass' => password_hash($pass, PASSWORD_DEFAULT),
        ]);

        $email = \Config\Services::email();

        $email->setTo($useremail); // jisko bhejna hai
        $email->setFrom('codewith247@gmail.com', 'CodeWith247 App'); // aapka gmail
        $email->setSubject('Welcome to My App');
        $email->setMessage('<h2>Thanks for signing up!</h2><p>You are now part of the system.</p>');

        if ($email->send()) {
            echo "Email sent successfully.";
        } else {
            echo $email->printDebugger(['headers']);
        }

        return redirect()->to('/login-user')->with('success', 'Registration successful. Please log in.');
    }
    // ========== Login Section =================================


    public function login()
    {
        // return "<pre>". print_r(session()->get()) ."</pre>";
        // return view('auth/login');
        return view('loginView');
    }

    public function loginAction()
    {
        $session = session();
        $model = new SignupModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('pass');
        // return "login action " . $password;


        $user = $model->where('email', $email)->first();  // yaha per email se verify hokar user ka pura data aara 
        // return "<pre>" . print_r($user, true) . "</pre>"; 

        if ($user && password_verify($password, $user['pass'])) {
            $session->set([
                'isLoggedIn' => true,
                'userId'     => $user['id'],
                'userEmail'  => $user['email'],
                'userName'   => $user['username'],
            ]);
            // return redirect()->to('/dashboard');
            return redirect()->to('/');
            // return "<pre>" . print_r($session->get()) . "</pre>";
        } else {
            return redirect()->back()->with('error', 'Invalid login credentials');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }


    // ========== Forgot Section =================================

    public function forgot()
    {
        return view('/forgot');
    }
    public function handleForgot()
    {
        $email = $this->request->getPost('email');
        $model = new SignupModel();
        $user = $model->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('msg', 'Email not found');
        }

        $token = bin2hex(random_bytes(20));
        $model->update($user['id'], ['reset_token' => $token]);

        $resetLink = base_url('reset-password/' . $token);
        return redirect()->back()->with('msg', "Reset link: $resetLink");
    }

    public function resetForm($token)
    {
        return view('reset', ['token' => $token]);
    }

    public function resetPassword($token)
    {
        $pass = $this->request->getPost('pass');
        $model = new SignupModel();
        $user = $model->where('reset_token', $token)->first();

        if (!$user) {
            return "Invalid or expired token";
        }

        $model->update($user['id'], [
            'pass' => password_hash($pass, PASSWORD_DEFAULT),
            'reset_token' => null,
        ]);

        return "Password updated! <a href='/login-user'>Login</a>";
    }
    public function testEmail()
    {
        $gmail = $this->request->getGet('email'); // getting ?email=... from URL

        $email = \Config\Services::email();

        $email->setTo($gmail); // jisko bhejna hai
        $email->setFrom('codewith247@gmail.com', 'CodeWith247 App'); // aapka gmail
        $email->setSubject('Welcome to My App');
        $email->setMessage('<h2>Thanks for signing up!</h2><p>You are now part of the system.</p>');

        if ($email->send()) {
            echo "Email sent successfully.";
        } else {
            echo $email->printDebugger(['headers']);
        }
    }
}



//  public function login_user()
//     {
//         return view('/loginView');
//     }

//     public function dologin_user()
//     {
//         $email = $this->request->getPost('email');
//         $pass = $this->request->getPost('pass');

//         $model = new SignupModel();
//         $user = $model->where('email', $email)->first();
//         session()->set([
//             'email' => $user['email'],
//             'role' => $user['role'],  // if added
//         ]);

//         if ($user && password_verify($pass, $user['pass'])) {
//             session()->set('user', $user['email']);
//             return redirect()->to('/');
//         }

//         return redirect()->back()->with('error', 'Invalid login');
//     }

//     public function logout()
//     {
//         session()->destroy();
//         return redirect()->to('/login-user');
//     }