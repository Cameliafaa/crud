<?php
require_once "../config/database.php";

$pageTitle = "Data Dosen";
$currentMenu = "dosen";

$limit = 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1) $page = 1;

$offset = ($page - 1) * $limit;

$totalResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbl_dosen");
$totalData = mysqli_fetch_assoc($totalResult)['total'];
$totalPage = (int) ceil($totalData / $limit);

$sql = "
    SELECT t.*
    
    FROM tbl_dosen t
    
    ORDER BY t.id_dosen DESC
    LIMIT $limit OFFSET $offset
";

$data = mysqli_query($conn, $sql);

include "../header.php";
include "../sidebar.php";
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h2 class="mb-1">Data Dosen</h2>
        <p class="text-secondary mb-0">Kelola data data dosen.</p>
    </div>

    <a href="tambah.php" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah
    </a>
</div>

<div class="card-simple">
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIDN</th>
                    <th>Nama Dosen</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $no = $offset + 1;
            while ($row = mysqli_fetch_assoc($data)):
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nidn']); ?></td>
                    <td><?= htmlspecialchars($row['nama_dosen']); ?></td>
                    <td><?= $row['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                    <td><?= htmlspecialchars($row['alamat']); ?></td>
                    <td><?= htmlspecialchars($row['no_telp']); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id_dosen']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus.php?id=<?= $row['id_dosen']; ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>

            <?php if ($totalData == 0): ?>
                <tr>
                    <td colspan="7" class="text-center text-secondary">Belum ada data.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($totalPage > 1): ?>
    <nav class="mt-3">
        <ul class="pagination justify-content-center mb-0">
            <li class="page-item <?= $page <= 1 ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?= $page - 1; ?>">Previous</a>
            </li>

            <?php for ($i = 1; $i <= $totalPage; $i++): ?>
                <li class="page-item <?= $page == $i ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?= $page >= $totalPage ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?= $page + 1; ?>">Next</a>
            </li>
        </ul>
    </nav>
    <?php endif; ?>
</div>

<?php include "../footer.php"; ?>
