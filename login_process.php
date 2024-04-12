<?php
// Proses validasi login
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Anda dapat memeriksa kredensial pengguna di sini (misalnya, dengan database)
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Contoh validasi sederhana, jika username dan password adalah 'admin'
    if($username === 'admin123' && $password === 'admin123') {
	// Jika login berhasil, set session dan alihkan ke index.php
        session_start();
        $_SESSION["loggedin"] = true;
        header("Location: index.php");
        exit();
    } else {
        // Jika login gagal, kembali ke halaman login dengan pesan error
        $error = "Username atau password salah.";
        header("Location: login.php?error=" . urlencode($error));
        exit();
    }
} else {
    // Jika pengguna mencoba mengakses langsung login_process.php, kembali ke halaman login
    header("Location: login.php");
    exit();
}
?>

