<?php
require_once 'core/Database.php';

class Appointment extends Database
{
    public function create($d)
    {
        $q = $this->pdo->prepare(
            "INSERT INTO appointments
             (user_id, vet_id, pet_name, appt_date, slot, notes, status, created)
             VALUES (?,?,?,?,?,?,?,NOW())"
        );
        $q->execute([
            $d['user_id'], $d['vet_id'], $d['pet_name'],
            $d['appt_date'], $d['slot'], $d['notes'], $d['status']
        ]);
        return $this->pdo->lastInsertId();
    }

    /* used by the booking page to disable busy times */
    public function takenSlots($vetId, $date)
    {
        $q = $this->pdo->prepare(
            "SELECT slot FROM appointments
              WHERE vet_id=? AND appt_date=? AND status IN ('booked','completed')"
        );
        $q->execute([$vetId,$date]);
        return array_column($q->fetchAll(PDO::FETCH_ASSOC), 'slot');
    }

    public function byUser($uid)
    {
        $q = $this->pdo->prepare(
            "SELECT a.*, v.name AS vet_name, v.city AS vet_city
               FROM appointments a
               JOIN vets v ON v.id=a.vet_id
              WHERE a.user_id=?
              ORDER BY a.appt_date DESC, STR_TO_DATE(a.slot,'%H:%i') DESC"
        );
        $q->execute([$uid]);
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    /* Upcoming (for quick list on profile) */
    public function upcomingByUser($uid, $limit = 5)
    {
        $sql =
        "SELECT a.*, v.name AS vet_name, v.city AS vet_city
           FROM appointments a
           JOIN vets v ON v.id=a.vet_id
          WHERE a.user_id=?
            AND (
              a.appt_date > CURDATE() OR
              (a.appt_date = CURDATE() AND STR_TO_DATE(a.slot,'%H:%i') >= CURTIME())
            )
          ORDER BY a.appt_date ASC, STR_TO_DATE(a.slot,'%H:%i') ASC
          LIMIT ".(int)$limit;

        $q = $this->pdo->prepare($sql);
        $q->execute([$uid]);
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $q = $this->pdo->prepare(
            "SELECT a.*, v.name AS vet_name, v.city AS vet_city, v.address AS vet_address
               FROM appointments a
               JOIN vets v ON v.id=a.vet_id
              WHERE a.id=?"
        );
        $q->execute([$id]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }

    /* NEW: cancel (owner only, only when booked) */
    public function cancel($id, $userId)
    {
        $q = $this->pdo->prepare(
            "UPDATE appointments
                SET status='cancelled'
              WHERE id=? AND user_id=? AND status='booked'"
        );
        $q->execute([$id, $userId]);
        return $q->rowCount() > 0;
    }
}
