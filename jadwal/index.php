<?php
require_once "../config/database.php";

$pageTitle = "Data Jadwal";
$currentMenu = "jadwal";

$limit = 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

$totalResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbl_jadwal");
$totalData = mysqli_fetch_assoc($totalResult)['total'];
$totalPage = (int) ceil($totalData / $limit);

$sql = "
SELECT j.*, d.nama_dosen, m.nama_matkul, s.nama_semester, s.tahun_ajaran
FROM tbl_jadwal j
JOIN tbl_dosen d ON j.id_dosen = d.id_dosen
JOIN tbl_matkul m ON j.id_matkul = m.id_matkul
JOIN tbl_semester s ON j.id_semester = s.id_semester
ORDER BY j.id_jadwal DESC
LIMIT $limit OFFSET $offset
";
$data = mysqli_query($conn, $sql);

include "../header.php";
include "../sidebar.php";
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h2 class="mb-1">Data Jadwal</h2>
        <p class="text-secondary mb-0">Kelola jadwal perkuliahan.</p>
    </div>
    <a href="tambah.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah</a>
</div>

<div class="card-simple">
<div class="table-responsive">
<table class="table table-striped align-middle">
<thead>
<tr>
    <th>No</th>
    <th>Dosen</th>
    <th>Mata Kuliah</th>
    <th>Semester</th>
    <th>Hari</th>
    <th>Jam</th>
    <th>Ruangan</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php $no=$offset+1; while($row=mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= htmlspecialchars($row['nama_dosen']); ?></td>
    <td><?= htmlspecialchars($row['nama_matkul']); ?></td>
    <td><?= htmlspecialchars($row['nama_semester']." ".$row['tahun_ajaran']); ?></td>
    <td><?= htmlspecialchars($row['hari']); ?></td>
    <td><?= htmlspecialchars(substr($row['jam_mulai'],0,5)." - ".substr($row['jam_selesai'],0,5)); ?></td>
    <td><?= htmlspecialchars($row['ruangan']); ?></td>
    <td>
        <a href="edit.php?id=<?= $row['id_jadwal']; ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="hapus.php?id=<?= $row['id_jadwal']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>

<?php if ($totalPage > 1): ?>
<nav>
<ul class="pagination justify-content-center mb-0">
<li class="page-item <?= $page<=1?'disabled':''; ?>"><a class="page-link" href="?page=<?= $page-1; ?>">Previous</a></li>
<?php for($i=1;$i<=$totalPage;$i++): ?>
<li class="page-item <?= $page==$i?'active':''; ?>"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
<?php endfor; ?>
<li class="page-item <?= $page>=$totalPage?'disabled':''; ?>"><a class="page-link" href="?page=<?= $page+1; ?>">Next</a></li>
</ul>
</nav>
<?php endif; ?>
</div>

<?php include "../footer.php"; ?>
