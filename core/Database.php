<?php
class Database {
    protected $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=pawcare_db", "root", "");
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
