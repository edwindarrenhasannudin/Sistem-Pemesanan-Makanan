# Proyek Sistem Pemesanan Makanan

Proyek ini adalah aplikasi untuk mengelola dan menampilkan data pesanan makanan di suatu restoran. Aplikasi ini memungkinkan pengguna untuk melakukan login, melihat data pesanan, serta melakukan aksi pengeditan dan penghapusan pesanan.

## Deskripsi Proyek

Aplikasi ini dibangun menggunakan PHP, MySQL, dan CSS untuk antarmuka pengguna. Fungsionalitas utama dari aplikasi ini meliputi:

1. **Login dan autentikasi pengguna** - Pengguna yang sudah login dapat mengakses data pesanan.
2. **Menampilkan data pesanan** - Menampilkan semua data pesanan dalam bentuk tabel yang rapi.
3. **Aksi pengeditan dan penghapusan** - Menyediakan tombol untuk mengedit atau menghapus pesanan.
4. **Logout** - Pengguna dapat logout dari sistem dengan aman.

## Kriteria Penilaian

Berikut adalah penjelasan untuk setiap bagian kriteria penilaian proyek:

### 1. **Login dan Keamanan**
   - **Deskripsi**: Aplikasi memastikan hanya pengguna yang sudah login yang dapat mengakses data pesanan. Pengguna yang belum login akan diarahkan ke halaman login.
   - **Penjelasan Implementasi**:
     - Penggunaan session untuk menyimpan status login pengguna.
     - Mengecek apakah session `$_SESSION['user']` tersedia. Jika tidak, pengguna akan diarahkan ke halaman login.
     - Proses logout yang menghapus session pengguna untuk memastikan akses aman.

### 2. **Tampilan dan User Interface (UI)**
   - **Deskripsi**: Antarmuka aplikasi dirancang untuk ramah pengguna dan mudah dinavigasi.
   - **Penjelasan Implementasi**:
     - Penggunaan CSS untuk mendesain halaman agar responsif dan mudah dibaca.
     - Penggunaan warna yang kontras (misalnya biru dan putih) untuk tampilan yang bersih dan profesional.
     - Penyusunan elemen-elemen seperti tombol logout dan tabel data dengan margin dan padding yang konsisten untuk pengalaman pengguna yang nyaman.

### 3. **Pengambilan dan Tampilan Data dari Database**
   - **Deskripsi**: Data pesanan diambil dari database MySQL dan ditampilkan dalam tabel.
   - **Penjelasan Implementasi**:
     - Penggunaan query SQL untuk mengambil semua data pesanan dari tabel `orders`.
     - Tabel HTML digunakan untuk menampilkan data dengan informasi seperti ID pesanan, kategori menu, nama makanan, jumlah porsi, dan lainnya.
     - Penggunaan fungsi `htmlspecialchars()` untuk menghindari serangan XSS (Cross-site Scripting) dengan membersihkan output.

### 4. **Pengeditan dan Penghapusan Pesanan**
   - **Deskripsi**: Pengguna dapat mengedit dan menghapus pesanan melalui antarmuka.
   - **Penjelasan Implementasi**:
     - Penggunaan link untuk mengarahkan pengguna ke halaman pengeditan (`edit_order.php`) atau menghapus pesanan dengan konfirmasi.
     - Setiap baris data pesanan dilengkapi dengan dua tombol aksi: edit dan hapus. Tombol hapus memunculkan konfirmasi sebelum menghapus pesanan dari database.

### 5. **Keamanan dan Validasi Input**
   - **Deskripsi**: Aplikasi memastikan input pengguna aman dan valid.
   - **Penjelasan Implementasi**:
     - Penggunaan metode `htmlspecialchars()` untuk mencegah serangan XSS dengan mengonversi karakter spesial menjadi entitas HTML yang aman.
     - Query SQL menggunakan parameter yang aman untuk mencegah SQL Injection.

### 6. **Responsivitas**
   - **Deskripsi**: Halaman aplikasi ini dapat menyesuaikan tampilan di berbagai perangkat (desktop, tablet, dan ponsel).
   - **Penjelasan Implementasi**:
     - Menggunakan `meta` tag untuk mengatur responsivitas halaman pada perangkat mobile.
     - Penggunaan CSS untuk memastikan elemen halaman (seperti tabel dan form) dapat menyesuaikan ukuran layar.

### 7. **Tombol Logout**
   - **Deskripsi**: Pengguna dapat logout dari aplikasi untuk mengakhiri sesi mereka dengan aman.
   - **Penjelasan Implementasi**:
     - Tombol logout mengarahkan pengguna ke file `logout.php`, yang menghapus session dan mengarahkan pengguna kembali ke halaman login.
   
### 8. **Pesan Error dan Notifikasi**
   - **Deskripsi**: Aplikasi memberikan pesan error yang jelas jika terjadi kesalahan.
   - **Penjelasan Implementasi**:
     - Jika terjadi kesalahan dalam menjalankan query atau jika tidak ada data pesanan, aplikasi akan menampilkan pesan kesalahan atau notifikasi yang mudah dimengerti.
     - Penggunaan notifikasi pop-up untuk memberikan umpan balik kepada pengguna saat mereka melakukan aksi seperti menghapus pesanan.

## Teknologi yang Digunakan
- **PHP**: Digunakan untuk logika server-side dan pengolahan data.
- **MySQL**: Digunakan untuk menyimpan data pesanan.
- **CSS**: Digunakan untuk mendesain tampilan dan membuat halaman responsif.
- **HTML**: Digunakan untuk struktur dasar halaman web.

## Instalasi

1. Pastikan Anda memiliki server web dengan PHP dan MySQL (misalnya XAMPP atau LAMP).
2. Clone atau salin file proyek ini ke dalam folder proyek pada server Anda.
3. Buat database MySQL baru dan impor file database yang sesuai untuk membuat tabel `orders`.
4. Konfigurasikan file `db_config.php` dengan informasi koneksi database Anda.
5. Akses aplikasi melalui browser pada `localhost` atau alamat server Anda.

## Lisensi
Proyek ini dilisensikan di bawah [MIT License](LICENSE).

