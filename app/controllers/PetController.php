<?php
require_once 'core/Controller.php';
require_once 'config.php';

class PetController extends Controller
{
    public function index()
    {
        $species = $_GET['species'] ?? null;

        if ($species) {
            $pets = $this->model('Pet')->bySpecies($species);
        } else {
            $pets = $this->model('Pet')->all();
        }

        $this->view('pet/index', [
            'pets'    => $pets,
            'species'=> $species
        ]);
    }

    public function detail()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: " . BASE_URL . "/Pet/index");
            exit;
        }

        $pet = $this->model('Pet')->find($id);
        if (!$pet) {
            header("Location: " . BASE_URL . "/Pet/index");
            exit;
        }

        $this->view('pet/detail', ['pet' => $pet]);
    }
}
