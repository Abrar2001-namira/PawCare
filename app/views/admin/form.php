<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><title><?=($data['mode']=='add'?'Add':'Edit')?> Product</title>
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
</style></head><body>
  
<div class="card">
    <h2><?=($data['mode']=='add'?'Add':'Edit')?> Product</h2>
    <?php
        /* defaults when adding */
        $p = $data['mode']=='edit' ? $data['prod']
                                   : ['id'=>'','name'=>'','price'=>'','image'=>'','description'=>'','category'=>'Food'];
        /* form action: keep id in query for GET + hidden for POST */
        $action = $data['mode']=='add'
                  ? BASE_URL.'/Admin/add'
                  : BASE_URL.'/Admin/edit?id='.$p['id'];
    ?>
    <form method="POST" action="<?=$action?>">
        <?php if($data['mode']=='edit'): ?>
            <input type="hidden" name="id" value="<?=$p['id']?>">
        <?php endif; ?>

        <label>Name</label>
        <input type="text" name="name" value="<?=htmlspecialchars($p['name'])?>" required>

        <label>Category</label>
        <select name="category">
            <?php foreach(['Food','Medicine','Toy','Accessories'] as $c): ?>
                <option value="<?=$c?>" <?=$p['category']===$c?'selected':''?>><?=$c?></option>
            <?php endforeach;?>
        </select>

        <label>Price (USD)</label>
        <input type="number" step="0.01" name="price" value="<?=$p['price']?>" required>

        <label>Image URL</label>
        <input type="text" name="image" value="<?=htmlspecialchars($p['image'])?>" required>

        <label>Description</label>
        <textarea name="description" rows="3" required><?=htmlspecialchars($p['description'])?></textarea>

        <button type="submit"><?=$data['mode']=='add'?'Save':'Update'?></button>
    </form>
</div>
</body></html>
