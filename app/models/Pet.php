<?php
require_once 'core/Database.php';

class Pet extends Database
{
    /* -------- READ -------- */
    public function all()
    {
        return $this->pdo
            ->query("SELECT * FROM pets ORDER BY id DESC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bySpecies($species)
    {
        $q = $this->pdo->prepare(
            "SELECT * FROM pets 
             WHERE LOWER(species)=LOWER(?) 
             ORDER BY id DESC"
        );
        $q->execute([$species]);
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $q = $this->pdo->prepare("SELECT * FROM pets WHERE id=?");
        $q->execute([$id]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }

    /* -------- CREATE -------- */
    public function create($d)
    {
        $q = $this->pdo->prepare(
            "INSERT INTO pets
               (name, species, age, breed, vaccinated, adopted,
                image, story, phone, email, foster_home)
             VALUES (?,?,?,?,?,?,?,?,?,?,?)"
        );
        return $q->execute([
            $d['name'],
            $d['species'],
            $d['age'],
            $d['breed'],
            $d['vaccinated'],
            $d['adopted'],
            $d['image'],
            $d['story'],
            $d['phone'],
            $d['email'],
            $d['foster_home']
        ]);
    }

    /* -------- UPDATE -------- */
    public function update($id, $d)
    {
        $q = $this->pdo->prepare(
            "UPDATE pets SET
                name=?, species=?, age=?, breed=?, vaccinated=?,
                adopted=?, image=?, story=?, phone=?, email=?,
                foster_home=?
             WHERE id=?"
        );
        return $q->execute([
            $d['name'],
            $d['species'],
            $d['age'],
            $d['breed'],
            $d['vaccinated'],
            $d['adopted'],
            $d['image'],
            $d['story'],
            $d['phone'],
            $d['email'],
            $d['foster_home'],
            $id
        ]);
    }

    /* -------- DELETE -------- */
    public function delete($id)
    {
        $q = $this->pdo->prepare("DELETE FROM pets WHERE id=?");
        return $q->execute([$id]);
    }
}
