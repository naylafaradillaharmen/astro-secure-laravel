<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AstroSecure</title>
  <link rel="shortcut icon" href="{{ asset('images/logo.png')}}" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    /* ── VARIABEL WARNA (ROOT) ── */
    :root {
      --biru-400: #5153a8;
      --biru-600: #33358d;
      --biru-900: #212364;
      --biru-1000: #1b1d57;

      --ungu-100: #eee2ff;
      --ungu-200: #e2ceff;
      --ungu-300: #ede8ff;
      --ungu-400: #f0ecff;
      --ungu-500: #e8e2f8;
      --ungu-600: #c7afea;

      --putih: #ffffff;
      --hitam: #000000;
    }

    /* ── RESET & BASE ── */
    html {
      scroll-behavior: smooth;
    }

    *, *::before, *::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Quicksand", sans-serif;
      background: var(--ungu-200);
      color: var(--biru-600);
      overflow-x: hidden;
    }

    /* ── NAVBAR ── */
    .navbar {
      position: sticky;
      top: 16px;
      z-index: 200;
      margin: 20px auto 16px auto;
      max-width: 1237px;
      width: calc(100% - 80px);
      height: 64px;
      background: var(--ungu-200);
      padding: 0 60px;
      border-radius: 999px;
      box-shadow: 0 8px 28px rgba(80, 55, 170, 0.2);
      display: flex;
      align-items: center;
    }

    .nav-links {
      width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .nav-links a {
      text-decoration: none;
      color: var(--biru-900);
      font-size: 18px;
      font-weight: 600;
      transition: color 0.2s;
    }

    .nav-links a:hover { 
      color: var(--biru-400); 
    }

    .nav-logo img {
      height: 30px;
      width: auto;
      display: block;
    }

    .nav-toggle {
      display: none;
      flex-direction: column;
      justify-content: center;
      gap: 5px;
      width: 36px;
      height: 36px;
      background: none;
      border: none;
      cursor: pointer;
      padding: 4px;
      flex-shrink: 0;
    }

    .nav-toggle span {
      display: block;
      height: 2.5px;
      border-radius: 2px;
      background: var(--biru-900);
      transition: transform 0.3s, opacity 0.3s;
      transform-origin: center;
    }

    .nav-toggle.open span:nth-child(1) { transform: translateY(7.5px) rotate(45deg); }
    .nav-toggle.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
    .nav-toggle.open span:nth-child(3) { transform: translateY(-7.5px) rotate(-45deg); }

    .nav-dropdown {
      display: none;
      position: absolute;
      top: calc(100% + 10px);
      left: 0;
      right: 0;
      background: var(--ungu-200);
      border-radius: 24px;
      box-shadow: 0 12px 32px rgba(80, 55, 170, 0.22);
      padding: 10px 0;
      flex-direction: column;
      overflow: hidden;
    }

    .nav-dropdown.open { display: flex; }

    .nav-dropdown a {
      text-decoration: none;
      color: var(--biru-900);
      font-size: 18px;
      font-weight: 600;
      padding: 13px 28px;
      transition: background 0.15s, color 0.15s;
    }

    .nav-dropdown a:hover {
      background: rgba(80, 55, 170, 0.08);
      color: var(--biru-400);
    }

    /* ── HERO SECTION ── */
    .hero {
      background: linear-gradient(to bottom, var(--ungu-200), var(--putih));
      padding: 52px 72px 48px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 24px;
      min-height: 88vh;
      position: relative;
      overflow: hidden;
    }

    .hero-text { flex: 1; max-width: 480px; position: relative; top: -60px; }
    .hero-text h1 { font-size: 52px; font-weight: 800; color: var(--biru-1000); line-height: 1.2; margin-bottom: 20px; }
    .hero-text p { font-size: 18px; font-weight: 500; color: var(--biru-600); line-height: 1.7; max-width: 400px; }

    .hero-planet { flex-shrink: 0; position: relative; width: 580px; }
    .hero-planet img { position: absolute; right: -60px; top: -300px; width: 640px; object-fit: contain; }

    /* ── PAIN POINTS SECTION ── */
    .pain-section {
      background: var(--putih);
      padding: 64px 48px 72px;
      position: relative;
      overflow: hidden;
    }

    .stars { position: absolute; inset: 0; pointer-events: none; z-index: 1; }

    @keyframes twinkle {
      0%   { opacity: 0.2; transform: scale(0.8) rotate(0deg); }
      50%  { opacity: 1;   transform: scale(1.1) rotate(15deg); }
      100% { opacity: 0.2; transform: scale(0.9) rotate(-10deg); }
    }

    .star { position: absolute; animation: twinkle ease-in-out infinite alternate; }

    .cards-row {
      display: flex; gap: 24px; justify-content: center; flex-wrap: wrap; position: relative; z-index: 2;
    }

    .pain-card {
      background: var(--ungu-400); border-radius: 20px; padding: 36px 28px;
      min-width: 200px; max-width: 280px; flex: 1; text-align: center;
      font-size: 15px; font-weight: 700; color: var(--biru-900); line-height: 1.5;
      box-shadow: -5px 5px 0 rgba(180, 145, 255, 0.3); transition: transform 0.2s, box-shadow 0.2s;
    }

    .pain-card:hover { transform: translateY(-4px); box-shadow: 8px 12px 0 rgba(80, 55, 170, 0.2); }

    /* ── TAGLINE SECTION ── */
    .tagline-section { background: var(--putih); padding: 64px 48px 80px; text-align: center; position: relative; overflow: hidden; }
    .tagline-section p { font-size: 19px; font-weight: 600; color: var(--biru-600); line-height: 1.75; max-width: 680px; margin: 0 auto; position: relative; z-index: 2; }

    /* ── MISI SECTION ── */
    .misi-section {
      background: var(--putih); padding: 60px 60px 40px; display: flex; align-items: center; justify-content: space-between; gap: 60px; position: relative; overflow: hidden;
    }

    /* MASKOT DIKEMBALIKAN KE LUAR LINGKARAN AGAR BISA NEMPEL KE DINDING KIRI */
    .mascot {
      position: absolute;
      left: -20px; /* Selalu nempel di dinding layar kiri */
      bottom: 25px; /* Disesuaikan agar pas dengan batas bawah lingkaran di desktop */
      width: 290px;
      z-index: 5;
    }
    .mascot img { width: 100%; display: block; }

    .misi-left {
      position: relative; flex: 0 0 440px; height: 440px; display: flex; align-items: center; justify-content: center;
    }

    .misi-circle {
      position: absolute; width: 100%; height: 100%; border-radius: 50%; background: var(--ungu-300); top: 0; left: 0; z-index: 1;
    }

    .misi-left-content {
      position: relative; z-index: 10; text-align: center; max-width: 320px; transform: translateY(-35px); 
    }

    .misi-left-content h2 { font-size: 44px; font-weight: 800; line-height: 1.2; color: var(--biru-1000); margin-bottom: 18px; }
    .misi-left-content p { font-size: 18px; font-weight: 500; color: var(--biru-600); line-height: 1.5; }

    .misi-right { flex: 1; display: flex; flex-direction: column; gap: 22px; position: relative; z-index: 3; }

    /* STYLE KARTU FITUR - AKAN DI-COPY PERSIS UNTUK TOMBOL DOWNLOAD */
    .feature-card {
      background: var(--ungu-400); border-radius: 22px; padding: 22px 26px; display: flex; align-items: center; gap: 22px;
      box-shadow: -5px 5px 0 rgba(180, 145, 255, 0.3); transition: transform 0.2s;
    }
    .feature-card:hover { transform: translateY(-4px); }

    .feature-icon { flex-shrink: 0; width: 64px; height: 64px; border-radius: 50%; background: var(--ungu-600); display: flex; align-items: center; justify-content: center; }
    .feature-icon img { width: 54%; height: 54%; object-fit: contain; }
    .feature-text h3 { font-size: 22px; font-weight: 800; color: var(--biru-1000); margin-bottom: 4px; }
    .feature-text p { font-size: 15px; font-weight: 500; color: var(--biru-600); line-height: 1.5; }

    /* ── CTA SECTION ── */
    .cta-section {
      background: var(--putih); padding: 80px 60px 0; display: flex; align-items: flex-end; gap: 60px; position: relative; overflow: hidden; border-top: 1px solid var(--ungu-400);
    }

    .cta-left { flex: 1; position: relative; z-index: 2; padding-bottom: 80px; }
    .cta-left h2 { font-size: 48px; font-weight: 600; color: var(--biru-1000); line-height: 1.3; margin-bottom: 16px; }
    .cta-sub { font-size: 28px; font-weight: 500; color: var(--biru-600); margin-bottom: 36px; }

    /* KONTAINER TOMBOL DOWNLOAD */
    .cta-btns {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }

    /* TOMBOL DOWNLOAD (100% IDENTIK DENGAN STYLE KARTU FITUR) */
    .cta-btn {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      gap: 16px;
      background: var(--ungu-400);
      border-radius: 22px;
      padding: 0 24px;
      border: none;
      font-family: inherit;
      box-shadow: -5px 5px 0 rgba(180, 145, 255, 0.3);
      transition: transform 0.2s;
      width: 270px;
      height: 80px;
    }

    button.cta-btn { cursor: pointer; }

    /* Hover persis kartu fitur */
    .cta-btn:hover {
      transform: translateY(-4px); 
    }

    .cta-btn-icon {
      width: 32px;
      height: 32px;
      fill: var(--biru-1000); 
      flex-shrink: 0;
    }

    .cta-btn-text {
      display: flex;
      flex-direction: column;
      text-align: left;
      font-size: 16px;
      font-weight: 800; /* Tebal disamakan dengan judul fitur */
      line-height: 1.3;
      color: var(--biru-1000);
    }

    /* CTA RIGHT HP NEMPEL KANAN (Desktop) */
    .cta-right { flex: 0 0 auto; align-self: flex-end; margin-right: -60px; }
    .cta-right img { display: block; width: 400px; object-fit: contain; }

    /* ── POPUP (MODAL) UNDUH ── */
    .modal-overlay {
      position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(33, 35, 100, 0.4); backdrop-filter: blur(4px);
      display: flex; align-items: center; justify-content: center; z-index: 1000; opacity: 0; visibility: hidden; transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    .modal-overlay.active { opacity: 1; visibility: visible; }
    .modal-content {
      background: var(--putih); border-radius: 24px; padding: 36px; text-align: center; max-width: 400px; width: 90%;
      box-shadow: 0 16px 32px rgba(50, 50, 100, 0.15); transform: translateY(20px); transition: transform 0.3s ease;
    }
    .modal-overlay.active .modal-content { transform: translateY(0); }
    .modal-icon { width: 60px; height: 60px; background: var(--ungu-300); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }
    .modal-icon svg { width: 30px; height: 30px; fill: var(--biru-600); }
    .modal-content h3 { color: var(--biru-1000); font-size: 24px; font-weight: 800; margin-bottom: 12px; }
    .modal-content p { color: var(--biru-600); font-size: 16px; font-weight: 500; line-height: 1.5; margin-bottom: 28px; }
    
    .modal-actions { display: flex; gap: 12px; justify-content: center; }
    .btn-cancel { flex: 1; background: var(--ungu-400); color: var(--biru-900); padding: 14px; border-radius: 14px; border: none; font-size: 16px; font-weight: 700; cursor: pointer; font-family: inherit; transition: background 0.2s; }
    .btn-cancel:hover { background: var(--ungu-600); }
    .btn-confirm { flex: 1; background: var(--biru-400); color: var(--putih); padding: 14px; border-radius: 14px; text-decoration: none; font-size: 16px; font-weight: 700; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(81, 83, 168, 0.3); transition: transform 0.2s, background 0.2s; }
    .btn-confirm:hover { background: var(--biru-600); transform: translateY(-2px); }

    /* ── FOOTER ── */
    .footer { background: var(--ungu-100); padding: 52px 48px 36px; display: flex; flex-direction: column; align-items: center; gap: 28px; }
    .footer-logo img { height: 56px; width: auto; }
    .footer-copy { font-size: 13px; font-weight: 500; color: var(--hitam); text-align: center; }

    /* ── RESPONSIVE: TABLET (≤1024px) ── */
    @media (max-width: 1024px) {
      .hero { padding: 44px 40px 40px; min-height: auto; }
      .hero-text h1 { font-size: 42px; }
      .hero-planet img { width: 500px; right: -40px; top: -140px; }

      .misi-section { flex-direction: column; padding: 56px 32px 40px; gap: 40px; align-items: stretch; }
      .misi-left { flex: none; width: 380px; height: 380px; margin: 0 auto; }
      .misi-left-content { transform: translateY(-25px); }
      .misi-left-content h2 { font-size: 34px; }
      .misi-left-content p  { font-size: 16px; }

      /* MASKOT TABLET (Dihitung matematis agar rata bawah lingkaran + nempel kiri) */
      .mascot { 
        left: -15px; 
        top: 436px; /* 56px(padding top) + 380px(tinggi lingkaran) = 436px */
        bottom: auto;
        transform: translateY(-90%);
        width: 240px; 
      }

      .cta-section { flex-direction: column; padding: 64px 32px 0; gap: 0; align-items: stretch; }
      .cta-left { padding-bottom: 40px; }
      .cta-left h2 { font-size: 38px; }
      .cta-sub { font-size: 22px; }
      
      /* HP TABLET NEMPEL DINDING KANAN */
      .cta-right { 
        align-self: flex-end; /* Tarik ke pojok kanan */
        margin-right: -32px; /* Offset padding 32px agar nempel */
        padding-bottom: 0; 
      }
      .cta-right img { width: 220px; }
    }

    /* ── RESPONSIVE: MOBILE (≤768px) ── */
    @media (max-width: 768px) {
      .navbar { margin: 12px auto; padding: 10px 20px; width: calc(100% - 32px); height: auto; }
      .nav-links a { font-size: 16px; }
      .hero { flex-direction: column; padding: 36px 24px 32px; gap: 16px; min-height: auto; }
      .hero-text { top: 0; max-width: 100%; text-align: center; }
      .hero-text h1 { font-size: 32px; }
      .hero-text p  { margin: 0 auto; font-size: 15px; }
      .hero-planet { width: 100%; height: 260px; }
      .hero-planet img { position: relative; right: auto; top: auto; width: 100%; max-width: 320px; margin: 0 auto; display: block; }
      
      .pain-section, .tagline-section { padding: 48px 24px 56px; }
      .pain-card { min-width: 160px; font-size: 14px; padding: 28px 20px; }
      .tagline-section p { font-size: 16px; }

      .misi-section { padding: 48px 24px 32px; gap: 32px; }
      .misi-left { width: 310px; height: 310px; }
      .misi-left-content { max-width: 250px; transform: translateY(-25px); }
      .misi-left-content h2 { font-size: 26px; margin-bottom: 10px; }
      .misi-left-content p  { font-size: 14px; }
      
      /* MASKOT MOBILE (Dihitung matematis agar rata bawah lingkaran + nempel kiri) */
      .mascot { 
        left: -15px; 
        top: 340px; /* 48px(padding top) + 310px(tinggi lingkaran) = 358px */
        bottom: auto;
        transform: translateY(-90%);
        width: 180px; 
      }

      .feature-card { padding: 18px 20px; gap: 16px; }
      .feature-icon { width: 54px; height: 54px; }
      .feature-text h3 { font-size: 18px; }
      .feature-text p  { font-size: 14px; }

      .cta-section  { padding: 48px 24px 0; }
      .cta-left h2  { font-size: 30px; text-align: center; }
      .cta-sub      { font-size: 18px; text-align: center; }
      
      .cta-btns { flex-direction: column; align-items: center; gap: 16px; width: 100%; }
      .cta-btn { width: 100%; max-width: 280px; }

      /* HP MOBILE NEMPEL DINDING KANAN */
      .cta-right { 
        align-self: center; /* Offset padding 24px agar 100% mentok kanan */
      }
      .cta-right img { width: 180px; }
      
      .footer { padding: 40px 24px 28px; }
      .modal-content { padding: 28px 24px; }
      .modal-actions { flex-direction: column-reverse; }
      .btn-cancel, .btn-confirm { width: 100%; }
    }

    /* ── RESPONSIVE: SMALL MOBILE (≤480px) ── */
    @media (max-width: 480px) {
      .navbar { margin: 10px auto; padding: 10px 20px; width: calc(100% - 28px); }
      .nav-links a:not(.nav-logo) { display: none; }
      .nav-toggle { display: flex; }
      .hero-text h1 { font-size: 28px; }
      .cards-row { flex-direction: column; align-items: center; }
      .pain-card  { max-width: 100%; width: 100%; }
    }
  </style>
</head>
<body>

  <nav class="navbar">
    <div class="nav-links">
      <a href="#" class="nav-logo"><img src="{{ asset('images/logo.png') }}" alt="AstroSecure" /></a>
      <a href="#tentang-kami">Tentang Kami</a>
      <a href="#alur-misi">Alur Misi</a>
      <a href="#download">Download</a>
      <button class="nav-toggle" id="navToggle" aria-label="Buka menu">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
    <div class="nav-dropdown" id="navDropdown">
      <a href="#tentang-kami">Tentang Kami</a>
      <a href="#alur-misi">Alur Misi</a>
      <a href="#download">Download</a>
    </div>
  </nav>

  <section class="hero" id="tentang-kami">
    <div class="hero-text">
      <h1>Ayo, mulai misi<br />bersama anak!</h1>
      <p>Bantu anak lebih disiplin dengan mengatur jadwal, menyelesaikan tugas, dan mengumpulkan reward, semua dalam satu pengalaman yang menyenangkan.</p>
    </div>
    <div class="hero-planet">
      <img src="{{ asset('images/planetBesar.png') }}" alt="Planet" />
    </div>
  </section>

  <section class="pain-section">
    <div class="stars" id="stars-pain"></div>
    <div class="cards-row">
      <div class="pain-card">Anak sulit lepas dari<br />HP</div>
      <div class="pain-card">Screen time sering jadi<br />drama</div>
      <div class="pain-card">Jadwal harian tidak<br />konsisten</div>
    </div>
  </section>

  <section class="tagline-section">
    <div class="stars" id="stars-tagline"></div>
    <p>Dari drama screen time menjadi misi harian yang terstruktur.<br />Atur misi, pantau pengerjaan, dan bantu anak membangun kebiasaan digital yang lebih sehat.</p>
  </section>

  <section class="misi-section" id="alur-misi">
    <div class="mascot">
      <img src="{{ asset('images/maskot.png') }}" alt="Maskot Astro" />
    </div>

    <div class="misi-left">
      <div class="misi-circle"></div>
      <div class="misi-left-content">
        <h2>Alur Misi</h2>
        <p>Melalui misi harian dan reward, anak belajar mengatur waktu bersama Lumi dan teman misi lainnya.</p>
      </div>
    </div>

    <div class="misi-right">
      <div class="feature-card">
        <div class="feature-icon">
          <img src="{{ asset('images/aturJadwal.png') }}" alt="Atur Jadwal" />
        </div>
        <div class="feature-text">
          <h3>Fitur Atur Jadwal</h3>
          <p>Anak menerima reward dan membuka skin baru setelah menyelesaikan tugas.</p>
        </div>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <img src="{{ asset('images/reminder.png') }}" alt="Reminder" />
        </div>
        <div class="feature-text">
          <h3>Fitur Reminder</h3>
          <p>Pengingat membantu anak tepat waktu dan membatasi screen time sesuai aturan orang tua.</p>
        </div>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <img src="{{ asset('images/reward.png') }}" alt="Reward" />
        </div>
        <div class="feature-text">
          <h3>Fitur Reward</h3>
          <p>Anak menerima reward dan membuka skin baru setelah menyelesaikan tugas.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="cta-section" id="download">
    <div class="stars" id="stars-cta"></div>
    <div class="cta-left">
      <h2>Siap mulai misi<br />kecil bersama<br />anak?</h2>
      <p class="cta-sub">Tanpa drama &bull; Lebih terarah &bull; Mudah dipantau</p>
      
      <div class="cta-btns">
        <div class="cta-btn info-only">
          <svg class="cta-btn-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.523 15.3414c-.5511 0-.9993-.4486-.9993-.9997s.4482-.9993.9993-.9993c.5511 0 .9993.4482.9993.9993.0004.5511-.4482.9997-.9993.9997m-11.046 0c-.5511 0-.9993-.4486-.9993-.9997s.4482-.9993.9993-.9993c.5511 0 .9993.4482.9993.9993 0 .5511-.4482.9997-.9993.9997m11.4045-6.02l1.9973-3.4592c.1158-.201.0467-.4569-.1539-.5727-.201-.1158-.4569-.0471-.5727.1539l-2.034 3.5222c-1.4239-.6465-3.036-.1005-4.838-.1005s-3.4141-.546-4.838.1005l-2.034-3.5222c-.1158-.201-.3717-.2697-.5727-.1539-.2006.1158-.2697.3717-.1539.5727l1.9973 3.4592C4.1957 10.6698 2.0528 13.5262 2 17h20c-.0528-3.4738-2.1957-6.3302-5.1185-7.6786"/>
          </svg>
          <div class="cta-btn-text">
            Hanya Tersedia di<br/>Android
          </div>
        </div>

        <button class="cta-btn" onclick="openDownloadModal()">
          <svg class="cta-btn-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
          </svg>
          <div class="cta-btn-text">
            Download Aplikasi
          </div>
        </button>
      </div>

    </div>
    <div class="cta-right">
      <img src="{{ asset('images/phone.png') }}" alt="Phone Mockup" />
    </div>
  </section>

  <footer class="footer">
    <div class="footer-logo">
      <img src="{{ asset('images/logoBesar.png') }}" alt="Logo AstroSecure" />
    </div>
    <p class="footer-copy">&copy; 2026 Astro Secure &mdash; Oasis Group, IDN Polytechnic Bogor. All rights reserved.</p>
  </footer>

  <div class="modal-overlay" id="downloadModal">
    <div class="modal-content">
      <div class="modal-icon">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
        </svg>
      </div>
      <h3>Mulai Petualangan?</h3>
      <p>Apakah kamu yakin ingin mengunduh aplikasi AstroSecure sekarang dan memulai misi seru bersama Lumi?</p>
      <div class="modal-actions">
        <button class="btn-cancel" onclick="closeDownloadModal()">Batal</button>
        <a href="link-aplikasi-kamu.apk" class="btn-confirm" download>Ya, Unduh</a>
      </div>
    </div>
  </div>

  <script>
    function makeStar(size, top, left, delay, duration) {
      const cx = size, cy = size, r1 = size;
      const r2 = size * 0.15;
      const color = "#5D00FF";
      
      const pts = Array.from({ length: 8 }, (_, i) => {
        const angle = (i * Math.PI) / 4 - Math.PI / 2;
        const r = i % 2 === 0 ? r1 : r2;
        return `${cx + r * Math.cos(angle)},${cy + r * Math.sin(angle)}`;
      });
      
      const span = document.createElement("span");
      span.className = "star";
      span.style.cssText = `top:${top}%;left:${left}%;animation-delay:${delay}s;animation-duration:${duration}s;`;
      span.innerHTML = `<svg width="${size*2}" height="${size*2}" viewBox="0 0 ${size*2} ${size*2}" xmlns="http://www.w3.org/2000/svg"><polygon points="${pts.join(" ")}" fill="${color}"/></svg>`;
      
      return span;
    }

    function generateRandomStars(containerId, count) {
      const container = document.getElementById(containerId);
      if (!container) return;
      
      for (let i = 0; i < count; i++) {
        const top = Math.random() * 95; 
        const left = Math.random() * 95; 
        const size = Math.random() * 5 + 4; 
        const delay = Math.random() * 2; 
        const duration = Math.random() * 2 + 2.5; 
        
        container.appendChild(makeStar(size, top, left, delay, duration));
      }
    }

    generateRandomStars("stars-pain", 15);
    generateRandomStars("stars-tagline", 10);
    generateRandomStars("stars-cta", 20);

    const toggle = document.getElementById('navToggle');
    const dropdown = document.getElementById('navDropdown');
    toggle.addEventListener('click', () => {
      const open = toggle.classList.toggle('open');
      dropdown.classList.toggle('open', open);
      toggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
    });
    dropdown.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', () => {
        toggle.classList.remove('open');
        dropdown.classList.remove('open');
      });
    });

    const downloadModal = document.getElementById('downloadModal');

    function openDownloadModal() {
      downloadModal.classList.add('active');
    }

    function closeDownloadModal() {
      downloadModal.classList.remove('active');
    }

    downloadModal.addEventListener('click', function(e) {
      if (e.target === downloadModal) {
        closeDownloadModal();
      }
    });
  </script>

</body>
</html>