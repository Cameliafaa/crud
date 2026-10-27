<?php
require_once "../config/database.php";

$id = (int) ($_GET['id'] ?? 0);

$stmt = mysqli_prepare($conn, "SELECT * FROM tbl_matkul WHERE id_matkul = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$data) die("Data tidak ditemukan.");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $kode_matkul = $_POST['kode_matkul'];
    $nama_matkul = $_POST['nama_matkul'];
    $sks = $_POST['sks'];

    $stmt = mysqli_prepare($conn, "UPDATE tbl_matkul SET kode_matkul=?, nama_matkul=?, sks=? WHERE id_matkul=?");
    mysqli_stmt_bind_param($stmt, "ssii", $kode_matkul, $nama_matkul, $sks, $id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}

$pageTitle = "Edit Mata Kuliah";
$currentMenu = "matkul";
include "../header.php";
include "../sidebar.php";
?>

<h2 class="mb-3">Edit Mata Kuliah</h2>
<div class="card-simple form-box">
<form method="POST">
    <div class="mb-3">
        <label class="form-label">Kode Mata Kuliah</label>
        <input type="text" name="kode_matkul" class="form-control" value="<?= htmlspecialchars($data['kode_matkul']); ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama Mata Kuliah</label>
        <input type="text" name="nama_matkul" class="form-control" value="<?= htmlspecialchars($data['nama_matkul']); ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">SKS</label>
        <input type="number" name="sks" class="form-control" value="<?= htmlspecialchars($data['sks']); ?>" required>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</form>
</div>

<?php include "../footer.php"; ?>
