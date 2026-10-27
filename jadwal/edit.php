<?php
require_once "../config/database.php";

$id=(int)($_GET['id']??0);
$stmt=mysqli_prepare($conn,"SELECT * FROM tbl_jadwal WHERE id_jadwal=?");
mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);
$data=mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if(!$data) die("Data tidak ditemukan.");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_dosen=(int)$_POST['id_dosen'];
    $id_matkul=(int)$_POST['id_matkul'];
    $id_semester=(int)$_POST['id_semester'];
    $hari=$_POST['hari'];
    $jam_mulai=$_POST['jam_mulai'];
    $jam_selesai=$_POST['jam_selesai'];
    $ruangan=$_POST['ruangan'];

    $stmt=mysqli_prepare($conn,"UPDATE tbl_jadwal SET id_dosen=?,id_matkul=?,id_semester=?,hari=?,jam_mulai=?,jam_selesai=?,ruangan=? WHERE id_jadwal=?");
    mysqli_stmt_bind_param($stmt,"iiissssi",$id_dosen,$id_matkul,$id_semester,$hari,$jam_mulai,$jam_selesai,$ruangan,$id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}

$dosen=mysqli_query($conn,"SELECT * FROM tbl_dosen ORDER BY nama_dosen");
$matkul=mysqli_query($conn,"SELECT * FROM tbl_matkul ORDER BY nama_matkul");
$semester=mysqli_query($conn,"SELECT * FROM tbl_semester ORDER BY id_semester DESC");

$pageTitle="Edit Jadwal";
$currentMenu="jadwal";
include "../header.php";
include "../sidebar.php";
?>

<h2 class="mb-3">Edit Jadwal</h2>
<div class="card-simple form-box">
<form method="POST">

    <div class="mb-3">
        <label class="form-label">Dosen</label>
        <select name="id_dosen" class="form-select" required>
            <option value="">-- Pilih Dosen --</option>
            <?php while($d=mysqli_fetch_assoc($dosen)): ?>
            <option value="<?= $d['id_dosen']; ?>" <?= isset($data) && $data['id_dosen']==$d['id_dosen']?'selected':''; ?>>
                <?= htmlspecialchars($d['nama_dosen']); ?>
            </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Mata Kuliah</label>
        <select name="id_matkul" class="form-select" required>
            <option value="">-- Pilih Mata Kuliah --</option>
            <?php while($m=mysqli_fetch_assoc($matkul)): ?>
            <option value="<?= $m['id_matkul']; ?>" <?= isset($data) && $data['id_matkul']==$m['id_matkul']?'selected':''; ?>>
                <?= htmlspecialchars($m['kode_matkul']." - ".$m['nama_matkul']); ?>
            </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Semester</label>
        <select name="id_semester" class="form-select" required>
            <option value="">-- Pilih Semester --</option>
            <?php while($s=mysqli_fetch_assoc($semester)): ?>
            <option value="<?= $s['id_semester']; ?>" <?= isset($data) && $data['id_semester']==$s['id_semester']?'selected':''; ?>>
                <?= htmlspecialchars($s['nama_semester']." ".$s['tahun_ajaran']); ?>
            </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Hari</label>
        <input type="text" name="hari" class="form-control" value="<?= isset($data)?htmlspecialchars($data['hari']):''; ?>" required>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" value="<?= isset($data)?htmlspecialchars($data['jam_mulai']):''; ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" value="<?= isset($data)?htmlspecialchars($data['jam_selesai']):''; ?>" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Ruangan</label>
        <input type="text" name="ruangan" class="form-control" value="<?= isset($data)?htmlspecialchars($data['ruangan']):''; ?>" required>
    </div>

<button class="btn btn-primary">Update</button>
<a href="index.php" class="btn btn-secondary">Kembali</a>
</form>
</div>
<?php include "../footer.php"; ?>
