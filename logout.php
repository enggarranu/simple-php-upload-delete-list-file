<?php
// Mulai session
session_start();

// Hapus semua variabel session
$_SESSION = array();

// Hapus session cookie
if(isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 86400, '/');
}

// Hancurkan session
session_destroy();

// Arahkan pengguna kembali ke halaman login
header("location: login.php");
exit;
?>
