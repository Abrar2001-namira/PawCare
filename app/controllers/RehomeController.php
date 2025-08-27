<?php
require_once 'core/Controller.php';
require_once 'config.php';
session_start();

class RehomeController extends Controller
{
    private function guard() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: ".BASE_URL."/User/login"); exit;
        }
    }

    /* GET: show form, POST: save request */
    public function request()
    {
        $this->guard();

        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $data = [
                'user_id'    => $_SESSION['user_id'],
                'owner_name' => trim($_POST['owner_name'] ?? $_SESSION['user']),
                'owner_email'=> trim($_POST['owner_email'] ?? ''),
                'owner_phone'=> trim($_POST['owner_phone'] ?? ''),
                'address'    => trim($_POST['address'] ?? ''),
                'name'       => trim($_POST['name'] ?? ''),
                'species'    => trim($_POST['species'] ?? 'Dog'),
                'age'        => trim($_POST['age'] ?? ''),
                'breed'      => trim($_POST['breed'] ?? ''),
                'vaccinated' => (int)($_POST['vaccinated'] ?? 1),
                'image'      => trim($_POST['image'] ?? ''),
                'story'      => trim($_POST['story'] ?? '')
            ];

            // simple validations
            if ($data['name']==='' || $data['image']==='') {
                echo "<script>alert('Please provide pet name and a photo URL.');history.back();</script>"; exit;
            }

            $id = $this->model('Rehome')->create($data);
            header("Location: ".BASE_URL."/Rehome/thanks?id=".$id); exit;
        }

        // prefill from logged user (optional)
        $u = $this->model('User')->findById($_SESSION['user_id']);
        $this->view('rehome/request', ['u'=>$u]);
    }

    public function thanks()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) { header("Location: ".BASE_URL."/User/profile"); exit; }
        $req = $this->model('Rehome')->find($id);
        if (!$req) { header("Location: ".BASE_URL."/User/profile"); exit; }
        $this->view('rehome/thanks', ['r'=>$req]);
    }
}
