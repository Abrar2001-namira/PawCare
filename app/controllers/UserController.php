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

            // after sign-up, go straight to welcome
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

                // admins go to Admin dashboard, everyone else to welcome
                $dest = $u['role']==='admin'
                      ? "/Admin/index"
                      : "/User/welcome";

                header("Location: ".BASE_URL.$dest); exit;
            }
            echo "<p style='color:red;text-align:center'>Invalid credentials</p>";
        }
        $this->view('user/login');
    }

    /* WELCOME PAGE */
    public function welcome()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: ".BASE_URL."/User/login"); exit;
        }
        // pass username to view
        $this->view('user/welcome', ['user'=>$_SESSION['user']]);
    }

    /* LOGOUT */
    public function logout()
    {
        session_destroy();
        header("Location: ".BASE_URL."/User/login"); exit;
    }
}
