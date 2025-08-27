<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8">
<title>Apply to Adopt • PawCare</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<style>
:root{
  --brand:#26c1a8; --brand-2:#ff8552; --ink:#41403e; --text:#555; --muted:#777;
  --card:#fff; --bg:#f0faf6; --line:#e9e7e6;
}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Quicksand',sans-serif;background:var(--bg);padding:42px 6%}

/* ===== Hero (pet image + guidelines) ===== */
.hero{
  max-width:1000px;margin:86px auto 16px;background:var(--card);
  border-radius:18px;box-shadow:0 8px 18px rgba(0,0,0,.08);
  display:flex;overflow:hidden
}
.hero-img{width:38%;min-height:280px;object-fit:cover}
.hero-txt{width:62%;padding:26px 30px}
h1{font-size:1.7rem;font-weight:600;color:var(--ink);line-height:1.2}
.small{color:var(--muted);font-size:.9rem;margin-top:6px}
ol{margin:10px 0 0 22px}
ol li{color:var(--text);line-height:1.55;margin:.32rem 0}
ol li::marker{content:"🐾 ";}

/* ===== Card / Form ===== */
.card{
  background:var(--card);border-radius:18px;box-shadow:0 8px 18px rgba(0,0,0,.08);
  max-width:1000px;margin:18px auto;padding:26px 30px
}
.section{margin-top:16px;padding-top:12px;border-top:2px dashed #eef3f1}
.section:first-of-type{border-top:none;padding-top:0;margin-top:0}
.section h2{
  font-size:1.05rem;color:var(--ink);font-weight:700;margin-bottom:6px;
  display:flex;align-items:center;gap:8px
}
.section h2 .tag{background:var(--brand);color:#fff;border-radius:999px;padding:4px 10px;font-size:.8rem}

/* Inputs */
label{display:block;font-weight:600;color:var(--ink);margin-top:14px;font-size:.95rem}
input,textarea,select{
  width:100%;padding:.8rem 1rem;border:2px solid var(--line);
  border-radius:12px;margin-top:.45rem;font-size:.95rem;background:#fff
}
input:focus,textarea:focus,select:focus{outline:none;border-color:var(--brand)}
.row{display:flex;gap:12px;flex-wrap:wrap}
.col{flex:1 1 260px}

/* ===== Fixed option alignment ===== */
.group{margin-top:10px}
.opts-grid{
  display:grid;gap:8px;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
  margin-top:6px
}
.option{
  display:flex;align-items:center;gap:10px;          /* ← center-align vertically */
  color:var(--text); line-height:1.35; padding:6px 4px
}
.option input{
  flex:0 0 auto; width:18px; height:18px;            /* ← uniform control size */
  margin:0; accent-color:var(--brand);               /* brand tick, matches theme */
}
.option span{display:block}

/* Button */
button{
  margin-top:20px;background:var(--brand);color:#fff;border:none;width:100%;
  padding:.95rem;font-weight:700;font-size:1rem;border-radius:12px;cursor:pointer;transition:.25s
}
button:hover{background:#1ea893}
.helper{color:var(--muted);font-size:.85rem;margin-top:8px}

/* Responsive */
@media (max-width:900px){
  .hero{flex-direction:column}
  .hero-img,.hero-txt{width:100%}
}
</style></head><body>
<?php include_once 'app/views/partials/nav.php'; ?>

<!-- ===== Guidelines ===== -->
<div class="hero">
  <img class="hero-img" src="<?=htmlspecialchars($pet['image'])?>" alt="<?=htmlspecialchars($pet['name'])?>">
  <div class="hero-txt">
    <h1>Adoption Guidelines for <span style="background:#eaf8f5;color:var(--brand);border:1px solid #d6f2ea;border-radius:999px;padding:4px 10px;font-size:.9rem;font-weight:700"><?=htmlspecialchars($pet['name'])?></span></h1>
    <div class="small">Please read these friendly rules before submitting your application.</div>
    <ol>
      <li><b>Minimum Age:</b> You must be at least 18 years old.</li>
      <li><b>Vet Reference:</b> Responsible care includes annual exams and vaccinations.</li>
      <li><b>Spay/Neuter:</b> All pets are spayed/neutered (unless medically exempt).</li>
      <li><b>Home Setup:</b> Indoor homes; fenced yards may be required for some dogs.</li>
      <li><b>Other Pets:</b> We’ll confirm compatibility and basic health tests when needed.</li>
      <li><b>Renters:</b> Please confirm pets are allowed (and deposits if required).</li>
      <li><b>Home Visit:</b> A short home check may be requested by appointment.</li>
    </ol>
  </div>
</div>

<!-- ===== Application Form ===== -->
<div class="card">
  <form method="POST" action="<?=BASE_URL?>/Adoption/apply?pet_id=<?=$pet['id']?>">
    <input type="hidden" name="pet_id" value="<?=$pet['id']?>">

    <div class="section">
      <h2><span class="tag">Step 1</span> Basics</h2>
      <div class="row">
        <div class="col">
          <label>App Date</label>
          <input type="text" value="<?=date('n/j/Y')?>" readonly>
        </div>
        <div class="col">
          <label>Pet</label>
          <input type="text" value="<?=htmlspecialchars($pet['name'])?>" readonly>
        </div>
      </div>

      <label>Name of Applicant *</label>
      <input type="text" name="applicant_name" required>

      <div class="row">
        <div class="col">
          <label>Email address *</label>
          <input type="email" name="email" required>
        </div>
        <div class="col">
          <label>Best Contact Phone Number *</label>
          <input type="text" name="phone" required>
        </div>
      </div>

      <label>Your City & State *</label>
      <input type="text" name="city_state" placeholder="e.g., Dhanmondi, Dhaka" required>

      <div class="group">
        <label>Can we text you at that number? *</label>
        <div class="opts-grid" style="grid-template-columns:repeat(2, minmax(120px,1fr))">
          <label class="option"><input type="radio" name="can_text" value="1" required><span>Yes, please.</span></label>
          <label class="option"><input type="radio" name="can_text" value="0"><span>No, thank you.</span></label>
        </div>
      </div>
    </div>

    <div class="section">
      <h2><span class="tag">Step 2</span> Tell us a little more</h2>

      <label>How did you hear about our adoptable pets? (select all that apply)</label>
      <div class="opts-grid">
        <label class="option"><input type="checkbox" name="heard[]" value="Website"><span>Website</span></label>
        <label class="option"><input type="checkbox" name="heard[]" value="Facebook"><span>Facebook</span></label>
        <label class="option"><input type="checkbox" name="heard[]" value="Instagram"><span>Instagram</span></label>
        <label class="option"><input type="checkbox" name="heard[]" value="Friend/Family"><span>Friend/Family</span></label>
        <label class="option"><input type="checkbox" name="heard[]" value="Other"><span>Other</span></label>
      </div>

      <label>Do you currently have any companion animals in your home? (select all that apply)</label>
      <div class="opts-grid">
        <label class="option"><input type="checkbox" name="current_pets[]" value="None"><span>None</span></label>
        <label class="option"><input type="checkbox" name="current_pets[]" value="1 Dog"><span>1 Dog</span></label>
        <label class="option"><input type="checkbox" name="current_pets[]" value="2+ Dogs"><span>2+ Dogs</span></label>
        <label class="option"><input type="checkbox" name="current_pets[]" value="1 Cat"><span>1 Cat</span></label>
        <label class="option"><input type="checkbox" name="current_pets[]" value="2+ Cats"><span>2+ Cats</span></label>
        <label class="option"><input type="checkbox" name="current_pets[]" value="Other"><span>Other</span></label>
      </div>

      <label>What are you looking for in a companion dog/cat? (select all that apply)</label>
      <div class="opts-grid">
        <label class="option"><input type="checkbox" name="looking_for[]" value="Company for my other animal(s)"><span>Company for my other animal(s)</span></label>
        <label class="option"><input type="checkbox" name="looking_for[]" value="A new best friend"><span>A new best friend</span></label>
        <label class="option"><input type="checkbox" name="looking_for[]" value="Good with cats"><span>A pet that gets along with cats</span></label>
        <label class="option"><input type="checkbox" name="looking_for[]" value="Good with kids"><span>A pet good with children</span></label>
        <label class="option"><input type="checkbox" name="looking_for[]" value="To help rescue a pet in need"><span>To help rescue a pet in need</span></label>
      </div>
    </div>

    <div class="section">
      <h2><span class="tag">Step 3</span> Home & Household</h2>

      <label>Household Type *</label>
      <div class="opts-grid">
        <label class="option"><input type="checkbox" name="house_type[]" value="Apartment"><span>Apartment</span></label>
        <label class="option"><input type="checkbox" name="house_type[]" value="Condo/Townhouse (fenced yard)"><span>Condo/Townhouse (fenced yard)</span></label>
        <label class="option"><input type="checkbox" name="house_type[]" value="Condo/Townhouse (no yard)"><span>Condo/Townhouse (no yard)</span></label>
        <label class="option"><input type="checkbox" name="house_type[]" value="Residential w/ fenced yard"><span>Residential home with fenced yard</span></label>
        <label class="option"><input type="checkbox" name="house_type[]" value="Residential w/ yard, no fence"><span>Residential home with yard, no fence</span></label>
        <label class="option"><input type="checkbox" name="house_type[]" value="Other"><span>Other</span></label>
      </div>

      <label>Household Members *</label>
      <textarea name="house_members" rows="3" placeholder="Ages / number of people" required></textarea>

      <label>Is there anything else you'd like to share with us?</label>
      <textarea name="notes" rows="3" placeholder="Any special needs, schedule, preferences"></textarea>
    </div>

    <div class="section">
      <h2><span class="tag">Final</span> Agreement</h2>
      <label class="option" style="margin-top:6px">
        <input type="checkbox" name="agree" value="1" required><span>I acknowledge the guidelines above and am able to proceed with adoption steps.</span>
      </label>

    
      <div class="helper">We’ll get back to you via email within 72 hours.</div>

      <button type="submit">Submit Adoption Application</button>
    </div>
  </form>
</div>
</body></html>
