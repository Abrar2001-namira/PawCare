<?php
require_once 'core/Controller.php';
require_once 'config.php';
session_start();

class AdminPetController extends Controller
{
    /* --- admin-only gate --- */
    private function guard()
    {
        if (($_SESSION['role'] ?? '') !== 'admin') {
            header("Location: " . BASE_URL . "/Shop/index");
            exit;
        }
    }

    /* LIST */
    public function index()
    {
        $this->guard();
        $pets = $this->model('Pet')->all();
        $this->view('admin/pets', ['pets' => $pets]);
    }

    /* ADD */
    public function add()
    {
        $this->guard();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model('Pet')->create($_POST);
            header("Location: " . BASE_URL . "/AdminPet/index"); exit;
        }
        $this->view('admin/pet_form', ['mode' => 'add']);
    }

    /* EDIT */
    public function edit()
    {
        $this->guard();
        $id = $_GET['id'] ?? ($_POST['id'] ?? null);
        if (!$id) { header("Location: " . BASE_URL . "/AdminPet/index"); exit; }

        $pModel = $this->model('Pet');

        /* save update */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pModel->update($id, $_POST);
            header("Location: " . BASE_URL . "/AdminPet/index"); exit;
        }

        /* load edit form */
        $pet = $pModel->find($id);
        $this->view('admin/pet_form', ['mode'=>'edit', 'pet'=>$pet]);
    }

    /* DELETE */
    public function delete()
    {
        $this->guard();
        $id = $_GET['id'] ?? null;
        if ($id) $this->model('Pet')->delete($id);
        header("Location: " . BASE_URL . "/AdminPet/index"); exit;
    }
}
