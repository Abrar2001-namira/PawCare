<?php
require_once 'core/Database.php';

class Product extends Database
{
    /* READ */
    public function all()             { return $this->pdo->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC); }
    public function byCategory($c)    {
        $q = $this->pdo->prepare("SELECT * FROM products WHERE LOWER(category) = LOWER(?)");
        $q->execute([$c]);
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }
    public function find($id)         { $q=$this->pdo->prepare("SELECT * FROM products WHERE id=?"); $q->execute([$id]); return $q->fetch(PDO::FETCH_ASSOC); }

    /* CREATE */
    public function create($d) {
        $q = $this->pdo->prepare("INSERT INTO products (name,category,price,image,description) VALUES (?,?,?,?,?)");
        return $q->execute([$d['name'],$d['category'],$d['price'],$d['image'],$d['description']]);
    }

    /* UPDATE */
    public function update($id,$d) {
        $q = $this->pdo->prepare("UPDATE products SET name=?,category=?,price=?,image=?,description=? WHERE id=?");
        return $q->execute([$d['name'],$d['category'],$d['price'],$d['image'],$d['description'],$id]);
    }

    /* DELETE */
    public function delete($id) {
        $q = $this->pdo->prepare("DELETE FROM products WHERE id=?");
        return $q->execute([$id]);
    }
}
