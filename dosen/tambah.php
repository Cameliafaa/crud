<?php
require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nidn = $_POST['nidn'];
    $nama_dosen = $_POST['nama_dosen'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];

    $stmt = mysqli_prepare($conn, "INSERT INTO tbl_dosen (nidn, nama_dosen, jenis_kelamin, alamat, no_telp) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $nidn, $nama_dosen, $jenis_kelamin, $alamat, $no_telp);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}

$pageTitle = "Tambah Dosen";
$currentMenu = "dosen";
include "../header.php";
include "../sidebar.php";
?>

<h2 class="mb-3">Tambah Dosen</h2>
<div class="card-simple form-box">
<form method="POST">
    <div class="mb-3">
        <label class="form-label">NIDN</label>
        <input type="text" name="nidn" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama Dosen</label>
        <input type="text" name="nama_dosen" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-select">
            <option value="L" >Laki-laki</option>
            <option value="P" >Perempuan</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <input type="text" name="alamat" class="form-control" >
    </div>

    <div class="mb-3">
        <label class="form-label">No. Telepon</label>
        <input type="text" name="no_telp" class="form-control" >
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</form>
</div>

<?php include "../footer.php"; ?>
