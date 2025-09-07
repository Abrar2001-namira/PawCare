<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title>Appointment History • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6;padding:40px}
.container{max-width:1050px;margin:90px auto 40px}
h1{font-size:2rem;font-weight:600;color:#41403e;margin-bottom:16px;text-align:center}
.sub{color:#6f7b78;font-size:.95rem;text-align:center;margin-bottom:24px}

.table{width:100%;border-collapse:collapse;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 6px 15px rgba(0,0,0,.08)}
th,td{padding:14px 16px;font-size:.92rem;vertical-align:top}
th{background:#26c1a8;color:#fff;text-align:left}
tr:nth-child(even){background:#fafafa}

.when{color:#1b3f39;font-weight:700}
.where{color:#445b58}
.pet{color:#445b58}
.note{color:#6a6a6a;font-size:.85rem}

.badge{display:inline-block;padding:4px 10px;border-radius:999px;font-weight:700;font-size:.78rem;margin-left:6px}
.booked{background:#e7f8f4;border:1px solid #bfece1;color:#1b907d}
.completed{background:#e8eafc;border:1px solid #c7cbff;color:#343a8b}
.cancelled{background:#ffe6e6;border:1px solid #ffb2b2;color:#9c2a2a}
.expired{background:#fff3d6;border:1px solid #f5d48a;color:#9b6b00}

.btn{display:inline-block;border:2px solid #26c1a8;color:#26c1a8;padding:.55rem .9rem;border-radius:10px;font-weight:700;text-decoration:none}
.btn:hover{background:#eaf8f5}
.empty{background:#fff;border:1px solid #e9e7e6;border-radius:12px;padding:18px;text-align:center;color:#60706d}
.topbar{display:flex;justify-content:flex-end;margin:10px 0 16px}
</style>
</head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<div class="container">
  <h1>Appointment History</h1>
  <div class="sub">All of your bookings in one place. Past, cancelled, and completed visits are listed below.</div>

  <div class="topbar">
    <a class="btn" href="<?=BASE_URL?>/Appointment/index">Book a Vet</a>
  </div>

<?php if (empty($list)): ?>
  <div class="empty">No appointments yet. Click “Book a Vet” to get started.</div>
<?php else: ?>

  <table class="table">
    <thead>
      <tr>
        <th style="width:180px">When</th>
        <th>Clinic</th>
        <th>For</th>
        <th style="width:120px">Status</th>
        <th style="width:28%">Notes</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $today  = new DateTime('today');
        $now    = new DateTime(); // current date + time
        foreach ($list as $r):
          // Format date & time
          $dStr = date('M d, Y', strtotime($r['appt_date']));
          $tStr = date('g:i A',      strtotime($r['slot']));

          // Determine visual status. If it's still "booked" but in the past, show "Expired".
          $status = strtolower($r['status']);
          $badge  = $status; // default class matches status

          // Build DateTime for the appointment moment
          $apptDT = DateTime::createFromFormat('Y-m-d H:i', $r['appt_date'].' '.$r['slot']);
          if ($status === 'booked' && $apptDT < $now) {
              $badge  = 'expired';
              $status = 'expired';
          }
      ?>
      <tr>
        <td class="when"><?=$dStr?> • <?=$tStr?></td>
        <td class="where"><strong><?=htmlspecialchars($r['vet_name'])?></strong> (<?=htmlspecialchars($r['vet_city'])?>)</td>
        <td class="pet"><?=htmlspecialchars($r['pet_name'])?></td>
        <td><span class="badge <?=$badge?>"><?=ucfirst($status)?></span></td>
        <td class="note"><?=htmlspecialchars($r['notes'] ?: '—')?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

<?php endif; ?>
</div>
</body></html>
