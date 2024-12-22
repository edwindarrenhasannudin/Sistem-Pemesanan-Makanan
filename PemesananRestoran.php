<?php
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
?>
