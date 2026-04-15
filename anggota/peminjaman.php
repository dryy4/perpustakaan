<?php 
// Pastikan file ini dipanggil melalui dashboard.php yang sudah ada session_start()
if(empty($_SESSION['id_anggota'])) {
    header("location:../login-anggota.php");
    exit;
}

include '../koneksi.php';
date_default_timezone_set("Asia/Jakarta");

$id_buku = $_GET['id']; 
$id_anggota = $_SESSION['id_anggota'];
$tgl = date('Y-m-d H:i:s');

// VALIDASI 1: Cek batas maksimal (3 buku). 
// Hitung yang statusnya 'peminjaman' (sedang dibaca) DAN 'menunggu_persetujuan' (sedang diajukan)
$cek_batas = mysqli_query($koneksi, "SELECT COUNT(id_transaksi) as total_pinjam FROM transaksi WHERE id_anggota='$id_anggota' AND status IN ('peminjaman', 'menunggu_persetujuan')");
$data_batas = mysqli_fetch_assoc($cek_batas);

if($data_batas['total_pinjam'] >= 3) {
    echo "<script>alert('Gagal! Kamu sudah mencapai batas maksimal (3 buku aktif/diajukan). Kembalikan buku sebelumnya terlebih dahulu.'); window.location.assign('dashboard.php');</script>";
    exit; 
}

// VALIDASI 2: Cek apakah buku yang sama sedang dipinjam atau sedang diajukan
$cek_duplikat = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_anggota='$id_anggota' AND id_buku='$id_buku' AND status IN ('peminjaman', 'menunggu_persetujuan')");

if(mysqli_num_rows($cek_duplikat) > 0) {
    echo "<script>alert('Gagal! Kamu sedang meminjam (atau sedang mengajukan) buku ini.'); window.location.assign('dashboard.php');</script>";
    exit;
}

// PROSES INSERT: Status diset 'menunggu_persetujuan'
// STOK BUKU TIDAK DIKURANGI DI SINI. (Stok dikurangi oleh Admin saat menyetujui)
$query = "INSERT INTO transaksi(id_anggota, id_buku, tgl_pinjam, status) VALUES('$id_anggota', '$id_buku', '$tgl', 'menunggu_persetujuan')";
$data = mysqli_query($koneksi, $query);

if($data){
    echo"<script>alert('Pengajuan pinjaman terkirim! Silakan tunggu persetujuan Admin.'); window.location.assign('dashboard.php');</script>";
} else {
    echo"<script>alert('Terjadi kesalahan database, gagal meminjam buku!'); window.location.assign('dashboard.php');</script>";
}
?>