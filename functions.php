<?php
// Selalu mulai session di awal
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

const USERS_FILE = __DIR__ . '/users.json';

/**
 * Membaca seluruh data user dari file JSON
 */
function getUsers(): array {
    if (!file_exists(USERS_FILE)) {
        file_put_contents(USERS_FILE, json_encode([]));
    }
    $content = file_get_contents(USERS_FILE);
    $data = json_decode($content, true);
    return is_array($data) ? $data : [];
}

/**
 * Menyimpan data user ke file JSON secara aman
 */
function saveUsers(array $users): bool {
    $jsonContent = json_encode($users, JSON_PRETTY_PRINT);
    return file_put_contents(USERS_FILE, $jsonContent) !== false;
}

/**
 * Sanitasi Input untuk Mencegah XSS (Kriteria Rubrik)
 */
function sanitizeInput(string $data): string {
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

/**
 * Mencari user berdasarkan Email (Cek Duplikasi)
 */
function findUserByEmail(string $email): ?array {
    $users = getUsers();
    foreach ($users as $user) {
        if (strtolower($user['email']) === strtolower($email)) {
            return $user;
        }
    }
    return null;
}

/**
 * Memeriksa status login user (Session Protection)
 */
function checkAuth(): void {
    // Cek Cookie "Remember Me" jika Session kosong
    if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_user'])) {
        $user = findUserByEmail($_COOKIE['remember_user']);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
        }
    }

    // Jika belum login, lempar ke login.php
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }
}