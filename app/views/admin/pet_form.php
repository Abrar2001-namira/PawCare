<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8">
<title><?=($data['mode']=='add'?'Add':'Edit')?> Pet</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6;display:flex;justify-content:center;align-items:center;min-height:100vh;padding:1rem}
.card{background:#fff;border-radius:16px;box-shadow:0 8px 18px rgba(0,0,0,.08);width:420px;padding:36px}
h2{color:#41403e;font-size:1.6rem;font-weight:600;margin-bottom:1.3rem;text-align:center}
label{display:block;font-weight:600;color:#41403e;margin-top:14px;font-size:.95rem}
input,textarea,select{width:100%;padding:.75rem 1rem;border:2px solid #e9e7e6;border-radius:10px;margin-top:.35rem;font-size:.9rem}
input:focus,textarea:focus,select:focus{border-color:#26c1a8;outline:none}
button{margin-top:22px;background:#26c1a8;color:#fff;border:none;width:100%;padding:.9rem;font-weight:600;font-size:1rem;border-radius:10px;cursor:pointer;transition:.3s background}
button:hover{background:#1ea893}
.section-title{margin-top:20px;font-weight:600;color:#41403e;font-size:1rem}
.contact-box{background:#fafafa;border:1px solid #e9e7e6;border-radius:10px;padding:18px;margin-top:10px}
.contact-box label:first-child{margin-top:0}
</style></head><body>

<div class="card">
  <h2><?=($data['mode']=='add'?'Add':'Edit')?> Pet</h2>
<?php
  $p = $data['mode']=='edit' ? $data['pet']
                             : ['id'=>'','name'=>'','species'=>'Dog','age'=>'','breed'=>'',
                                'vaccinated'=>1,'adopted'=>0,'image'=>'','story'=>'',
                                'phone'=>'','email'=>'','location'=>''];
  $action = $data['mode']=='add'
            ? BASE_URL.'/AdminPet/add'
            : BASE_URL.'/AdminPet/edit?id='.$p['id'];
?>
  <form method="POST" action="<?=$action?>">
    <?php if($data['mode']=='edit'): ?>
      <input type="hidden" name="id" value="<?=$p['id']?>">
    <?php endif; ?>

    <label>Species</label>
    <select name="species">
      <option value="Dog"  <?=$p['species']==='Dog'?'selected':''?>>Dog</option>
      <option value="Cat"  <?=$p['species']==='Cat'?'selected':''?>>Cat</option>
    </select>

    <label>Name</label>
    <input type="text" name="name" value="<?=htmlspecialchars($p['name'])?>" required>

    <label>Age</label>
    <input type="text" name="age" value="<?=htmlspecialchars($p['age'])?>" required>

    <label>Breed</label>
    <input type="text" name="breed" value="<?=htmlspecialchars($p['breed'])?>" required>

    <label>Vaccinated</label>
    <select name="vaccinated">
      <option value="1" <?=$p['vaccinated']?'selected':''?>>Yes</option>
      <option value="0" <?=!$p['vaccinated']?'selected':''?>>No</option>
    </select>

    <label>Adopted</label>
    <select name="adopted">
      <option value="0" <?=$p['adopted']?'':'selected'?>>Available</option>
      <option value="1" <?=$p['adopted']?'selected':''?>>Adopted</option>
    </select>

    <label>Image URL</label>
    <input type="text" name="image" value="<?=htmlspecialchars($p['image'])?>" required>

    <label>Story</label>
    <textarea name="story" rows="3" required><?=htmlspecialchars($p['story'])?></textarea>

    <div class="section-title">Contact Details</div>
    <div class="contact-box">
      <label>Phone</label>
      <input type="text" name="phone" value="<?=htmlspecialchars($p['phone'])?>">

      <label>Email</label>
      <input type="email" name="email" value="<?=htmlspecialchars($p['email'])?>">

      <label>Location</label>
      <input type="text" name="location" value="<?=htmlspecialchars($p['location'])?>">
    </div>

    <button type="submit"><?=$data['mode']=='add'?'Save':'Update'?></button>
  </form>
</div>
</body></html>
