<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8">
<title>Thank You • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6}

/* layout */
.wrap{padding:40px 6%}
.card{
  background:#fff;border-radius:16px;box-shadow:0 8px 18px rgba(0,0,0,.08);
  padding:26px 28px;max-width:980px;margin:80px auto 24px
}
.grid{display:grid;grid-template-columns:1fr 1.1fr;gap:24px;align-items:center}
@media(max-width:860px){.grid{grid-template-columns:1fr}}

/* image side */
.pic{
  position:relative;display:flex;align-items:center;justify-content:center
}
.pic img{
  width:100%;max-width:380px;height:340px;object-fit:cover;border-radius:16px;
  box-shadow:0 8px 18px rgba(0,0,0,.08)
}
.badge{
  position:absolute;bottom:-12px;left:50%;transform:translateX(-50%);
  background:#26c1a8;color:#fff;padding:8px 16px;border-radius:999px;
  font-weight:700;box-shadow:0 6px 14px rgba(0,0,0,.08)
}

/* text side */
h1{color:#41403e;font-size:1.8rem;font-weight:600;margin-bottom:.6rem}
p{color:#555;line-height:1.5;margin-bottom:10px}
.info{background:#fafafa;border:1px solid #e0dedc;border-radius:12px;padding:12px 14px;margin:10px 0}
.row{display:flex;gap:10px;flex-wrap:wrap;margin-top:10px}
a.btn{
  display:inline-block;text-decoration:none;font-weight:600;border-radius:12px;
  padding:12px 24px
}
.btn-primary{background:#26c1a8;color:#fff}
.btn-primary:hover{background:#1ea893}
.btn-ghost{border:2px solid #26c1a8;color:#26c1a8;background:transparent}
.btn-ghost:hover{background:#e7f8f4}
.small{color:#777;font-size:.9rem;margin-top:8px}
</style></head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<?php
  $shelter = htmlspecialchars($donation['shelter_name'] ?? 'the shelter');
  $amount  = number_format($donation['amount'] ?? 0, 2);
  $when    = isset($donation['created']) ? date('M j, Y • H:i', strtotime($donation['created'])) : '';
  $id      = $donation['id'] ?? null;
?>

<div class="wrap">
  <div class="card">
    <div class="grid">
      <!-- Image + amount badge -->
      <div class="pic">
        <img src="https://as1.ftcdn.net/v2/jpg/09/13/79/82/1000_F_913798269_4INTAQy7HdwL16cE5FbLPNEXbE8YpStX.jpg"
             alt="Happy dog and cat celebrating a donation">
        <div class="badge">+$<?=$amount?></div>
      </div>

      <!-- Text -->
      <div>
        <h1>Tail-wag alert! You just made a pet’s day 🐾</h1>
        <p>
          Thank you for donating <b>$<?=$amount?></b> to <b><?=$shelter?></b>.
          Your kindness helps with food, medicine, safe foster care—and lots of happy zoomies.
        </p>

        <div class="info">
          <?php if($id): ?><div class="small">Donation ID: <b>#<?=$id?></b></div><?php endif; ?>
          <?php if($when): ?><div class="small">Date: <b><?=$when?></b></div><?php endif; ?>
        </div>

        <div class="row">
          <a href="<?=BASE_URL?>/Pet/index" class="btn btn-primary">Meet the Pets</a>
          <a href="<?=BASE_URL?>/Donation/give" class="btn btn-ghost">Donate Again</a>
        </div>
        <p class="small">Every gift matters. Thanks for being the human behind a happy tail. 💚</p>
      </div>
    </div>
  </div>
</div>
</body></html>
