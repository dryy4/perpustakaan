<?php 
$id_transaksi = $_GET['id'];
$id_buku = $_GET['buku'];

date_default_timezone_set("Asia/Jakarta");
$tgl_kembali = date('Y-m-d H:i:s');

$query = "UPDATE transaksi SET tgl_kembali='$tgl_kembali', status='pengembalian' WHERE id_transaksi='$id_transaksi'";
$data = mysqli_query($koneksi, $query);

if($data){
    mysqli_query($koneksi, "UPDATE buku SET stok = stok + 1 WHERE id_buku = '$id_buku'");
    
    echo"<script>alert('Buku berhasil dikonfirmasi kembali dan stok telah bertambah!'); window.location.assign('?halaman=data_peminjaman');</script>";
} else {
    echo"<script>alert('Gagal mengkonfirmasi pengembalian!'); window.location.assign('?halaman=data_peminjaman');</script>";
}
?>