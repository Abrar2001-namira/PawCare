<?php
require_once 'core/Controller.php';
require_once 'config.php';
session_start();

class AdminDonationController extends Controller
{
    private function guard()
    {
        if (($_SESSION['role'] ?? '') !== 'admin') {
            header("Location: ".BASE_URL."/Shop/index"); exit;
        }
    }

    public function index()
    {
        $this->guard();
        $list = $this->model('Donation')->all();   // joined with shelters
        $this->view('admin/donations', ['donations'=>$list]);
    }
}
