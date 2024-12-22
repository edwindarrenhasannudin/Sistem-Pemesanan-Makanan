# Proyek Sistem Pemesanan Makanan

Proyek ini merupakan aplikasi web sistem pemesanan makanan yang dibangun  menggunakan **HTML**, **CSS**, **JavaScript**, dan **PHP** untuk mengelola dan menampilkan data pesanan makanan di suatu restoran. Aplikasi ini memungkinkan pengguna untuk melakukan login, melakukan pemesanan makanan, melihat data pesanan, mengelola data pesanan, serta melakukan aksi pengeditan dan penghapusan pesanan.

## Deskripsi Proyek

Aplikasi ini dibangun menggunakan PHP, MySQL, dan CSS untuk antarmuka pengguna. Fungsionalitas utama dari aplikasi ini meliputi:

1. **Login dan autentikasi pengguna** - Pengguna yang sudah login dapat mengakses data pesanan.
2. **Menampilkan data pesanan** - Menampilkan semua data pesanan dalam bentuk tabel yang rapi.
3. **Aksi pengeditan dan penghapusan** - Menyediakan tombol untuk mengedit atau menghapus pesanan.
4. **Logout** - Pengguna dapat logout dari sistem dengan aman.

## Bagian 1: Client-side Programming 

### 1.1 Manipulasi DOM dengan JavaScript 
Pada bagian ini, aplikasi menggunakan JavaScript untuk memanipulasi DOM dan menampilkan data dari server ke dalam tabel HTML.

- **Form Input**: Formulir pemesanan mencakup minimal 4 elemen input, seperti teks, checkbox, dan radio button.
- **Tabel HTML**: Data yang diperoleh dari server ditampilkan dalam tabel HTML menggunakan PHP.

#### Contoh Form Input:
```html
<form>
    <label for="foodName">Nama Makanan</label>
    <input type="text" id="foodName" name="foodName">

    <label for="quantity">Jumlah Porsi</label>
    <input type="number" id="quantity" name="quantity">

    <label for="extras">Opsi Tambahan</label>
    <input type="checkbox" id="extras" name="extras" value="extra">

    <label for="paymentMethod">Metode Pembayaran</label>
    <input type="radio" id="paymentMethod" name="payment" value="credit_card"> Credit Card
    <input type="radio" id="paymentMethod" name="payment" value="cash"> Cash
</form>
```
## 1.2 Event Handling

Aplikasi ini menangani berbagai **event** untuk form input menggunakan **JavaScript**. Berikut adalah jenis-jenis **event** yang diimplementasikan:

### 1.2.1 OnSubmit Event
**OnSubmit Event** digunakan untuk menangani pengiriman form. Event ini akan dipicu ketika pengguna mengirimkan data pada form. Sebelum data dikirimkan, JavaScript akan memvalidasi input untuk memastikan semua data terisi dengan benar.

#### Contoh Implementasi:
```html
<form id="orderForm" onsubmit="return validateForm()">
    <!-- Form elements here -->
    <button type="submit">Kirim</button>
</form>
```
### 1.2.2 OnClick Event
OnClick Event digunakan untuk mengelola interaksi dengan checkbox dan radio button. Event ini akan dipicu ketika pengguna memilih opsi checkbox atau radio button. Hal ini memungkinkan aplikasi untuk menangani perubahan pilihan pengguna.

### Contoh Implementasi:
```html
<input type="checkbox" id="extras" name="extras" value="extra" onclick="handleCheckboxClick()">
```
### 1.2.3 OnChange Event
OnChange Event digunakan untuk menangani perubahan pada input teks dan angka. Setiap kali pengguna mengubah nilai input, event ini akan dipicu, memungkinkan aplikasi untuk segera melakukan validasi atau pembaruan data.

### Contoh Implementasi:
```html
<input type="text" id="foodName" name="foodName" onchange="validateInput()">
```
### 1.2.4 Validasi Form dengan JavaScript
Sebelum data dikirimkan ke server, form akan divalidasi menggunakan JavaScript untuk memastikan semua input memenuhi kriteria yang diperlukan. Validasi mencakup pengecekan apakah semua field yang wajib diisi telah diisi, dan apakah data yang dimasukkan sesuai dengan format yang diharapkan.

