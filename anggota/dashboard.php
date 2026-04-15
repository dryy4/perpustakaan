<?php 
include '../koneksi.php';
session_start();
if(empty($_SESSION['id_anggota'])) {
    header("location:../login-anggota.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital - Ruang Baca Anggota</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6; 
        }
        .sidebar-menu:hover {
            background-color: #f8f9fa;
            color: #0d6efd !important;
            transform: translateX(5px);
            transition: all 0.3s ease;
        }
        .book-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
        }
        
        .book-cover-wrapper {
            overflow: hidden;
        }
        .book-cover-img {
            transition: transform 0.5s ease;
        }
        .book-card:hover .book-cover-img {
            transform: scale(1.05);
        }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #a8a8a8; }
    </style>
</head>
<body>
    <div class="container-fluid vh-100 p-0 overflow-hidden d-flex">
        
<div class="bg-white shadow-sm d-flex flex-column h-100 p-4" style="width: 280px; z-index: 10;">
            <div class="mb-5 mt-2 text-center">
                <h4 class="fw-bold text-primary mb-0">📚Perpus <span class="text-dark">Digital.</span></h4>
                <small class="text-muted">Ruang Baca Siswa</small>
            </div>

            <div class="d-flex flex-column gap-3 mb-auto"> <p class="text-muted small fw-semibold mb-0 ps-2">MENU UTAMA</p>
                
                <a href="dashboard.php" class="text-decoration-none p-3 rounded-4 fw-medium sidebar-menu <?= (empty($_GET['halaman'])) ? 'bg-primary text-white shadow-sm' : 'text-dark' ?>">
                    <div class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-door me-3" viewBox="0 0 16 16">
                            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
                        </svg>
                        Beranda
                    </div>
                </a>
                
                <a href="?halaman=history" class="text-decoration-none p-3 rounded-4 fw-medium sidebar-menu <?= (isset($_GET['halaman']) && $_GET['halaman'] == 'history') ? 'bg-primary text-white shadow-sm' : 'text-dark' ?>">
                    <div class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock-history me-3" viewBox="0 0 16 16">
                            <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.757.205 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                            <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                            <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        Riwayat Pinjaman
                    </div>
                </a>
            </div>

            <div class="mt-auto border-top pt-4">
                <a href="logout.php" class="btn btn-light text-danger w-100 fw-semibold d-flex justify-content-between align-items-center p-3 rounded-4">
                    Keluar Akun
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                </a>
            </div>
        </div>

        <div class="flex-grow-1 h-100 overflow-auto position-relative">
            
            <?php
            $halaman = isset($_GET['halaman']) ? $_GET['halaman'] : "";
            if(file_exists($halaman . ".php")){
                
                echo "<div class='p-4 p-md-5'>";
                include $halaman . ".php"; 
                echo "</div>";
            }else{
            ?>
            
            <div class="bg-white px-4 px-md-5 py-4 shadow-sm mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3 sticky-top">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Halo, <?= $_SESSION['nama_anggota']; ?>! 👋</h3>
                    <p class="text-muted mb-0 small">Siap untuk petualangan literasi hari ini?</p>
                </div>
                
                <form action="?halaman=cari" method="post" class="m-0">
                    <div class="input-group" style="width: 350px;">
                        <input type="text" name="cari" class="form-control border-end-0 bg-light py-2 px-4 rounded-start-pill" placeholder="Cari judul buku..." required style="box-shadow: none;">
                        <button type="submit" class="btn btn-light border border-start-0 rounded-end-pill px-3 text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <div class="px-4 px-md-5 pb-5">

                <div class="mb-5">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="fs-5">📖</span>
                        <h5 class="fw-bold mb-0">Buku yang Sedang Kamu Pinjam</h5>
                    </div>
                    
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover align-middle mb-0">
                                <thead class="table-light border-bottom">
                                    <tr class="text-muted small text-uppercase">
                                        <th class="ps-4 py-3 fw-medium">No</th>
                                        <th class="py-3 fw-medium">Judul Buku</th>
                                        <th class="py-3 fw-medium">Tanggal Pinjam</th>
                                        <th class="pe-4 py-3 fw-medium text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1;
                                    date_default_timezone_set("Asia/Jakarta");
                                    $tgl_sekarang = date('Y-m-d'); 
                                    
                                    $query = "SELECT *, transaksi.status AS status_pinjam FROM transaksi JOIN buku ON transaksi.id_buku=buku.id_buku WHERE transaksi.id_anggota=$_SESSION[id_anggota] AND transaksi.status IN ('peminjaman', 'menunggu_persetujuan', 'menunggu_kembali')";
                                    $data = mysqli_query($koneksi, $query);
                                    
                                    if(mysqli_num_rows($data) > 0) {
                                        foreach($data as $peminjaman){ 
                                            
                                            
                                            $denda_berjalan = 0;
                                            $hari_telat = 0;
                                            $is_telat = false;
                                            
                                            if($peminjaman['status_pinjam'] != 'menunggu_persetujuan' && $peminjaman['tgl_jatuh_tempo'] != null) {
                                                if($tgl_sekarang > $peminjaman['tgl_jatuh_tempo']) {
                                                    $is_telat = true;
                                                    $selisih = strtotime($tgl_sekarang) - strtotime($peminjaman['tgl_jatuh_tempo']);
                                                    $hari_telat = floor($selisih / (60 * 60 * 24));
                                                    $denda_berjalan = $hari_telat * 1000; 
                                                }
                                            }
                                            
                                        ?>
                                        <tr class="border-bottom <?= ($is_telat) ? 'bg-danger bg-opacity-10' : '' ?>">
                                            <td class="ps-4 text-muted"> <?= $no++ ?> </td>
                                            <td class="fw-semibold text-dark"> 
                                                <?= $peminjaman['judul_buku'] ?> 
                                                
                                                <?php if($peminjaman['status_pinjam'] != 'menunggu_persetujuan') { ?>
                                                    <div class="mt-1 small">
                                                        <span class="text-muted">Batas: <?= date('d M Y', strtotime($peminjaman['tgl_jatuh_tempo'])) ?></span>
                                                        <?php if($is_telat) { ?>
                                                            <span class="badge bg-danger ms-2">Telat <?= $hari_telat ?> Hari (Denda: Rp <?= number_format($denda_berjalan, 0, ',', '.') ?>)</span>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <td><span class="badge bg-light text-dark fw-normal border px-3 py-2 rounded-pill"><?= date('d-M-Y', strtotime($peminjaman['tgl_pinjam'])); ?></span></td>
                                            
                                            <td class="pe-4 text-end">
                                                <?php if($peminjaman['status_pinjam'] == 'menunggu_persetujuan') { ?>
                                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Menunggu Persetujuan</span>
                                                
                                                <?php } elseif($peminjaman['status_pinjam'] == 'menunggu_kembali') { ?>
                                                    <span class="badge bg-info text-dark px-3 py-2 rounded-pill">Menuggu Persetujuan Pengembalian ke Admin</span>
                                                
                                                <?php } elseif($peminjaman['status_pinjam'] == 'peminjaman') { ?>
                                                    <a class="btn btn-outline-success btn-sm rounded-pill px-4 fw-medium" href="?halaman=pengembalian&id=<?= $peminjaman['id_transaksi'] ?>&buku=<?= $peminjaman['id_buku'] ?>" onclick="return confirm('Apakah kamu yakin ingin mengembalikan buku <?= $peminjaman['judul_buku'] ?>?')">
                                                        Kembalikan
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } 
                                    } else { ?>
                                        <tr>
                                            <td colspan="4" class="text-center py-5 text-muted">
                                                Kamu belum meminjam buku apapun. Yuk mulai membaca!
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <span class="fs-5">✨</span>
                            <h5 class="fw-bold mb-0">Daftar Buku - Buku</h5>
                        </div>
                    </div>
                    
                    <div class="row g-4">
                        <?php 
                        $data_buku = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id_buku DESC");
                        foreach($data_buku as $buku){?>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="card book-card border-0 shadow-sm h-100 rounded-4 bg-white p-2">
                                
                                <div class="book-cover-wrapper rounded-3 mb-3 position-relative bg-light" style="height: 250px;">
                                    
                                    <?php if(isset($buku['cover']) && $buku['cover'] != "") { ?>
                                        <img src="../cover/<?= $buku['cover'] ?>" alt="<?= $buku['judul_buku'] ?>" class="book-cover-img w-100 h-100" style="object-fit: cover;">
                                    <?php } else { ?>
                                        <div class="w-100 h-100 d-flex justify-content-center align-items-center text-secondary opacity-50">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                                            <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.814 5 1c-.5.163-2.148.52-2.92.83C1.196 2.186 1 2.452 1 2.82v11c0 .346.196.63.49.79.28.15.59.18.91.07.72-.25 2.14-.64 2.92-.83.58-.14 2.01-.28 2.92.56.91-.84 2.34-.7 2.92-.56.78.19 2.2.58 2.92.83.32.11.63.08.91-.07.29-.16.49-.44.49-.79v-11c0-.368-.196-.634-.49-.81-.77-.31-2.42-.67-2.92-.83-.58-.186-2.01-.064-2.92.783z"/>
                                            </svg>
                                        </div>
                                    <?php } ?>

                                    <div class="position-absolute top-0 end-0 p-2">
                                        <?php if($buku['stok'] > 0){ ?>
                                            <span class="badge bg-success shadow-sm rounded-pill px-3 py-2 fw-medium small">
                                                Tersedia: <?= $buku['stok'] ?>
                                            </span>
                                        <?php } else { ?>
                                            <span class="badge bg-danger shadow-sm rounded-pill px-3 py-2 fw-medium small">
                                                Stok Habis
                                            </span>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div class="card-body d-flex flex-column p-1 px-2 pb-2">
                                    <h6 class="fw-bold text-dark mb-3" style="line-height: 1.4; font-size: 1.05rem;"><?= $buku['judul_buku'] ?></h6>
                                    
                                    <div class="d-flex flex-column gap-2 mb-4 mt-auto">
                                        <div class="d-flex align-items-center text-muted small">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-person me-2 text-primary" viewBox="0 0 16 16"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/></svg>
                                            <span class="text-truncate"><?= $buku['pengarang'] ?></span>
                                        </div>
                                        <div class="d-flex align-items-center text-muted small">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-building me-2 text-primary" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"/><path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"/></svg>
                                            <span class="text-truncate"><?= $buku['penerbit'] ?> (<?= $buku['tahun_terbit'] ?>)</span>
                                        </div>
                                    </div>
                                    
                                    <?php if($buku['stok'] > 0){ ?>
                                        <a href="?halaman=peminjaman&id=<?= $buku['id_buku'] ?>" class="btn btn-primary w-100 rounded-pill py-2 fw-medium" onclick="return confirm('Pinjam buku <?= $buku['judul_buku'] ?> ?')">Pinjam Sekarang</a>
                                    <?php }else{ ?>
                                        <a href="#" class="btn btn-light text-muted w-100 rounded-pill py-2 fw-medium disabled" style="background-color: #f8f9fa;">Sedang Kosong</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            
        </div>
    </div>
</body>
</html>