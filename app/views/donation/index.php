<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8">
<title>Donate • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6}

/* hero with soft overlay image (keeps theme colors) */
.hero{
  position:relative; height:60vh; min-height:360px; margin-top:10px;
  background:url("https://plus.unsplash.com/premium_photo-1661676172038-377ab3d82a18?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D") center/cover no-repeat;
  display:flex;align-items:center;justify-content:center
}
.hero::before{content:'';position:absolute;inset:0;background:rgba(0,0,0,.35)}
.hero-inner{position:relative;text-align:center;color:#fff;padding:0 1rem;max-width:900px}
.hero-inner h1{font-size:2.2rem;font-weight:700;margin-bottom:.6rem}
.hero-inner p{font-size:1rem;line-height:1.6}
.hero-inner em{color:#bdf0e7;font-style:normal}

/* content */
.wrap{padding:28px 6%}
.card{background:#fff;border-radius:16px;box-shadow:0 8px 18px rgba(0,0,0,.08);padding:26px 28px;margin:auto;max-width:1020px}
h2{font-size:1.5rem;color:#41403e;font-weight:600;margin-bottom:10px}
p{color:#555;line-height:1.45;font-size:.95rem;margin-bottom:10px}
ul{margin:8px 0 0 18px;color:#555;line-height:1.45;font-size:.95rem}

/* two-column info + image */
.two{display:grid;grid-template-columns:1.1fr .9fr;gap:22px;align-items:center}
.side-img{width:100%;border-radius:16px;box-shadow:0 8px 18px rgba(0,0,0,.08);object-fit:cover}

/* stats */
.stats{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-top:16px}
.stat{background:#fafafa;border:1px solid #e0dedc;border-radius:12px;padding:14px;text-align:center}
.stat .num{font-weight:700;color:#ff8552;font-size:1.2rem}
.stat .lbl{color:#41403e;font-weight:600;margin-top:4px}

/* button */
.cta{margin-top:18px;text-align:center}
a.btn{
  display:inline-block;background:#26c1a8;color:#fff;text-decoration:none;
  padding:14px 34px;border-radius:12px;font-weight:600
}
a.btn:hover{background:#1ea893}

@media(max-width:920px){.two{grid-template-columns:1fr}.hero{height:46vh}}
@media(max-width:520px){.stats{grid-template-columns:1fr}}
</style></head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<section class="hero">
  <div class="hero-inner">
    <h1>Donate</h1>
    <p><em>“They can’t ask for help, but their eyes tell the story. Be the reason their tail wags again.”</em></p>
  </div>
</section>

<div class="wrap">
  <div class="card">
    <div class="two">
      <div>
        <h2>Donate To Our Animal Shelter Partners</h2>
        <p>
          At PawCare, your generosity supports <b>registered shelters</b> that rescue, vaccinate,
          and foster cats and dogs. We keep things simple and transparent so your gift goes where
          it matters most: <b>belly rubs, full bowls, and safe snoozes</b>.
        </p>
        <ul>
          <li>We forward your donation directly to the shelter you select.</li>
          <li>Funds help with food, medicine, vaccinations, and foster home care.</li>
          <li>We track totals publicly—because every wag and purr deserves honesty.</li>
        </ul>

        <div class="stats">
          <div class="stat">
            <div class="num"><?=$stats['donors']?></div>
            <div class="lbl">Donors so far</div>
          </div>
          <div class="stat">
            <div class="num">$<?=number_format($stats['total'],2)?></div>
            <div class="lbl">Total raised</div>
          </div>
          <div class="stat">
            <div class="num"><?=$stats['donations']?></div>
            <div class="lbl">Donations</div>
          </div>
        </div>

        <div class="cta">
          <a href="<?=BASE_URL?>/Donation/give" class="btn">Donate now</a>
        </div>
      </div>

      <!-- friendly pet photo -->
      <img class="side-img" src="https://images.unsplash.com/photo-1543852786-1cf6624b9987?auto=format&fit=crop&w=900&q=80" alt="Happy cat and dog">
    </div>
  </div>
</div>
</body></html>
