<?php
require_once "../config/database.php";

$pageTitle = "Data KRS";
$currentMenu = "krs";

$limit = 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

$totalResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbl_krs");
$totalData = mysqli_fetch_assoc($totalResult)['total'];
$totalPage = (int) ceil($totalData / $limit);

$sql = "
SELECT k.*, m.nim, m.nama_mahasiswa,
       j.hari, j.ruangan, mk.nama_matkul
FROM tbl_krs k
JOIN tbl_mahasiswa m ON k.id_mahasiswa = m.id_mahasiswa
JOIN tbl_jadwal j ON k.id_jadwal = j.id_jadwal
JOIN tbl_matkul mk ON j.id_matkul = mk.id_matkul
ORDER BY k.id_krs DESC
LIMIT $limit OFFSET $offset
";
$data = mysqli_query($conn, $sql);

include "../header.php";
include "../sidebar.php";
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h2 class="mb-1">Data KRS</h2>
        <p class="text-secondary mb-0">Kelola pengambilan jadwal mahasiswa.</p>
    </div>
    <a href="tambah.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah</a>
</div>

<div class="card-simple">
<div class="table-responsive">
<table class="table table-striped align-middle">
<thead>
<tr>
    <th>No</th>
    <th>Mahasiswa</th>
    <th>Jadwal</th>
    <th>Tanggal KRS</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php $no=$offset+1; while($row=mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= htmlspecialchars($row['nama_mahasiswa']." - ".$row['nim']); ?></td>
    <td><?= htmlspecialchars($row['nama_matkul']." | ".$row['hari']." - ".$row['ruangan']); ?></td>
    <td><?= htmlspecialchars($row['tanggal_krs']); ?></td>
    <td>
        <a href="edit.php?id=<?= $row['id_krs']; ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="hapus.php?id=<?= $row['id_krs']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</a>
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
