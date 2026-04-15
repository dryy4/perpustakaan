<?php 

$id_transaksi = $_GET['id'];

$cek_transaksi = mysqli_query($koneksi, "SELECT id_buku, status FROM transaksi WHERE id_transaksi='$id_transaksi'");
$data_transaksi = mysqli_fetch_assoc($cek_transaksi);

$id_buku = $data_transaksi['id_buku'];
$status_transaksi = $data_transaksi['status'];

$hapus = mysqli_query($koneksi, "DELETE FROM transaksi WHERE id_transaksi='$id_transaksi'");

if($hapus){
    if($status_transaksi == 'peminjaman') {
        mysqli_query($koneksi, "UPDATE buku SET stok = stok + 1 WHERE id_buku = '$id_buku'");
    }

    echo"<script>alert('Data transaksi berhasil dihapus!'); window.location.assign('?halaman=data_peminjaman');</script>";
} else {
    echo"<script>alert('Gagal menghapus data transaksi!'); window.location.assign('?halaman=data_peminjaman');</script>";
}
?>