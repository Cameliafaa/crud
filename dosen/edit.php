<?php
require_once "../config/database.php";

$id = (int) ($_GET['id'] ?? 0);

$stmt = mysqli_prepare($conn, "SELECT * FROM tbl_dosen WHERE id_dosen = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$data) die("Data tidak ditemukan.");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nidn = $_POST['nidn'];
    $nama_dosen = $_POST['nama_dosen'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];

    $stmt = mysqli_prepare($conn, "UPDATE tbl_dosen SET nidn=?, nama_dosen=?, jenis_kelamin=?, alamat=?, no_telp=? WHERE id_dosen=?");
    mysqli_stmt_bind_param($stmt, "sssssi", $nidn, $nama_dosen, $jenis_kelamin, $alamat, $no_telp, $id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}

$pageTitle = "Edit Dosen";
$currentMenu = "dosen";
include "../header.php";
include "../sidebar.php";
?>

<h2 class="mb-3">Edit Dosen</h2>
<div class="card-simple form-box">
<form method="POST">
    <div class="mb-3">
        <label class="form-label">NIDN</label>
        <input type="text" name="nidn" class="form-control" value="<?= htmlspecialchars($data['nidn']); ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama Dosen</label>
        <input type="text" name="nama_dosen" class="form-control" value="<?= htmlspecialchars($data['nama_dosen']); ?>" required>
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
        <input type="text" name="alamat" class="form-control" value="<?= htmlspecialchars($data['alamat']); ?>" >
    </div>

    <div class="mb-3">
        <label class="form-label">No. Telepon</label>
        <input type="text" name="no_telp" class="form-control" value="<?= htmlspecialchars($data['no_telp']); ?>" >
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</form>
</div>

<?php include "../footer.php"; ?>
