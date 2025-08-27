<?php
require_once 'core/Database.php';

class Pet extends Database
{
    public function all()
    {
        return $this->pdo->query("SELECT * FROM pets ORDER BY id DESC")
                         ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bySpecies($species)
    {
        $q = $this->pdo->prepare(
            "SELECT * FROM pets WHERE LOWER(species)=LOWER(?) ORDER BY id DESC"
        );
        $q->execute([$species]);
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    /* NEW: combined search by species + location (partial match). */
    public function search($species = null, $location = '')
    {
        $sql  = "SELECT * FROM pets WHERE 1";
        $args = [];

        if ($species) {
            $sql .= " AND LOWER(species)=LOWER(?)";
            $args[] = $species;
        }
        if ($location !== '') {
            $sql .= " AND LOWER(location) LIKE LOWER(?)";
            $args[] = "%".$location."%";
        }

        $sql .= " ORDER BY id DESC";
        $q = $this->pdo->prepare($sql);
        $q->execute($args);
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $q = $this->pdo->prepare("SELECT * FROM pets WHERE id=?");
        $q->execute([$id]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }

    public function create($d)
    {
        $q = $this->pdo->prepare(
            "INSERT INTO pets
               (name, species, age, breed, vaccinated, adopted,
                image, story, phone, email, location)
             VALUES (?,?,?,?,?,?,?,?,?,?,?)"
        );
        return $q->execute([
            $d['name'], $d['species'], $d['age'], $d['breed'],
            $d['vaccinated'], $d['adopted'], $d['image'], $d['story'],
            $d['phone'], $d['email'], $d['location']
        ]);
    }

    public function update($id, $d)
    {
        $q = $this->pdo->prepare(
            "UPDATE pets SET
                name=?, species=?, age=?, breed=?, vaccinated=?,
                adopted=?, image=?, story=?, phone=?, email=?, location=?
             WHERE id=?"
        );
        return $q->execute([
            $d['name'], $d['species'], $d['age'], $d['breed'], $d['vaccinated'],
            $d['adopted'], $d['image'], $d['story'], $d['phone'], $d['email'],
            $d['location'], $id
        ]);
    }

    public function delete($id)
    {
        $q = $this->pdo->prepare("DELETE FROM pets WHERE id=?");
        return $q->execute([$id]);
    }

    public function setAdopted($id, $flag = 1)
    {
        $q = $this->pdo->prepare("UPDATE pets SET adopted=? WHERE id=?");
        return $q->execute([(int)$flag, $id]);
    }
}
