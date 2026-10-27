<?php
$current = $currentMenu ?? '';
?>
<aside class="sidebar">
    <div class="sidebar-brand">
        <i class="bi bi-mortarboard-fill"></i>
        <span>Sistem Akademik</span>
    </div>

    <hr>

    <nav>
        <a href="/akademik/mahasiswa/index.php" class="<?= $current === 'mahasiswa' ? 'active' : ''; ?>">
            <i class="bi bi-people"></i> Mahasiswa
        </a>

        <a href="/akademik/dosen/index.php" class="<?= $current === 'dosen' ? 'active' : ''; ?>">
            <i class="bi bi-person-badge"></i> Dosen
        </a>

        <a href="/akademik/matkul/index.php" class="<?= $current === 'matkul' ? 'active' : ''; ?>">
            <i class="bi bi-book"></i> Mata Kuliah
        </a>

        <a href="/akademik/semester/index.php" class="<?= $current === 'semester' ? 'active' : ''; ?>">
            <i class="bi bi-calendar3"></i> Semester
        </a>

        <a href="/akademik/jadwal/index.php" class="<?= $current === 'jadwal' ? 'active' : ''; ?>">
            <i class="bi bi-clock"></i> Jadwal
        </a>

        <a href="/akademik/krs/index.php" class="<?= $current === 'krs' ? 'active' : ''; ?>">
            <i class="bi bi-file-earmark-text"></i> KRS
        </a>

        <a href="/akademik/user/index.php" class="<?= $current === 'user' ? 'active' : ''; ?>">
            <i class="bi bi-person-gear"></i> User
        </a>
    </nav>
</aside>

<main class="main-content">
