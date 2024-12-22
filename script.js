document.addEventListener("DOMContentLoaded", () => {
    // Menunggu hingga seluruh halaman selesai dimuat sebelum mengeksekusi kode
    const form = document.getElementById("orderForm"); // Mendapatkan elemen formulir untuk pesanan.
    const tableBody = document.getElementById("orderTable").     querySelector("tbody"); // Mendapatkan bagian tubuh tabel untuk menampilkan data pesanan.
    const notification = document.getElementById("notification"); // Menangkap elemen notifikasi untuk menunjukkan pesan ke pengguna.

    // Simulasi data awal dari server
    const serverData = [
        { menuCategory: "Makanan Utama", foodName: "Nasi Goreng", quantity: 2, extras: ["Telur"], payment: "Cash" },
        { menuCategory: "Makanan Pendamping", foodName: "Sate Ayam", quantity: 1, extras: ["Kerupuk", "Keju"], payment: "QRIS" },
    ];

    // Fungsi untuk menampilkan data ke tabel
    function populateTable(data) {
        tableBody.innerHTML = ""; // Reset tabel sebelum menampilkan data baru
        data.forEach((item, index) => {
            // Untuk setiap item dalam data, buat baris baru di tabel
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${item.menuCategory}</td>
                <td>${item.foodName}</td>
                <td>${item.quantity}</td>
                <td>${item.extras.join(", ") || "Tidak Ada"}</td>
                <td>${item.payment}</td>
                <td>
                    <button class="edit-btn" data-index="${index}">Edit</button>
                    <button class="delete-btn" data-index="${index}">Hapus</button>
                </td>
            `;
            tableBody.appendChild(row); // Tambahkan baris ke tabel
        });

        // Tambahkan event listener untuk tombol edit dan hapus
        document.querySelectorAll(".edit-btn").forEach((button) => {
            button.addEventListener("click", handleEdit);
        });
        document.querySelectorAll(".delete-btn").forEach((button) => {
            button.addEventListener("click", handleDelete);
        });
    }

    // Tampilkan data awal dari server
    populateTable(serverData); // Menampilkan data awal yang sudah didefinisikan 

    // Fungsi untuk menampilkan notifikasi dengan animasi
    function showNotification(message, type = "success") {
        notification.textContent = message; // Set pesan notifikasi
        notification.className = `notification ${type}`; // Tentukan kelas CSS untuk jenis notifikasi (success/error)
        notification.style.display = "block"; // Menampilkan notifikasi

        // Menambahkan kelas show untuk animasi
        setTimeout(() => {
            notification.classList.add("show");
        }, 10);

        // Menghilangkan notifikasi setelah beberapa detik
        setTimeout(() => {
            notification.classList.remove("show");
            setTimeout(() => {
                notification.style.display = "none";
            }, 500); // Waktu untuk animasi hilang
        }, 3000); // Durasi tampilan notifikasi
    }

    // Tangani perubahan kategori menu
    const categorySelect = form.menuCategory;
    categorySelect.addEventListener("change", () => {
        if (!categorySelect.value) {
            showNotification("Kategori menu harus dipilih!", "error");
        }
    });

    // Tangani pengiriman formulir
    form.addEventListener("submit", (event) => {
        event.preventDefault(); // Mencegah pengiriman formulir secara default

        // Ambil data dari form
        const formData = new FormData(form);
        const menuCategory = formData.get("menuCategory");
        const foodName = formData.get("foodName");
        const quantity = parseInt(formData.get("quantity"), 10);
        const payment = formData.get("payment");
        const extras = [];
        form.querySelectorAll("input[name='extras']:checked").forEach((checkbox) => {
            extras.push(checkbox.value); // Ambil data opsi tambahan yang dipilih 
        });

        // Validasi data yang dimasukkan
        if (!menuCategory || !foodName || quantity < 1 || !payment) {
            showNotification("Mohon isi semua field dengan benar!", "error");
            return;
        }

        // Tambah data baru ke tabel dan array serverData
        const newData = { menuCategory, foodName, quantity, extras, payment };
        serverData.push(newData); // Simpan ke array
        populateTable(serverData); // Perbarui tabel

        showNotification("Pesanan berhasil ditambahkan!"); // Tampilkan notifikasi 

        // Reset formulir setelah pengiriman
        form.reset();
    });

    // Fungsi untuk menangani edit data
    function handleEdit(event) {
        const index = event.target.dataset.index; // Ambil index dari tombol edit 
        const item = serverData[index]; // Ambil item yang akan diedit

        // Isi form dengan data yang akan diedit
        form.menuCategory.value = item.menuCategory;
        form.foodName.value = item.foodName;
        form.quantity.value = item.quantity;
        form.payment.value = item.payment;
        form.querySelectorAll("input[name='extras']").forEach((checkbox) => {
            checkbox.checked = item.extras.includes(checkbox.value);
        });

        // Hapus data lama
        serverData.splice(index, 1);
        populateTable(serverData); // Perbarui tabel

        showNotification("Silakan edit pesanan dan klik submit.", "info");
    }

    // Fungsi untuk menangani hapus data
    function handleDelete(event) {
        const index = event.target.dataset.index; // Ambil index dari tombol hapus 

        // Konfirmasi penghapusan
        if (confirm("Apakah Anda yakin ingin menghapus pesanan ini?")) {
            serverData.splice(index, 1); // Hapus dari array
            populateTable(serverData); // Perbarui tabel
            showNotification("Pesanan berhasil dihapus!"); // Tampilkan notifikasi
        }
    }

    // Fungsi untuk menetapkan cookie
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); // Set expired time
        document.cookie = `${name}=${encodeURIComponent(value)}; expires=${date.toUTCString()}; path=/`;
    }

    // Fungsi untuk mendapatkan nilai cookie
    function getCookie(name) {
        const cookies = document.cookie.split("; ");
        for (let cookie of cookies) {
            const [key, value] = cookie.split("=");
            if (key === name) return decodeURIComponent(value);
        }
        return null;
    }

    // Fungsi untuk menghapus cookie
    function deleteCookie(name) {
        setCookie(name, "", -1); // Set expired time ke masa lalu
    }

    // Fungsi untuk menyimpan data ke localStorage
    function setLocalStorage(key, value) {
        localStorage.setItem(key, JSON.stringify(value)); // Simpan data ke localStorage 
    }

    // Fungsi untuk mendapatkan data dari localStorage
    function getLocalStorage(key) {
        const value = localStorage.getItem(key);
        return value ? JSON.parse(value) : null; // Ambil data dari localStorage 
    }

    // Fungsi untuk menghapus data dari localStorage
    function removeLocalStorage(key) {
        localStorage.removeItem(key); // Hapus data dari localStorage
    }

    // Fungsi untuk menyimpan data ke sessionStorage
    function setSessionStorage(key, value) {
        sessionStorage.setItem(key, JSON.stringify(value)); // Simpan data ke sessionStorage 
    }

    // Fungsi untuk mendapatkan data dari sessionStorage
    function getSessionStorage(key) {
        const value = sessionStorage.getItem(key);
        return value ? JSON.parse(value) : null; // Ambil data dari sessionStorage
    }

    // Fungsi untuk menghapus data dari sessionStorage
    function removeSessionStorage(key) {
        sessionStorage.removeItem(key); // Hapus data dari sessionStorage
    }

    form.addEventListener("submit", (event) => {
        event.preventDefault();
    
        const formData = new FormData(form);
        const menuCategory = formData.get("menuCategory");
        const foodName = formData.get("foodName");
        const quantity = parseInt(formData.get("quantity"), 10);
        const payment = formData.get("payment");
        const extras = [];
        form.querySelectorAll("input[name='extras']:checked").forEach((checkbox) => {
            extras.push(checkbox.value);
        });
    
        if (!menuCategory || !foodName || quantity < 1 || !payment) {
            showNotification("Mohon isi semua field dengan benar!", "error");
            return;
        }
    
        const newData = { menuCategory, foodName, quantity, extras, payment };
    
        // Simpan data ke cookie
        setCookie(`order_${Date.now()}`, JSON.stringify(newData), 7); // Expire 7 hari
    
        // Simpan data ke localStorage
        const orders = getLocalStorage("orders") || [];
        orders.push(newData);
        setLocalStorage("orders", orders);
    
        // Update tabel
        serverData.push(newData); // Simpan ke array
        populateTable(serverData); // Perbarui tabel
    
        showNotification("Pesanan berhasil ditambahkan!");
        form.reset();
    });

    document.addEventListener("DOMContentLoaded", () => {
        // Ambil data dari localStorage
        const storedOrders = getLocalStorage("orders");
        if (storedOrders) {
            serverData.push(...storedOrders);
        }
    
        // Tampilkan data di tabel
        populateTable(serverData);
    });
    
    function handleDelete(event) {
        const index = event.target.dataset.index;
    
        if (confirm("Apakah Anda yakin ingin menghapus pesanan ini?")) {
            const order = serverData[index];
    
            // Hapus dari localStorage
            const orders = getLocalStorage("orders") || [];
            const updatedOrders = orders.filter((o) => JSON.stringify(o) !== JSON.stringify(order));
            setLocalStorage("orders", updatedOrders);
    
            // Hapus dari array dan update tabel
            serverData.splice(index, 1);
            populateTable(serverData); // Perbarui tabel
    
            showNotification("Pesanan berhasil dihapus!"); // Tampilkan notifikasi 
        }
    }
});
