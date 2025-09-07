<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title>Vaccination Reminders • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6;padding:40px}
.container{max-width:1050px;margin:90px auto 30px}
h1{font-size:2rem;font-weight:600;color:#41403e;text-align:center;margin-bottom:8px}
.sub{color:#6f7b78;text-align:center;margin-bottom:22px;font-size:.95rem}

.grid{display:grid;grid-template-columns:1fr;gap:18px}
.card{background:#fff;border-radius:16px;box-shadow:0 8px 18px rgba(0,0,0,.08);padding:20px}

label{display:block;font-weight:700;color:#41403e;margin:10px 0 6px;font-size:.95rem}
input,textarea{width:100%;padding:.75rem 1rem;border:2px solid #e9e7e6;border-radius:10px}
input:focus,textarea:focus{border-color:#26c1a8;outline:none}
.row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
button{margin-top:14px;background:#26c1a8;color:#fff;border:none;padding:.9rem 1.2rem;font-weight:700;border-radius:10px;cursor:pointer}
button:hover{background:#1ea893}

.table{width:100%;border-collapse:collapse;margin-top:10px}
th,td{padding:12px 14px;text-align:left;font-size:.93rem}
th{background:#26c1a8;color:#fff}
tr:nth-child(even){background:#fafafa}

.badge{display:inline-block;padding:4px 10px;border-radius:999px;font-weight:700;font-size:.78rem}
.scheduled{background:#e7f8f4;border:1px solid #bfece1;color:#1b907d}
.done{background:#e8eafc;border:1px solid #c7cbff;color:#343a8b}
.missed{background:#ffe6e6;border:1px solid #ffb2b2;color:#9c2a2a}
.soon{background:#fff3d6;border:1px solid #f5d48a;color:#9b6b00}

.act a{display:inline-block;margin-right:8px;text-decoration:none;font-weight:700}
a.green{color:#26c1a8}a.green:hover{text-decoration:underline}
a.red{color:#ff6b6b}a.red:hover{text-decoration:underline}
</style></head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<div class="container">
  <h1>Vaccination Reminders</h1>
  <div class="sub">Add your pet’s vaccinations and we’ll keep them visible on your profile when due soon.</div>

  <div class="grid">
    <div class="card">
      <form method="POST" action="<?=BASE_URL?>/Vaccination/index">
        <div class="row">
          <div>
            <label>Pet Name *</label>
            <input type="text" name="pet_name" required>
          </div>
          <div>
            <label>Vaccine *</label>
            <input type="text" name="vaccine" placeholder="e.g., Rabies, DHPP" required>
          </div>
        </div>

        <div class="row">
          <div>
            <label>Dose / Shot #</label>
            <input type="text" name="dose" placeholder="e.g., Booster #2">
          </div>
          <div>
            <label>Due Date *</label>
            <input type="date" name="due_date" required>
          </div>
        </div>

        <label>Notes</label>
        <textarea name="notes" rows="3" placeholder="Any details your vet gave you"></textarea>

        <button type="submit">Save Vaccination</button>
      </form>
    </div>

    <div class="card">
      <?php if(empty($list)): ?>
        <div style="color:#60706d">No vaccinations yet. Add your first reminder on the left.</div>
      <?php else: ?>
      <table class="table">
        <thead>
          <tr>
            <th style="width:160px">Due</th>
            <th>Pet</th>
            <th>Vaccine</th>
            <th style="width:110px">Status</th>
            <th style="width:22%">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $today = new DateTime('today');
          foreach($list as $r):
              $due = new DateTime($r['due_date']);
              $status = $r['status'];

              // mark missed (visual only) if still scheduled but date passed
              $badge = $status;
              if ($status==='scheduled' && $due < $today) $badge = 'missed';

              // within next 7 days = soon
              $soon = ($status!=='done' && $due >= $today && $due <= (new DateTime('+7 days')));
        ?>
          <tr>
            <td><?=date('M d, Y', strtotime($r['due_date']))?></td>
            <td><?=htmlspecialchars($r['pet_name'])?></td>
            <td>
              <?=htmlspecialchars($r['vaccine'])?>
              <?php if($r['dose']): ?> (<?=htmlspecialchars($r['dose'])?>)<?php endif; ?>
              <?php if($soon): ?> <span class="badge soon">Soon</span><?php endif; ?>
            </td>
            <td><span class="badge <?=$badge?>"><?=ucfirst($badge)?></span></td>
            <td class="act">
              <?php if($r['status']!=='done'): ?>
                <a class="green" href="<?=BASE_URL?>/Vaccination/done?id=<?=$r['id']?>">Mark Done</a>
              <?php else: ?>
                <a class="green" href="<?=BASE_URL?>/Vaccination/schedule?id=<?=$r['id']?>">Re-schedule</a>
              <?php endif; ?>
              <a class="red" href="<?=BASE_URL?>/Vaccination/delete?id=<?=$r['id']?>" onclick="return confirm('Delete this record?')">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      <?php endif; ?>
    </div>
  </div>
</div>
</body></html>
