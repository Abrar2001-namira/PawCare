<?php
require_once 'core/Controller.php';
require_once 'config.php';
session_start();

class AdminAdoptionController extends Controller
{
    private function guard() {
        if (($_SESSION['role'] ?? '') !== 'admin') {
            header("Location: ".BASE_URL."/User/login"); exit;
        }
    }

    public function index()
    {
        $this->guard();
        $apps = $this->model('Adoption')->all(); // includes pet info
        $this->view('admin/adoptions', ['apps'=>$apps]);
    }

    public function accept()
    {
        $this->guard();
        $id = $_GET['id'] ?? null;
        if(!$id){ header("Location: ".BASE_URL."/AdminAdoption/index"); exit; }

        $app = $this->model('Adoption')->find($id);
        if(!$app){ header("Location: ".BASE_URL."/AdminAdoption/index"); exit; }

        // 1) mark application accepted
        $this->model('Adoption')->setStatus($id, 'accepted');
        // 2) mark the pet as adopted
        $this->model('Pet')->setAdopted($app['pet_id'], 1);
        // 3) auto-reject all other pending apps for this pet
        $this->model('Adoption')->closeOthersForPet($app['pet_id'], $id);

        header("Location: ".BASE_URL."/AdminAdoption/index"); exit;
    }

    public function reject()
    {
        $this->guard();
        $id = $_GET['id'] ?? null;
        if(!$id){ header("Location: ".BASE_URL."/AdminAdoption/index"); exit; }

        $this->model('Adoption')->setStatus($id, 'rejected');
        header("Location: ".BASE_URL."/AdminAdoption/index"); exit;
    }
}
