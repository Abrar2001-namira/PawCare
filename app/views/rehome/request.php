<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title>ReHome Your Pet • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6;padding:40px 6%}
.card{background:#fff;border-radius:16px;box-shadow:0 8px 18px rgba(0,0,0,.08);max-width:820px;margin:100px auto 24px;padding:28px}
h2{color:#41403e;font-size:1.6rem;font-weight:600;margin-bottom:8px;text-align:center}
p.lead{color:#555;text-align:center;margin-bottom:12px}
label{display:block;font-weight:600;color:#41403e;margin-top:14px}
input,select,textarea{width:100%;padding:.8rem 1rem;border:2px solid #e9e7e6;border-radius:10px;margin-top:.4rem;font-size:.95rem}
input:focus,select:focus,textarea:focus{border-color:#26c1a8;outline:none}
.row{display:flex;gap:12px;flex-wrap:wrap}
.col{flex:1 1 250px}
button{margin-top:18px;background:#26c1a8;color:#fff;border:none;width:100%;padding:.95rem;font-weight:700;border-radius:12px;cursor:pointer}
button:hover{background:#1ea893}
.box{background:#fafafa;border:1px dashed #e0dedc;border-radius:12px;padding:12px;margin-top:10px}
</style></head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<div class="card">
  <h2>ReHome Your Pet</h2>
  <p class="lead">Tell us about your pet — we’ll review and add them to our adoption list after approval.</p>

  <form method="POST" action="<?=BASE_URL?>/Rehome/request">
    <div class="box">
      <div class="row">
        <div class="col">
          <label>Your Name</label>
          <input type="text" name="owner_name" value="<?=htmlspecialchars($u['username'] ?? '')?>" required>
        </div>
        <div class="col">
          <label>Your Email</label>
          <input type="email" name="owner_email" value="<?=htmlspecialchars($u['email'] ?? '')?>" required>
        </div>
      </div>
      <label>Phone</label>
      <input type="text" name="owner_phone" placeholder="+8801xxxxxxxxx">
      <label>Address (Foster / Pickup)</label>
      <input type="text" name="address" placeholder="House, Road, Area, City">
    </div>

    <label>Pet Name</label>
    <input type="text" name="name" required>

    <div class="row">
      <div class="col">
        <label>Species</label>
        <select name="species">
          <option value="Dog">Dog</option>
          <option value="Cat">Cat</option>
        </select>
      </div>
      <div class="col">
        <label>Age</label>
        <input type="text" name="age" placeholder="e.g., 2 years">
      </div>
      <div class="col">
        <label>Breed</label>
        <input type="text" name="breed" placeholder="e.g., Persian / Mixed">
      </div>
    </div>

    <label>Vaccinated</label>
    <select name="vaccinated">
      <option value="1">Yes</option>
      <option value="0">No</option>
    </select>

    <label>Photo URL</label>
    <input type="text" name="image" placeholder="https://...jpg" required>

    <label>Story / Notes</label>
    <textarea name="story" rows="4" placeholder="Temperament, likes, any special care"></textarea>

    <button type="submit">Submit ReHome Request</button>
  </form>
</div>
</body></html>
