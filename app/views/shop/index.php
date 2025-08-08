<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PawCare • Pet Shop</title>

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">

    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Quicksand',sans-serif;background:#f0faf6;padding:40px 6%}
        h1{font-size:2.1rem;font-weight:600;color:#41403e;text-align:center;margin:1.6rem 0}

        .filters{text-align:center;margin-bottom:2rem}
        .filters a{color:#26c1a8;text-decoration:none;font-weight:600;margin:0 .6rem;font-size:.95rem;transition:.2s}
        .filters a:hover{color:#1b907d}
        .filters .active{color:#ff8552}

        .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:24px}
        .card{background:#fff;border-radius:16px;box-shadow:0 8px 18px rgba(0,0,0,.08);display:flex;flex-direction:column;overflow:hidden;transition:.25s}
        .card:hover{transform:translateY(-6px)}
        .card img{width:100%;height:150px;object-fit:cover}
        .category-tag{position:absolute;top:12px;left:12px;background:#26c1a8;color:#fff;font-size:.75rem;font-weight:600;padding:4px 8px;border-radius:12px}
        .card-wrap{position:relative}
        .card-body{padding:18px 20px}
        .name{font-weight:600;color:#41403e;font-size:1.05rem;margin-bottom:.4rem}
        .price{color:#ff8552;font-weight:700;font-size:1rem}
        a.card-link{text-decoration:none}
    </style>
</head>
<body>
<?php include_once __DIR__.'/../partials/nav.php'; ?> <!-- fixed path -->

<h1>🐾 PawCare Shop</h1>

<div class="filters">
<?php
$cats=['All','Food','Medicine','Toy','Accessories'];
foreach($cats as $c){
    $act=($data['cat']===$c || ($c==='All' && !$data['cat']));
    $url=$c==='All'?BASE_URL.'/Shop/index':BASE_URL.'/Shop/index?cat='.$c;
    echo '<a href="'.$url.'" class="'.($act?'active':'').'">'.$c.'</a>';
}
?>
</div>

<div class="grid">
<?php foreach($data['products'] as $p): ?>
 <a class="card-link" href="<?=BASE_URL?>/Shop/detail?id=<?=$p['id']?>">


   <div class="card">
      <div class="card-wrap">
         <span class="category-tag"><?=$p['category']?></span>
         <img src="<?=htmlspecialchars($p['image'])?>" alt="<?=htmlspecialchars($p['name'])?>">
      </div>
      <div class="card-body">
         <div class="name"><?=htmlspecialchars($p['name'])?></div>
         <div class="price">$<?=number_format($p['price'],2)?></div>
      </div>
   </div>
 </a>
<?php endforeach; ?>
</div>
</body>
</html>
