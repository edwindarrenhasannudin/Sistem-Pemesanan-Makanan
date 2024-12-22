<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Menentukan karakter encoding dokumen menjadi UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur tampilan agar responsif pada perangkat mobile -->
    <title>Form Pemesanan Restoran</title> <!-- Judul halaman -->
    <link rel="stylesheet" href="styles.css"> <!-- Menghubungkan file CSS eksternal -->
</head>
<body>
    <div class="title-box">
        <h1>Form Pemesanan Makanan</h1> <!-- Menampilkan judul utama halaman --> 
    </div>
    <div class="container">
        <div class="left-images">
            <!-- Menampilkan gambar di sisi kiri -->
            <img src="assets/Nasi-Goreng.jpg" alt="Gambar Kiri 1" class="img-left">
            <img src="assets/Sate-Ayam.jpeg" alt="Gambar Kiri 2" class="img-left">
        </div>
        <script>
        // Fungsi untuk mendapatkan parameter dari URL
        function getUrlParameter(name) {
            name = name.replace(/[[]/, "\\[").replace(/[\]]/, "\\]");
            const regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
            const results = regex.exec(location.search);
            return results === null ? null : decodeURIComponent(results[1].replace(/\+/g, " "));
        }

        // Cek apakah ada status dan message di URL
        const status = getUrlParameter('status');
        const message = getUrlParameter('message');

        if (status && message) {
            // Menampilkan pop-up jika parameter ditemukan
            alert(`${status === 'success' ? 'Berhasil' : 'Gagal'}: ${message}`);
        }
        </script>

        <form id="orderForm" method="POST" action="process_order.php">
             <!-- Form untuk mengirim pesanan -->
            <div class="form-group">
                <label for="menuCategory">Pilih Kategori Makanan:</label>
                <select id="menuCategory" name="menuCategory">
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Makanan Utama">Makanan Utama</option>
                    <option value="Makanan Pendamping">Makanan Pendamping</option>
                    <option value="Hidangan Penutup">Hidangan Penutup</option>
                </select>
            </div>
            <div class="form-group">
                <label for="foodName">Nama Makanan:</label>
                <select id="foodName" name="foodName">
                    <option value="" disabled selected>Pilih Makanan</option>
                    <option value="Nasi Goreng">Nasi Goreng</option>
                    <option value="Mie Ayam">Mie Ayam</option>
                    <option value="Sate Ayam">Sate Ayam</option>
                    <option value="Bakso">Bakso</option>
                    <option value="Ayam Goreng">Ayam Goreng</option>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Jumlah Porsi:</label>
                <input type="number" id="quantity" name="quantity" min="1">
            </div>

            <div class="form-group">
                <label>Opsi Tambahan:</label>
                <div class="checkbox-group">
                    <input type="checkbox" id="extra1" name="extras[]" value="Telur">
                    <label for="extra1">Telur</label>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="extra2" name="extras[]" value="Kerupuk">
                    <label for="extra2">Kerupuk</label>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="extra3" name="extras[]" value="Keju">
                    <label for="extra3">Keju</label>
                </div>
            </div>        

            <div class="form-group">
                <label>Metode Pembayaran:</label>
                <div class="radio-group">
                    <input type="radio" id="cash" name="payment" value="Cash">
                    <label for="cash">Cash</label>
                </div>
                <div class="radio-group">
                    <input type="radio" id="QRIS" name="payment" value="QRIS">
                    <label for="QRIS">QRIS</label>
                </div>
            </div>

            <button type="submit">Pesan</button> <!-- Tombol submit untuk mengirim data form --> 
            <!-- Tombol Admin -->
            <a href="login.php" class="btn-back">Admin</a> <!-- Link menuju halaman login admin --> 
        </form>
        <div class="right-images">
            <!-- Menampilkan gambar di sisi kanan -->
            <img src="assets/Mie-Ayam-Bakso.jpeg" alt="Gambar Kanan 1" class="img-right">
            <img src="assets/Ayam-Goreng.jpg" alt="Gambar Kanan 2" class="img-right">
        </div>
        <!-- Menampilkan pop-up jika parameter ditemukan -->
        <div id="notification" class="notification" style="display: none;"></div>
    </div>
</body>
</html>

<br>

<?php
// Menyertakan file yang berisi kelas PemesananRestoran
include 'PemesananRestoran.php';

// Membuat objek dari kelas PemesananRestoran
$pesanan1 = new PemesananRestoran("Makanan Utama", "Nasi Goreng", 2, "Cash", ["Telur", "Kerupuk"]);
$pesanan2 = new PemesananRestoran("Hidangan Penutup", "Bakso", 3, "QRIS", ["Keju"]);

// Menambah dan menampilkan pesanan
$pesanan1->tambahPesanan(); // Menambahkan pesanan ke sistem
$pesanan1->tampilkanPesanan(); // Menampilkan detail pesanan

echo "<hr>"; // Membuat garis horizontal untuk pemisahan

// Menambahkan pesanan kedua dan menampilkannya
$pesanan2->tambahPesanan();
$pesanan2->tampilkanPesanan();

// Mengubah jumlah porsi dan menampilkan kembali
$pesanan1->ubahJumlahPorsi(4); // Mengupdate jumlah porsi
$pesanan1->tampilkanPesanan(); // Menampilkan detail pesanan yang diperbarui

echo "<hr>"; // Membuat garis horizontal untuk pemisahan

// Mengganti metode pembayaran dan menampilkan kembali
$pesanan2->gantiMetodePembayaran("Cash");
$pesanan2->tampilkanPesanan();

echo "<hr>"; // Membuat garis horizontal untuk pemisahan

// Menghapus pesanan dan mencoba menampilkannya
$pesanan1->hapusPesanan();
$pesanan1->tampilkanPesanan();
?>
