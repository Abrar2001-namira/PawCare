<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8">
<title>All Pets • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
:root{ --brand:#26c1a8; --ink:#41403e; --muted:#777; --bg:#f0faf6; --card:#fff; --line:#e9e7e6; }
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:var(--bg);padding:40px 6%}
h1{font-size:2rem;font-weight:700;color:var(--ink);text-align:center;margin:90px 0 16px}

/* Tabs + search */
.bar{max-width:1100px;margin:0 auto 14px;display:flex;flex-wrap:wrap;gap:10px;align-items:center;justify-content:space-between}
.tabs{display:flex;gap:10px;flex-wrap:wrap}
.tab{display:inline-block;padding:8px 14px;border-radius:999px;border:2px solid var(--brand);color:var(--brand);text-decoration:none;font-weight:700}
.tab.active{background:var(--brand);color:#fff}
.search{display:flex;gap:8px;align-items:center}
.search input{width:260px;max-width:60vw;padding:.7rem 1rem;border:2px solid var(--line);border-radius:12px}
.search input:focus{outline:none;border-color:var(--brand)}
.search button{padding:.7rem 1rem;border:none;background:var(--brand);color:#fff;border-radius:12px;font-weight:700;cursor:pointer}
.counter{max-width:1100px;margin:6px auto 14px;color:var(--muted);font-size:.95rem}

/* grid */
.grid{max-width:1100px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fill,minmax(230px,1fr));gap:16px}
.card{background:var(--card);border-radius:14px;box-shadow:0 6px 14px rgba(0,0,0,.08);overflow:hidden}
.card img{width:100%;height:170px;object-fit:cover}
.card .b{padding:12px 14px}
.card .name{font-weight:700;color:var(--ink)}
.meta{font-size:.9rem;color:#555;margin-top:4px}
.badge{display:inline-block;margin-top:8px;padding:3px 10px;border-radius:999px;font-weight:700;font-size:.78rem}
.avail{background:#e7f8f4;color:#1b907d;border:1px solid #bfece1}
.adopt{background:#ffe6e6;color:#9c2a2a;border:1px solid #ffb2b2}
.btn{display:block;text-align:center;margin:10px 0 2px;padding:8px 12px;background:var(--brand);color:#fff;text-decoration:none;border-radius:10px;font-weight:700}
.btn:hover{background:#1ea893}
.loc{color:#777;font-size:.85rem;margin-top:6px}
</style>
</head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<h1>Find Your New Best Friend</h1>

<?php
  $species  = $data['species']  ?? null;
  $location = $data['location'] ?? '';
  $q = urlencode($location);
  $link = function($sp) use($q){
    $base = BASE_URL.'/Pet/index';
    if ($sp)  return $base.'?species='.$sp.($q!=='' ? '&location='.$q : '');
    return $base.($q!=='' ? '?location='.$q : '');
  };
?>
<div class="bar">
  <div class="tabs">
    <a class="tab <?=(!$species?'active':'')?>" href="<?=$link(null)?>">All</a>
    <a class="tab <?=($species==='Dog'?'active':'')?>" href="<?=$link('Dog')?>">Dog</a>
    <a class="tab <?=($species==='Cat'?'active':'')?>" href="<?=$link('Cat')?>">Cat</a>
  </div>

  <form class="search" method="GET" action="<?=BASE_URL?>/Pet/index">
    <?php if($species): ?><input type="hidden" name="species" value="<?=$species?>"><?php endif;?>
    <input type="text" name="location" value="<?=htmlspecialchars($location)?>" placeholder="Search by location (e.g., Dhaka)">
    <button type="submit">Search</button>
  </form>
</div>

<div class="counter">
  <?php $count = count($data['pets']); ?>
  Showing <b><?=$count?></b> pet<?=$count==1?'':'s'?><?=$location ? " near “".htmlspecialchars($location)."”" : ""?><?=$species ? " in ".$species : ""?>.
</div>

<div class="grid">
<?php foreach($data['pets'] as $p): ?>
  <div class="card">
    <img src="<?=htmlspecialchars($p['image'])?>" alt="<?=htmlspecialchars($p['name'])?>">
    <div class="b">
      <div class="name"><?=htmlspecialchars($p['name'])?> • <?=htmlspecialchars($p['species'])?></div>
      <div class="meta"><?=htmlspecialchars($p['breed'])?> • <?=htmlspecialchars($p['age'])?></div>
      <div class="loc">📍 <?=htmlspecialchars($p['location'] ?: '—')?></div>
      <span class="badge <?=$p['adopted']?'adopt':'avail'?>"><?=$p['adopted']?'Adopted':'Available'?></span>
      <a class="btn" href="<?=BASE_URL?>/Pet/detail?id=<?=$p['id']?>">View</a>
    </div>
  </div>
<?php endforeach; ?>
</div>

</body></html>
