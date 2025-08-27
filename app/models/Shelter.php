<?php
require_once 'core/Database.php';

class Shelter extends Database
{
    public function all()
    {
        return $this->pdo->query("SELECT * FROM shelters ORDER BY name ASC")
                         ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $q = $this->pdo->prepare("SELECT * FROM shelters WHERE id=?");
        $q->execute([$id]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }
}
