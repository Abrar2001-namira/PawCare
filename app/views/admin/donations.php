<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title>Admin • Donations</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6;padding:40px}
h1{text-align:center;margin:90px 0 1.6rem;font-size:2rem;font-weight:600;color:#41403e}
table{width:100%;background:#fff;border-collapse:collapse;border-radius:12px;overflow:hidden;box-shadow:0 6px 15px rgba(0,0,0,.08)}
th,td{padding:14px 16px;font-size:.9rem;vertical-align:top}
th{background:#26c1a8;color:#fff;text-align:left}
tr:nth-child(even){background:#fafafa}
.amount{font-weight:700;color:#ff8552}
.note{color:#555;font-size:.85rem}
.when{color:#777;font-size:.85rem}
</style></head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<h1>Donations</h1>

<table>
<thead>
  <tr>
    <th>ID</th>
    <th>Date</th>
    <th>Shelter</th>
    <th>Donor Name</th>
    <th>Donor Email</th>
    <th>Amount</th>
    <th>Note</th>
  </tr>
</thead>
<tbody>
<?php foreach($donations as $d): ?>
<tr>
  <td><?=$d['id']?></td>
  <td class="when"><?=date('Y-m-d H:i', strtotime($d['created']))?></td>
  <td><?=htmlspecialchars($d['shelter_name'] ?? '—')?></td>
  <td><?=htmlspecialchars($d['name'] ?: '—')?></td>
  <td><?=htmlspecialchars($d['email'] ?: '—')?></td>
  <td class="amount">$<?=number_format($d['amount'],2)?></td>
  <td class="note"><?=htmlspecialchars($d['note'] ?: '')?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</body></html>
