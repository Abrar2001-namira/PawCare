<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title>My Profile • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6;padding:40px 6%}
.card{background:#fff;border-radius:16px;box-shadow:0 8px 18px rgba(0,0,0,.08);max-width:880px;margin:100px auto 24px;padding:26px}
h2{color:#41403e;font-size:1.6rem;font-weight:600;margin-bottom:8px}
.small{color:#777;font-size:.88rem}
.avatar{width:88px;height:88px;border-radius:50%;background:#eaf8f5;border:2px solid #d6f2ea;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.6rem;color:#26c1a8;margin-bottom:10px}
.field{background:#fafafa;border:1px solid #e9e7e6;border-radius:12px;padding:10px 12px;margin-top:12px}
.label{font-weight:700;color:#41403e;font-size:.9rem}
.value{color:#555;margin-top:4px;white-space:pre-wrap}
.bio{white-space:pre-wrap;line-height:1.45;color:#555}
button.primary{margin-top:16px;background:#26c1a8;color:#fff;border:none;width:100%;padding:.95rem;font-weight:700;font-size:1rem;border-radius:12px;cursor:pointer;transition:.25s}
button.primary:hover{background:#1ea893}
a.link{display:block;text-align:center;margin-top:10px;color:#26c1a8;text-decoration:none;font-weight:700}
a.link:hover{text-decoration:underline}
.section-title{margin-top:18px;font-weight:700;color:#41403e}
.appt-box,.vax-box{margin-top:8px;background:#fff;border:1px solid #e9e7e6;border-radius:12px}
.row{display:flex;gap:12px;align-items:center;padding:12px;border-top:1px solid #f1efee}
.row:first-child{border-top:none}
.when{min-width:160px;color:#1b3f39;font-weight:700}
.who{color:#445b58}
.badge{display:inline-block;padding:4px 10px;border-radius:999px;font-weight:700;font-size:.78rem;margin-left:8px}
.booked{background:#e7f8f4;border:1px solid #bfece1;color:#1b907d}
.completed{background:#e8eafc;border:1px solid #c7cbff;color:#343a8b}
.cancelled{background:#ffe6e6;border:1px solid #ffb2b2;color:#9c2a2a}
.soon{background:#fff3d6;border:1px solid #f5d48a;color:#9b6b00}
.empty{padding:14px;color:#60706d}
.actions-row{display:flex;gap:10px;margin-top:10px}
.btn-outline{display:inline-block;padding:.7rem 1rem;border:2px solid #26c1a8;color:#26c1a8;border-radius:12px;font-weight:700;text-decoration:none;text-align:center;flex:1}
.btn-outline:hover{background:#eaf8f5}
.btn-cancel{margin-left:auto;background:#fff;border:2px solid #ff6b6b;color:#ff6b6b;padding:.55rem .8rem;border-radius:10px;font-weight:700;cursor:pointer}
.btn-cancel:hover{background:#ffefef}
</style></head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<?php
  // $u comes from UserController::profile
  // Load upcoming appointments and vaccination reminders (next 30 days)
  $apptUpcoming = $this->model('Appointment')->upcomingByUser($u['id'] ?? $_SESSION['user_id'] ?? 0, 6);
  $vaxSoon      = $this->model('Vaccination')->upcomingDue($u['id'] ?? $_SESSION['user_id'] ?? 0, 30, 5);
?>

<div class="card">
  <div class="avatar"><?=strtoupper(substr(($u['username'] ?? 'U'),0,1))?></div>
  <h2>Hello, <?=htmlspecialchars($u['username'])?> 👋</h2>
  <div class="small">Keep your info up to date so we can contact you about orders, adoptions, rehoming, or vet appointments.</div>

  <div class="field"><div class="label">Email</div><div class="value"><?=htmlspecialchars($u['email'] ?: '—')?></div></div>
  <div class="field"><div class="label">Phone</div><div class="value"><?=htmlspecialchars($u['phone'] ?: '—')?></div></div>
  <div class="field"><div class="label">Address</div><div class="value"><?=htmlspecialchars($u['address'] ?: '—')?></div></div>

  <div style="margin-top:14px">
    <div class="label" style="margin-bottom:6px">Bio</div>
    <div class="bio"><?=htmlspecialchars($u['bio'] ?: "Tell us about you! (e.g., favorite breed, pet experience)")?></div>
  </div>

  <!-- Vaccination reminders -->
  <div class="section-title">Vaccination reminders (next 30 days)</div>
  <div class="vax-box">
    <?php if(empty($vaxSoon)): ?>
      <div class="empty">No upcoming vaccinations. <a class="btn-outline" style="display:inline-block;margin-left:8px" href="<?=BASE_URL?>/Vaccination/index">Add one</a></div>
    <?php else: foreach($vaxSoon as $v): ?>
      <div class="row">
        <div class="when">📅 <?=date('M d, Y', strtotime($v['due_date']))?></div>
        <div class="who"><strong><?=htmlspecialchars($v['pet_name'])?></strong> – <?=htmlspecialchars($v['vaccine'])?> <?=($v['dose']?'('.htmlspecialchars($v['dose']).')':'')?></div>
        <span class="badge soon">Soon</span>
      </div>
    <?php endforeach; endif; ?>
  </div>

  <!-- Upcoming Appointments (existing) -->
  <div class="section-title">Upcoming appointments</div>
  <div class="appt-box">
    <?php if (!empty($apptUpcoming)): ?>
      <?php foreach ($apptUpcoming as $r): ?>
        <?php $d = date('M d, Y', strtotime($r['appt_date'])); $t = date('g:i A', strtotime($r['slot'])); ?>
        <div class="row">
          <div class="when">🗓️ <?=$d?> • <?=$t?></div>
          <div class="who">with <strong><?=htmlspecialchars($r['vet_name'])?></strong> (<?=htmlspecialchars($r['vet_city'])?>) — for <strong><?=htmlspecialchars($r['pet_name'])?></strong></div>
          <span class="badge booked" style="margin-left:10px">Booked</span>
          <form method="post" action="<?=BASE_URL?>/Appointment/cancel" style="margin-left:auto">
            <input type="hidden" name="id" value="<?=$r['id']?>">
            <button class="btn-cancel" type="submit" onclick="return confirm('Cancel this appointment?')">Cancel</button>
          </form>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="empty">No upcoming appointments. Book one now to see it here.</div>
    <?php endif; ?>
  </div>

  <!-- Actions -->
  <div class="actions-row">
    <a class="btn-outline" href="<?=BASE_URL?>/Appointment/index">Book a Vet</a>
    <a class="btn-outline" href="<?=BASE_URL?>/Vaccination/index">Manage Vaccinations</a>
  </div>

  <form action="<?=BASE_URL?>/User/edit" method="get"><button class="primary" type="submit">Edit Profile</button></form>
  <a class="link" href="<?=BASE_URL?>/Rehome/request">ReHome a pet?</a>
</div>
</body></html>
