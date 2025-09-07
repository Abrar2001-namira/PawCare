<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title>Appointment Confirmed • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
:root{--brand:#26c1a8;--bg:#f0faf6;--card:#fff}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:var(--bg);padding:40px 6%}
.card{max-width:760px;margin:110px auto;background:var(--card);border-radius:18px;box-shadow:0 10px 22px rgba(0,0,0,.08);padding:28px;text-align:center}
h1{font-size:1.9rem;margin-bottom:8px}
p{color:#555}
.badge{display:inline-block;margin-top:10px;background:#e7f8f4;border:1px solid #bfece1;color:#1b907d;padding:8px 14px;border-radius:999px;font-weight:700}
a.btn{display:inline-block;margin-top:16px;padding:11px 16px;background:var(--brand);color:#fff;text-decoration:none;border-radius:12px;font-weight:700}
</style></head><body>
<?php include_once 'app/views/partials/nav.php'; ?>
<div class="card">
  <h1>Appointment Confirmed 🎉</h1>
  <p>We booked <b><?=htmlspecialchars($a['pet_name'])?></b> with <b><?=htmlspecialchars($a['vet_name'])?></b> in <b><?=htmlspecialchars($a['vet_city'])?></b>.</p>
  <div class="badge"><?=htmlspecialchars($a['appt_date'])?> at <?=htmlspecialchars($a['slot'])?></div>
  <p style="margin-top:12px">You can view your upcoming and past bookings anytime.</p>
  <a class="btn" href="<?=BASE_URL?>/Appointment/history">View Appointment History</a>
</div>
</body></html>
