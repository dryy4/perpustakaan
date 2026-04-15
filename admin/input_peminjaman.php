<?php 
include '../koneksi.php';

$anggota = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY nama_anggota ASC");
$buku = mysqli_query($koneksi, "SELECT * FROM buku WHERE stok > 0 ORDER BY judul_buku ASC");
?>

<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <h4 class="mb-0 fw-bold">Tambah Data Peminjaman</h4>
    <a href="?halaman=data_peminjaman" class="btn btn-secondary btn-sm">Kembali</a>
</div>

<div class="card border-0 shadow-sm rounded-4 bg-white">
    <div class="card-body p-4 p-md-5">
        
        <form action="#" method="post">
            <div class="mb-3">
                <label class="form-label text-muted small">Pilih Anggota</label>
                <select name="id_anggota" class="form-select" required>
                    <option value="" selected disabled>-- Klik untuk Pilih Anggota --</option>
                    <?php 
                    foreach($anggota as $data){
                        echo "<option value='{$data['id_anggota']}'>{$data['nis']} - {$data['nama_anggota']}</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label text-muted small">Pilih Buku (Hanya yang berstok)</label>
                <select name="id_buku" class="form-select" required>
                    <option value="" selected disabled>-- Klik untuk Pilih Buku --</option>
                    <?php 
                    foreach($buku as $data){
                        echo "<option value='{$data['id_buku']}'>{$data['judul_buku']} (Sisa Stok: {$data['stok']})</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="mb-4">
                <label class="form-label text-muted small">Tanggal Peminjaman</label>
                <input type="datetime-local" name="tgl_pinjam" class="form-control" required>
                <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">Format: Bulan / Hari / Tahun - Jam : Menit</small>
            </div>
            
            <hr class="text-muted my-4">
            <button type="submit" class="btn btn-primary px-5 fw-bold rounded-pill" name="tombol">Simpan Peminjaman</button>
        </form>
    </div>
</div>

<?php 
if(isset($_POST['tombol'])){
    $id_anggota = $_POST['id_anggota'];
    $id_buku = $_POST['id_buku'];
    
    date_default_timezone_set("Asia/Jakarta");
    $tgl_pinjam = date('Y-m-d H:i:s', strtotime($_POST['tgl_pinjam']));
    
    $cek_batas = mysqli_query($koneksi, "SELECT COUNT(id_transaksi) as total_pinjam FROM transaksi WHERE id_anggota='$id_anggota' AND status='peminjaman'");
    $data_batas = mysqli_fetch_assoc($cek_batas);

    if($data_batas['total_pinjam'] >= 3) {
        echo "<script>alert('Gagal! Anggota ini sudah mencapai batas maksimal (3 buku yang belum dikembalikan).'); window.location.assign('?halaman=input_peminjaman');</script>";
        exit;
    }

    $cek_duplikat = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_anggota='$id_anggota' AND id_buku='$id_buku' AND status='peminjaman'");
    
    if(mysqli_num_rows($cek_duplikat) > 0) {
        echo "<script>alert('Gagal! Anggota ini sedang meminjam buku yang sama dan belum dikembalikan.'); window.location.assign('?halaman=input_peminjaman');</script>";
        exit;
    }

    $query = "INSERT INTO transaksi(id_anggota, id_buku, tgl_pinjam, status) VALUES ('$id_anggota', '$id_buku', '$tgl_pinjam', 'peminjaman')";
    $data = mysqli_query($koneksi, $query);

    if($data){
        mysqli_query($koneksi, "UPDATE buku SET stok = stok - 1 WHERE id_buku='$id_buku'");
        
        echo"<script>alert('Data peminjaman berhasil tersimpan!'); window.location.assign('?halaman=data_peminjaman');</script>";
    }else{
        echo"<script>alert('Data peminjaman gagal tersimpan!'); window.location.assign('?halaman=input_peminjaman');</script>";
    }
}
?>