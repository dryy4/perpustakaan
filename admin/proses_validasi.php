<?php
include '../koneksi.php';
$aksi = $_GET['aksi'];
$id = $_GET['id'];
$id_buku = isset($_GET['buku']) ? $_GET['buku'] : '';

if($aksi == 'setujui_pinjam'){
    date_default_timezone_set("Asia/Jakarta");
    $tgl_pinjam = date('Y-m-d H:i:s');
    $tgl_jatuh_tempo = date('Y-m-d', strtotime('+7 days'));
    
        $update = mysqli_query($koneksi, "UPDATE transaksi SET 
                status='peminjaman', 
                tgl_pinjam='$tgl_pinjam', 
                tgl_jatuh_tempo='$tgl_jatuh_tempo' 
                WHERE id_transaksi='$id'") or die(mysqli_error($koneksi));

    if($update){
        mysqli_query($koneksi, "UPDATE buku SET stok = stok - 1 WHERE id_buku = '$id_buku'");
        echo "<script>alert('Peminjaman Disetujui!'); window.location.href='?halaman=data_peminjaman';</script>";
    }
} elseif($aksi == 'konfirmasi_kembali'){
    date_default_timezone_set("Asia/Jakarta");
    $tgl = date('Y-m-d H:i:s');
    $tgl_hari_ini = date('Y-m-d');
    
    $cek_transaksi = mysqli_query($koneksi, "SELECT tgl_jatuh_tempo FROM transaksi WHERE id_transaksi='$id'");
    $data_t = mysqli_fetch_assoc($cek_transaksi);
    $jatuh_tempo = $data_t['tgl_jatuh_tempo'];
    
    $denda = 0;
    if($tgl_hari_ini > $jatuh_tempo && $jatuh_tempo != null) {
        $selisih_hari = strtotime($tgl_hari_ini) - strtotime($jatuh_tempo);
        $hari_telat = floor($selisih_hari / (60 * 60 * 24));
        $denda = $hari_telat * 1000; 
    }

    mysqli_query($koneksi, "UPDATE transaksi SET status='pengembalian', tgl_kembali='$tgl', denda='$denda' WHERE id_transaksi='$id'");
    mysqli_query($koneksi, "UPDATE buku SET stok = stok + 1 WHERE id_buku = '$id_buku'");
    
    if($denda > 0) {
        echo "<script>alert('Pengembalian Berhasil! Terdapat denda keterlambatan sebesar Rp " . number_format($denda, 0, ',', '.') . "'); window.location.href='?halaman=data_peminjaman';</script>";
    } else {
        echo "<script>alert('Pengembalian Berhasil Tepat Waktu!'); window.location.href='?halaman=data_peminjaman';</script>";
    }
}
?>