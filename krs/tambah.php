<?php
require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_mahasiswa=(int)$_POST['id_mahasiswa'];
    $id_jadwal=(int)$_POST['id_jadwal'];
    $tanggal_krs=$_POST['tanggal_krs'];

    $stmt=mysqli_prepare($conn,"INSERT INTO tbl_krs (id_mahasiswa,id_jadwal,tanggal_krs) VALUES (?,?,?)");
    mysqli_stmt_bind_param($stmt,"iis",$id_mahasiswa,$id_jadwal,$tanggal_krs);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}

$mahasiswa=mysqli_query($conn,"SELECT * FROM tbl_mahasiswa ORDER BY nama_mahasiswa");
$jadwal=mysqli_query($conn,"SELECT j.*, m.nama_matkul FROM tbl_jadwal j JOIN tbl_matkul m ON j.id_matkul=m.id_matkul ORDER BY j.id_jadwal DESC");

$pageTitle="Tambah KRS";
$currentMenu="krs";
include "../header.php";
include "../sidebar.php";
?>

<h2 class="mb-3">Tambah KRS</h2>
<div class="card-simple form-box">
<form method="POST">

    <div class="mb-3">
        <label class="form-label">Mahasiswa</label>
        <select name="id_mahasiswa" class="form-select" required>
            <option value="">-- Pilih Mahasiswa --</option>
            <?php while($m=mysqli_fetch_assoc($mahasiswa)): ?>
            <option value="<?= $m['id_mahasiswa']; ?>" <?= isset($data) && $data['id_mahasiswa']==$m['id_mahasiswa']?'selected':''; ?>>
                <?= htmlspecialchars($m['nim']." - ".$m['nama_mahasiswa']); ?>
            </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Jadwal</label>
        <select name="id_jadwal" class="form-select" required>
            <option value="">-- Pilih Jadwal --</option>
            <?php while($j=mysqli_fetch_assoc($jadwal)): ?>
            <option value="<?= $j['id_jadwal']; ?>" <?= isset($data) && $data['id_jadwal']==$j['id_jadwal']?'selected':''; ?>>
                <?= htmlspecialchars($j['nama_matkul']." | ".$j['hari']." - ".$j['ruangan']); ?>
            </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Tanggal KRS</label>
        <input type="date" name="tanggal_krs" class="form-control" value="<?= isset($data)?htmlspecialchars($data['tanggal_krs']):date('Y-m-d'); ?>" required>
    </div>

<button class="btn btn-primary">Simpan</button>
<a href="index.php" class="btn btn-secondary">Kembali</a>
</form>
</div>
<?php include "../footer.php"; ?>
