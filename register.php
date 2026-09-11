<?php
require_once 'functions.php';

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = sanitizeInput($_POST['name'] ?? '');
    $email    = sanitizeInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validasi Form
    if (empty($name) || empty($email) || empty($password)) {
        $error = 'Semua kolom wajib diisi!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid!';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal harus 6 karakter!';
    } elseif (findUserByEmail($email)) {
        $error = 'Email sudah terdaftar, gunakan email lain!';
    } else {
        $users = getUsers();
        
        // Enkripsi Password (Bukan Plain Text)
        $newUser = [
            'id'         => uniqid('user_', true),
            'name'       => $name,
            'email'      => $email,
            'password'   => password_hash($password, PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $users[] = $newUser;

        if (saveUsers($users)) {
            $success = 'Registrasi berhasil! Silakan login.';
        } else {
            $error = 'Gagal menyimpan data. Coba lagi nanti.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🔐</text></svg>">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register — TR 7 Auth System</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <main class="auth-wrapper">
    <div class="auth-card">
      <div class="auth-header">
        <i class="fa-solid fa-user-plus"></i>
        <h2>Buat Akun Baru</h2>
        <p>Isi formulir untuk mendaftar sistem</p>
      </div>

      <?php if ($error): ?>
        <div class="alert alert-error"><i class="fa-solid fa-circle-exclamation"></i> <?= $error ?></div>
      <?php endif; ?>

      <?php if ($success): ?>
        <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> <?= $success ?></div>
      <?php endif; ?>

      <form action="register.php" method="POST" class="auth-form">
        <div class="form-group">
          <label for="name">Nama Lengkap</label>
          <input type="text" id="name" name="name" required placeholder="Masukkan nama lengkap">
        </div>

        <div class="form-group">
          <label for="email">Alamat Email</label>
          <input type="email" id="email" name="email" required placeholder="nama@email.com">
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required placeholder="Minimal 6 karakter">
        </div>

        <button type="submit" class="btn-primary">Daftar Sekarang</button>
      </form>

      <div class="auth-footer">
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
      </div>
    </div>
  </main>
</body>
</html>