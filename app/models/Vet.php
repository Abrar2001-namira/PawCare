<?php
require_once 'core/Database.php';

class Vet extends Database
{
    public function search($location = '')
    {
        if ($location==='') {
            return $this->pdo->query("SELECT * FROM vets ORDER BY city,name")->fetchAll(PDO::FETCH_ASSOC);
        }
        $q = $this->pdo->prepare("SELECT * FROM vets WHERE LOWER(city) LIKE LOWER(?) OR LOWER(address) LIKE LOWER(?) OR LOWER(name) LIKE LOWER(?) ORDER BY city,name");
        $like = "%".$location."%";
        $q->execute([$like,$like,$like]);
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $q = $this->pdo->prepare("SELECT * FROM vets WHERE id=?");
        $q->execute([$id]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }
}
