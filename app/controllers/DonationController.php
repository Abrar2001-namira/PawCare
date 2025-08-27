<?php
require_once 'core/Controller.php';
require_once 'config.php';
session_start();

class DonationController extends Controller
{
    /* Landing page (hero + info + stats + Donate Now button) */
    public function index()
    {
        $stats = $this->model('Donation')->stats();
        $this->view('donation/index', [
            'stats'    => $stats
        ]);
    }

    /* Show the donation form */
    public function give()
    {
        $shelters = $this->model('Shelter')->all();
        $this->view('donation/give', [
            'shelters' => $shelters,
            'username' => $_SESSION['user'] ?? '',
            'email'    => ''   // prefill if you want later
        ]);
    }

    /* Handle submit */
    public function submit()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: ".BASE_URL."/Donation/give"); exit;
        }

        $amount    = (float)($_POST['amount'] ?? 0);
        $shelterId = $_POST['shelter_id'] ?? null;

        if ($amount <= 0 || !$shelterId) {
            echo "<script>alert('Please select a shelter and enter a valid amount.');history.back();</script>";
            exit;
        }

        $data = [
            'user_id'    => $_SESSION['user_id'] ?? null,
            'name'       => trim($_POST['name'] ?? ($_SESSION['user'] ?? '')),
            'email'      => trim($_POST['email'] ?? ''),
            'shelter_id' => $shelterId,
            'amount'     => $amount,
            'note'       => trim($_POST['note'] ?? '')
        ];

        $id = $this->model('Donation')->create($data);
        header("Location: ".BASE_URL."/Donation/thanks?id=".$id); exit;
    }

    /* Thank-you page */
    public function thanks()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) { header("Location: ".BASE_URL."/Donation/index"); exit; }

        $don = $this->model('Donation')->find($id);
        if (!$don) { header("Location: ".BASE_URL."/Donation/index"); exit; }

        $this->view('donation/thanks', ['donation'=>$don]);
    }
}
