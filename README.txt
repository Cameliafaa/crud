AKADEMIK PER MENU - CRUD SIMPLE

1. Copy folder "akademik" ke:
   C:\xampp\htdocs\akademik

2. Start Apache dan MySQL dari XAMPP.

3. Import database db_latihan-2.sql ke phpMyAdmin.
   Nama database: db_latihan

4. Buka:
   http://localhost/akademik

Struktur:
- config/database.php = koneksi database
- header.php/sidebar.php/footer.php = layout yang dipakai bersama
- mahasiswa/ = CRUD mahasiswa
- dosen/ = CRUD dosen
- matkul/ = CRUD mata kuliah
- semester/ = CRUD semester
- jadwal/ = CRUD jadwal (dropdown relasi)
- krs/ = CRUD KRS (dropdown relasi)
- user/ = CRUD user

Pagination default: 5 data per halaman.

CATATAN:
Sidebar menggunakan path /akademik/...
Kalau nama folder project diganti, sesuaikan href di sidebar.php
dan path CSS di header.php.
