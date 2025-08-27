<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8">
<title>Application Submitted • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6}
.wrap{padding:40px 6%}
.card{background:#fff;border-radius:16px;box-shadow:0 8px 18px rgba(0,0,0,.08);padding:26px 28px;max-width:980px;margin:80px auto 24px}
.grid{display:grid;grid-template-columns:1fr 1.1fr;gap:24px;align-items:center}
@media(max-width:860px){.grid{grid-template-columns:1fr}}
.pic img{width:100%;max-width:380px;height:340px;object-fit:cover;border-radius:16px;box-shadow:0 8px 18px rgba(0,0,0,.08)}
.badge{display:inline-block;background:#26c1a8;color:#fff;padding:8px 16px;border-radius:999px;font-weight:700;margin-top:10px}
h1{color:#41403e;font-size:1.8rem;font-weight:600;margin-bottom:.6rem}
p{color:#555;line-height:1.5;margin-bottom:10px}
a.btn{display:inline-block;text-decoration:none;background:#26c1a8;color:#fff;padding:12px 24px;border-radius:12px;font-weight:600}
a.btn:hover{background:#1ea893}
.small{color:#777;font-size:.9rem;margin-top:8px}
</style></head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<div class="wrap">
  <div class="card">
    <div class="grid">
      <div class="pic">
        <img src="<?=htmlspecialchars($app['pet_image'] ?: 'https://images.unsplash.com/photo-1525253013412-55c1a69a5738?auto=format&fit=crop&w=640&q=80')?>" alt="">
        <div class="badge">Application sent!</div>
      </div>
      <div>
        <h1>Thanks for applying to adopt <?=htmlspecialchars($app['pet_name'])?> 🐾</h1>
        <p>We received your application for <?=htmlspecialchars($app['pet_name'])?>. Our team will review your info and contact you by email shortly.</p>
        <p class="small">Submitted by <b><?=htmlspecialchars($app['applicant_name'])?></b> • <?=htmlspecialchars($app['email'])?></p>
        <a class="btn" href="<?=BASE_URL?>/Pet/index">Back to Pets</a>
      </div>
    </div>
  </div>
</div>
</body></html>
