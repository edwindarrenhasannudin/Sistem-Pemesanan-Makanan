<?php
// Menentukan nama host untuk server database
$host = "localhost"; 

// Menentukan username untuk akses ke database
$username = "root";  

// Menentukan password untuk akses ke database (kosong dalam hal ini)
$password = "";      

// Menentukan nama database yang akan digunakan
$dbname = "restaurant"; 

// Membuat koneksi ke database menggunakan objek mysqli
$conn = new mysqli($host, $username, $password, $dbname);

// Mengecek apakah koneksi berhasil
if ($conn->connect_error) {
    // Jika koneksi gagal, tampilkan pesan error dan hentikan eksekusi
    die("Koneksi gagal: " . $conn->connect_error);
}

// Jika koneksi berhasil, kode akan lanjut ke sini
?>
