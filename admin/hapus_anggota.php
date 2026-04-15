<?php
$id = $_GET['id'];
include '../koneksi.php';
$query = "DELETE FROM anggota WHERE id_anggota = '$id'";
$data = mysqli_query($koneksi, $query);
if($data){
    echo "<script> alert('data berhasil dihapus'); window.location.assign('?halaman=data_anggota');</script>";
}else{
    echo "<script> alert('data gagal dihapus'); window.location.assign('?halaman=data_anggota');</script>";
}
header("Location:?halaman=data_anggota");
?>