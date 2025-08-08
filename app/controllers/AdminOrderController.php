<?php
require_once 'core/Controller.php';
require_once 'config.php';
session_start();

class AdminOrderController extends Controller
{
    private function guard()
    {
        if (($_SESSION['role'] ?? '') !== 'admin') {
            header("Location: ".BASE_URL."/Shop/index"); exit;
        }
    }

    /* list all orders */
    public function index()
    {
        $this->guard();
        $orders = $this->model('Order')->all();
        $this->view('admin/orders', ['orders'=>$orders]);
    }

    /* mark delivered */
    public function deliver()
    {
        $this->guard();
        $id = $_GET['id'] ?? null;
        if ($id) $this->model('Order')->setDelivered($id);
        header("Location: ".BASE_URL."/AdminOrder/index");
    }
}
