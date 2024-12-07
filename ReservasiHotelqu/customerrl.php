<?php
session_start();

if (!isset($_SESSION['userID'])) {
    // Redirect jika pengguna tidak login
    header("Location: login.php");
    exit();
}

// Tampilkan pesan selamat datang
echo "Selamat datang, " . htmlspecialchars($_SESSION['namaLengkap']) . "!";
?>