<?php
require_once 'core/Database.php';

class Rehome extends Database
{
    public function create($d)
    {
        $q = $this->pdo->prepare(
            "INSERT INTO rehomes
             (user_id, owner_name, owner_email, owner_phone, address,
              name, species, age, breed, vaccinated, image, story,
              status, created)
             VALUES (?,?,?,?,?,?,?,?,?,?,?,?, 'pending', NOW())"
        );
        $q->execute([
            $d['user_id'], $d['owner_name'], $d['owner_email'], $d['owner_phone'], $d['address'],
            $d['name'], $d['species'], $d['age'], $d['breed'], $d['vaccinated'], $d['image'], $d['story']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function all()
    {
        return $this->pdo->query(
            "SELECT * FROM rehomes ORDER BY created DESC"
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $q = $this->pdo->prepare("SELECT * FROM rehomes WHERE id=?");
        $q->execute([$id]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }

    public function setStatus($id, $status)
    {
        $q = $this->pdo->prepare("UPDATE rehomes SET status=? WHERE id=?");
        return $q->execute([$status, $id]);
    }
}
