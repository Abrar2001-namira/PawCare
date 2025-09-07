<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title>Product • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
:root{
  --brand:#26c1a8; --brand2:#1ea893;
  --ink:#163c35; --muted:#6f7b78; --bg:#f0faf6; --line:#e9e7e6;
}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:var(--bg);color:var(--ink);padding:40px 6%}

.wrap{max-width:1100px;margin:92px auto 24px;display:grid;grid-template-columns:1fr 1fr;gap:28px}
@media(max-width:980px){.wrap{grid-template-columns:1fr}}

.gallery{background:#fff;border:1px solid var(--line);border-radius:16px;overflow:hidden;box-shadow:0 10px 20px rgba(0,0,0,.06)}
.gallery .pic{width:100%;height:420px;background:#f6f8f8}
.gallery img{width:100%;height:100%;object-fit:cover;display:block}

.panel{background:#fff;border:1px solid var(--line);border-radius:16px;padding:20px;box-shadow:0 10px 20px rgba(0,0,0,.06)}
h1{font-size:1.8rem;margin-bottom:6px}
.meta{color:var(--muted);margin-bottom:10px}
.price{font-size:1.6rem;font-weight:800;color:#1b3f39;margin:8px 0 12px}
.desc{color:#475a56;line-height:1.55;white-space:pre-wrap}

.actions{display:flex;gap:10px;margin-top:16px}
.qty{display:flex;gap:8px;align-items:center;border:2px solid var(--line);border-radius:12px;padding:6px 10px}
.qty input{width:64px;border:none;outline:none;font-weight:700}
.btn{flex:1;text-align:center;text-decoration:none;padding:.9rem 1rem;border-radius:12px;font-weight:700}
.btn-primary{background:var(--brand);color:#fff}
.btn-primary:hover{background:var(--brand2)}
.btn-ghost{border:2px solid var(--brand);color:var(--brand);background:#fff}
.btn-ghost:hover{background:#eaf8f5}
</style></head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<?php $p = $data['prod']; ?>

<div class="wrap">
  <div class="gallery">
    <div class="pic">
      <img src="<?=htmlspecialchars($p['image'])?>" alt=""
           onerror="this.src='<?=BASE_URL?>/public/assets/images/product-placeholder.jpg'">
    </div>
  </div>

  <div class="panel">
    <h1><?=htmlspecialchars($p['name'])?></h1>
    <div class="meta"><?=htmlspecialchars($p['category'])?></div>
    <div class="price">$<?=number_format($p['price'],2)?></div>
    <div class="desc"><?=htmlspecialchars($p['description'])?></div>

    <div class="actions">
      <a class="btn btn-ghost" href="<?=BASE_URL?>/Shop/index">Back to shop</a>
      <form method="post" action="<?=BASE_URL?>/Cart/add?id=<?=$p['id']?>" style="flex:1;display:flex;gap:10px">
        <div class="qty">
          <label for="qty" style="font-weight:700;color:#1b3f39">Qty</label>
          <input id="qty" name="qty" type="number" value="1" min="1">
        </div>
        <button class="btn btn-primary" type="submit">Add to cart</button>
      </form>
    </div>
  </div>
</div>
</body></html>
