<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title><?=htmlspecialchars($prod['name'])?> • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6;padding:40px 6%}
.card{background:#fff;border-radius:16px;box-shadow:0 8px 18px rgba(0,0,0,.08);display:flex;overflow:hidden;max-width:920px;margin:auto}
.card img{width:50%;object-fit:cover}
.info{padding:36px 40px;width:50%;display:flex;flex-direction:column}
h2{font-size:1.8rem;font-weight:600;color:#41403e;margin-bottom:.8rem}
.price{color:#ff8552;font-size:1.2rem;font-weight:700;margin-bottom:1rem}
.desc{color:#555;font-size:.95rem;line-height:1.4;flex:1}
form{margin-top:18px}
input[type=number]{width:70px;padding:.5rem;border:2px solid #e9e7e6;border-radius:8px;font-size:.95rem;margin-right:12px}
button{background:#26c1a8;color:#fff;border:none;padding:.65rem 22px;font-weight:600;border-radius:10px;cursor:pointer;transition:.3s}
button:hover{background:#1ea893}
@media(max-width:760px){.card{flex-direction:column}.card img,.info{width:100%}}
</style></head><body>
<?php include_once __DIR__.'/../partials/nav.php'; ?>

<div class="card" style="margin-top:90px">
    <img src="<?=htmlspecialchars($prod['image'])?>" alt="">
    <div class="info">
        <h2><?=htmlspecialchars($prod['name'])?></h2>
        <div class="price">$<?=number_format($prod['price'],2)?></div>
        <div class="desc"><?=htmlspecialchars($prod['description'])?></div>

        <form method="POST" action="<?=BASE_URL?>/Cart/add?id=<?=$prod['id']?>">
            <input type="number" name="qty" value="1" min="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
</div>
</body></html>
