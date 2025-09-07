<?php
/* Nav bar (theme-friendly) + Vaccination "today" notifier */

if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once __DIR__ . '/../../../config.php';

/* --- Vaccination bell flag (simple & fast) --- */
$hasTodayVaccination = false;
if (!empty($_SESSION['user_id'])) {
    // lightweight direct query using the existing Database base class
    require_once __DIR__ . '/../../../core/Database.php';
    class _MiniDB extends Database { public function p(){ return $this->pdo; } }
    $db = (new _MiniDB())->p();

    $q = $db->prepare("
        SELECT 1
          FROM vaccinations
         WHERE user_id = ?
           AND status <> 'done'
           AND due_date = CURDATE()
         LIMIT 1
    ");
    $q->execute([$_SESSION['user_id']]);
    $hasTodayVaccination = (bool)$q->fetchColumn();
}

$user   = $_SESSION['user']    ?? null;
$role   = $_SESSION['role']    ?? 'guest';
$isAuth = !empty($_SESSION['user_id']);

/* Helper: hide some menu items for admin per your earlier rule */
$hideShopPetsDonateForAdmin = ($role === 'admin');

/* Cart count (sum quantities) */
$cartCount = 0;
if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $qty) { $cartCount += (int)$qty; }
}
?>
<style>
/* keep your theme: Quicksand, mint accents, rounded pills */
.navbar{
  position:sticky; top:0; z-index:999;
  background:#ffffff; border-bottom:1px solid #e9e7e6;
  padding:10px 6%; display:flex; align-items:center; gap:18px;
  font-family:'Quicksand',sans-serif;
}
.nav-brand{
  font-weight:800; color:#26c1a8; text-decoration:none; font-size:1.2rem;
  padding:8px 12px; border-radius:10px;
}
.nav-links{ display:flex; gap:12px; align-items:center; margin-left:8px; flex-wrap:wrap }
.nav-links a{
  color:#214a44; text-decoration:none; padding:8px 12px;
  border-radius:10px; transition:background .2s;
}
.nav-links a:hover{ background:#eaf8f5 }
.nav-right{ margin-left:auto; display:flex; align-items:center; gap:10px }

/* Bell button */
.bell{
  position:relative; display:inline-flex; align-items:center; justify-content:center;
  width:40px; height:40px; border-radius:10px; border:1px solid #e9e7e6; background:#fff;
  cursor:pointer; text-decoration:none;
}
.bell:hover{ background:#f6fbfa }
.bell svg{ width:20px; height:20px; fill:#214a44 }
.bell-dot{
  position:absolute; top:6px; right:6px;
  width:10px; height:10px; border-radius:50%;
  background:#ff4d4f; box-shadow:0 0 0 2px #fff;
}
.btn{
  background:#26c1a8; color:#fff; text-decoration:none; padding:8px 14px;
  border-radius:10px; font-weight:700;
}
.btn:hover{ background:#1ea893 }
.avatar{
  display:inline-flex; width:36px; height:36px; border-radius:50%;
  background:#eaf8f5; border:2px solid #d6f2ea; color:#26c1a8;
  align-items:center; justify-content:center; font-weight:800;
}
</style>

<nav class="navbar">
  <!-- Brand takes user to Welcome page -->
  <a class="nav-brand" href="<?=BASE_URL?>/User/welcome">PawCare</a>

  <div class="nav-links">
    <?php if (!$hideShopPetsDonateForAdmin): ?>
      <a href="<?=BASE_URL?>/Pet/index">Pets</a>
      <a href="<?=BASE_URL?>/Shop/index">Shop</a>
      <a href="<?=BASE_URL?>/Donation/index">Donate</a>
      <a href="<?=BASE_URL?>/Appointment/index">Find A Vet</a>
    <?php endif; ?>
    <!-- Renamed label only -->

    <?php if (!$hideShopPetsDonateForAdmin): ?>
      <?php if ($isAuth): ?>
        <!-- My Orders (user only) -->
        <a href="<?=BASE_URL?>/Order/index">My Orders</a>
      <?php endif; ?>
      <!-- Cart with count (user-facing navbar) -->
      <a href="<?=BASE_URL?>/Cart/index">Cart (<?=$cartCount?>)</a>
    <?php endif; ?>

    <?php if ($role === 'admin'): ?>
      <!-- Admin menu (keeps your existing admin pages) -->
      <a href="<?=BASE_URL?>/Admin/index">Admin Products</a>
      <a href="<?=BASE_URL?>/AdminPet/index">Admin Pets</a>
      <a href="<?=BASE_URL?>/AdminAdoption/index">AdoptionInfo</a>
      <a href="<?=BASE_URL?>/AdminDonation/index">Admin Donations</a>
      <a href="<?=BASE_URL?>/AdminOrder/index">Admin Orders</a>
      <a href="<?=BASE_URL?>/AdminRehome/index">Admin Rehomes</a>
    <?php endif; ?>
  </div>

  <div class="nav-right">
    <!-- Vaccination notification bell -->
    <a class="bell" href="<?=BASE_URL?>/Vaccination/index"
       title="<?= $hasTodayVaccination ? 'Vaccinations due today!' : 'Vaccination reminders' ?>"
       aria-label="<?= $hasTodayVaccination ? 'Vaccinations due today!' : 'Vaccination reminders' ?>">
      <!-- simple bell icon (SVG) to match theme -->
      <svg viewBox="0 0 24 24" aria-hidden="true">
        <path d="M12 22a2.2 2.2 0 0 0 2.2-2.2H9.8A2.2 2.2 0 0 0 12 22Zm8-6v-5.5A6 6 0 0 0 13 4.1V3a1 1 0 1 0-2 0v1.1A6 6 0 0 0 4 10.5V16l-1.7 1.7A1 1 0 0 0 3 19h18a1 1 0 0 0 .7-1.7L20 16Z"/>
      </svg>
      <?php if ($hasTodayVaccination): ?>
        <span class="bell-dot" aria-hidden="true"></span>
      <?php endif; ?>
    </a>

    <?php if ($isAuth): ?>
      <a class="avatar" href="<?=BASE_URL?>/User/profile"><?=strtoupper(substr($user ?? 'U',0,1))?></a>
      <a class="btn" href="<?=BASE_URL?>/User/logout">Logout</a>
    <?php else: ?>
      <a href="<?=BASE_URL?>/User/login">Login</a>
      <a class="btn" href="<?=BASE_URL?>/User/register">Sign up</a>
    <?php endif; ?>
  </div>
</nav>
