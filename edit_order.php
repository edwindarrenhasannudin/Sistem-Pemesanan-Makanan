<?php
// Memulai sesi untuk melacak pengguna yang login
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: login.php");
    exit(); // Menghentikan eksekusi script
}

// Memeriksa apakah parameter 'id' ada di URL
if (!isset($_GET['id'])) {
    // Jika 'id' tidak ditemukan, tampilkan pesan error dan hentikan eksekusi
    echo "Pesanan tidak ditemukan!";
    exit();
}

// Mengambil nilai 'id' dari parameter URL
$id = $_GET['id'];

// Menyertakan file konfigurasi database untuk membuat koneksi
include 'db_config.php';

// Membuat query untuk mengambil data pesanan berdasarkan ID
$query = "SELECT * FROM orders WHERE id = ?";
$stmt = $conn->prepare($query); // Menyiapkan pernyataan SQL
$stmt->bind_param("i", $id); // Mengikat parameter ID ke query
$stmt->execute(); // Menjalankan pernyataan SQL
$result = $stmt->get_result(); // Mendapatkan hasil dari query

// Memeriksa apakah data pesanan ditemukan
if ($result->num_rows === 0) {
    echo "Pesanan tidak ditemukan!";
    exit();
}

// Mengambil data pesanan sebagai array asosiatif
$order = $result->fetch_assoc();

// Memeriksa apakah form telah dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari input form
    $menuCategory = $_POST['menuCategory'];
    $foodName = $_POST['foodName'];
    $quantity = $_POST['quantity'];
    $extras = implode(",", $_POST['extras']); // Menggabungkan opsi tambahan menjadi string
    $payment = $_POST['payment'];

    // Membuat query untuk memperbarui data pesanan
    $updateQuery = "UPDATE orders SET menu_category = ?, food_name = ?, quantity = ?, extras = ?, payment = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery); // Menyiapkan pernyataan SQL
    $stmt->bind_param("ssisss", $menuCategory, $foodName, $quantity, $extras, $payment, $id); // Mengikat parameter ke query
    $stmt->execute(); // Menjalankan pernyataan SQL

    // Setelah data diperbarui, redirect ke halaman daftar pesanan
    header("Location: view_orders.php");
    exit(); // Menghentikan eksekusi script
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Metadata untuk karakter encoding dan pengaturan responsive -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan</title>
    <!-- Menyertakan file CSS untuk styling -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Kotak judul -->
    <div class="title-box">
        <h1>Edit Pesanan</h1>
    </div>
    
    <!-- Kontainer form -->
    <div class="container">
        <form method="POST" action="">
            <!-- Input kategori makanan -->
            <div class="form-group">
                <label for="menuCategory">Kategori Makanan:</label>
                <select id="menuCategory" name="menuCategory" required>
                    <!-- Menampilkan opsi dengan nilai yang sudah dipilih -->
                    <option value="Makanan Utama" <?php echo $order['menu_category'] === 'Makanan Utama' ? 'selected' : ''; ?>>Makanan Utama</option>
                    <option value="Makanan Pendamping" <?php echo $order['menu_category'] === 'Makanan Pendamping' ? 'selected' : ''; ?>>Makanan Pendamping</option>
                    <option value="Hidangan Penutup" <?php echo $order['menu_category'] === 'Hidangan Penutup' ? 'selected' : ''; ?>>Hidangan Penutup</option>
                </select>
            </div>
            <!-- Input nama makanan -->
            <div class="form-group">
                <label for="foodName">Nama Makanan:</label>
                <select id="foodName" name="foodName" required>
                    <!-- Menampilkan opsi makanan yang sudah dipilih -->
                    <option value="Nasi Goreng" <?php echo $order['food_name'] === 'Nasi Goreng' ? 'selected' : ''; ?>>Nasi Goreng</option>
                    <option value="Mie Ayam" <?php echo $order['food_name'] === 'Mie Ayam' ? 'selected' : ''; ?>>Mie Ayam</option>
                    <option value="Sate Ayam" <?php echo $order['food_name'] === 'Sate Ayam' ? 'selected' : ''; ?>>Sate Ayam</option>
                    <option value="Bakso" <?php echo $order['food_name'] === 'Bakso' ? 'selected' : ''; ?>>Bakso</option>
                    <option value="Ayam Goreng" <?php echo $order['food_name'] === 'Ayam Goreng' ? 'selected' : ''; ?>>Ayam Goreng</option>
                </select>
            </div>
            <!-- Input jumlah porsi -->
            <div class="form-group">
                <label for="quantity">Jumlah Porsi:</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($order['quantity']); ?>" required>
            </div>
            <!-- Input opsi tambahan -->
            <div class="form-group">
                <label for="extras">Opsi Tambahan:</label>
                <!-- Menampilkan opsi tambahan yang sudah dipilih -->
                <input type="checkbox" name="extras[]" value="Telur" <?php echo in_array('Telur', explode(',', $order['extras'])) ? 'checked' : ''; ?>> Telur
                <input type="checkbox" name="extras[]" value="Kerupuk" <?php echo in_array('Kerupuk', explode(',', $order['extras'])) ? 'checked' : ''; ?>> Kerupuk
                <input type="checkbox" name="extras[]" value="Keju" <?php echo in_array('Keju', explode(',', $order['extras'])) ? 'checked' : ''; ?>> Keju
            </div>
            <!-- Input metode pembayaran -->
            <div class="form-group">
                <label for="payment">Metode Pembayaran:</label>
                <select id="payment" name="payment" required>
                    <!-- Menampilkan opsi pembayaran yang sudah dipilih -->
                    <option value="Cash" <?php echo $order['payment'] === 'Cash' ? 'selected' : ''; ?>>Cash</option>
                    <option value="QRIS" <?php echo $order['payment'] === 'QRIS' ? 'selected' : ''; ?>>QRIS</option>
                </select>
            </div>
            <!-- Tombol submit -->
            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
