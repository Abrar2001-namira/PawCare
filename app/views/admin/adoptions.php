<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title>Admin • Adoption Applications</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6;padding:40px}
h1{text-align:center;margin:90px 0 1.4rem;font-size:2rem;font-weight:600;color:#41403e}
table{width:100%;background:#fff;border-collapse:collapse;border-radius:12px;overflow:hidden;box-shadow:0 6px 15px rgba(0,0,0,.08)}
th,td{padding:12px 14px;font-size:.9rem;vertical-align:top}
th{background:#26c1a8;color:#fff;text-align:left}
tr:nth-child(even){background:#fafafa}
img.thumb{width:44px;height:44px;object-fit:cover;border-radius:8px;margin-right:8px;vertical-align:middle}
.badge{display:inline-block;padding:4px 10px;border-radius:999px;font-weight:700;font-size:.78rem}
.pending{background:#fff3d6;color:#9b6b00;border:1px solid #f5d48a}
.accepted{background:#e7f8f4;color:#1b907d;border:1px solid #bfece1}
.rejected{background:#ffe6e6;color:#9c2a2a;border:1px solid #ffb2b2}
a.btn{display:inline-block;background:#26c1a8;color:#fff;text-decoration:none;padding:8px 12px;border-radius:10px;font-weight:600;margin-right:8px}
a.btn:hover{background:#1ea893}
a.btn-alt{display:inline-block;border:2px solid #26c1a8;color:#26c1a8;text-decoration:none;padding:6px 10px;border-radius:10px;font-weight:600}
a.btn-alt:hover{background:#e7f8f4}
.when{color:#777;font-size:.85rem}
.email,.phone{color:#555}
</style></head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<h1>Adoption Applications</h1>

<table>
<thead>
<tr>
  <th>ID</th>
  <th>Submitted</th>
  <th>Pet</th>
  <th>Applicant</th>
  <th>Contact</th>
  <th>City/State</th>
  <th>Status</th>
  <th style="width:22%">Actions</th>
</tr>
</thead>
<tbody>
<?php foreach($apps as $a): ?>
<tr>
  <td><?=$a['id']?></td>
  <td class="when"><?=date('Y-m-d H:i', strtotime($a['created']))?></td>
  <td>
    <img class="thumb" src="<?=htmlspecialchars($a['pet_image'])?>" alt="">
    <?=htmlspecialchars($a['pet_name'])?>
  </td>
  <td><?=htmlspecialchars($a['applicant_name'])?></td>
  <td>
    <div class="email"><?=htmlspecialchars($a['email'])?></div>
    <div class="phone"><?=htmlspecialchars($a['phone'])?></div>
  </td>
  <td><?=htmlspecialchars($a['city_state'])?></td>
  <td><span class="badge <?=$a['status']?>"><?=ucfirst($a['status'])?></span></td>
  <td>
    <?php if($a['status']==='pending'): ?>
      <a class="btn" href="<?=BASE_URL?>/AdminAdoption/accept?id=<?=$a['id']?>" onclick="return confirm('Accept this application and mark the pet as Adopted?')">Accept</a>
      <a class="btn-alt" href="<?=BASE_URL?>/AdminAdoption/reject?id=<?=$a['id']?>" onclick="return confirm('Reject this application?')">Reject</a>
    <?php else: ?><span class="when">No actions</span><?php endif; ?>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</body></html>
