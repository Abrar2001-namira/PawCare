<?php
require_once 'core/Database.php';

class User extends Database
{
    public function create($d)
    {
        $q = $this->pdo->prepare(
            "INSERT INTO users (username,email,password,role) VALUES (?,?,?,?)"
        );
        $q->execute([
            $d['username'],
            $d['email'],
            $d['password'],
            $d['role'] ?? 'user'
        ]);
        return $this->pdo->lastInsertId();       // ⭐ new
    }

    public function checkLogin($email)
    {
        $q = $this->pdo->prepare("SELECT * FROM users WHERE email=?");
        $q->execute([$email]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }
}
