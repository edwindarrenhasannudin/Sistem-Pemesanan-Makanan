<?php
include 'db_config.php'; // Mengimpor file konfigurasi database yang berisi koneksi ke database. 

// Menangani input dari formulir
$menuCategory = isset($_POST['menuCategory']) ? $_POST['menuCategory'] : null; // Mengambil input kategori menu dari formulir, default null jika tidak ada.
$foodName = isset($_POST['foodName']) ? $_POST['foodName'] : null; // Mengambil input nama makanan dari formulir.
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : null; // Mengambil input jumlah porsi, dikonversi menjadi integer.
$payment = isset($_POST['payment']) ? $_POST['payment'] : null; // Mengambil input metode pembayaran dari formulir.
$extras = isset($_POST['extras']) ? implode(", ", $_POST['extras']) : null; // Menggabungkan input opsi tambahan menjadi string dengan pemisah koma.

// Validasi data
if (empty($menuCategory) || empty($foodName) || empty($quantity) || empty($payment)) {
    header("Location: index.php?status=error&message=Mohon+lengkapi+semua+data!"); // Redirect ke halaman utama dengan pesan error jika ada data yang kosong.
    exit; // Menghentikan eksekusi script.
}

// Ambil informasi pengguna (IP dan Browser)
$ip_address = $_SERVER['REMOTE_ADDR']; // Mendapatkan alamat IP pengguna.
$user_agent = $_SERVER['HTTP_USER_AGENT']; // Mendapatkan informasi browser pengguna. 

// Menyimpan data ke dalam database
$sql = "INSERT INTO orders (menu_category, food_name, quantity, extras, payment, ip_address, user_agent)
        VALUES (?, ?, ?, ?, ?, ?, ?)"; // Query SQL untuk menyimpan data pesanan ke tabel `orders`.

$stmt = $conn->prepare($sql); // Mempersiapkan statement untuk mencegah SQL Injection. 
$stmt->bind_param("ssissss", $menuCategory, $foodName, $quantity, $extras, $payment, $ip_address, $user_agent); // Menghubungkan data ke parameter query (s untuk string, i untuk integer).

// Eksekusi query
if ($stmt->execute()) {
    header("Location: index.php?status=success&message=Pesanan+Anda+berhasil+diproses!"); // Redirect jika eksekusi berhasil.
} else {
    $error_message = "Terjadi+kesalahan:+" . urlencode($stmt->error); // Menyimpan pesan error.
    header("Location: index.php?status=error&message=$error_message"); // Redirect jika eksekusi gagal.
}

$stmt->close(); // Menutup statement untuk melepaskan sumber daya.
$conn->close(); // Menutup koneksi ke database.
?>
