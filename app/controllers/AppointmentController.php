<?php
require_once 'core/Controller.php';
require_once 'config.php';
session_start();

class AppointmentController extends Controller
{
    /* Landing: find nearby vets by location */
    public function index()
    {
        $location = trim($_GET['location'] ?? '');
        $vets = $this->model('Vet')->search($location);
        $this->view('appointment/index', ['vets'=>$vets, 'location'=>$location]);
    }

    /* Book: GET=show slots, POST=save booking */
    public function book()
    {
        if (!isset($_GET['vet_id']) && !isset($_POST['vet_id'])) {
            header("Location: ".BASE_URL."/Appointment/index"); exit;
        }
        $vetId = (int)($_GET['vet_id'] ?? $_POST['vet_id']);
        $vet   = $this->model('Vet')->find($vetId);
        if (!$vet) { header("Location: ".BASE_URL."/Appointment/index"); exit; }

        // date to show (default today)
        $date = $_GET['date'] ?? $_POST['appt_date'] ?? date('Y-m-d');
        $date = date('Y-m-d', strtotime($date));

        // workday slots 9:00–17:00 hourly
        $slots = ['09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00'];
        $taken = $this->model('Appointment')->takenSlots($vetId, $date);

        if ($_SERVER['REQUEST_METHOD']==='POST') {
            if (!isset($_SESSION['user_id'])) { header("Location: ".BASE_URL."/User/login"); exit; }

            $petName = trim($_POST['pet_name'] ?? '');
            $slot    = $_POST['slot'] ?? '';
            $notes   = trim($_POST['notes'] ?? '');

            if ($petName==='' || !in_array($slot, $slots, true)) {
                echo "<script>alert('Please enter your pet name and select an available slot.');history.back();</script>"; exit;
            }
            if (in_array($slot, $taken, true)) {
                echo "<script>alert('Sorry, that slot was just taken. Please choose another.');history.back();</script>"; exit;
            }

            $id = $this->model('Appointment')->create([
                'user_id'   => $_SESSION['user_id'],
                'vet_id'    => $vetId,
                'pet_name'  => $petName,
                'appt_date' => $date,
                'slot'      => $slot,
                'notes'     => $notes,
                'status'    => 'booked'
            ]);
            header("Location: ".BASE_URL."/Appointment/thanks?id=".$id); exit;
        }

        $this->view('appointment/book', [
            'vet'=>$vet, 'date'=>$date, 'slots'=>$slots, 'taken'=>$taken
        ]);
    }

    /* Thank you */
    public function thanks()
    {
        $id = (int)($_GET['id'] ?? 0);
        if (!$id) { header("Location: ".BASE_URL."/Appointment/index"); exit; }
        $a = $this->model('Appointment')->find($id);
        if (!$a) { header("Location: ".BASE_URL."/Appointment/index"); exit; }
        $this->view('appointment/thanks', ['a'=>$a]);
    }

    /* User’s appointment history */
    public function history()
    {
        if (!isset($_SESSION['user_id'])) { header("Location: ".BASE_URL."/User/login"); exit; }
        $list = $this->model('Appointment')->byUser($_SESSION['user_id']);
        $this->view('appointment/history', ['list'=>$list]);
    }

    /* NEW: cancel from profile/history */
    public function cancel()
    {
        if (!isset($_SESSION['user_id'])) { header("Location: ".BASE_URL."/User/login"); exit; }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: ".BASE_URL."/User/profile"); exit;
        }

        $id = (int)($_POST['id'] ?? 0);
        if ($id) {
            $this->model('Appointment')->cancel($id, $_SESSION['user_id']);
            // As soon as status becomes 'cancelled', the slot disappears from takenSlots(),
            // so it becomes available for everyone immediately.
        }

        header("Location: ".BASE_URL."/User/profile"); exit;
    }
}
