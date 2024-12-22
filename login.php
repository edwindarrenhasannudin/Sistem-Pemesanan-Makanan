<?php
session_start(); // Memulai session untuk menyimpan data pengguna setelah login 

// Contoh simulasi login pengguna
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Mengecek apakah form dikirim melalui metode POST 
    $username = $_POST['username']; // Mengambil input username dari form
    $password = $_POST['password']; // Mengambil input password dari form

    // Validasi login sederhana (ganti dengan logika database)
    if ($username === 'admin' && $password === '12345') { // Membandingkan input dengan kredensial statis 
        // Simpan informasi pengguna ke session
        $_SESSION['user'] = [
            'username' => $username, // Menyimpan username ke session
            'role' => 'Administrator' // Menambahkan peran (role) pengguna 
        ];

        // Redirect ke halaman utama
        header("Location: view_orders.php"); // Mengarahkan pengguna ke halaman `view_orders.php` setelah berhasil login 
        exit(); // Menghentikan eksekusi script setelah redirect
    } else {
        $error_message = "Username atau password salah!"; // Menyimpan pesan error jika login gagal
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Menentukan karakter encoding dokumen menjadi UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur tampilan agar responsif pada perangkat mobile -->
    <title>Login</title> <!-- Judul halaman -->
    <link rel="stylesheet" href="styles.css"> <!-- Menghubungkan file CSS eksternal --> 
</head>
<body>
    <div class="title-box">
        <h1>Login Form Pesan Makanan</h1> <!-- Menampilkan judul utama halaman --> 
    </div>
    <!-- Menampilkan pesan error dengan warna teks merah jika login gagal. -->
    <?php if (isset($error_message)) { echo "<p style='color: red;'>$error_message</p>"; } ?> 
    <div class="container">
        <div class="left-images">
            <!-- Menampilkan gambar di sisi kiri -->
            <img src="assets/Mie-Ayam-Bakso.jpeg" alt="Gambar Kiri 1" class="img-left">
            <img src="assets/Ayam-Goreng.jpg" alt="Gambar Kiri 2" class="img-left">
        </div>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label> <!-- Label untuk input username -->
                <input type="text" id="username" name="username" required> <!-- Input teks untuk username -->
            </div>
            <div class="form-group">
                <label for="password">Password:</label> <!-- Label untuk input password -->
                <input type="password" id="password" name="password" required> <!-- Input teks untuk password -->
            </div>
            <button type="submit">Login</button> <!-- Tombol untuk mengirimkan form -->
            <!-- Tombol Kembali -->
            <a href="index.php" class="btn-back">Kembali</a> <!-- Link untuk kembali ke halaman utama -->
        </form>
        <div class="right-images">
                <!-- Menampilkan gambar di sisi kanan -->
                <img src="assets/Nasi-Goreng.jpg" alt="Gambar Kanan 1" class="img-right">
                <img src="assets/Sate-Ayam.jpeg" alt="Gambar Kanan 2" class="img-right">
        </div>
    </div>
</body>
</html>
