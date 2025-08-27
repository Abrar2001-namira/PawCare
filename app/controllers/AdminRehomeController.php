<?php
require_once 'core/Controller.php';
require_once 'config.php';
session_start();

class AdminRehomeController extends Controller
{
    private function guard() {
        if (($_SESSION['role'] ?? '') !== 'admin') {
            header("Location: ".BASE_URL."/User/login"); exit;
        }
    }

    public function index()
    {
        $this->guard();
        $list = $this->model('Rehome')->all();
        $this->view('admin/rehomes', ['list'=>$list]);
    }

    public function accept()
    {
        $this->guard();
        $id = $_GET['id'] ?? null; if(!$id){ header("Location: ".BASE_URL."/AdminRehome/index"); exit; }
        $req = $this->model('Rehome')->find($id); if(!$req){ header("Location: ".BASE_URL."/AdminRehome/index"); exit; }

        // Create a PET entry from request (available by default)
        $this->model('Pet')->create([
            'name'        => $req['name'],
            'species'     => $req['species'],
            'age'         => $req['age'],
            'breed'       => $req['breed'],
            'vaccinated'  => $req['vaccinated'],
            'adopted'     => 0,
            'image'       => $req['image'],
            'story'       => $req['story'],
            'phone'       => $req['owner_phone'],
            'email'       => $req['owner_email'],
            'location'    => $req['address']    // ⬅️ use Location
        ]);

        $this->model('Rehome')->setStatus($id,'accepted');
        echo "<script>alert('Request accepted. Pet added to list!');location='".BASE_URL."/AdminRehome/index';</script>";
        exit;
    }

    public function reject()
    {
        $this->guard();
        $id = $_GET['id'] ?? null; if(!$id){ header("Location: ".BASE_URL."/AdminRehome/index"); exit; }
        $this->model('Rehome')->setStatus($id,'rejected');
        header("Location: ".BASE_URL."/AdminRehome/index"); exit;
    }
}
