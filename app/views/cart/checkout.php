<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title>Checkout • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6;display:flex;justify-content:center;align-items:center;min-height:100vh;padding:1rem}
.card{background:#fff;border-radius:16px;box-shadow:0 8px 18px rgba(0,0,0,.08);width:460px;padding:36px}
h2{color:#41403e;font-size:1.6rem;font-weight:600;margin-bottom:1.1rem;text-align:center}
label{display:block;font-weight:600;color:#41403e;margin-top:14px;font-size:.95rem}
input,textarea{width:100%;padding:.75rem 1rem;border:2px solid #e9e7e6;border-radius:10px;margin-top:.35rem;font-size:.9rem}
input:focus,textarea:focus{border-color:#26c1a8;outline:none}
.item-summary{background:#fafafa;border:1px solid #e0dedc;border-radius:10px;padding:12px;margin-top:10px;font-size:.9rem;color:#555;line-height:1.4}
.item-summary-title{font-weight:700;color:#41403e;margin-top:14px;font-size:.95rem}
.total{margin-top:18px;font-weight:700;color:#ff8552;font-size:1.05rem;text-align:right}
button{margin-top:22px;background:#26c1a8;color:#fff;border:none;width:100%;padding:.9rem;font-weight:600;font-size:1rem;border-radius:10px;cursor:pointer;transition:.3s}
button:hover{background:#1ea893}
</style></head><body>


<div class="card" style="margin-top:80px">
  <h2>Delivery Details</h2>

  <!-- 🐾 Order items heading -->
  <div class="item-summary-title">Order Items</div>
  <div class="item-summary">
    <?php foreach($items as $i): ?>
        • <?=htmlspecialchars($i['name'])?> — <?=$i['qty']?> item(s)<br>
    <?php endforeach;?>
  </div>

  <form method="POST">
      <label>Name</label>
      <input type="text" name="customer" required>

      <label>Address</label>
      <textarea name="address" rows="3" required></textarea>

      <label>Contact&nbsp;No.</label>
      <input type="text" name="contact" required>

      <div class="total">Total&nbsp;$<?=number_format($total,2)?></div>

      <button type="submit">Confirm Order</button>
  </form>
</div>
</body></html>
