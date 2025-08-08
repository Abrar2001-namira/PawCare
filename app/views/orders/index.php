<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title>My Orders • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6;padding:40px}
h1{text-align:center;font-size:2rem;font-weight:600;color:#41403e;margin:90px 0 1.6rem}
table{width:100%;background:#fff;border-collapse:collapse;border-radius:12px;overflow:hidden;box-shadow:0 6px 15px rgba(0,0,0,.08)}
th,td{padding:14px 16px;font-size:.9rem}
th{background:#26c1a8;color:#fff;text-align:left}
tr:nth-child(even){background:#fafafa}
.empty{color:#555;text-align:center;margin-top:40px}
</style></head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<h1>My Orders</h1>

<?php if(!$orders): ?>
   <p class="empty">You haven’t placed any orders yet.</p>
<?php else: ?>
<table>
+ <thead><tr><th>ID</th><th>Date</th><th>Items</th><th>Total</th><th>Status</th></tr></thead>

<tbody>
<?php foreach($orders as $o): ?>
   <tr>
      <td><?=$o['id']?></td>
      <td><?=date('Y-m-d H:i', strtotime($o['created']))?></td>
      <td><?=htmlspecialchars($o['items'])?></td>
       <td>$<?=number_format($o['total'],2)?></td>
   <td><?=$o['status']?></td>
   </tr>
<?php endforeach;?>
</tbody>
</table>
<?php endif;?>
</body></html>
