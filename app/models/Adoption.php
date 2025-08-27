<?php
require_once 'core/Database.php';

class Adoption extends Database
{
    public function create($d)
    {
        $q = $this->pdo->prepare(
            "INSERT INTO adoptions
             (user_id, pet_id, applicant_name, email, phone, city_state,
              can_text, heard_about, current_pets, looking_for, house_type,
              house_members, notes, initials, agree, status, created)
             VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, 'pending', NOW())"
        );
        $q->execute([
            $d['user_id'], $d['pet_id'], $d['applicant_name'], $d['email'], $d['phone'],
            $d['city_state'], $d['can_text'], $d['heard_about'], $d['current_pets'],
            $d['looking_for'], $d['house_type'], $d['house_members'], $d['notes'],
            $d['initials'], $d['agree']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function find($id)
    {
        $q = $this->pdo->prepare(
            "SELECT a.*, p.name AS pet_name, p.image AS pet_image
               FROM adoptions a
               LEFT JOIN pets p ON p.id = a.pet_id
             WHERE a.id=?"
        );
        $q->execute([$id]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }

    /* Admin list with pet info */
    public function all()
    {
        return $this->pdo->query(
            "SELECT a.*, p.name AS pet_name, p.image AS pet_image
               FROM adoptions a
               LEFT JOIN pets p ON p.id = a.pet_id
             ORDER BY a.created DESC"
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setStatus($id, $status)
    {
        $q = $this->pdo->prepare("UPDATE adoptions SET status=? WHERE id=?");
        return $q->execute([$status, $id]);
    }

    /* Reject other pending applications for the same pet */
    public function closeOthersForPet($petId, $acceptedId)
    {
        $q = $this->pdo->prepare(
            "UPDATE adoptions SET status='rejected'
             WHERE pet_id=? AND id<>? AND status='pending'"
        );
        $q->execute([$petId, $acceptedId]);
    }
}
