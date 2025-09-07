<?php
require_once 'core/Controller.php';
require_once 'config.php';
session_start();

class VaccinationController extends Controller
{
    private function guard() {
        if (!isset($_SESSION['user_id'])) { header("Location: ".BASE_URL."/User/login"); exit; }
    }

    /* List + Add form */
    public function index()
    {
        $this->guard();

        $m = $this->model('Vaccination');

        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $pet    = trim($_POST['pet_name'] ?? '');
            $vac    = trim($_POST['vaccine']  ?? '');
            $dose   = trim($_POST['dose']     ?? '');
            $due    = trim($_POST['due_date'] ?? '');
            $notes  = trim($_POST['notes']    ?? '');

            if ($pet==='' || $vac==='' || $due==='') {
                echo "<script>alert('Please fill Pet Name, Vaccine and Due Date');history.back();</script>"; exit;
            }

            $m->create([
                'user_id'  => $_SESSION['user_id'],
                'pet_name' => $pet,
                'vaccine'  => $vac,
                'dose'     => $dose,
                'due_date' => date('Y-m-d', strtotime($due)),
                'notes'    => $notes
            ]);

            header("Location: ".BASE_URL."/Vaccination/index"); exit;
        }

        $list = $m->byUser($_SESSION['user_id']);
        $this->view('vaccination/index', ['list'=>$list]);
    }

    public function done()
    {
        $this->guard();
        $id = (int)($_GET['id'] ?? 0);
        if ($id) $this->model('Vaccination')->setStatus($id, $_SESSION['user_id'], 'done');
        header("Location: ".BASE_URL."/Vaccination/index"); exit;
    }

    public function schedule()
    {
        $this->guard();
        $id = (int)($_GET['id'] ?? 0);
        if ($id) $this->model('Vaccination')->setStatus($id, $_SESSION['user_id'], 'scheduled');
        header("Location: ".BASE_URL."/Vaccination/index"); exit;
    }

    public function delete()
    {
        $this->guard();
        $id = (int)($_GET['id'] ?? 0);
        if ($id) $this->model('Vaccination')->delete($id, $_SESSION['user_id']);
        header("Location: ".BASE_URL."/Vaccination/index"); exit;
    }
}
