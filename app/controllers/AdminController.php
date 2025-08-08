<?php
require_once 'core/Controller.php';
require_once 'config.php';
session_start();

class AdminController extends Controller
{
    /* --- admin-only gate --- */
    private function guard() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: " . BASE_URL . "/Shop/index"); exit;
        }
    }

    /* LIST */
    public function index() {
        $this->guard();
        $all = $this->model('Product')->all();
        $this->view('admin/index', ['products' => $all]);
    }

    /* ADD */
    public function add() {
        $this->guard();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model('Product')->create($_POST);
            header("Location: " . BASE_URL . "/Admin/index"); exit;
        }
        $this->view('admin/form', ['mode' => 'add']);
    }

    /* EDIT */
    public function edit() {
        $this->guard();
        /* id may come by GET (first load) or hidden POST (update) */
        $id = $_GET['id'] ?? ($_POST['id'] ?? null);
        if (!$id) { header("Location: " . BASE_URL . "/Admin/index"); exit; }

        $pModel = $this->model('Product');

        /* save update */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pModel->update($id, $_POST);
            header("Location: " . BASE_URL . "/Admin/index"); exit;
        }

        /* load edit form */
        $prod = $pModel->find($id);
        $this->view('admin/form', ['mode'=>'edit', 'prod'=>$prod]);
    }

    /* DELETE  (id by query) */
    public function delete() {
        $this->guard();
        $id = $_GET['id'] ?? null;
        if ($id) $this->model('Product')->delete($id);
        header("Location: " . BASE_URL . "/Admin/index"); exit;
    }
}
