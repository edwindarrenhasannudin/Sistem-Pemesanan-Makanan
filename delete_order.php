<?php
// Memulai sesi untuk melacak pengguna yang login
session_start();

// Memeriksa apakah pengguna sudah login dengan mengecek sesi 'user'
if (!isset($_SESSION['user'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: login.php");
    exit(); // Menghentikan eksekusi script setelah redirect
}

// Memeriksa apakah parameter 'id' ada di URL
if (!isset($_GET['id'])) {
    // Jika 'id' tidak ditemukan, tampilkan pesan error dan hentikan eksekusi
    echo "Pesanan tidak ditemukan!";
    exit();
}

// Mengambil nilai 'id' dari parameter URL
$id = $_GET['id'];

// Menyertakan file konfigurasi database untuk koneksi
include 'db_config.php';

// Membuat query SQL untuk menghapus data pesanan berdasarkan ID
$query = "DELETE FROM orders WHERE id = ?";
$stmt = $conn->prepare($query); // Menyiapkan pernyataan SQL
$stmt->bind_param("i", $id); // Mengikat parameter ID ke query, 'i' menandakan tipe data integer
$stmt->execute(); // Menjalankan pernyataan SQL

// Setelah penghapusan, redirect ke halaman daftar pesanan
header("Location: view_orders.php");
exit(); // Menghentikan eksekusi script setelah redirect
?>
