<?php
require_once 'core/Controller.php';
require_once 'config.php';
session_start();

class UserController extends Controller
{
    /* REGISTER */
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $id = $this->model('User')->create([
                'username'=>$_POST['username'],
                'email'   =>$_POST['email'],
                'password'=>password_hash($_POST['password'],PASSWORD_DEFAULT),
                'role'    =>'user'
            ]);

            $_SESSION['user_id'] = $id;
            $_SESSION['user']    = $_POST['username'];
            $_SESSION['role']    = 'user';
            header("Location: ".BASE_URL."/User/welcome"); exit;
        }
        $this->view('user/register');
    }

    /* LOGIN */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $u = $this->model('User')->checkLogin($_POST['email']);
            if ($u && password_verify($_POST['password'],$u['password'])) {
                $_SESSION['user_id'] = $u['id'];
                $_SESSION['user']    = $u['username'];
                $_SESSION['role']    = $u['role'];
                $dest = $u['role']==='admin' ? "/Admin/index" : "/User/welcome";
                header("Location: ".BASE_URL.$dest); exit;
            }
            echo "<p style='color:red;text-align:center'>Invalid credentials</p>";
        }
        $this->view('user/login');
    }

    /* WELCOME */
    public function welcome()
    {
        if (!isset($_SESSION['user_id'])) { header("Location: ".BASE_URL."/User/login"); exit; }
        $this->view('user/welcome', ['user'=>$_SESSION['user']]);
    }

    /* READ-ONLY PROFILE (no edit form here) */
    public function profile()
    {
        if (!isset($_SESSION['user_id'])) { header("Location: ".BASE_URL."/User/login"); exit; }
        $u = $this->model('User')->findById($_SESSION['user_id']);
        $this->view('user/profile', ['u'=>$u]);
    }

    /* EDIT PROFILE (only shown when user clicks “Edit Profile”) */
    public function edit()
    {
        if (!isset($_SESSION['user_id'])) { header("Location: ".BASE_URL."/User/login"); exit; }

        $userModel = $this->model('User');

        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $userModel->update($_SESSION['user_id'], [
                'username'=> trim($_POST['username'] ?? ''),
                'email'   => trim($_POST['email'] ?? ''),
                'phone'   => trim($_POST['phone'] ?? ''),
                'address' => trim($_POST['address'] ?? ''),
                'bio'     => trim($_POST['bio'] ?? '')
            ]);
            $_SESSION['user'] = $_POST['username'] ?? $_SESSION['user'];
            echo "<script>alert('Profile updated!');location='".BASE_URL."/User/profile';</script>";
            exit;
        }

        $u = $userModel->findById($_SESSION['user_id']);
        $this->view('user/edit', ['u'=>$u]);
    }

    /* LOGOUT */
    public function logout()
    {
        session_destroy();
        header("Location: ".BASE_URL."/User/login"); exit;
    }
}