### Contoh Validasi:
```
function validateForm() {
    var foodName = document.getElementById("foodName").value;
    var quantity = document.getElementById("quantity").value;

    if (foodName === "" || quantity <= 0) {
        alert("Mohon lengkapi semua input dengan benar.");
        return false; // Mencegah pengiriman form
    }
    return true;
}
```
## 1.3 Form Validation

Formulir akan divalidasi sebelum dikirimkan ke server dengan menggunakan JavaScript untuk memastikan bahwa semua input memenuhi kriteria yang diperlukan. Berikut adalah beberapa jenis validasi yang diterapkan:

### 1.3.1 Pengecekan Input Teks
Pastikan input teks seperti nama makanan tidak kosong sebelum pengiriman form.

### Contoh Validasi Teks:
```
function validateInput() {
    var foodName = document.getElementById("foodName").value;
    if (foodName === "") {
        alert("Nama makanan tidak boleh kosong.");
    }
}
```
### 1.3.2 Pengecekan Input Angka
Jumlah porsi yang dimasukkan harus lebih besar dari 0 untuk validasi angka.

### Contoh Validasi Angka:
```
function validateQuantity() {
    var quantity = document.getElementById("quantity").value;
    if (quantity <= 0) {
        alert("Jumlah porsi harus lebih besar dari 0.");
    }
}
```
### 1.3.3 Pengecekan Pilihan Checkbox dan Radio Button
Jika ada opsi tambahan yang disediakan dalam form, pastikan pengguna memilih setidaknya satu opsi.

### Contoh Validasi Checkbox/Radio:
```
function validateExtras() {
    var extras = document.querySelectorAll('input[name="extras"]:checked');
    if (extras.length === 0) {
        alert("Pilih setidaknya satu opsi tambahan.");
    }
}
```
## Bagian 2: Server-side Programming 
### 2.1 Pengelolaan Data dengan PHP 
Pada bagian ini, data dari formulir diambil menggunakan metode POST dan diproses menggunakan PHP. Data yang diterima termasuk informasi tentang pesanan, jenis browser, dan alamat IP pengguna. Semua data akan disimpan di database.

### Contoh Pengelolaan Data dengan PHP:
```
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $foodName = $_POST['foodName'];
    $quantity = $_POST['quantity'];
    $extras = $_POST['extras'];
    $paymentMethod = $_POST['paymentMethod'];

    // Validasi data dan simpan ke database
    $query = "INSERT INTO orders (food_name, quantity, extras, payment_method, ip_address, user_agent)
              VALUES ('$foodName', '$quantity', '$extras', '$paymentMethod', '$ipAddress', '$userAgent')";
    $conn->query($query);
}
```
### 2.2 Objek PHP Berbasis OOP (10%)
Aplikasi ini menggunakan konsep Object-Oriented Programming (OOP) di PHP dengan membuat kelas Mahasiswa yang memiliki minimal dua metode.

