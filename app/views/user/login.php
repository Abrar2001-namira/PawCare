<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PawCare • Log In</title>

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">

    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{
            font-family:'Quicksand',sans-serif;
            background:linear-gradient(135deg,#fff 0%,#f0faf6 100%);
            display:flex;justify-content:center;align-items:center;
            min-height:100vh;padding:1rem;
        }
        a{color:#26c1a8;text-decoration:none;font-size:0.9rem}
        a:hover{text-decoration:underline}

        .card{
            background:#ffffff;border-radius:18px;
            box-shadow:0 10px 25px rgba(0,0,0,0.08);
            display:flex;max-width:860px;overflow:hidden;width:100%;
        }
        .card img{width:50%;object-fit:cover}

        .form-wrap{
            padding:3rem 3.5rem;width:50%;
            display:flex;flex-direction:column;justify-content:center;
        }
        h1{color:#41403e;font-size:1.9rem;font-weight:600;margin-bottom:1.8rem;display:flex;gap:.5rem;align-items:center}
        h1 span{font-size:2rem}

        label{color:#41403e;font-weight:600;font-size:0.93rem;margin-bottom:.4rem;display:block}
        input{
            width:100%;padding:.8rem 1rem;margin-bottom:1.4rem;
            border:2px solid #e9e7e6;border-radius:10px;font-size:.95rem;transition:.25s border;
        }
        input:focus{border-color:#26c1a8;outline:none}

        button{
            background:#ff8552;color:#fff;border:none;width:100%;
            padding:.95rem;font-size:1rem;font-weight:600;border-radius:10px;
            cursor:pointer;transition:.3s background;
        }
        button:hover{background:#e4713f}

        .switch{margin-top:1.4rem;text-align:center;color:#666}

        @media(max-width:720px){
            .card{flex-direction:column;max-width:420px}
            .card img{display:none}
            .form-wrap{width:100%;padding:2.2rem}
        }
    </style>
</head>
<body>

    <div class="card">
        <!-- New cute cat photo -->
        <img src="https://img.freepik.com/free-photo/view-cats-dogs-being-friends_23-2151806276.jpg?semt=ais_hybrid&w=740" alt="Playful kitten">

        <div class="form-wrap">
            <h1><span>🐾</span>Welcome Back</h1>

            <form method="POST" action="">
                <label>Email</label>
                <input type="email" name="email" required>

                <label>Password</label>
                <input type="password" name="password" required>

                <button type="submit">Log In</button>
            </form>

            <p class="switch">
                Don’t have an account?
                <a href="<?php echo BASE_URL; ?>/User/register">Sign up</a>
            </p>
        </div>
    </div>
</body>
</html>
