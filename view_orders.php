<?php
session_start(); // Memulai session untuk melacak status login pengguna

// Periksa apakah pengguna sudah login, jika tidak, arahkan ke halaman login
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Arahkan pengguna ke halaman login
    exit(); // Hentikan eksekusi script lebih lanjut jika belum login
}

// Ambil data pengguna dari session
$user = $_SESSION['user']; // Mengambil data pengguna yang telah disimpan dalam session
?>

<!DOCTYPE html>
<html lang="id"> <!-- Menentukan bahasa halaman -->
<head>
    <meta charset="UTF-8"> <!-- Menentukan karakter encoding halaman -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur tampilan responsif untuk perangkat mobile -->
    <title>Data Pesanan</title> <!-- Judul halaman -->
    <!-- Menyertakan file CSS untuk styling halaman -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="title-box">
        <!-- Menampilkan pesan selamat datang kepada pengguna -->
        <h1>Selamat Datang, <?php echo htmlspecialchars($user['username']); ?>!</h1>
    </div>
    
    <div class="container">
        <h1>Data Pesanan</h1>
        
        <?php
        // Menyertakan file koneksi database
        include 'db_config.php';

        // Menjalankan query untuk mengambil semua pesanan dari database
        $query = "SELECT * FROM orders";
        $result = $conn->query($query); // Eksekusi query dan simpan hasilnya dalam variabel $result

        // Pastikan query berhasil dijalankan
        if ($result === false) {
            // Menampilkan pesan kesalahan jika query gagal dijalankan
            echo "<p>Terjadi kesalahan pada query: " . $conn->error . "</p>";
        } else {
            // Jika ada hasil (pesanan ditemukan)
            if ($result->num_rows > 0) {
                // Menampilkan tabel untuk data pesanan
                echo "<table>";
                echo "<thead>";
                // Menampilkan header tabel
                echo "<tr>
                        <th>ID Pesanan</th>
                        <th>Kategori</th>
                        <th>Nama Makanan</th>
                        <th>Jumlah Porsi</th>
                        <th>Opsi Tambahan</th>
                        <th>Metode Pembayaran</th>
                        <th>IP Address</th>
                        <th>Jenis Browser</th>
                        <th>Aksi</th>
                      </tr>";
                echo "</thead>";
                echo "<tbody>";
                
                // Menampilkan setiap baris data pesanan dalam tabel
                while ($row = $result->fetch_assoc()) {
                    // Menampilkan data pesanan dalam tabel
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["menu_category"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["food_name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["quantity"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["extras"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["payment"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["ip_address"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["user_agent"]) . "</td>";
                    // Menampilkan tombol aksi untuk mengedit dan menghapus pesanan
                    echo "<td>
                            <a href='edit_order.php?id=" . htmlspecialchars($row["id"]) . "' class='btn-edit'>📝​​</a> |
                            <a href='delete_order.php?id=" . htmlspecialchars($row["id"]) . "' class='btn-delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pesanan ini?\")'>🗑️</a>
                          </td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                // Jika tidak ada data pesanan yang ditemukan
                echo "<p class='no-results'>Data pesanan tidak ditemukan.</p>";
            }
        }
        ?>

        <!-- Tombol Logout untuk keluar dari sistem -->
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</body>
</html>
