<?php
require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama_semester = $_POST['nama_semester'];
    $tahun_ajaran = $_POST['tahun_ajaran'];

    $stmt = mysqli_prepare($conn, "INSERT INTO tbl_semester (nama_semester, tahun_ajaran) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $nama_semester, $tahun_ajaran);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}

$pageTitle = "Tambah Semester";
$currentMenu = "semester";
include "../header.php";
include "../sidebar.php";
?>

<h2 class="mb-3">Tambah Semester</h2>
<div class="card-simple form-box">
<form method="POST">
    <div class="mb-3">
        <label class="form-label">Nama Semester</label>
        <input type="text" name="nama_semester" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Tahun Ajaran</label>
        <input type="text" name="tahun_ajaran" class="form-control" required>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</form>
</div>

<?php include "../footer.php"; ?>
