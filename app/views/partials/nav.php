<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<style>
.nav-bar{
    background:#fff;box-shadow:0 4px 12px rgba(0,0,0,.05);
    padding:14px 6%;display:flex;justify-content:space-between;align-items:center;
    font-family:'Quicksand',sans-serif
}
.nav-brand{font-weight:700;color:#26c1a8;text-decoration:none;font-size:1.2rem}
.nav-links a{
    margin-left:22px;color:#41403e;text-decoration:none;font-weight:600;font-size:.95rem;
    transition:.2s
}
.nav-links a:hover{color:#ff8552}
</style>

<div class="nav-bar">
   <a class="nav-brand" href="<?=BASE_URL?>/User/welcome">🐾 PawCare</a>

   <div class="nav-links">
        <!-- always show Shop & Pets -->
        <a href="<?=BASE_URL?>/Shop/index">Shop</a>
        <a href="<?=BASE_URL?>/Pet/index">Pets</a>

        <?php
          $isAdmin = ($_SESSION['role'] ?? '') === 'admin';
          $logged  = isset($_SESSION['user_id']);
        ?>

        <!-- regular users: My Orders -->
        <?php if($logged && !$isAdmin): ?>
            <a href="<?=BASE_URL?>/Order/index">My Orders</a>
        <?php endif; ?>

        <!-- admin-only links -->
        <?php if($isAdmin): ?>
            <a href="<?=BASE_URL?>/Admin/index">Products</a>
            <a href="<?=BASE_URL?>/AdminPet/index">PetInfo</a>
            <a href="<?=BASE_URL?>/AdminOrder/index">Orders</a>
        <?php endif; ?>

        <!-- Cart only for non-admin users -->
        <?php if(!$isAdmin): ?>
            <a href="<?=BASE_URL?>/Cart/index">Cart (<?=array_sum($_SESSION['cart'] ?? [])?>)</a>
        <?php endif; ?>

        <!-- Login / Logout -->
        <?php if($logged): ?>
            <a href="<?=BASE_URL?>/User/logout">Logout</a>
        <?php else: ?>
            <a href="<?=BASE_URL?>/User/login">Login</a>
        <?php endif; ?>
   </div>
</div>
