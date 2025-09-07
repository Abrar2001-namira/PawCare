<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Find a Vet • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
:root{
  --brand:#26c1a8; --brand2:#1ea893;
  --ink:#163c35; --muted:#6c7e7b;
  --bg:#f0faf6; --card:#ffffff; --line:#e9e7e6; --danger:#ff6b6b;
}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:var(--bg);color:var(--ink);padding:40px 6%}

/* hero */
.hero{max-width:1180px;margin:92px auto 24px;display:grid;grid-template-columns:1.1fr .9fr;gap:28px;align-items:center}
@media (max-width:980px){.hero{grid-template-columns:1fr}}
h1{font-size:2.4rem;line-height:1.15;margin-bottom:10px}
.lead{color:var(--muted)}
.hero-pic{width:100%;aspect-ratio:4/3;border-radius:24px;overflow:hidden;background:#eaf8f5;box-shadow:0 18px 26px rgba(0,0,0,.10)}
.hero-pic img{width:100%;height:100%;object-fit:cover;display:block}

/* search bar */
.formbar{margin-top:16px;display:flex;gap:10px}
.formbar input{flex:1;padding:1rem;border:2px solid var(--line);border-radius:14px;background:#fff}
.formbar input:focus{outline:none;border-color:var(--brand)}
.formbar button{padding:1rem 1.2rem;border:none;border-radius:14px;background:var(--brand);color:#fff;font-weight:700;cursor:pointer}
.formbar button:hover{background:var(--brand2)}

/* helpline + 24/7 */
.info-strip{max-width:1180px;margin:6px auto 18px;display:grid;grid-template-columns:2fr 1fr;gap:14px}
@media (max-width:980px){.info-strip{grid-template-columns:1fr}}
.tile{background:#fff;border:1px solid var(--line);border-radius:14px;padding:14px;box-shadow:0 10px 18px rgba(0,0,0,.06)}
.tile h3{font-size:1.1rem;margin-bottom:6px}
.small{color:#6b7a77;font-size:.92rem}
.badge{display:inline-block;padding:4px 10px;border-radius:999px;font-weight:700;font-size:.78rem;margin-right:6px;border:1px solid #bfece1;background:#e7f8f4;color:#1b907d}
.badge.red{border-color:#ffc3c3;background:#ffe9e9;color:#c43a3a}

/* count + chip */
.bar{max-width:1180px;margin:6px auto 10px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px}
.count{color:var(--muted)}
.chip{display:inline-flex;align-items:center;gap:6px;background:#e7f8f4;border:1px solid #bfece1;color:#1b907d;padding:6px 10px;border-radius:999px;font-weight:700;font-size:.85rem}

/* vet grid */
.grid{max-width:1180px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:18px}
.card{background:#fff;border:1px solid var(--line);border-radius:16px;overflow:hidden;box-shadow:0 10px 20px rgba(0,0,0,.06)}
.thumb{width:100%;aspect-ratio:16/10;background:#f6f8f8}
.thumb img{width:100%;height:100%;object-fit:cover;display:block}
.b{padding:14px 16px}
.name{font-weight:700}
.meta{color:#4c5e5b;font-size:.93rem;margin-top:6px}
.btn{display:block;margin-top:12px;text-align:center;background:var(--brand);color:#fff;text-decoration:none;font-weight:700;padding:11px;border-radius:12px}
.btn:hover{background:var(--brand2)}
.tag247{margin-left:8px}
.empty{max-width:800px;margin:18px auto;background:#fff;border:1px dashed var(--line);border-radius:14px;padding:16px;text-align:center;color:#60706d}
</style>
</head>
<body>
<?php include_once 'app/views/partials/nav.php'; ?>

<section class="hero">
  <div>
    <h1>Pet Clinic</h1>
    <p class="lead">Search vets near you, see who’s <b>open 24/7</b>, call the online helpline, and book a slot.</p>
    <form class="formbar" method="GET" action="<?=BASE_URL?>/Appointment/index">
      <input type="text" name="location" value="<?=htmlspecialchars($location ?? '')?>" placeholder="Search by city or area (e.g., Dhaka)" aria-label="Search location">
      <button type="submit">Find Vets</button>
    </form>
  </div>
  <figure class="hero-pic">
    <img src="https://www.waterwayanimalhospital.com/wp-content/uploads/sites/357/2022/12/AdobeStock_287230497-scaled.jpeg" alt="Happy dog at the clinic">
  </figure>
</section>

<?php
  // Compute 24/7 clinics from the search result (works if your vets table has `hours` like "24/7"
  // or a boolean column `is_24_7` = 1. If missing, nothing breaks.)
  $open247 = array_values(array_filter($vets ?? [], function($v){
      if (isset($v['is_24_7']) && (int)$v['is_24_7']===1) return true;
      if (!empty($v['hours']) && stripos($v['hours'],'24/7')!==false) return true;
      return false;
  }));
?>

<section class="info-strip">
  <div class="tile">
    <h3>📞 Online Helpline</h3>
    <div class="small">We’re here to guide you to an available vet and answer quick questions.</div>
    <div style="margin-top:8px;font-weight:700;font-size:1.05rem">
      <a href="tel:+880170000000" style="color:var(--brand);text-decoration:none">+880 1700-000000</a>
      <span class="badge">24/7</span>
    </div>
  </div>

  <div class="tile">
    <h3>🏥 24/7 Clinics<?= $location ? " near “".htmlspecialchars($location)."”" : "" ?></h3>
    <?php if ($open247): ?>
      <div class="small">
        <?php foreach($open247 as $i=>$c): ?>
          <span class="badge"><?=htmlspecialchars($c['name'])?></span>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="small">No specific 24/7 clinic in this search. Call the helpline for immediate assistance.</div>
    <?php endif; ?>
  </div>
</section>

<section class="bar">
  <?php $count = count($vets ?? []); ?>
  <div class="count">Showing <b><?=$count?></b> vet<?=($count==1?'':'s')?><?= $location ? " near “".htmlspecialchars($location)."”" : "" ?>.</div>
  <?php if(!empty($location)): ?><div class="chip">📍 <?=htmlspecialchars($location)?></div><?php endif; ?>
</section>

<?php if(!$vets): ?>
  <div class="empty">No vets found. Try a nearby city or a shorter search.</div>
<?php endif; ?>

<section class="grid">
  <?php
    $placeholder='https://www.waterwayanimalhospital.com/wp-content/uploads/sites/357/2022/12/AdobeStock_287230497-scaled.jpeg';
    foreach($vets as $v):
      $img = $v['photo'] ?: $placeholder;
      $is247 = (isset($v['is_24_7']) && (int)$v['is_24_7']===1) || (!empty($v['hours']) && stripos($v['hours'],'24/7')!==false);
  ?>
  <article class="card">
    <div class="thumb"><img src="<?=htmlspecialchars($img)?>" alt="<?=htmlspecialchars($v['name'])?>" onerror="this.src='<?=htmlspecialchars($placeholder)?>'"></div>
    <div class="b">
      <div class="name"><?=htmlspecialchars($v['name'])?> <?php if($is247): ?><span class="badge tag247">24/7</span><?php endif; ?></div>
      <div class="meta">📍 <?=htmlspecialchars($v['city'])?> — <?=htmlspecialchars($v['address'])?></div>
      <?php if(!empty($v['phone'])): ?><div class="meta">☎️ <?=htmlspecialchars($v['phone'])?></div><?php endif; ?>
      <?php if(!empty($v['hours'])): ?><div class="small" style="margin-top:4px">Hours: <?=htmlspecialchars($v['hours'])?></div><?php endif; ?>
      <a class="btn" href="<?=BASE_URL?>/Appointment/book?vet_id=<?=$v['id']?>">View Available Slots</a>
    </div>
  </article>
  <?php endforeach; ?>
</section>

</body>
</html>
