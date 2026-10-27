<?php
require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $kode_matkul = $_POST['kode_matkul'];
    $nama_matkul = $_POST['nama_matkul'];
    $sks = $_POST['sks'];

    $stmt = mysqli_prepare($conn, "INSERT INTO tbl_matkul (kode_matkul, nama_matkul, sks) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssi", $kode_matkul, $nama_matkul, $sks);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}

$pageTitle = "Tambah Mata Kuliah";
$currentMenu = "matkul";
include "../header.php";
include "../sidebar.php";
?>

<h2 class="mb-3">Tambah Mata Kuliah</h2>
<div class="card-simple form-box">
<form method="POST">
    <div class="mb-3">
        <label class="form-label">Kode Mata Kuliah</label>
        <input type="text" name="kode_matkul" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama Mata Kuliah</label>
        <input type="text" name="nama_matkul" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">SKS</label>
        <input type="number" name="sks" class="form-control" required>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</form>
</div>

<?php include "../footer.php"; ?>
