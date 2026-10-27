<?php
require_once "../config/database.php";

$id = (int) ($_GET['id'] ?? 0);

$stmt = mysqli_prepare($conn, "SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$data) die("Data mahasiswa tidak ditemukan.");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nim = $_POST['nim'];
    $nama = $_POST['nama_mahasiswa'];
    $jk = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['no_telp'];

    $stmt = mysqli_prepare($conn, "UPDATE tbl_mahasiswa SET nim=?, nama_mahasiswa=?, jenis_kelamin=?, alamat=?, no_telp=? WHERE id_mahasiswa=?");
    mysqli_stmt_bind_param($stmt, "sssssi", $nim, $nama, $jk, $alamat, $telp, $id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}

$pageTitle = "Edit Mahasiswa";
$currentMenu = "mahasiswa";
include "../header.php";
include "../sidebar.php";
?>

<h2 class="mb-3">Edit Mahasiswa</h2>
<div class="card-simple form-box">
<form method="POST">
    <div class="mb-3">
        <label class="form-label">NIM</label>
        <input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($data['nim']); ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama Mahasiswa</label>
        <input type="text" name="nama_mahasiswa" class="form-control" value="<?= htmlspecialchars($data['nama_mahasiswa']); ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-select">
            <option value="L" <?= $data['jenis_kelamin'] === 'L' ? 'selected' : ''; ?>>Laki-laki</option>
            <option value="P" <?= $data['jenis_kelamin'] === 'P' ? 'selected' : ''; ?>>Perempuan</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <input type="text" name="alamat" class="form-control" value="<?= htmlspecialchars($data['alamat'] ?? ''); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">No. Telepon</label>
        <input type="text" name="no_telp" class="form-control" value="<?= htmlspecialchars($data['no_telp'] ?? ''); ?>">
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</form>
</div>

<?php include "../footer.php"; ?>
