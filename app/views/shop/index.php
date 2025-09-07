<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title>PawCare • Shop</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
:root{
  --brand:#26c1a8; --brand2:#1ea893;
  --ink:#163c35; --muted:#6f7b78;
  --bg:#f0faf6; --card:#ffffff; --line:#e9e7e6;
}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:var(--bg);color:var(--ink);padding:40px 6%}

/* hero */
.hero{max-width:1180px;margin:92px auto 22px;display:grid;grid-template-columns:1.15fr .85fr;gap:22px;align-items:center}
@media(max-width:980px){.hero{grid-template-columns:1fr}}
h1{font-size:2.2rem;line-height:1.2;margin-bottom:6px}
.lead{color:var(--muted)}
.hero-card{background:var(--card);border:1px solid var(--line);border-radius:16px;padding:20px;box-shadow:0 10px 20px rgba(0,0,0,.06)}
.hero-pic{height:220px;border-radius:16px;overflow:hidden;background:#eaf8f5;box-shadow:0 10px 20px rgba(0,0,0,.06)}
.hero-pic img{width:100%;height:100%;object-fit:cover;display:block}

/* toolbar */
.toolbar{max-width:1180px;margin:6px auto 18px;display:flex;flex-wrap:wrap;gap:10px;align-items:center}
.tab{display:inline-block;padding:8px 12px;border:1px solid #bfece1;background:#e7f8f4;color:#1b907d;border-radius:999px;font-weight:700;text-decoration:none}
.tab.active{background:var(--brand);border-color:var(--brand);color:#fff}
.search{margin-left:auto;display:flex;gap:8px}
.search input{padding:.75rem 1rem;border:2px solid var(--line);border-radius:12px;background:#fff;min-width:240px}
.search button{padding:.75rem 1rem;border:none;border-radius:12px;background:var(--brand);color:#fff;font-weight:700;cursor:pointer}
.search button:hover{background:var(--brand2)}
@media(max-width:720px){.search{width:100%}.search input{flex:1;min-width:0}}

/* grid */
.grid{max-width:1180px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fill,minmax(230px,1fr));gap:16px}
.card{background:#fff;border:1px solid var(--line);border-radius:16px;overflow:hidden;display:flex;flex-direction:column;box-shadow:0 10px 20px rgba(0,0,0,.06);transition:transform .18s ease, box-shadow .18s ease}
.card:hover{transform:translateY(-3px);box-shadow:0 14px 24px rgba(0,0,0,.09)}
.thumb{width:100%;height:170px;background:#f6f8f8;position:relative}
.thumb img{width:100%;height:100%;object-fit:cover;display:block}
.badge{position:absolute;left:10px;top:10px;background:#fff;border:1px solid var(--line);padding:4px 8px;border-radius:999px;font-weight:700;font-size:.78rem;color:#1b3f39}
.b{padding:14px 16px;display:flex;flex-direction:column;gap:8px}
.name{font-weight:700}
.cat{font-size:.85rem;color:#60706d}
.price-row{display:flex;align-items:center;justify-content:space-between}
.price{font-size:1.05rem;font-weight:800;color:#1b3f39}
.actions{margin-top:6px;display:flex;gap:10px}
.btn{flex:1;text-align:center;text-decoration:none;padding:.7rem;border-radius:12px;font-weight:700}
.btn-primary{background:var(--brand);color:#fff}
.btn-primary:hover{background:var(--brand2)}
.btn-ghost{border:2px solid var(--brand);color:var(--brand);background:#fff}
.btn-ghost:hover{background:#eaf8f5}

/* empty */
.empty{max-width:880px;margin:20px auto;background:#fff;border:1px dashed var(--line);border-radius:14px;padding:16px;text-align:center;color:#60706d}
</style>
</head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<section class="hero">
  <div class="hero-card">
    <h1>Pet Shop</h1>
    <p class="lead">Healthy food, playful toys, comfy accessories—everything your buddy loves, in one place.</p>
  </div>
  <figure class="hero-pic">
    <img src="https://www.shutterstock.com/image-photo/dog-cat-shopping-cart-on-600nw-2174056805.jpg"
         alt="" onerror="this.src='<?=BASE_URL?>/public/assets/images/shop-hero.jpg'">
  </figure>
</section>

<?php
  // Category tabs use existing ShopController index?cat=...
  $active = $data['cat'] ?? null;
  $mk = function($label,$cat) use($active){
    $is = ($active===$cat || ($cat===null && $active===null));
    $href = $cat ? BASE_URL.'/Shop/index?cat='.urlencode($cat) : BASE_URL.'/Shop/index';
    return '<a class="tab'.($is?' active':'').'" href="'.$href.'">'.($label).'</a>';
  };
?>
<div class="toolbar">
  <?=$mk('All', null)?>
  <?=$mk('Food', 'Food')?>
  <?=$mk('Medicine', 'Medicine')?>
  <?=$mk('Toy', 'Toy')?>
  <?=$mk('Accessories', 'Accessories')?>

  <!-- quick client-side filter by name -->
  <form class="search" onsubmit="event.preventDefault()">
    <input id="q" type="text" placeholder="Search product name...">
    <button onclick="filterCards()">Search</button>
  </form>
</div>

<?php if(empty($data['products'])): ?>
  <div class="empty">No products found in this category.</div>
<?php endif; ?>

<section id="grid" class="grid">
<?php foreach($data['products'] as $p): ?>
  <article class="card" data-name="<?=htmlspecialchars(strtolower($p['name']))?>">
    <div class="thumb">
      <img src="<?=htmlspecialchars($p['image'])?>" alt=""
           onerror="this.src='<?=BASE_URL?>/public/assets/images/product-placeholder.jpg'">
      <span class="badge"><?=htmlspecialchars($p['category'])?></span>
    </div>
    <div class="b">
      <div class="name"><?=htmlspecialchars($p['name'])?></div>
      <div class="price-row">
        <div class="cat">for happy pets</div>
        <div class="price">$<?=number_format($p['price'],2)?></div>
      </div>

      <div class="actions">
        <a class="btn btn-ghost" href="<?=BASE_URL?>/Shop/detail?id=<?=$p['id']?>">Details</a>
        <form method="post" action="<?=BASE_URL?>/Cart/add?id=<?=$p['id']?>" style="flex:1">
          <input type="hidden" name="qty" value="1">
          <button class="btn btn-primary" type="submit">Add to cart</button>
        </form>
      </div>
    </div>
  </article>
<?php endforeach; ?>
</section>

<script>
function filterCards(){
  const q = (document.getElementById('q').value || '').trim().toLowerCase();
  const items = document.querySelectorAll('#grid .card');
  items.forEach(el=>{
    const n = el.getAttribute('data-name');
    el.style.display = (!q || (n && n.indexOf(q)>-1)) ? '' : 'none';
  });
}
</script>
</body></html>
