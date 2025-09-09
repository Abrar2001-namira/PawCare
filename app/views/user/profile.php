<!DOCTYPE html>
<html lang="en"><head>
<meta charset="UTF-8"><title>PawCare • My Profile</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700;800&display=swap" rel="stylesheet">
<style>
  *{box-sizing:border-box;margin:0;padding:0}
  body{font-family:'Quicksand',sans-serif;background:#f7fbfa;min-height:100vh}

  /* Page wrapper + consistent vertical rhythm */
  .page{max-width:980px;margin:32px auto 40px;padding:0 18px;display:grid;gap:18px}

  /* Generic card */
  .card{
    background:#ffffff;border:1px solid #ebe9e7;border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.05);padding:22px 20px
  }

  /* Header block */
  .head{display:flex;align-items:center;gap:14px;margin-bottom:6px}
  .avatar{
    width:88px;height:88px;border-radius:50%;background:#eaf8f5;border:2px solid #d6f2ea;
    display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.6rem;color:#26c1a8
  }
  h2{color:#41403e;font-size:1.6rem;font-weight:800}
  .small{color:#6b7a78;margin-top:2px}

  /* Info fields */
  .fields{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:14px}
  @media(max-width:720px){.fields{grid-template-columns:1fr}}
  .field{background:#fafafa;border:1px solid #e9e7e6;border-radius:12px;padding:12px 12px}
  .label{font-weight:700;color:#41403e;font-size:.9rem}
  .value{color:#555;margin-top:4px;white-space:pre-wrap}
  .bio{white-space:pre-wrap;line-height:1.45;color:#555;margin-top:10px}

  /* Section titles */
  .section-title{margin:6px 0 10px;font-weight:800;color:#41403e}

  /* Buttons */
  .actions-row{display:flex;gap:10px;margin-top:14px;flex-wrap:wrap}
  .btn-outline{
    display:inline-block;padding:.7rem 1rem;border:2px solid #26c1a8;color:#26c1a8;border-radius:12px;
    font-weight:700;text-decoration:none;text-align:center;min-width:160px
  }
  .btn-outline:hover{background:#eaf8f5}
  button.primary{
    background:#26c1a8;color:#fff;border:none;padding:.9rem 1.2rem;font-weight:700;border-radius:12px;cursor:pointer
  }
  button.primary:hover{background:#1ea893}

  /* Vaccinations mini-list */
  .vax-box{margin-top:6px;border:1px solid #e9e7e6;border-radius:12px;background:#fff}
  .row{display:flex;gap:12px;align-items:center;padding:12px;border-top:1px solid #f1efee}
  .row:first-child{border-top:none}
  .when{min-width:160px;color:#1b3f39;font-weight:700}
  .who{color:#445b58}
  .badge{display:inline-block;padding:4px 10px;border-radius:999px;font-weight:700;font-size:.78rem}
  .soon{background:#fff3d6;border:1px solid #f5d48a;color:#9b6b00}
  .empty{padding:14px;color:#60706d}

  /* Appointments list (your existing styles kept, spacing refined) */
  .appt-box{margin-top:6px;background:#fff;border:1px solid #e9e7e6;border-radius:12px}
  .appt-row{display:flex;gap:12px;align-items:center;padding:12px;border-top:1px solid #f1efee}
  .appt-row:first-child{border-top:none}
  .booked{background:#e7f8f4;color:#1b907d;border:1px solid #bfece1}
  .completed{background:#e8eafc;color:#343a8b;border:1px solid #c7cbff}
  .cancelled{background:#ffe6e6;color:#9c2a2a;border:1px solid #ffb2b2}
  .btn-cancel{
    margin-left:auto;background:#fff;border:2px solid #ff6b6b;color:#ff6b6b;
    padding:.55rem .8rem;border-radius:10px;font-weight:700;cursor:pointer
  }
  .btn-cancel:hover{background:#ffefef}

  /* Adopted Pets grid */
  .pet-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:14px}
  .pet-card{border:1px solid #e9e7e6;border-radius:16px;overflow:hidden;background:#fff;display:flex;flex-direction:column}
  .pet-card img{width:100%;height:150px;object-fit:cover;background:#f4f7f6}
  .pet-card .pbody{padding:10px 12px}
  .pet-card .pname{margin:0 0 6px 0;color:#214a44;font-weight:800}
  .pet-card a{color:#26c1a8;text-decoration:none;font-weight:700}
  .pet-card a:hover{text-decoration:underline}
</style>
</head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<?php
  // $u comes from UserController::profile
  // Load upcoming appointments and vaccination reminders (next 30 days)
  $apptUpcoming = $this->model('Appointment')->upcomingByUser($u['id'] ?? $_SESSION['user_id'] ?? 0, 6);
  $vaxSoon      = $this->model('Vaccination')->upcomingDue($u['id'] ?? $_SESSION['user_id'] ?? 0, 30, 5);

  // Adopted pets list (controller should pass $adopted; fall back to empty if not set)
  $adopted = $adopted ?? [];
?>

<div class="page">

  <!-- PROFILE -->
  <div class="card">
    <div class="head">
      <div class="avatar"><?=strtoupper(substr(($u['username'] ?? 'U'),0,1))?></div>
      <div>
        <h2>Hello, <?=htmlspecialchars($u['username'])?> 👋</h2>
        <p class="small">Keep your info up to date so we can contact you about orders, adoptions, rehoming, or vet appointments.</p>
      </div>
    </div>

    <div class="fields">
      <div class="field"><div class="label">Email</div><div class="value"><?=htmlspecialchars($u['email'] ?: '—')?></div></div>
      <div class="field"><div class="label">Phone</div><div class="value"><?=htmlspecialchars($u['phone'] ?: '—')?></div></div>
      <div class="field"><div class="label">Address</div><div class="value"><?=htmlspecialchars($u['address'] ?: '—')?></div></div>
      <div class="field"><div class="label">Bio</div><div class="value"><?=htmlspecialchars($u['bio'] ?: "Tell us about you! (e.g., favorite breed, pet experience)")?></div></div>
    </div>

    <div class="actions-row">
      <form action="<?=BASE_URL?>/User/edit" method="get"><button class="primary" type="submit">Edit Profile</button></form>
      <a class="btn-outline" href="<?=BASE_URL?>/Rehome/request">ReHome a pet?</a>
      <a class="btn-outline" href="<?=BASE_URL?>/Appointment/index">Book a Vet</a>
    </div>
  </div>

  <!-- VACCINATION REMINDERS -->
  <div class="card">
    <h3 class="section-title">Vaccination reminders (next 30 days)</h3>
    <div class="vax-box">
      <?php if(empty($vaxSoon)): ?>
        <div class="empty">No upcoming vaccinations.
          <a class="btn-outline" style="display:inline-block;margin-left:8px" href="<?=BASE_URL?>/Vaccination/index">Add one</a>
        </div>
      <?php else: foreach($vaxSoon as $v): ?>
        <div class="row">
          <div class="when">📅 <?=date('M d, Y', strtotime($v['due_date']))?></div>
          <div class="who"><strong><?=htmlspecialchars($v['pet_name'])?></strong> – <?=htmlspecialchars($v['vaccine'])?> <?=($v['dose']?'('.htmlspecialchars($v['dose']).')':'')?></div>
          <span class="badge soon">Soon</span>
        </div>
      <?php endforeach; endif; ?>
    </div>
  </div>

  <!-- UPCOMING APPOINTMENTS -->
  <div class="card">
    <h3 class="section-title">Upcoming appointments</h3>
    <div class="appt-box">
      <?php if (!empty($apptUpcoming)): ?>
        <?php foreach ($apptUpcoming as $r): ?>
          <?php $d = date('M d, Y', strtotime($r['appt_date'])); $t = date('g:i A', strtotime($r['slot'])); ?>
          <div class="appt-row">
            <div class="when">🗓️ <?=$d?> • <?=$t?></div>
            <div class="who">with <strong><?=htmlspecialchars($r['vet_name'])?></strong> (<?=htmlspecialchars($r['vet_city'])?>) — for <strong><?=htmlspecialchars($r['pet_name'])?></strong></div>
            <span class="badge <?=htmlspecialchars(strtolower($r['status']))?>"><?=ucfirst($r['status'])?></span>

            <?php if (strtolower($r['status'])==='booked'): ?>
              <form method="post" action="<?=BASE_URL?>/Appointment/cancel" style="margin-left:auto">
                <input type="hidden" name="id" value="<?=$r['id']?>">
                <button class="btn-cancel" type="submit" onclick="return confirm('Cancel this appointment?')">Cancel</button>
              </form>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="empty">No upcoming appointments. Book one now to see it here.</div>
      <?php endif; ?>
    </div>

    <div class="actions-row" style="margin-top:12px">
      <a class="btn-outline" href="<?=BASE_URL?>/Appointment/history">My Appointments</a>
    </div>
  </div>

  <!-- MY ADOPTED PETS -->
  <div class="card">
    <h3 class="section-title">🏡 My Adopted Pets</h3>
    <?php if (empty($adopted)): ?>
      <div class="empty">No adopted pets yet. Once an adoption is accepted, your pet will appear here with their photo. 💚</div>
    <?php else: ?>
      <div class="pet-grid">
        <?php foreach ($adopted as $a): ?>
          <div class="pet-card">
            <img src="<?=htmlspecialchars($a['pet_image'] ?? '')?>" alt="<?=htmlspecialchars($a['pet_name'] ?? 'Pet')?>">
            <div class="pbody">
              <p class="pname"><?=htmlspecialchars($a['pet_name'] ?? 'Pet')?></p>
              <a href="<?=BASE_URL?>/Pet/detail?id=<?=intval($a['pet_id'])?>">View profile</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

</div>
</body></html>
