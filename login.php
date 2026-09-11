<?php
require_once 'functions.php';

// Jika sudah login, langsung lempar ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = sanitizeInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    if (empty($email) || empty($password)) {
        $error = 'Email dan Password wajib diisi!';
    } else {
        $user = findUserByEmail($email);

        // Verifikasi User dan Hash Password
        if ($user && password_verify($password, $user['password'])) {
            // Set Session
            $_SESSION['user_id']    = $user['id'];
            $_SESSION['user_name']  = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            // Fitur Bonus: Remember Me (Cookie 7 hari)
            if ($remember) {
                setcookie('remember_user', $user['email'], time() + (86400 * 7), "/");
            }

            header("Location: dashboard.php");
            exit;
        } else {
            $error = 'Email atau Password salah!';
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
  <title>Login — TR 7 Auth System</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <main class="auth-wrapper">
    <div class="auth-card">
      <div class="auth-header">
        <i class="fa-solid fa-right-to-bracket"></i>
        <h2>Masuk ke Akun</h2>
        <p>Gunakan kredensial yang telah terdaftar</p>
      </div>

      <?php if ($error): ?>
        <div class="alert alert-error"><i class="fa-solid fa-circle-exclamation"></i> <?= $error ?></div>
      <?php endif; ?>

      <form action="login.php" method="POST" class="auth-form">
        <div class="form-group">
          <label for="email">Alamat Email</label>
          <input type="email" id="email" name="email" required placeholder="nama@email.com">
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required placeholder="Masukkan password">
        </div>

        <div class="form-checkbox">
          <input type="checkbox" id="remember" name="remember">
          <label for="remember">Ingat Saya (Remember Me)</label>
        </div>

        <button type="submit" class="btn-primary">Masuk Sekarang</button>
      </form>

      <div class="auth-footer">
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
      </div>
    </div>
  </main>
</body>
</html>