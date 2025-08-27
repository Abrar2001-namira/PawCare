<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8">
<title>Make a Donation • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6;padding:40px 6%}
.card{background:#fff;border-radius:16px;box-shadow:0 8px 18px rgba(0,0,0,.08);padding:26px 28px;max-width:680px;margin:80px auto 20px}
h1{font-size:1.6rem;font-weight:600;color:#41403e;margin-bottom:12px}
label{display:block;font-weight:600;color:#41403e;margin-top:14px;font-size:.95rem}
input,textarea,select{width:100%;padding:.75rem 1rem;border:2px solid #e9e7e6;border-radius:10px;margin-top:.35rem;font-size:.9rem}
input:focus,textarea:focus,select:focus{border-color:#26c1a8;outline:none}
button{margin-top:18px;background:#26c1a8;color:#fff;border:none;width:100%;padding:.9rem;font-weight:600;font-size:1rem;border-radius:10px;cursor:pointer;transition:.3s}
button:hover{background:#1ea893}
.small{color:#777;font-size:.85rem;margin-top:10px}
</style></head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<div class="card">
  <h1>Make a Donation</h1>
  <form method="POST" action="<?=BASE_URL?>/Donation/submit">
    <label>Your Name</label>
    <input type="text" name="name" value="<?=htmlspecialchars($username)?>" placeholder="Optional">

    <label>Email</label>
    <input type="email" name="email" value="<?=htmlspecialchars($email)?>" placeholder="Optional (for receipt)">

    <label>Choose Shelter</label>
    <select name="shelter_id" required>
      <option value="">-- Select a shelter --</option>
      <?php foreach($shelters as $s): ?>
        <option value="<?=$s['id']?>"><?=htmlspecialchars($s['name'])?></option>
      <?php endforeach; ?>
    </select>

    <label>Amount (USD)</label>
    <input type="number" name="amount" step="0.01" min="1" required>

    <label>Message (optional)</label>
    <textarea name="note" rows="3" placeholder="Send a little love note to the shelter 💚"></textarea>

    <button type="submit">Donate Now</button>
  </form>
  <div class="small">Your donation goes directly to the selected registered shelter.</div>
</div>
</body></html>
