<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title>ReHome Request Sent • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6}
.wrap{padding:40px 6%}
.card{background:#fff;border-radius:16px;box-shadow:0 8px 18px rgba(0,0,0,.08);max-width:860px;margin:100px auto 24px;padding:28px;text-align:center}
h2{color:#41403e;font-size:1.7rem;font-weight:600;margin-bottom:8px}
p{color:#555}
a.btn{display:inline-block;margin-top:14px;padding:12px 22px;border-radius:12px;background:#26c1a8;color:#fff;text-decoration:none;font-weight:700}
a.btn:hover{background:#1ea893}
</style></head><body>
<?php include_once 'app/views/partials/nav.php'; ?>
<div class="wrap">
  <div class="card">
    <h2>Thanks! We received your ReHome request 🐾</h2>
    <p>Our team will review your submission for <b><?=htmlspecialchars($r['name'])?></b> and get back to you.</p>
    <a class="btn" href="<?=BASE_URL?>/User/profile">Back to Profile</a>
  </div>
</div>
</body></html>
