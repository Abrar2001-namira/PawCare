<!-- FILE: app/views/user/edit.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Profile • PawCare</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <style>
    *{box-sizing:border-box;margin:0;padding:0}
    body{font-family:'Quicksand',sans-serif;background:#f0faf6;padding:40px 6%}
    .card{
      background:#fff;border-radius:16px;box-shadow:0 8px 18px rgba(0,0,0,.08);
      max-width:720px;margin:100px auto;padding:28px
    }
    h2{color:#41403e;font-size:1.7rem;font-weight:600;margin-bottom:10px;text-align:center}
    label{display:block;font-weight:600;color:#41403e;margin-top:14px}
    input,textarea{
      width:100%;padding:.8rem 1rem;border:2px solid #e9e7e6;border-radius:12px;
      margin-top:.45rem;font-size:.95rem;background:#fff
    }
    textarea{min-height:110px}
    input:focus,textarea:focus{border-color:#26c1a8;outline:none}

    /* Primary submit */
    button[type="submit"]{
      margin-top:16px;background:#26c1a8;color:#fff;border:none;width:100%;
      padding:.95rem;font-weight:700;font-size:1rem;border-radius:12px;cursor:pointer;transition:.25s
    }
    button[type="submit"]:hover{background:#1ea893}

    /* Action row under the Save button */
    .actions{
      display:flex;gap:12px;margin-top:12px;
    }
    /* Use unique classes to avoid clashing with navbar .btn */
    .btn-outline{
      flex:1; display:inline-block; text-align:center; text-decoration:none;
      border:2px solid #26c1a8; color:#26c1a8; background:#fff;
      padding:12px 16px; border-radius:12px; font-weight:700;
      transition:background .2s, transform .05s;
    }
    .btn-outline:hover{background:#e7f8f4}
    .btn-outline:active{transform:translateY(1px)}

    .btn-orange{
      flex:1; display:inline-block; text-align:center; text-decoration:none;
      border:2px solid #ff8552; color:#ff8552; background:#fff;
      padding:12px 16px; border-radius:12px; font-weight:700;
      transition:background .2s, transform .05s;
    }
    .btn-orange:hover{background:#fff3ee}
    .btn-orange:active{transform:translateY(1px)}

    .small{color:#777;font-size:.88rem;margin-top:6px;text-align:center}

    @media(max-width:520px){
      .actions{flex-direction:column}
    }
  </style>
</head>
<body>
  <?php include_once 'app/views/partials/nav.php'; ?>

  <div class="card">
    <h2>Edit Profile</h2>

    <form method="POST" action="<?=BASE_URL?>/User/edit">
      <label>Name</label>
      <input type="text" name="username" value="<?=htmlspecialchars($u['username'])?>" required>

      <label>Email</label>
      <input type="email" name="email" value="<?=htmlspecialchars($u['email'])?>" required>

      <label>Phone</label>
      <input type="text" name="phone" placeholder="+8801xxxxxxxxx" value="<?=htmlspecialchars($u['phone'] ?? '')?>">

      <label>Address</label>
      <input type="text" name="address" placeholder="House, Road, Area, City" value="<?=htmlspecialchars($u['address'] ?? '')?>">

      <label>Short Bio</label>
      <textarea name="bio" placeholder="A few lines about you, your pets, experience, or preferences..."><?=htmlspecialchars($u['bio'] ?? '')?></textarea>

      <!-- Save -->
      <button type="submit">Save Changes</button>

      <!-- Clearly visible action buttons -->
      <div class="actions">
        <a class="btn-outline" href="<?=BASE_URL?>/User/profile">Cancel</a>
        <a class="btn-orange" href="<?=BASE_URL?>/Rehome/request">ReHome pet?</a>
      </div>

      <div class="small">Tip: Add your phone & address to speed up adoptions and deliveries.</div>
    </form>
  </div>
</body>
</html>
