<?php
require_once 'core/Database.php';

class User extends Database
{
    public function create($d)
    {
        // accept optional phone/address/bio without breaking existing register flow
        $q = $this->pdo->prepare(
            "INSERT INTO users (username,email,password,role,phone,address,bio)
             VALUES (?,?,?,?,?,?,?)"
        );
        $q->execute([
            $d['username'],
            $d['email'],
            $d['password'],
            $d['role'] ?? 'user',
            $d['phone']   ?? null,
            $d['address'] ?? null,
            $d['bio']     ?? null,
        ]);
        return $this->pdo->lastInsertId();
    }

    public function checkLogin($email)
    {
        $q = $this->pdo->prepare("SELECT * FROM users WHERE email=?");
        $q->execute([$email]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $q = $this->pdo->prepare("SELECT id,username,email,role,phone,address,bio FROM users WHERE id=?");
        $q->execute([$id]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $d)
    {
        $q = $this->pdo->prepare("UPDATE users SET username=?, email=?, phone=?, address=?, bio=? WHERE id=?");
        return $q->execute([
            $d['username'],
            $d['email'],
            $d['phone'],
            $d['address'],
            $d['bio'],
            $id
        ]);
    }
}
