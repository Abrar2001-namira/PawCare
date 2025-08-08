<?php
require_once 'core/Controller.php';
require_once 'config.php';
session_start();

class OrderController extends Controller
{
    /* /Order/index → list current user’s orders */
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {          // not logged-in
            header("Location: ".BASE_URL."/User/login"); exit;
        }

        $orders = $this->model('Order')->byUser($_SESSION['user_id']);
        $this->view('orders/index', ['orders'=>$orders]);
    }
}
