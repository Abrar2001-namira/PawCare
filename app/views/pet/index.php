<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title>Pets for Adoption • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6;padding:40px 6%}
h1{text-align:center;font-size:2rem;font-weight:600;color:#41403e;margin:1.6rem 0}
.filters{text-align:center;margin-bottom:2rem}
.filters a{color:#26c1a8;text-decoration:none;font-weight:600;margin:0 .6rem;font-size:.95rem;transition:.2s}
.filters a:hover{color:#1b907d}
.filters .active{color:#ff8552}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:24px}
.card{background:#fff;border-radius:16px;box-shadow:0 8px 18px rgba(0,0,0,.08);overflow:hidden;transition:.25s}
.card:hover{transform:translateY(-6px)}
.card img{width:100%;height:180px;object-fit:cover}
.card-body{padding:16px}
.name{font-weight:600;font-size:1.1rem;color:#41403e}
.status{margin-top:8px;color:#fff;font-weight:600;padding:6px 10px;border-radius:8px;display:inline-block;font-size:.8rem}
.adopted{background:#aaa}
.available{background:#26c1a8}
a.card-link{text-decoration:none}
</style>
</head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<h1>🐾 Pets for Adoption</h1>
<div class="filters">
  <a href="<?=BASE_URL?>/Pet/index"            class="<?=!$species ? 'active':''?>">All</a>
  <a href="<?=BASE_URL?>/Pet/index?species=Dog" class="<?=$species==='Dog'?'active':''?>">Dogs</a>
  <a href="<?=BASE_URL?>/Pet/index?species=Cat" class="<?=$species==='Cat'?'active':''?>">Cats</a>
</div>

<div class="grid">
<?php foreach($pets as $p): ?>
  <a class="card-link" href="<?=BASE_URL?>/Pet/detail?id=<?=$p['id']?>">
    <div class="card">
      <img src="<?=htmlspecialchars($p['image'])?>" alt="">
      <div class="card-body">
        <div class="name"><?=htmlspecialchars($p['name'])?></div>
        <div class="status <?=$p['adopted'] ? 'adopted' : 'available'?>">
          <?=$p['adopted'] ? 'Adopted' : 'Available'?>
        </div>
      </div>
    </div>
  </a>
<?php endforeach; ?>
</div>
</body></html>
