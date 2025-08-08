<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PawCare • Welcome</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0 }
    body {
      font-family: 'Quicksand', sans-serif;
      background: #f0faf6;
    }
    /* ─── Nav is included below ─── */

    /* ─── Hero section ─── */
    .hero {
      position: relative;
      height: 100vh;
      background: url('https://neurosciencenews.com/files/2023/10/cat-dog-culture-affection-neuroscience.jpg')
                  center/cover no-repeat;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.4);
    }
    .hero-content {
      position: relative;
      text-align: center;
      color: #fff;
      max-width: 700px;
      padding: 0 1rem;
    }
    .hero-content h1 {
      font-size: 2.8rem;
      font-weight: 600;
      margin-bottom: 1rem;
    }
    .hero-content p {
      font-size: 1rem;
      line-height: 1.5;
      margin-bottom: 2rem;
    }
    .hero-content a.btn {
      display: inline-block;
      background: #26c1a8;
      color: #fff;
      text-decoration: none;
      padding: 14px 34px;
      font-size: 1rem;
      font-weight: 600;
      border-radius: 12px;
      transition: .3s background;
    }
    .hero-content a.btn:hover {
      background: #1ea893;
    }
  </style>
</head>
<body>
  <?php include_once 'app/views/partials/nav.php'; ?>

  <section class="hero">
    <div class="hero-content">
      <h1>Welcome to Your Paw-tastic Adventure, <?=htmlspecialchars($data['user'])?>!</h1>
      <div style="white-space: pre-wrap; font-family: 'Segoe UI', sans-serif; font-size: 1.1rem; margin-bottom: 3rem;">
Your one-stop haven for furry friends, wagging tails, and purring hearts.
Looking for the perfect companion? Whether it’s playful pups, cuddly kittens, or all the toys and treats in between — we’re here to help you find joy, love, and loyalty wrapped in fur.
Adopt. Shop. Love.

🦴 Browse our adorable buddies
🛍️ Explore must-have pet goodies
💗 Bring home happiness today!
</div>
      <a href="<?=BASE_URL?>/Pet/index" class="btn">Start Your Paw-venture</a>
    </div>
  </section>
</body>
</html>
