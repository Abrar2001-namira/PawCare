<?php
require_once 'core/Database.php';

class Donation extends Database
{
    public function create($d)
    {
        $q = $this->pdo->prepare(
            "INSERT INTO donations (user_id,name,email,shelter_id,amount,note,created)
             VALUES (?,?,?,?,?,?,NOW())"
        );
        $q->execute([
            $d['user_id'], $d['name'], $d['email'],
            $d['shelter_id'], $d['amount'], $d['note']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function stats()
    {
        $row = $this->pdo->query(
            "SELECT 
                COUNT(*) AS donations,
                IFNULL(SUM(amount),0) AS total,
                COUNT(DISTINCT COALESCE(NULLIF(email,''), CONCAT('u',user_id), CONCAT('a',id))) AS donors
             FROM donations"
        )->fetch(PDO::FETCH_ASSOC);

        return [
            'donations' => (int)($row['donations'] ?? 0),
            'total'     => (float)($row['total'] ?? 0),
            'donors'    => (int)($row['donors'] ?? 0),
        ];
    }

    public function find($id)
    {
        $q = $this->pdo->prepare(
            "SELECT d.*, s.name AS shelter_name
               FROM donations d
               LEFT JOIN shelters s ON s.id = d.shelter_id
             WHERE d.id=?"
        );
        $q->execute([$id]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }

    /* ⭐ Admin list */
    public function all()
    {
        return $this->pdo->query(
            "SELECT d.id, d.created, d.name, d.email, d.amount, d.note,
                    s.name AS shelter_name
               FROM donations d
               LEFT JOIN shelters s ON s.id = d.shelter_id
             ORDER BY d.created DESC"
        )->fetchAll(PDO::FETCH_ASSOC);
    }
}
