<?php 
session_start();
if(empty($_SESSION['id_admin'])) {
    header("location:../login-admin.php");
}
// Tambahkan koneksi database agar bisa menghitung jumlah data
include '../koneksi.php'; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Perpustakaan Sekolah Digital</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .stat-card { transition: transform 0.3s ease; }
        .stat-card:hover { transform: translateY(-5px); }
    </style>
</head>
<body>
    <div class="container-fluid p-0 overflow-hidden">
        <div class="row g-0 min-vh-100">
            
            <aside class="col-md-3 col-lg-2 bg-dark text-white p-4 d-flex flex-column shadow" style="z-index: 10;">
                <div class="text-center mb-4 border-bottom border-secondary pb-4 mt-2">
                    <h5 class="fw-bold text-primary mb-1">Admin Panel</h5>
                    <small class="text-light opacity-75">Perpustakaan Digital</small>
                </div>
                
                <nav class="nav flex-column gap-2 mb-auto mt-2">
                    <a href="dashboard.php" class="btn btn-outline-light text-start border-0 <?= (empty($_GET['halaman'])) ? 'active bg-primary text-white' : '' ?>">Dashboard</a>
                    <a href="?halaman=data_buku" class="btn btn-outline-light text-start border-0 <?= (isset($_GET['halaman']) && $_GET['halaman'] == 'data_buku') ? 'active bg-primary text-white' : '' ?>">Data Buku</a>
                    <a href="?halaman=data_anggota" class="btn btn-outline-light text-start border-0 <?= (isset($_GET['halaman']) && $_GET['halaman'] == 'data_anggota') ? 'active bg-primary text-white' : '' ?>">Data Anggota</a>
                    <a href="?halaman=data_peminjaman" class="btn btn-outline-light text-start border-0 <?= (isset($_GET['halaman']) && $_GET['halaman'] == 'data_peminjaman') ? 'active bg-primary text-white' : '' ?>">Peminjaman</a>
                </nav>
                
                <div class="mt-5 border-top border-secondary pt-4">
                    <a href="logout.php" class="btn btn-danger w-100 fw-bold">Logout</a>
                </div>
            </aside>

            <main class="col-md-9 col-lg-10 p-4 p-md-5 bg-light h-100 overflow-auto">
                
                <div class="card border-0 shadow-sm p-4 p-md-5 rounded-4 bg-white">
                    <?php
                    $halaman = isset($_GET['halaman']) ? $_GET['halaman'] : "";
                    if(file_exists($halaman . ".php")){
                        include $halaman . ".php"; 
                    }else{
                        
                        
                        
                        $q_anggota = mysqli_query($koneksi, "SELECT COUNT(id_anggota) AS total FROM anggota");
                        $jml_anggota = mysqli_fetch_assoc($q_anggota)['total'];

                        
                        $q_buku = mysqli_query($koneksi, "SELECT COUNT(id_buku) AS total FROM buku");
                        $jml_buku = mysqli_fetch_assoc($q_buku)['total'];

                        
                        $q_pinjam = mysqli_query($koneksi, "SELECT COUNT(id_transaksi) AS total FROM transaksi WHERE status='peminjaman'");
                        $jml_pinjam = mysqli_fetch_assoc($q_pinjam)['total'];
                    ?>
                        
                        <div class="mb-5">
                            <h3 class="text-dark fw-bold mb-2">Selamat Datang, <?= $_SESSION['nama_admin']; ?>! 🌟</h3>
                            <p class="text-muted">
                                Aplikasi perpustakaan digital ini memudahkan Anda dalam mengelola sirkulasi peminjaman buku secara efisien.
                            </p>
                        </div>

                        <div class="row g-4 mb-4">
                            
                            <div class="col-md-4">
                                <div class="card stat-card border-0 bg-primary bg-opacity-10 rounded-4 h-100 p-3">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                              <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                            </svg>
                                        </div>
                                        <div class="ms-4">
                                            <h6 class="text-muted mb-1 fw-semibold">Total Anggota</h6>
                                            <h2 class="mb-0 fw-bold text-primary"><?= $jml_anggota; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card stat-card border-0 bg-success bg-opacity-10 rounded-4 h-100 p-3">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="bg-success text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
                                              <path d="M8 1.783C7.015.936 5.587.814 5 1c-.5.163-2.148.52-2.92.83C1.196 2.186 1 2.452 1 2.82v11c0 .346.196.63.49.79.28.15.59.18.91.07.72-.25 2.14-.64 2.92-.83.58-.14 2.01-.28 2.92.56.91-.84 2.34-.7 2.92-.56.78.19 2.2.58 2.92.83.32.11.63.08.91-.07.29-.16.49-.44.49-.79v-11c0-.368-.196-.634-.49-.81-.77-.31-2.42-.67-2.92-.83-.58-.186-2.01-.064-2.92.783Z"/>
                                            </svg>
                                        </div>
                                        <div class="ms-4">
                                            <h6 class="text-muted mb-1 fw-semibold">Total Judul Buku</h6>
                                            <h2 class="mb-0 fw-bold text-success"><?= $jml_buku; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card stat-card border-0 bg-warning bg-opacity-10 rounded-4 h-100 p-3">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="bg-warning text-dark rounded-circle d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                                              <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z"/>
                                            </svg>
                                        </div>
                                        <div class="ms-4">
                                            <h6 class="text-muted mb-1 fw-semibold">Buku Dipinjam</h6>
                                            <h2 class="mb-0 fw-bold text-warning"><?= $jml_pinjam; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php } ?>
                </div>
            </main>
            
        </div>
    </div>
</body>
</html>