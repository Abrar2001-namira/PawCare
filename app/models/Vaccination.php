<?php
require_once 'core/Database.php';

class Vaccination extends Database
{
    public function create($d)
    {
        $q = $this->pdo->prepare(
            "INSERT INTO vaccinations (user_id, pet_name, vaccine, dose, due_date, notes, status)
             VALUES (?,?,?,?,?,?, 'scheduled')"
        );
        $q->execute([
            $d['user_id'], $d['pet_name'], $d['vaccine'],
            $d['dose'], $d['due_date'], $d['notes']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function byUser($uid)
    {
        $q = $this->pdo->prepare(
            "SELECT * FROM vaccinations WHERE user_id=? ORDER BY due_date ASC, id DESC"
        );
        $q->execute([$uid]);
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    /* Next reminders: due in next 30 days (and not done) */
    public function upcomingDue($uid, $days = 30, $limit = 5)
    {
        $q = $this->pdo->prepare(
            "SELECT * FROM vaccinations
              WHERE user_id=? AND status<>'done'
                AND due_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL ? DAY)
              ORDER BY due_date ASC
              LIMIT ".(int)$limit
        );
        $q->execute([$uid, (int)$days]);
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setStatus($id, $uid, $status)
    {
        $q = $this->pdo->prepare("UPDATE vaccinations SET status=? WHERE id=? AND user_id=?");
        return $q->execute([$status, $id, $uid]);
    }

    public function delete($id, $uid)
    {
        $q = $this->pdo->prepare("DELETE FROM vaccinations WHERE id=? AND user_id=?");
        return $q->execute([$id, $uid]);
    }
}
