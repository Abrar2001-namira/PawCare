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

<?php
  $isAdmin   = ($_SESSION['role'] ?? '') === 'admin';
  $logged    = isset($_SESSION['user_id']);
  $cartCount = array_sum($_SESSION['cart'] ?? []);
?>

<div class="nav-bar">
   <!-- Brand → Welcome page -->
   <a class="nav-brand" href="<?=BASE_URL?>/User/welcome">🐾 PawCare</a>

   <div class="nav-links">
        <!-- User links (hidden for admins) -->
        <?php if(!$isAdmin): ?>
            <a href="<?=BASE_URL?>/Shop/index">Shop</a>
            <a href="<?=BASE_URL?>/Pet/index">Pets</a>
            <a href="<?=BASE_URL?>/Donation/index">Donate</a>
            
            <?php if($logged): ?><a href="<?=BASE_URL?>/User/profile">Profile</a><?php endif; ?>
        <?php endif; ?>

        <?php if($logged && !$isAdmin): ?>
            <a href="<?=BASE_URL?>/Order/index">My Orders</a>
        <?php endif; ?>

        <!-- Admin-only links -->
        <?php if($isAdmin): ?>
            <a href="<?=BASE_URL?>/Admin/index">Products</a>
            <a href="<?=BASE_URL?>/AdminPet/index">PetInfo</a>
            <a href="<?=BASE_URL?>/AdminOrder/index">Orders</a>
            <a href="<?=BASE_URL?>/AdminDonation/index">Donations</a>
            <a href="<?=BASE_URL?>/AdminAdoption/index">AdoptionInfo</a>
            <a href="<?=BASE_URL?>/AdminRehome/index">ReHome Requests</a>
        <?php endif; ?>

        <?php if(!$isAdmin): ?>
            <a href="<?=BASE_URL?>/Cart/index">Cart (<?=$cartCount?>)</a>
        <?php endif; ?>

        <?php if($logged): ?>
            <a href="<?=BASE_URL?>/User/logout">Logout</a>
        <?php else: ?>
            <a href="<?=BASE_URL?>/User/login">Login</a>
        <?php endif; ?>
   </div>
</div>
