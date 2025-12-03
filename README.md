Markdown

Tugas1 CRUD Kursus

Deskripsi
Aplikasi ini memungkinkan pengguna untuk:
- Menambah kursus baru (**Create**)
- Melihat daftar kursus (**Read**)
- Mengubah data kursus (**Update**)
- Menghapus kursus (**Delete**)

Aplikasi dibuat dengan **PHP** dan **MySQL/MariaDB**, menggunakan **PDO** untuk koneksi database, serta mendukung upload gambar kursus. Harga ditampilkan dalam format pecahan **Rupiah**.

---

Spesifikasi Teknis
- **Bahasa Pemrograman**: PHP 8.4  
- **Database**: MySQL/MariaDB  
- **Struktur Folder**:
  ```
  crud-kursus/
  ├── config/       # Koneksi database (db.php)
  ├── uploads/      # Folder untuk menyimpan gambar kursus
  ├── css/          # Styling (style.css)
  ├── index.php     # Halaman daftar kursus (Read)
  ├── create.php    # Form tambah kursus (Create)
  ├── edit.php      # Form edit kursus (Update)
  ├── delete.php    # Proses hapus kursus (Delete)
  ├── schema.sql    # Struktur tabel SQL
  └── README.md     # Dokumentasi aplikasi
  ```
- **Koneksi Database**: PDO dengan mode error `PDO::ERRMODE_EXCEPTION`

---

Cara Menjalankan
1. Import `schema.sql` ke MySQL/MariaDB:
   ```sql
   CREATE DATABASE kursus_db;
   USE kursus_db;

   CREATE TABLE courses (
     id INT AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(100) NOT NULL,
     category VARCHAR(50) NOT NULL,
     price DECIMAL(10,2) NOT NULL,
     duration INT NOT NULL,
     image_path VARCHAR(255),
     status ENUM('aktif','nonaktif') NOT NULL
   );
   ```
2. Atur koneksi di `config/db.php` sesuai username/password database.  
3. Jalankan server lokal:
   ```bash
   php -S localhost:8000
   ```
4. Akses aplikasi di browser:
   ```
   http://localhost:8000/index.php
   ```

---

Skenario Uji
1. **Tambah Kursus**
   - Isi form di `create.php` dengan data kursus baru.
   - Pastikan data tersimpan di database dan muncul di daftar kursus.
2. **Tampilkan Daftar Kursus**
   - Buka `index.php`.
   - Pastikan semua kursus tampil dalam tabel dengan format harga Rupiah.
3. **Edit Kursus**
   - Klik tombol **Edit** pada salah satu kursus.
   - Ubah data (misalnya harga atau status).
   - Pastikan perubahan tersimpan dan muncul notifikasi **“Edit berhasil”**.
4. **Delete Kursus**
   - Klik tombol **Delete** pada salah satu kursus.
   - Pastikan data terhapus dari database dan muncul notifikasi **“Data berhasil dihapus”**.
5. **Upload Gambar**
   - Tambahkan kursus dengan gambar.
   - Pastikan file tersimpan di folder `uploads/` dan path tersimpan di database.

