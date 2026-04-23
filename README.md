# RIVE INTELLIGENCE TERMINAL (ALPHA-01)
> **The Future of Retail Management.**
> Estetika Ultra-Premium dengan Arsitektur Performa Tinggi.

---

## 🌌 IDENTITY: MIDNIGHT AURORA
RIVE POS bukan sekadar aplikasi kasir; ini adalah sebuah pengalaman visual. Dibangun dengan tema **Midnight Aurora**, aplikasi ini menggabungkan kedalaman warna *Deep Indigo*, tekstur *Grainy* mewah, dan animasi *Glassmorphism* yang dinamis.

---

## 🛠️ TECH STACK
*   **Backend**: Laravel 11 (PHP 8.2+)
*   **Frontend**: Tailwind CSS (JIT Engine)
*   **Interactivity**: Alpine.js (Reactive Logic)
*   **Icons**: Lucide Icons (Stroke-based design)
*   **Database**: MySQL / MariaDB

---

## ⚡ CORE FEATURES
1.  **Neural Dashboard**: Visualisasi flux pendapatan, status latensi sistem, dan intelijen transaksi secara real-time.
2.  **Autonomous Terminal**: Sistem kasir high-speed dengan pencarian katalog instan dan kalkulasi pajak otomatis.
3.  **Stock Intelligence**: Manajemen inventaris dengan kategori dinamis, peringatan stok rendah, dan sistem replenish (restock).
4.  **Ledger History**: Arsip transaksi lengkap dengan invoice unik dan cetak struk (Receipt) bergaya butik premium.
5.  **Multi-Role Access**: Pemisahan otoritas antara `Owner` (Full Control) dan `Staff` (Cashier Only).

---

## 🚀 CARA MENJALANKAN (INSTALLATION)

1.  **Clone & Install Dependencies**:
    ```bash
    composer install
    npm install
    ```

2.  **Environment Setup**:
    Salin `.env.example` menjadi `.env` dan sesuaikan database:
    ```env
    DB_DATABASE=rive_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

3.  **Database Migration & Seeding**:
    ```bash
    php artisan migrate:fresh --seed
    ```
    *Akun Default:*
    - **Owner**: `owner@RIVE.com` / `password123`
    - **Staff**: `staff@RIVE.com` / `password123`

4.  **Storage Link**:
    Penting untuk menampilkan gambar produk:
    ```bash
    php artisan storage:link
    ```

5.  **Run System**:
    ```bash
    npm run dev
    # Buka terminal baru
    php artisan serve
    ```

---

## 🔄 ALUR SISTEM (SYSTEM FLOW)

1.  **Authentication**: User login melalui "Identity Node". Sistem mendeteksi role (Owner/Staff).
2.  **Stocking**: Owner masuk ke menu **Stock**, membuat kategori, dan menambah produk (Entry). Gambar akan diupload ke storage.
3.  **Operation**: Kasir membuka **Terminal**. Memilih produk (Entity) -> Masuk ke Bucket Queue -> Input nominal pembayaran (Tender).
4.  **Verification**: Tombol "Finalize" diklik. Sistem memvalidasi saldo, mengurangi stok otomatis, dan mencatat transaksi ke Ledger.
5.  **Archiving**: Nota (Receipt) muncul otomatis. Transaksi tersimpan selamanya di menu **Archive** untuk audit.

---

## 👨‍💻 PANDUAN MODIFIKASI CODE (DEVELOPER GUIDE)

### 1. Ganti Warna Tema (Indigo Glow)
Warna utama didefinisikan di `resources/views/layouts/app.blade.php`.
- Untuk mengganti aura: Cari bagian `<!-- Aurora Background Glows -->` dan ganti class `bg-indigo-600/10` ke warna Tailwind lain (misal: `bg-emerald-600/10`).
- Tekstur grainy dikontrol oleh `opacity-[0.03]` pada overlay noise.

### 2. Logika POS (Reactive Logic)
Seluruh logika kasir (tambah keranjang, hitung total) ada di `resources/views/pos/index.blade.php` di dalam fungsi `posSystem()`.
- **Tambah logic diskon**: Edit bagian `get total()` untuk menyertakan variabel diskon.

### 3. Struktur Layout
Aplikasi ini menggunakan konsep **Single-Layout Architecture**:
- `layouts/app.blade.php`: Kerangka utama (sidebar, background, noise).
- `layouts/navigation.blade.php`: Top-bar dinamis dengan efek scroll blur.

### 4. Menambah Ikon
Kami menggunakan **Lucide Icons**. Untuk menambah ikon baru:
1. Cari nama ikon di [lucide.dev](https://lucide.dev).
2. Tambahkan tag: `<i data-lucide="NAMA_IKON"></i>`.
3. Pastikan `lucide.createIcons()` dipanggil (sudah otomatis di layout utama).

---

## 💎 DESIGN PHILOSOPHY
> *"Complexity hidden behind simplicity."*
Setiap komponen di RIVE didesain dengan padding yang luas (`p-12`, `p-16`), radius border yang besar (`rounded-[4rem]`), dan tipografi yang berani (`font-black uppercase tracking-tighter`).

---
**RIVE INTELLIGENCE GROUP • 2026**
