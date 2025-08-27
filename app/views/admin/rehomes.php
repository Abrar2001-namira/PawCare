<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title>Admin • ReHome Requests</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6;padding:40px}
h1{text-align:center;margin:90px 0 1.4rem;font-size:2rem;font-weight:600;color:#41403e}
table{width:100%;background:#fff;border-collapse:collapse;border-radius:12px;overflow:hidden;box-shadow:0 6px 15px rgba(0,0,0,.08)}
th,td{padding:12px 14px;font-size:.9rem;vertical-align:top}
th{background:#26c1a8;color:#fff;text-align:left}
tr:nth-child(even){background:#fafafa}
.badge{display:inline-block;padding:4px 10px;border-radius:999px;font-weight:700;font-size:.78rem}
.pending{background:#fff3d6;color:#9b6b00;border:1px solid #f5d48a}
.accepted{background:#e7f8f4;color:#1b907d;border:1px solid #bfece1}
.rejected{background:#ffe6e6;color:#9c2a2a;border:1px solid #ffb2b2}
a.btn{display:inline-block;background:#26c1a8;color:#fff;text-decoration:none;padding:8px 12px;border-radius:10px;font-weight:600;margin-right:8px}
a.btn:hover{background:#1ea893}
a.btn-alt{display:inline-block;border:2px solid #26c1a8;color:#26c1a8;text-decoration:none;padding:6px 10px;border-radius:10px;font-weight:600}
a.btn-alt:hover{background:#e7f8f4}
.note{color:#555;white-space:pre-wrap}
</style></head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<h1>ReHome Requests</h1>

<table>
<thead>
  <tr>
    <th>ID</th><th>Date</th><th>Pet</th><th>Owner</th>
    <th>Contact</th><th>Address</th><th>Status</th><th style="width:22%">Actions</th>
  </tr>
</thead>
<tbody>
<?php foreach($list as $r): ?>
<tr>
  <td><?=$r['id']?></td>
  <td><?=date('Y-m-d H:i', strtotime($r['created']))?></td>
  <td>
    <div><b><?=htmlspecialchars($r['name'])?></b> (<?=htmlspecialchars($r['species'])?>)</div>
    <?php if(!empty($r['image'])): ?>
      <div><img src="<?=htmlspecialchars($r['image'])?>" alt="" style="height:44px;width:44px;object-fit:cover;border-radius:8px;margin-top:4px"></div>
    <?php endif; ?>
    <div class="note"><?=htmlspecialchars($r['story'])?></div>
  </td>
  <td><?=htmlspecialchars($r['owner_name'])?></td>
  <td>
    <div><?=htmlspecialchars($r['owner_email'])?></div>
    <div><?=htmlspecialchars($r['owner_phone'])?></div>
  </td>
  <td><?=htmlspecialchars($r['address'])?></td>
  <td><span class="badge <?=$r['status']?>"><?=ucfirst($r['status'])?></span></td>
  <td>
    <?php if($r['status']==='pending'): ?>
      <a class="btn" href="<?=BASE_URL?>/AdminRehome/accept?id=<?=$r['id']?>" onclick="return confirm('Accept and add this pet to the list?')">Accept</a>
      <a class="btn-alt" href="<?=BASE_URL?>/AdminRehome/reject?id=<?=$r['id']?>" onclick="return confirm('Reject this request?')">Reject</a>
    <?php else: ?>
      <span style="color:#777">No actions</span>
    <?php endif; ?>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</body></html>
