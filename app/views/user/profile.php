<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title>My Profile • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6;padding:40px 6%}
.card{
  background:#fff;border-radius:16px;box-shadow:0 8px 18px rgba(0,0,0,.08);
  max-width:820px;margin:100px auto 24px;padding:26px
}
h2{color:#41403e;font-size:1.6rem;font-weight:600;margin-bottom:8px}
.small{color:#777;font-size:.88rem}
.avatar{
  width:88px;height:88px;border-radius:50%;background:#eaf8f5;border:2px solid #d6f2ea;
  display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.6rem;color:#26c1a8;margin-bottom:10px
}
.field{
  background:#fafafa;border:1px solid #e9e7e6;border-radius:12px;padding:10px 12px;margin-top:12px
}
.label{font-weight:700;color:#41403e;font-size:.9rem}
.value{color:#555;margin-top:4px;white-space:pre-wrap}
.bio{white-space:pre-wrap;line-height:1.45;color:#555}
button.primary{
  margin-top:16px;background:#26c1a8;color:#fff;border:none;width:100%;
  padding:.95rem;font-weight:700;font-size:1rem;border-radius:12px;cursor:pointer;transition:.25s
}
button.primary:hover{background:#1ea893}
a.link{display:block;text-align:center;margin-top:10px;color:#26c1a8;text-decoration:none;font-weight:700}
a.link:hover{text-decoration:underline}
</style></head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<div class="card">
  <div class="avatar"><?=strtoupper(substr(($u['username'] ?? 'U'),0,1))?></div>
  <h2>Hello, <?=htmlspecialchars($u['username'])?> 👋</h2>
  <div class="small">Keep your info up to date so we can contact you about orders, adoptions, or rehoming.</div>

  <div class="field">
    <div class="label">Email</div>
    <div class="value"><?=htmlspecialchars($u['email'] ?: '—')?></div>
  </div>

  <div class="field">
    <div class="label">Phone</div>
    <div class="value"><?=htmlspecialchars($u['phone'] ?: '—')?></div>
  </div>

  <div class="field">
    <div class="label">Address</div>
    <div class="value"><?=htmlspecialchars($u['address'] ?: '—')?></div>
  </div>

  <div style="margin-top:14px">
    <div class="label" style="margin-bottom:6px">Bio</div>
    <div class="bio"><?=htmlspecialchars($u['bio'] ?: "Tell us about you! (e.g., favorite breed, pet experience)")?></div>
  </div>

  <!-- Single bottom button to edit -->
  <form action="<?=BASE_URL?>/User/edit" method="get">
    <button class="primary" type="submit">Edit Profile</button>
  </form>

  <!-- Optional small link to ReHome (not a second panel or big button) -->
  <a class="link" href="<?=BASE_URL?>/Rehome/request">ReHome a pet?</a>
</div>
</body></html>
