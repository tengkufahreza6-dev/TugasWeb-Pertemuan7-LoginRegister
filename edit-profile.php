<?php
require_once 'functions.php';
checkAuth();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName  = sanitizeInput($_POST['name'] ?? '');
    $newPass  = $_POST['password'] ?? '';

    if (empty($newName)) {
        $error = 'Nama tidak boleh kosong!';
    } else {
        $users = getUsers();
        $updated = false;

        foreach ($users as &$user) {
            if ($user['id'] === $_SESSION['user_id']) {
                $user['name'] = $newName;
                $_SESSION['user_name'] = $newName;

                // Update password jika diisi
                if (!empty($newPass)) {
                    if (strlen($newPass) < 6) {
                        $error = 'Password baru minimal 6 karakter!';
                        break;
                    }
                    $user['password'] = password_hash($newPass, PASSWORD_DEFAULT);
                }

                $updated = true;
                break;
            }
        }

        if ($updated && empty($error)) {
            if (saveUsers($users)) {
                $success = 'Profil berhasil diperbarui!';
            } else {
                $error = 'Gagal menyimpan perubahan.';
            }
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
  <title>Edit Profil — TR 7</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <main class="auth-wrapper">
    <div class="auth-card">
      <div class="auth-header">
        <i class="fa-solid fa-user-pen"></i>
        <h2>Edit Profil</h2>
        <p>Perbarui informasi nama atau password kamu</p>
      </div>

      <?php if ($error): ?>
        <div class="alert alert-error"><i class="fa-solid fa-circle-exclamation"></i> <?= $error ?></div>
      <?php endif; ?>

      <?php if ($success): ?>
        <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> <?= $success ?></div>
      <?php endif; ?>

      <form action="edit-profile.php" method="POST" class="auth-form">
        <div class="form-group">
          <label for="name">Nama Lengkap</label>
          <input type="text" id="name" name="name" required value="<?= $_SESSION['user_name'] ?>">
        </div>

        <div class="form-group">
          <label for="email">Alamat Email (Tidak dapat diubah)</label>
          <input type="email" id="email" value="<?= $_SESSION['user_email'] ?>" disabled>
        </div>

        <div class="form-group">
          <label for="password">Password Baru (Kosongkan jika tidak ingin diubah)</label>
          <input type="password" id="password" name="password" placeholder="Minimal 6 karakter">
        </div>

        <button type="submit" class="btn-primary">Simpan Perubahan</button>
      </form>

      <div class="auth-footer">
        <p><a href="dashboard.php"><i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard</a></p>
      </div>
    </div>
  </main>
</body>
</html>