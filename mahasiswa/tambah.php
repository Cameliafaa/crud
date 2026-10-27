<?php
require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nim = $_POST['nim'];
    $nama = $_POST['nama_mahasiswa'];
    $jk = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['no_telp'];

    $stmt = mysqli_prepare($conn, "INSERT INTO tbl_mahasiswa (nim, nama_mahasiswa, jenis_kelamin, alamat, no_telp) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $nim, $nama, $jk, $alamat, $telp);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}

$pageTitle = "Tambah Mahasiswa";
$currentMenu = "mahasiswa";
include "../header.php";
include "../sidebar.php";
?>

<h2 class="mb-3">Tambah Mahasiswa</h2>

<div class="card-simple form-box">
<form method="POST">
    <div class="mb-3">
        <label class="form-label">NIM</label>
        <input type="text" name="nim" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama Mahasiswa</label>
        <input type="text" name="nama_mahasiswa" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-select">
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <input type="text" name="alamat" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">No. Telepon</label>
        <input type="text" name="no_telp" class="form-control">
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</form>
</div>

<?php include "../footer.php"; ?>
