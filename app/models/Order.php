<?php
require_once 'core/Database.php';

class Order extends Database
{
    /* save a new order */
    public function create($d)
    {
        $q = $this->pdo->prepare(
            "INSERT INTO orders (user_id,customer,address,contact,items,total,status)
             VALUES (?,?,?,?,?,?,'pending')"
        );
        $q->execute([
            $d['user_id'], $d['customer'], $d['address'],
            $d['contact'], $d['items'], $d['total']
        ]);
        return $this->pdo->lastInsertId();
    }

    /* fetch orders for one user */
    public function byUser($uid)
    {
        $q = $this->pdo->prepare(
            "SELECT * FROM orders WHERE user_id=? ORDER BY created DESC"
        );
        $q->execute([$uid]);
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    /* admin – fetch everyone’s orders */
    public function all()
    {
        return $this->pdo->query(
            "SELECT * FROM orders ORDER BY created DESC"
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    /* admin – change status */
    public function setDelivered($id)
    {
        $q=$this->pdo->prepare("UPDATE orders SET status='delivered' WHERE id=?");
        return $q->execute([$id]);
    }
}
