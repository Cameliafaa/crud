<?php
require_once "../config/database.php";

$id = (int) ($_GET['id'] ?? 0);

$stmt = mysqli_prepare($conn, "SELECT * FROM tbl_user WHERE id_user = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$data) die("Data tidak ditemukan.");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $stmt = mysqli_prepare($conn, "UPDATE tbl_user SET username=?, password=?, level=? WHERE id_user=?");
    mysqli_stmt_bind_param($stmt, "sssi", $username, $password, $level, $id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}

$pageTitle = "Edit User";
$currentMenu = "user";
include "../header.php";
include "../sidebar.php";
?>

<h2 class="mb-3">Edit User</h2>
<div class="card-simple form-box">
<form method="POST">
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($data['username']); ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Level</label>
        <select name="level" class="form-select">
            <option value="admin" <?= $data['level'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
            <option value="dosen" <?= $data['level'] === 'dosen' ? 'selected' : ''; ?>>Dosen</option>
            <option value="mahasiswa" <?= $data['level'] === 'mahasiswa' ? 'selected' : ''; ?>>Mahasiswa</option>
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</form>
</div>

<?php include "../footer.php"; ?>
