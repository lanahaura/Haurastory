<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Perpustakaan Digital</title>

  <!-- Font lucu (optional) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&display=swap" rel="stylesheet">

  <style>
    :root{
      --y1:#FFF6B3;  /* pastel kuning */
      --y2:#FFE07A;  /* aksen */
      --b:#2f2a1f;   /* teks */
      --card:#fffdf1;
      --shadow: 0 10px 30px rgba(0,0,0,.08);
      --radius: 22px;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      font-family: "Fredoka", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      color:var(--b);
      background:
        radial-gradient(1200px 600px at 20% 10%, #fffbe0 0%, transparent 55%),
        radial-gradient(900px 500px at 80% 20%, #fff2a8 0%, transparent 60%),
        linear-gradient(180deg, var(--y1), #fff 60%);
      min-height:100vh;
    }
    .container{max-width:1100px;margin:0 auto;padding:28px 18px}
    .nav{
      display:flex;align-items:center;justify-content:space-between;
      background:rgba(255,255,255,.65);
      border:1px solid rgba(0,0,0,.06);
      border-radius:999px;
      padding:10px 14px;
      box-shadow: var(--shadow);
      backdrop-filter: blur(10px);
    }
    .brand{display:flex;gap:10px;align-items:center;font-weight:700}
    .logo{
      width:40px;height:40px;border-radius:14px;
      background:linear-gradient(135deg, var(--y2), #ffd24a);
      display:grid;place-items:center;
      box-shadow: 0 10px 20px rgba(255,208,68,.35);
    }
    .nav a{color:var(--b);text-decoration:none;font-weight:600}
    .nav .links{display:flex;gap:10px;align-items:center}
    .btn{
      border:0;cursor:pointer;
      padding:10px 14px;border-radius:999px;
      font-weight:700;
      background:#fff;
      border:1px solid rgba(0,0,0,.08);
      transition: transform .12s ease, box-shadow .12s ease;
    }
    .btn:hover{transform: translateY(-1px); box-shadow: 0 12px 24px rgba(0,0,0,.10);}
    .btn.primary{
      background:linear-gradient(135deg, var(--y2), #ffd24a);
      border:0;
    }
    .hero{display:grid;grid-template-columns: 1.15fr .85fr;gap:22px;align-items:center;margin-top:22px}
    .card{
      background:rgba(255,255,255,.72);
      border:1px solid rgba(0,0,0,.06);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding:22px;
    }
    h1{font-size:44px;line-height:1.05;margin:0 0 10px}
    p{margin:0 0 14px;font-size:16px;opacity:.9}
    .pill{
      display:inline-flex;align-items:center;gap:8px;
      padding:8px 12px;border-radius:999px;
      background: rgba(255,255,255,.75);
      border:1px solid rgba(0,0,0,.06);
      font-weight:700;
      margin-bottom:12px;
    }
    .grid{
      display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px;margin-top:12px
    }
    .mini{
      background:var(--card);
      border:1px dashed rgba(0,0,0,.12);
      border-radius:18px;
      padding:14px;
    }
    .mini b{display:block;margin-bottom:4px}
    .cute{
      width:100%; aspect-ratio: 1 / 1;
      border-radius: var(--radius);
      background:
        radial-gradient(circle at 25% 30%, #fff 0 20%, transparent 21%),
        radial-gradient(circle at 65% 35%, #fff 0 18%, transparent 19%),
        radial-gradient(circle at 48% 65%, #ffcf4b 0 14%, transparent 15%),
        linear-gradient(135deg, #fff 0%, #fff6cc 40%, #ffe07a 100%);
      border:1px solid rgba(0,0,0,.06);
      box-shadow: 0 18px 40px rgba(0,0,0,.10);
      position:relative;
      overflow:hidden;
    }
    .cute:after{
      content:"";
      position:absolute; inset:-40%;
      background: radial-gradient(circle, rgba(255,255,255,.65), transparent 55%);
      transform: rotate(18deg);
    }
    .footer{opacity:.8;font-size:13px;margin-top:16px;text-align:center}
    @media (max-width: 900px){
      .hero{grid-template-columns: 1fr; }
      h1{font-size:38px}
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="nav">
      <div class="brand">
        <div class="logo">📚</div>
        <div>Perpustakaan Digital</div>
      </div>

      <div class="links">
        <!-- ini nanti diarahkan ke login/register USER saja -->
        <a class="btn" href="/login">Login User</a>
        <a class="btn primary" href="/register">Register User</a>
      </div>
    </div>

    <div class="hero">
      <div class="card">
        <div class="pill">✨• Pinjaman buku</div>
        <h1>HAURA STORY HOUSE</h1>
        <p>
          Perpustakaan Digital adalah ruang baca modern yang menghadirkan ilmu tanpa batas.
          Akses ribuan koleksi bacaan kapan saja dan di mana saja untuk mendukung belajar, menambah wawasan, dan menumbuhkan budaya literasi di era digital.
        </p>
        <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top:10px;">
          <a class="btn primary" href="/register">Mulai sebagai User</a>
          <a class="btn" href="#fitur">Lihat Fitur</a>
        </div>

        <div id="fitur" class="grid">
          <div class="mini">
            <b>🔎 Pencarian Buku</b>
            <span>Cari judul/penulis dengan cepat.</span>
          </div>
          <div class="mini">
            <b>🗓️ Peminjaman</b>
            <span>Riwayat pinjam tampil jelas.</span>
          </div>
          <div class="mini">
            <b>🧾 Laporan</b>
            <span>Informasi dibuat komunikatif.</span>
          </div>
          <div class="mini">
            <b>🧑‍💼 Role</b>
            <span>Admin • Petugas • User.</span>
          </div>
        </div>

        <div class="footer">
          © {{ date('Y') }} Perpustakaan Digital • Tema kuning pastel 🍯
        </div>
      </div>

      <div class="cute" aria-label="Ilustrasi lucu"></div>
    </div>
  </div>
</body>
</html>
