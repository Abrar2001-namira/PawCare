<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8">
<title><?=htmlspecialchars($pet['name'])?> • Pet Profile</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:#f0faf6;padding:40px 6%}
.card{
    max-width:880px;margin:auto;background:#fff;border-radius:16px;
    box-shadow:0 8px 18px rgba(0,0,0,.08);display:flex;overflow:hidden
}
.card img{width:50%;object-fit:cover}
.info{padding:36px;width:50%}
h2{font-size:1.8rem;font-weight:600;margin-bottom:10px;color:#41403e}
.item{margin-bottom:12px;font-size:.95rem;color:#555}
.label{font-weight:600;color:#41403e}
.status{
    margin-top:16px;display:inline-block;font-weight:600;padding:8px 14px;
    border-radius:8px;font-size:.9rem;color:#fff
}
.adopted{background:#aaa}
.available{background:#26c1a8}

/* NEW – keep Story formatting */
.story{
    white-space:pre-wrap;           /* preserves spaces & new lines */
    line-height:1.45;
    margin-top:6px;color:#555
}

@media(max-width:760px){
    .card{flex-direction:column}
    .card img,.info{width:100%}
}
</style></head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<div class="card" style="margin-top:90px">
    <img src="<?=htmlspecialchars($pet['image'])?>" alt="">
    <div class="info">
        <h2><?=htmlspecialchars($pet['name'])?></h2>

        <div class="item"><span class="label">Age:</span> <?=htmlspecialchars($pet['age'])?></div>
        <div class="item"><span class="label">Breed:</span> <?=htmlspecialchars($pet['breed'])?></div>
        <div class="item"><span class="label">Vaccinated:</span> <?=$pet['vaccinated'] ? 'Yes' : 'No'?></div>

        <div class="item"><span class="label">Foster&nbsp;Home&nbsp;Address:</span> <?=htmlspecialchars($pet['foster_home']) ?: '—'?></div>
        <div class="item"><span class="label">Phone:</span> <?=htmlspecialchars($pet['phone']) ?: '—'?></div>
        <div class="item"><span class="label">Email:</span> <?=htmlspecialchars($pet['email']) ?: '—'?></div>

        <!-- Story with preserved formatting -->
        <div class="item">
            <span class="label">Story:</span>
            <div class="story"><?=nl2br(htmlspecialchars($pet['story']))?></div>
        </div>

        <div class="status <?=$pet['adopted'] ? 'adopted' : 'available'?>">
            <?=$pet['adopted'] ? 'Adopted' : 'Available'?>
        </div>
    </div>
</div>
</body></html>
