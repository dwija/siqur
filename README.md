<h2 align="center">SiQur: Sistem Informasi TAUD SaQu Cahaya Al-Madinah Pontianak</h2>

### Tentang
Sistem Informasi TAUD SaQu Cahaya Al-Madinah Pontianak (SiQur) telah dirancang dan dikembangkan dengan metode R&D model waterfall, berbasis Web (menggunakan framework laravel) dengan sistem basis data yang terpusat dan terintegrasi (menggunakan MySQL). Sistem informasi (SiQur) ini dapat digunakan untuk mengolah dan mengelola data akademik pada TAUD SaQu Cahaya Al-Madinah Pontianak. Dengan kata lain, SiQur ini menjadi solusi dari permasalahan yang ada. Sistem Informasi yang mampu mencatat, mengolah, dan mengeluarkan informasi berupa laporan secara cepat, tepat, dan akurat.

### Fitur:

#### a)	 Pengguna Staf Admin
-	Dapat mengelola data pengguna (Guru dan Staf Admin)
-	Dapat mengelola data peserta didik (siswa)
-	Dapat mengelola data kelas
-	Dapat mengelola data orang tua
-	Dapat mengelola data kurikulum (Qur’an dan Iqro) 
-	Dapat mencetak laporan harian dan persiswa
-	Dapat memperoleh informasi peserta didik, kelas, dan perkembangan peserta didik.

#### b)	Pengguna Guru Pengajar: 
-	Dapat memberikan penilaian pada peserta didik (siswa)
-	Dapat mencetak laporan harian dan persiswa
-	Dapat memperoleh informasi peserta didik, kelas, dan perkembangan peserta didik.


### Install SiQur Laravel dari Github ke XAMPP Windows

- Pastikan sudah ada paket web server Xampp atau paket web server sejenis (php 7)
- Composer sudah terinstall, cek dengan perintah `composer -V` melalui cmd terminal. Jika belum, Install Composer download di https://getcomposer.org/
- Koneksi internet untuk proses installasi

- Download Source Code dari repo Github SiQur dalam bentuk Zip 
- Extract file zip (source code) ke dalam direktori htdocs pada XAMPP, misal htdocs/siqur
- Melalui terminal cmd, masuk ke direktori siqur `cd siqur`
- Masih di terminal cmd, lakukan perintah `composer install` (perlu koneksi internet)
- Composer akan menginstall dependency paket dari source code tersebut hingga selesai
- Jalankan perintah `php artisan` untuk menguji apakah perintah artisan Laravel bekerja
- Buat database baru (db_siqur) pada mysql (via phpmyadmin)
- Duplikat file .env.example, lalu rename menjadi .env
- Kembali ke terminal cmd `php artisan key:generate`
- Setting koneksi database di file .env (DB_DATABASE, DB_USERNAME, DB_PASSWORD).
- Jalan kan perintah `php artisan migrate` Jika di cek di phpmyadmin, seharusnya tabel sudah muncul.
- Buka CMD masuk ke direktori siqur ketikkan perintah `php artisan siqur:setup`
- Installasi pada tahap ini selesai.
- Untuk menjalankan ketik perintah `php artisan serve`
- akses localhost:8000 atau 127.0.0.1:8000
- Masukkan user 4dmin password Admin10 (level root)

Pesan developer sebelumnya: 
#### Gunakan dengan bijak


--------------------
Tugas Proyek SI
Disusun oleh:

Rachmat Mulyono (NIM 12200958)
Dwija Saptahadi (NIM 12201033)
Desi (NIM 12201072)
Tengku Dhea Azzahra (NIM 12200345)

Sebagai Tugas Mata Kuliah
Metode Penelitian, MPSI, APSI, IMK, dan WP3
Program Studi D3 Sistem Informasi 
Universitas Bina Sarana Informatika
Pontianak, 2022 
