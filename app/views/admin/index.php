<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title>Admin • Products</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}body{font-family:'Quicksand',sans-serif;background:#f0faf6;padding:40px}
h1{font-size:2rem;font-weight:600;color:#41403e;margin-bottom:1.6rem;text-align:center}
a.btn{background:#26c1a8;color:#fff;text-decoration:none;padding:10px 22px;border-radius:10px;font-weight:600}
a.btn:hover{background:#1ea893}
table{width:100%;margin-top:20px;border-collapse:collapse;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 6px 15px rgba(0,0,0,.08)}
th,td{padding:14px 16px;font-size:.9rem}
th{background:#26c1a8;color:#fff;text-align:left}
tr:nth-child(even){background:#fafafa}
.actions a{margin-right:10px;color:#ff8552;text-decoration:none;font-weight:600}
.actions a:hover{color:#e4713f}
</style></head><body>
  <?php include_once 'app/views/partials/nav.php'; ?>

<h1>🐾 Admin Dashboard – Products</h1>
<div style="text-align:right"><a class="btn" href="<?=BASE_URL?>/Admin/add">+ Add Product</a></div>

<table>
<thead><tr><th>ID</th><th>Name</th><th>Cat.</th><th>Price</th><th style="width:22%">Actions</th></tr></thead>
<tbody>
<?php foreach($data['products'] as $p): ?>
<tr>
    <td><?=$p['id']?></td>
    <td><?=htmlspecialchars($p['name'])?></td>
    <td><?=$p['category']?></td>
    <td>$<?=number_format($p['price'],2)?></td>
    <td class="actions">
        <!-- now uses ?id= to pass product id -->
        <a href="<?=BASE_URL?>/Admin/edit?id=<?=$p['id']?>">Edit</a>
        <a href="<?=BASE_URL?>/Admin/delete?id=<?=$p['id']?>" onclick="return confirm('Delete this product?')">Delete</a>
    </td>
</tr>
<?php endforeach;?>
</tbody>
</table>
</body></html>
