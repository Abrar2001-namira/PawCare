<?php
require_once 'core/Controller.php';
require_once 'config.php';
session_start();

class CartController extends Controller
{
    public function add()
    {
        $id  = $_GET['id'] ?? null;
        $qty = max(1, (int)($_POST['qty'] ?? 1));
        if (!$id) header("Location: ".BASE_URL."/Shop/index");
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + $qty;
        header("Location: ".BASE_URL."/shop/index");
    }

    public function index()
    {
        [$items,$total] = $this->cartItems();
        $this->view('cart/index',['items'=>$items,'total'=>$total]);
    }

    public function remove()
    {
        $id = $_GET['id'] ?? null;
        unset($_SESSION['cart'][$id]);
        header("Location: ".BASE_URL."/Cart/index");
    }

    /*  Checkout: show form → save order */
    public function checkout()
    {
        [$items,$total] = $this->cartItems();
        if (!$items) { header("Location: ".BASE_URL."/Cart/index"); exit; }

        if ($_SERVER['REQUEST_METHOD']==='POST') {
            /* turn item list into easy-to-read text */
            $list = array_map(fn($i)=>$i['name'].' x'.$i['qty'],$items);
            $itemString = implode(', ', $list);

            $this->model('Order')->create([
    'user_id' => $_SESSION['user_id'] ?? null,   // ⭐ new
    'customer'=> $_POST['customer'],
    'address' => $_POST['address'],
    'contact' => $_POST['contact'],
    'items'   => $itemString,
    'total'   => $total
]);

            unset($_SESSION['cart']);
            echo "<script>alert('Order placed! Thank you.');location='".BASE_URL."/Shop/index';</script>";
            exit;
        }
        $this->view('cart/checkout',['items'=>$items,'total'=>$total]);
    }

    /* -------- helper -------- */
    private function cartItems()
    {
        $cart = $_SESSION['cart'] ?? [];
        $items=[]; $total=0;
        if ($cart) {
            $m = $this->model('Product');
            foreach ($cart as $pid=>$q) {
                if ($p=$m->find($pid)) {
                    $p['qty']=$q; $p['line']=$q*$p['price'];
                    $items[]=$p;   $total+=$p['line'];
                }
            }
        }
        return [$items,$total];
    }
}
