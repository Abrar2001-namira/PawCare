<?php
require_once 'core/Controller.php';
require_once 'config.php';
session_start();

class AdoptionController extends Controller
{
    /* Show guidelines + form for a specific pet */
    public function apply()
    {
        $petId = $_GET['pet_id'] ?? ($_POST['pet_id'] ?? null);
        if (!$petId) { header("Location: ".BASE_URL."/Pet/index"); exit; }

        $pet = $this->model('Pet')->find($petId);
        if (!$pet)  { header("Location: ".BASE_URL."/Pet/index"); exit; }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            /* basic validation */
            if (empty($_POST['applicant_name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['city_state']) || empty($_POST['agree'])) {
                echo "<script>alert('Please fill the required fields and agree to the guidelines.');history.back();</script>";
                exit;
            }

            /* turn checkbox arrays into comma strings */
            $join = function($key) { return isset($_POST[$key]) ? implode(', ', (array)$_POST[$key]) : ''; };

            $data = [
                'user_id'        => $_SESSION['user_id'] ?? null,
                'pet_id'         => $petId,
                'applicant_name' => trim($_POST['applicant_name']),
                'email'          => trim($_POST['email']),
                'phone'          => trim($_POST['phone']),
                'city_state'     => trim($_POST['city_state']),
                'can_text'       => (int)($_POST['can_text'] ?? 0),
                'heard_about'    => $join('heard'),
                'current_pets'   => $join('current_pets'),
                'looking_for'    => $join('looking_for'),
                'house_type'     => $join('house_type'),
                'house_members'  => trim($_POST['house_members'] ?? ''),
                'notes'          => trim($_POST['notes'] ?? ''),
                'initials'       => trim($_POST['initials'] ?? ''),
                'agree'          => 1
            ];

            $id = $this->model('Adoption')->create($data);
            header("Location: ".BASE_URL."/Adoption/thanks?id=".$id); exit;
        }

        $this->view('adoption/apply', ['pet'=>$pet]);
    }

    /* Short confirmation */
    public function thanks()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) { header("Location: ".BASE_URL."/Pet/index"); exit; }

        $a = $this->model('Adoption')->find($id);
        if (!$a) { header("Location: ".BASE_URL."/Pet/index"); exit; }

        $this->view('adoption/thanks', ['app'=>$a]);
    }
}
