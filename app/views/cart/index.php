<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title>Your Cart • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}body{font-family:'Quicksand',sans-serif;background:#f0faf6;padding:40px}
h1{text-align:center;font-size:2rem;font-weight:600;color:#41403e;margin:90px 0 1.6rem}
table{width:100%;background:#fff;border-collapse:collapse;border-radius:12px;overflow:hidden;box-shadow:0 6px 15px rgba(0,0,0,.08)}
th,td{padding:14px 16px;font-size:.9rem}
th{background:#26c1a8;color:#fff;text-align:left}
tr:nth-child(even){background:#fafafa}
.total{font-weight:700;color:#ff8552;text-align:right;padding-top:18px}
a.btn{display:inline-block;background:#26c1a8;color:#fff;text-decoration:none;padding:12px 28px;border-radius:10px;font-weight:600;margin-top:20px}
a.btn:hover{background:#1ea893}
</style></head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<h1>Your Cart</h1>

<?php if(!$data['items']): ?>
   <p style="text-align:center;color:#555">Your cart is empty.</p>
<?php else: ?>
<table>
<thead><tr><th>Product</th><th>Qty</th><th>Price</th><th>Line</th><th></th></tr></thead>
<tbody>
   <?php foreach($data['items'] as $i): ?>
      <tr>
        <td><?=htmlspecialchars($i['name'])?></td>
        <td><?=$i['qty']?></td>
        <td>$<?=number_format($i['price'],2)?></td>
        <td>$<?=number_format($i['line'],2)?></td>
        <td><a style="color:#ff8552;text-decoration:none;font-weight:600" href="<?=BASE_URL?>/Cart/remove?id=<?=$i['id']?>">Remove</a></td>
      </tr>
   <?php endforeach;?>
</tbody>
</table>

<div class="total">Total  $<?=number_format($data['total'],2)?></div>
<div style="text-align:right"><<a class="btn" href="<?=BASE_URL?>/Cart/checkout">Checkout</a></div>
<?php endif;?>
</body></html>
