<?php
require_once "../config/database.php";

$id = (int) ($_GET['id'] ?? 0);

$stmt = mysqli_prepare($conn, "SELECT * FROM tbl_semester WHERE id_semester = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$data) die("Data tidak ditemukan.");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama_semester = $_POST['nama_semester'];
    $tahun_ajaran = $_POST['tahun_ajaran'];

    $stmt = mysqli_prepare($conn, "UPDATE tbl_semester SET nama_semester=?, tahun_ajaran=? WHERE id_semester=?");
    mysqli_stmt_bind_param($stmt, "ssi", $nama_semester, $tahun_ajaran, $id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}

$pageTitle = "Edit Semester";
$currentMenu = "semester";
include "../header.php";
include "../sidebar.php";
?>

<h2 class="mb-3">Edit Semester</h2>
<div class="card-simple form-box">
<form method="POST">
    <div class="mb-3">
        <label class="form-label">Nama Semester</label>
        <input type="text" name="nama_semester" class="form-control" value="<?= htmlspecialchars($data['nama_semester']); ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Tahun Ajaran</label>
        <input type="text" name="tahun_ajaran" class="form-control" value="<?= htmlspecialchars($data['tahun_ajaran']); ?>" required>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</form>
</div>

<?php include "../footer.php"; ?>
