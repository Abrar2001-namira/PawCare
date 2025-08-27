<?php
require_once 'core/Controller.php';
require_once 'config.php';

class PetController extends Controller
{
    public function index()
    {
        $species  = $_GET['species']  ?? null;               // 'Dog', 'Cat', or null for All
        $location = trim($_GET['location'] ?? '');           // free text search

        $pets = $this->model('Pet')->search($species, $location);

        $this->view('pet/index', [
            'pets'     => $pets,
            'species'  => $species,
            'location' => $location
        ]);
    }

    public function detail()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) { header("Location: " . BASE_URL . "/Pet/index"); exit; }

        $pet = $this->model('Pet')->find($id);
        if (!$pet) { header("Location: " . BASE_URL . "/Pet/index"); exit; }

        $this->view('pet/detail', ['pet' => $pet]);
    }
}
