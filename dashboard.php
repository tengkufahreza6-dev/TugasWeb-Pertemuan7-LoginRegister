<?php
require_once 'functions.php';
checkAuth(); // Proteksi Halaman
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🔐</text></svg>">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard — User Area</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <div class="dashboard-wrapper">
    <header class="dash-header">
      <div class="brand-logo">
        <i class="fa-solid fa-shield-halved"></i>
        <span>AuthSystem<sup>TR7</sup></span>
      </div>
      <div class="user-nav">
        <span class="user-greeting"><i class="fa-solid fa-circle-user"></i> <?= $_SESSION['user_name'] ?></span>
        <a href="edit-profile.php" class="btn-sec"><i class="fa-solid fa-user-gear"></i> Edit Profil</a>
        <a href="logout.php" class="btn-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
      </div>
    </header>

    <main class="dash-content">
      <div class="welcome-card">
        <h1>Selamat Datang, <?= $_SESSION['user_name'] ?>! 👋</h1>
        <p>Kamu berhasil masuk ke area Dashboard yang terproteksi menggunakan Session PHP.</p>
        
        <div class="info-grid">
          <div class="info-item">
            <span class="info-label">Sesi Email:</span>
            <strong><?= $_SESSION['user_email'] ?></strong>
          </div>
          <div class="info-item">
            <span class="info-label">Status Proteksi:</span>
            <strong class="text-success"><i class="fa-solid fa-lock"></i> Session Active</strong>
          </div>
          <div class="info-item">
            <span class="info-label">Penyimpanan Backend:</span>
            <strong>File JSON (users.json)</strong>
          </div>
        </div>
      </div>
    </main>

    <footer class="main-footer">
      <p>&copy; 2026 AuthSystem — Tengku Fahreza (PSIK 25B)</p>
    </footer>
  </div>
</body>
</html>