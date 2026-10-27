<?php
require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $stmt = mysqli_prepare($conn, "INSERT INTO tbl_user (username, password, level) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $username, $password, $level);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}

$pageTitle = "Tambah User";
$currentMenu = "user";
include "../header.php";
include "../sidebar.php";
?>

<h2 class="mb-3">Tambah User</h2>
<div class="card-simple form-box">
<form method="POST">
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Level</label>
        <select name="level" class="form-select">
            <option value="admin" >Admin</option>
            <option value="dosen" >Dosen</option>
            <option value="mahasiswa" >Mahasiswa</option>
        </select>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</form>
</div>

<?php include "../footer.php"; ?>
