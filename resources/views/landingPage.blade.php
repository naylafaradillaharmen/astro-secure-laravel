<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AstroSecure</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    html{
        scroll-behavior: smooth;
    }

    *, *::before, *::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --biru-400: #5153a8;
      --biru-600: #33358d;
      --biru-900: #212364;
      --biru-1000: #1b1d57;
      --ungu-100: #eee2ff;
      --ungu-200: #e2ceff;
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
      margin: 20px 40px 16px;
      background: var(--ungu-200);
      padding: 14px 36px;
      border-radius: 999px;
      box-shadow: 0 8px 28px rgba(80, 55, 170, 0.2);
    }

    .nav-links {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .nav-links a {
      text-decoration: none;
      color: var(--biru-900);
      font-size: 15px;
      font-weight: 600;
      transition: color 0.2s;
    }

    .nav-links a:hover { color: var(--biru-400); }

    .nav-logo img {
      height: 38px;
      width: auto;
      display: block;
    }

    /* hamburger button — hidden by default */
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

    /* dropdown */
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
      font-size: 15px;
      font-weight: 600;
      padding: 13px 28px;
      transition: background 0.15s, color 0.15s;
    }

    .nav-dropdown a:hover {
      background: rgba(80, 55, 170, 0.08);
      color: var(--biru-400);
    }

    /* ── HERO ── */
    .hero {
      background: linear-gradient(to bottom, var(--ungu-200), #fff);
      padding: 52px 72px 48px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 24px;
      min-height: 88vh;
      position: relative;
      overflow: hidden;
    }

    .hero-text {
      flex: 1;
      max-width: 480px;
      position: relative;
      top: -60px;
    }

    .hero-text h1 {
      font-size: 52px;
      font-weight: 800;
      color: var(--biru-1000);
      line-height: 1.2;
      margin-bottom: 20px;
    }

    .hero-text p {
      font-size: 16px;
      font-weight: 500;
      color: var(--biru-600);
      line-height: 1.7;
      max-width: 400px;
    }

    .hero-planet {
      flex-shrink: 0;
      position: relative;
      width: 580px;
    }

    .hero-planet img {
      position: absolute;
      right: -60px;
      top: -300px;
      width: 640px;
      object-fit: contain;
    }

    /* ── PAIN POINTS ── */
    .pain-section {
      background: #fff;
      padding: 64px 48px 72px;
      position: relative;
      overflow: hidden;
    }

    .stars {
      position: absolute;
      inset: 0;
      pointer-events: none;
      z-index: 1;
    }

    @keyframes twinkle {
      0%   { opacity: 0.3; transform: scale(0.85) rotate(0deg); }
      50%  { opacity: 1;   transform: scale(1.2)  rotate(20deg); }
      100% { opacity: 0.35; transform: scale(0.9) rotate(-15deg); }
    }

    .star {
      position: absolute;
      animation: twinkle ease-in-out infinite alternate;
    }

    .cards-row {
      display: flex;
      gap: 24px;
      justify-content: center;
      flex-wrap: wrap;
      position: relative;
      z-index: 2;
    }

    .pain-card {
      background: var(--ungu-100);
      border-radius: 20px;
      padding: 36px 28px;
      min-width: 200px;
      max-width: 280px;
      flex: 1;
      text-align: center;
      font-size: 15px;
      font-weight: 700;
      color: var(--biru-900);
      line-height: 1.5;
      box-shadow: 6px 8px 0 rgba(80, 55, 170, 0.16);
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .pain-card:hover {
      transform: translateY(-4px);
      box-shadow: 8px 12px 0 rgba(80, 55, 170, 0.2);
    }

    /* ── TAGLINE ── */
    .tagline-section {
      background: #fff;
      padding: 64px 48px 80px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .tagline-section p {
      font-size: 19px;
      font-weight: 600;
      color: var(--biru-600);
      line-height: 1.75;
      max-width: 680px;
      margin: 0 auto;
      position: relative;
      z-index: 2;
    }

    /* ── MISI ── */
    .misi-section {
      background: #fff;
      padding: 80px 60px 0;
      display: flex;
      align-items: flex-end;
      justify-content: space-between;
      gap: 60px;
      position: relative;
      overflow: hidden;
    }

    .misi-left {
      position: relative;
      flex: 0 0 400px;
      min-height: 480px;
    }

    .misi-circle {
      position: absolute;
      width: 360px;
      height: 360px;
      border-radius: 50%;
      background: #ede8ff;
      top: -20px;
      left: -40px;
      z-index: 1;
    }

    .misi-left-content {
      position: relative;
      z-index: 4;
      padding-top: 40px;
      padding-left: 20px;
    }

    .misi-left-content h2 {
      font-size: 50px;
      font-weight: 800;
      line-height: 1.2;
      color: var(--biru-1000);
      margin-bottom: 18px;
    }

    .misi-left-content p {
      font-size: 20px;
      font-weight: 500;
      color: var(--biru-600);
      line-height: 1.5;
    }

    .mascot {
      position: absolute;
      bottom: 0;
      left: -60px;
      width: 280px;
      z-index: 3;
    }

    .mascot img {
      width: 100%;
      display: block;
    }

    .misi-right {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 22px;
      padding-bottom: 80px;
    }

    .feature-card {
      background: #f0ecff;
      border-radius: 22px;
      padding: 22px 26px;
      display: flex;
      align-items: center;
      gap: 22px;
      box-shadow: -5px 5px 0 rgba(180, 145, 255, 0.3);
      transition: transform 0.2s;
    }

    .feature-card:hover { transform: translateY(-4px); }

    .feature-icon {
      flex-shrink: 0;
      width: 64px;
      height: 64px;
      border-radius: 50%;
      background: #c7afea;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .feature-icon img {
      width: 54%;
      height: 54%;
      object-fit: contain;
    }

    .feature-text h3 {
      font-size: 22px;
      font-weight: 800;
      color: var(--biru-1000);
      margin-bottom: 4px;
    }

    .feature-text p {
      font-size: 15px;
      font-weight: 500;
      color: var(--biru-600);
      line-height: 1.5;
    }

    /* ── CTA ── */
    .cta-section {
      background: #fff;
      padding: 80px 60px 0;
      display: flex;
      align-items: flex-end;
      gap: 60px;
      position: relative;
      overflow: hidden;
      border-top: 1px solid #f0ecff;
    }

    .cta-left {
      flex: 1;
      position: relative;
      z-index: 2;
      padding-bottom: 80px;
    }

    .cta-left h2 {
      font-size: 48px;
      font-weight: 600;
      color: var(--biru-1000);
      line-height: 1.3;
      margin-bottom: 16px;
    }

    .cta-sub {
      font-size: 28px;
      font-weight: 500;
      color: var(--biru-600);
      margin-bottom: 36px;
    }

    .cta-btns {
      display: flex;
      gap: 16px;
      flex-wrap: wrap;
    }

    .cta-btn {
      display: flex;
      align-items: center;
      gap: 12px;
      background: #e8e2f8;
      border-radius: 14px;
      padding: 14px 20px;
      text-decoration: none;
      color: var(--biru-1000);
      font-size: 13px;
      font-weight: 500;
      line-height: 1.5;
      box-shadow: 4px 4px 0 rgba(120, 90, 220, 0.12);
      min-width: 180px;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .cta-btn img { width: 32px; height: 32px; object-fit: contain; }
    .cta-btn strong { font-size: 14px; font-weight: 800; display: block; }

    .cta-btn:hover {
      transform: translateY(-3px);
      box-shadow: 6px 7px 0 rgba(120, 90, 220, 0.16);
    }

    .cta-right {
      flex: 0 0 auto;
      align-self: flex-end;
      margin-right: -60px;
    }

    .cta-right img {
      display: block;
      width: 260px;
      object-fit: contain;
    }

    /* ── FOOTER ── */
    .footer {
      background: var(--ungu-100);
      padding: 52px 48px 36px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 28px;
    }

    .footer-logo img {
      height: 56px;
      width: auto;
    }

    .footer-copy {
      font-size: 13px;
      font-weight: 500;
      color: #000;
      text-align: center;
    }

    /* ── RESPONSIVE: TABLET (≤1024px) ── */
    @media (max-width: 1024px) {
      .hero { padding: 44px 40px 40px; min-height: auto; }
      .hero-text h1 { font-size: 42px; }
      .hero-planet img { width: 500px; right: -40px; top: -140px; }

      .misi-section {
        flex-direction: column;
        padding: 56px 32px 0;
        gap: 0;
        align-items: stretch;
      }

      .misi-left {
        flex: none;
        width: 100%;
        min-height: 360px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      .misi-circle {
        width: 300px;
        height: 300px;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
      }

      .misi-left-content { padding-left: 0; text-align: center; }
      .misi-left-content h2 { font-size: 40px; }
      .misi-left-content p  { font-size: 17px; }

      .mascot {
        position: relative;
        left: auto;
        bottom: auto;
        width: 200px;
        margin: 16px auto 0;
      }

      .misi-right { padding-bottom: 48px; }

      .cta-section {
        flex-direction: column;
        padding: 64px 32px 0;
        gap: 0;
        align-items: stretch;
      }

      .cta-left { padding-bottom: 40px; }
      .cta-left h2 { font-size: 38px; }
      .cta-sub { font-size: 22px; }

      .cta-right {
        margin-right: 0;
        display: flex;
        justify-content: center;
        padding-bottom: 0;
      }

      .cta-right img { width: 220px; }
    }

    /* ── RESPONSIVE: MOBILE (≤768px) ── */
    @media (max-width: 768px) {
      .navbar {
        margin: 12px 16px;
        padding: 12px 20px;
      }

      .hero {
        flex-direction: column;
        padding: 36px 24px 32px;
        gap: 16px;
        min-height: auto;
      }

      .hero-text {
        top: 0;
        max-width: 100%;
        text-align: center;
      }

      .hero-text h1 { font-size: 32px; }
      .hero-text p  { margin: 0 auto; font-size: 15px; }

      .hero-planet {
        width: 100%;
        height: 260px;
      }

      .hero-planet img {
        position: relative;
        right: auto;
        top: auto;
        width: 100%;
        max-width: 320px;
        margin: 0 auto;
        display: block;
      }

      .pain-section,
      .tagline-section {
        padding: 48px 24px 56px;
      }

      .pain-card {
        min-width: 160px;
        font-size: 14px;
        padding: 28px 20px;
      }

      .tagline-section p { font-size: 16px; }

      .misi-section { padding: 48px 24px 0; }
      .misi-circle  { width: 260px; height: 260px; }
      .misi-left-content h2 { font-size: 34px; }
      .misi-left-content p  { font-size: 15px; }
      .mascot { width: 160px; }

      .feature-card { padding: 18px 20px; gap: 16px; }
      .feature-icon { width: 54px; height: 54px; }
      .feature-text h3 { font-size: 18px; }
      .feature-text p  { font-size: 14px; }

      .cta-section  { padding: 48px 24px 0; }
      .cta-left h2  { font-size: 30px; text-align: center; }
      .cta-sub      { font-size: 18px; text-align: center; }
      .cta-btns     { justify-content: center; }
      .cta-right img { width: 180px; }

      .footer { padding: 40px 24px 28px; }
    }

    /* ── RESPONSIVE: SMALL MOBILE (≤480px) ── */
    @media (max-width: 480px) {
      .navbar { margin: 10px 14px; padding: 12px 20px; }

      /* hide text links, show hamburger — logo stays in place */
      .nav-links a:not(.nav-logo) { display: none; }
      .nav-toggle { display: flex; }

      .hero-text h1 { font-size: 28px; }

      .cards-row { flex-direction: column; align-items: center; }
      .pain-card  { max-width: 100%; width: 100%; }

      .cta-btn { min-width: 100%; justify-content: center; }
      .cta-btns { flex-direction: column; }
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
    <div class="misi-left">
      <div class="misi-circle"></div>
      <div class="misi-left-content">
        <h2>Alur Misi</h2>
        <p>Melalui misi harian dan reward,<br />anak belajar mengatur waktu<br />bersama Astro.</p>
      </div>
      <div class="mascot">
        <img src="{{ asset('images/maskot.png') }}" alt="Maskot Astro" />
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
        <a href="#" class="cta-btn">
          <img src="{{ asset('images/android.png') }}" alt="Android" />
          <span>Hanya Tersedia di<br /><strong>Android</strong></span>
        </a>
        <a href="#" class="cta-btn">
          <img src="{{ asset('images/playStore.png') }}" alt="Play Store" />
          <span>Unduh sekarang di<br /><strong>Play Store</strong></span>
        </a>
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

  <script>
    function makeStar(size, color, top, left, delay, duration) {
      const cx = size, cy = size, r1 = size, r2 = size * 0.38;
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

    const starData = {
      "stars-pain": [
        [7,4,9,"#f7c948",0,2.8],[13,17,6,"#64b5f6",0.4,3.1],[5,32,7,"#f06292",0.8,2.5],
        [18,49,8,"#ab7ee8",1.1,3.3],[9,67,6,"#4dd0c4",0.3,2.9],[7,79,5,"#ff9966",0.6,3.5],
        [14,91,9,"#f7c948",1.4,2.7],[55,3,7,"#fd79a8",0.9,3.0],[70,11,5,"#74b9ff",0.2,2.6],
        [80,39,8,"#a29bfe",1.2,3.2],[74,61,6,"#55efc4",0.5,2.8],[61,84,7,"#f7c948",1.0,3.4],
        [85,93,9,"#f06292",0.7,3.0],[40,26,5,"#64b5f6",1.3,2.7],[50,72,6,"#ab7ee8",0.1,3.1],
      ],
      "stars-tagline": [
        [11,4,8,"#f06292",0.3,2.9],[8,21,6,"#f7c948",1.0,3.2],[19,43,7,"#64b5f6",0.5,2.6],
        [10,64,9,"#ab7ee8",1.3,3.0],[14,87,5,"#4dd0c4",0.2,3.4],[70,7,7,"#ff9966",0.8,2.8],
        [64,37,8,"#fd79a8",0.6,3.1],[74,57,6,"#74b9ff",1.1,2.7],[71,79,9,"#f7c948",0.4,3.3],
        [82,92,5,"#a29bfe",0.9,2.9],[45,15,6,"#55efc4",1.4,3.0],[55,68,7,"#f06292",0.7,2.8],
      ],
      "stars-cta": [
        [8,3,9,"#f7c948",0.2,3.0],[6,19,6,"#f06292",0.8,2.7],[11,35,7,"#64b5f6",0.4,3.3],
        [7,54,8,"#ab7ee8",1.2,2.9],[5,71,5,"#4dd0c4",0.6,3.1],[10,87,9,"#ff9966",1.0,2.6],
        [9,95,6,"#fd79a8",0.3,3.4],[60,5,7,"#74b9ff",1.4,2.8],[75,14,8,"#f7c948",0.7,3.0],
        [80,29,5,"#a29bfe",0.5,2.7],[70,54,9,"#55efc4",1.1,3.2],[65,74,6,"#f06292",0.9,2.9],
        [78,89,7,"#64b5f6",0.1,3.5],[85,97,8,"#ab7ee8",1.3,2.8],[40,45,5,"#f7c948",0.4,3.1],
      ],
    };

    Object.entries(starData).forEach(([id, stars]) => {
      const el = document.getElementById(id);
      if (!el) return;
      stars.forEach(([top, left, size, color, delay, dur]) => {
        el.appendChild(makeStar(size, color, top, left, delay, dur));
      });
    });

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
  </script>

</body>
</html>