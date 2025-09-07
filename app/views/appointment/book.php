<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Book Appointment • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
:root{
  --brand:#26c1a8; --brand2:#1ea893;
  --ink:#163c35; --muted:#6c7e7b; --bg:#f0faf6; --card:#fff; --line:#e9e7e6; --danger:#ff6b6b;
}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:var(--bg);color:var(--ink);padding:40px 6%}
.wrap{max-width:960px;margin:92px auto 26px}
.card{background:var(--card);border:1px solid var(--line);border-radius:16px;box-shadow:0 10px 20px rgba(0,0,0,.06);padding:18px}
.header{display:grid;grid-template-columns:240px 1fr;gap:16px}
@media (max-width:800px){.header{grid-template-columns:1fr}}
.hero{width:100%;aspect-ratio:4/3;border-radius:12px;overflow:hidden;background:#f6f8f8}
.hero img{width:100%;height:100%;object-fit:cover;display:block}
h1{font-size:1.5rem;margin-bottom:6px}
.meta{color:#4c5e5b;font-size:.95rem;margin-top:6px}
.badge{display:inline-block;padding:4px 10px;border-radius:999px;font-weight:700;font-size:.78rem;border:1px solid #bfece1;background:#e7f8f4;color:#1b907d}
.badge.red{border-color:#ffc3c3;background:#ffe9e9;color:#c43a3a}
.helpline{margin-top:8px;font-weight:700}
.helpline a{color:var(--brand);text-decoration:none}

/* date switcher */
.switcher{margin:14px 0 8px;display:flex;gap:10px;flex-wrap:wrap}
.switcher input{padding:.7rem;border:2px solid var(--line);border-radius:12px}
.switcher button{padding:.7rem 1rem;border:none;border-radius:12px;background:var(--brand);color:#fff;font-weight:700;cursor:pointer}
.switcher button:hover{background:var(--brand2)}

/* slots */
h2{font-size:1.1rem;margin:12px 0 8px}
.legend{font-size:.85rem;color:#6a7a77;margin-bottom:6px}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(110px,1fr));gap:10px}
.slot{position:relative}
.slot input{display:none}
.slot label{
  display:block;text-align:center;padding:.8rem;border-radius:12px;border:2px solid var(--brand);
  color:var(--brand);cursor:pointer;font-weight:700;background:#e7f8f4;
}
.slot input:checked + label{background:var(--brand);color:#fff}
.slot.busy label{border-color:#ffc3c3;background:#ffe9e9;color:#c43a3a;cursor:not-allowed}
.slot.busy label:after{content:"Booked";position:absolute;right:8px;top:8px;font-size:.7rem;background:#ffdad9;color:#9c2a2a;padding:2px 6px;border-radius:999px}
.actions{margin-top:12px;display:grid;gap:10px}
input[type="text"],textarea{width:100%;padding:.85rem;border:2px solid var(--line);border-radius:12px}
input[type="text"]:focus,textarea:focus{outline:none;border-color:var(--brand)}
button.primary{padding:1rem;border:none;border-radius:12px;background:var(--brand);color:#fff;font-weight:700;cursor:pointer}
button.primary:hover{background:var(--brand2)}
</style>
</head>
<body>
<?php include_once 'app/views/partials/nav.php'; ?>
<div class="wrap">
  <div class="card">
    <div class="header">
      <figure class="hero">
        <?php $placeholder='https://images.unsplash.com/photo-1559757148-5c350d0d3c56?q=80&w=1200&auto=format&fit=crop';
              $img = $vet['photo'] ?: $placeholder; ?>
        <img src="<?=htmlspecialchars($img)?>" alt="<?=htmlspecialchars($vet['name'])?>" onerror="this.src='<?=htmlspecialchars($placeholder)?>'">
      </figure>
      <div>
        <h1><?=htmlspecialchars($vet['name'])?>
          <?php
            $is247 = (isset($vet['is_24_7']) && (int)$vet['is_24_7']===1) || (!empty($vet['hours']) && stripos($vet['hours'],'24/7')!==false);
            if($is247): ?><span class="badge">24/7</span><?php endif; ?>
        </h1>
        <div class="meta">📍 <?=htmlspecialchars($vet['city'])?> — <?=htmlspecialchars($vet['address'])?></div>
        <?php if(!empty($vet['phone'])): ?><div class="meta">☎️ <?=htmlspecialchars($vet['phone'])?></div><?php endif; ?>
        <?php if(!empty($vet['hours'])): ?><div class="meta">⏰ Hours: <?=htmlspecialchars($vet['hours'])?></div><?php endif; ?>
        <div class="helpline">Online Helpline: <a href="tel:+880170000000">+880 1700-000000</a> <span class="badge">24/7</span></div>

        <!-- date switcher -->
        <form class="switcher" method="get" action="<?=BASE_URL?>/Appointment/book">
          <input type="hidden" name="vet_id" value="<?=$vet['id']?>">
          <input type="date" name="date" value="<?=$date?>">
          <button type="submit">Check Date</button>
        </form>

        <h2>Available slots for checkup — <?=date('M d, Y', strtotime($date))?></h2>
        <div class="legend">Green = Available &nbsp;&nbsp;|&nbsp;&nbsp; <span class="badge red" style="border:none">Red</span> = Booked</div>

        <!-- booking form -->
        <form method="post" action="<?=BASE_URL?>/Appointment/book">
          <input type="hidden" name="vet_id" value="<?=$vet['id']?>">
          <input type="hidden" name="appt_date" value="<?=$date?>">

          <div class="grid">
            <?php foreach($slots as $s):
                  $busy = in_array($s,$taken,true); ?>
              <div class="slot <?=$busy?'busy':''?>">
                <?php if($busy): ?>
                  <input disabled type="radio" id="s<?=$s?>">
                  <label for="s<?=$s?>"><?=$s?></label>
                <?php else: ?>
                  <input type="radio" name="slot" id="s<?=$s?>" value="<?=$s?>">
                  <label for="s<?=$s?>"><?=$s?></label>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>

          <div class="actions">
            <input type="text" name="pet_name" placeholder="Your pet's name *" required>
            <textarea name="notes" rows="2" placeholder="Notes for the vet (optional)"></textarea>
            <button class="primary" type="submit">Confirm Booking</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
</body>
</html>
