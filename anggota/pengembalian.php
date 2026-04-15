<?php 
// Pastikan file ini dipanggil melalui dashboard.php yang sudah ada session_start()
if(empty($_SESSION['id_anggota'])) {
    header("location:../login-anggota.php");
    exit; 
}

include '../koneksi.php';
date_default_timezone_set("Asia/Jakarta");

$id = $_GET['id']; 
$buku = $_GET['buku'];

// PROSES UPDATE: Status diset 'menunggu_kembali'. 
// Tanggal kembali tidak diisi dulu (biar Admin yang mengisi saat fisik kembali)
// STOK BUKU TIDAK DITAMBAH DI SINI. (Stok ditambah oleh Admin saat verifikasi)
$query = "UPDATE transaksi SET status='menunggu_kembali' WHERE id_transaksi='$id'";
$data = mysqli_query($koneksi, $query);

if($data){
    echo"<script>alert('Terima kasih! Silakan serahkan buku fisik ke Admin untuk verifikasi pengembalian.'); window.location.assign('dashboard.php');</script>";
} else {
    echo"<script>alert('Terjadi kesalahan, gagal memproses pengembalian!'); window.location.assign('dashboard.php');</script>";
}
?>