### Contoh Kelas PHP:
```
class PemesananRestoran {
    private $menuCategory; // Kategori menu makanan, misalnya "Makanan Utama", "Makanan Pendamping", atau "Hidangan Penutup". 
    private $foodName; // Nama makanan atau minuman yang dipesan.
    private $quantity; // Jumlah porsi makanan yang dipesan.
    private $extras = []; // Opsi tambahan untuk pesanan, misalnya "Tambah Keju".
    private $payment; // Metode pembayaran, misalnya "Cash" atau "QRIS".

    // Konstruktor untuk inisialisasi objek
    public function __construct($menuCategory, $foodName, $quantity, $payment, $extras = []) {
        $this->menuCategory = $menuCategory; // Inisialisasi kategori menu.
        $this->foodName = $foodName; // Inisialisasi nama makanan.
        $this->quantity = $quantity; // Inisialisasi jumlah porsi.
        $this->payment = $payment; // Inisialisasi metode pembayaran.
        $this->extras = $extras; // Inisialisasi opsi tambahan.
    }

    // Metode untuk menambah pesanan
    public function tambahPesanan() {
        echo "Pesanan berhasil ditambahkan: {$this->foodName}, Kategori: {$this->menuCategory}, Jumlah: {$this->quantity} porsi.<br>";
    }

    // Metode untuk menampilkan detail pesanan
    public function tampilkanPesanan() {
        echo "Detail Pesanan:<br>";
        echo "Kategori: {$this->menuCategory}<br>"; // Menampilkan kategori menu.
        echo "Nama Makanan: {$this->foodName}<br>"; // Menampilkan nama makanan.
        echo "Jumlah Porsi: {$this->quantity}<br>"; // Menampilkan jumlah porsi.
        echo "Opsi Tambahan: " . (count($this->extras) > 0 ? implode(", ", $this->extras) : "Tidak ada") . "<br>"; // Menampilkan opsi tambahan, jika ada.
        echo "Metode Pembayaran: {$this->payment}<br>"; // Menampilkan metode pembayaran.
    }

    // Metode untuk mengubah jumlah porsi
    public function ubahJumlahPorsi($newQuantity) {
        $this->quantity = $newQuantity; // Mengubah jumlah porsi menjadi nilai baru.
        echo "Jumlah porsi untuk {$this->foodName} telah diubah menjadi {$this->quantity} porsi.<br>";
    }

    // Metode untuk mengganti metode pembayaran
    public function gantiMetodePembayaran($newPayment) {
        $this->payment = $newPayment; // Mengubah metode pembayaran menjadi nilai baru. 
        echo "Metode pembayaran telah diganti menjadi {$this->payment}.<br>";
    }

    // Metode untuk menghapus pesanan
    public function hapusPesanan() {
        echo "Pesanan {$this->foodName} telah dihapus.<br>";
        // Reset semua atribut ke default
        $this->foodName = ""; // Mengosongkan nama makanan.
        $this->menuCategory = ""; // Mengosongkan kategori menu.
        $this->quantity = 0; // Mengatur jumlah porsi ke 0.
        $this->extras = []; // Mengosongkan opsi tambahan.
        $this->payment = ""; // Mengosongkan metode pembayaran.
    }
}
```
## Bagian 3: Database Management 
### 3.1 Pembuatan Tabel Database
Pada bagian ini, tabel orders dibuat untuk menyimpan data pesanan pengguna, termasuk nama makanan, jumlah porsi, opsi tambahan, dan lainnya.

### Contoh Struktur Tabel:
```
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    menu_category VARCHAR(255),
    food_name VARCHAR(255),
    quantity INT,
    extras VARCHAR(255),
    payment VARCHAR(50),
    ip_address VARCHAR(50),
    user_agent VARCHAR(255)
);
```
### 3.2 Konfigurasi Koneksi Database 
Koneksi ke database dilakukan dengan menggunakan file db_config.php yang berisi informasi login dan konfigurasi database.

### Contoh Koneksi Database:
```
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistem_pemesanan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
```
### 3.3 Manipulasi Data pada Database 
Data yang dikirim dari form disimpan di database dengan menjalankan query INSERT. Pengguna dapat melakukan operasi lain seperti UPDATE dan DELETE untuk mengelola data pesanan.

## Bagian 4: State Management 
### 4.1 State Management dengan Session
Pengguna yang telah login dapat menyimpan informasi session menggunakan session_start(). Informasi seperti username dan ID pengguna disimpan dalam session untuk digunakan di halaman lain.

### Contoh Pengelolaan Session:
```
session_start();
$_SESSION['username'] = $user;
```
### 4.2 Pengelolaan State dengan Cookie dan Browser Storage 
Aplikasi menggunakan cookie untuk menyimpan preferensi pengguna, dan browser storage untuk menyimpan informasi secara lokal.

### Contoh Cookie dengan JavaScript:
```
// Set Cookie
document.cookie = "userName=JohnDoe; path=/";

// Get Cookie
let cookies = document.cookie;
```
### Contoh Penggunaan Local Storage:
```
// Set item in localStorage
localStorage.setItem("user", "JohnDoe");

// Get item from localStorage
let user = localStorage.getItem("user");
```
```
