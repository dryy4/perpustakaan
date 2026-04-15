<?php 
include '../koneksi.php';
$id = $_GET['id'];
$query_anggota = mysqli_query($koneksi,"SELECT * FROM anggota WHERE id_anggota = '$id'");
$data_anggota = mysqli_fetch_array($query_anggota);
?>

<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <h4 class="mb-0 fw-bold">Edit Data Anggota</h4>
    <a href="?halaman=data_anggota" class="btn btn-secondary btn-sm">Kembali</a>
</div>

<div class="card border-0 shadow-sm rounded-4 bg-white">
    <div class="card-body p-4 p-md-5">
        
        <form action="#" method="post">
            <div class="mb-3">
                <label class="form-label text-muted small">NIS</label>
                <input value="<?= $data_anggota['nis'] ?>" type="number" name="nis" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label text-muted small">Nama Anggota</label>
                <input value="<?= $data_anggota['nama_anggota'] ?>" type="text" name="nama_anggota" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-muted small">Kelas</label>
                <input value="<?= $data_anggota['kelas'] ?>" type="text" name="kelas" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label text-muted small">Username</label>
                <input value="<?= $data_anggota['username'] ?>" type="text" name="username" class="form-control" required>
            </div>
            
            <div class="mb-4 p-3 bg-light rounded-3 border">
                <label class="form-label text-primary fw-bold small">Ganti Password (Opsional)</label>
                <input type="password" name="password" class="form-control" placeholder="Ketik password baru...">
                <small class="text-muted mt-1 d-block" style="font-size: 0.75rem;">Biarkan kosong jika tidak ingin mengubah password anggota ini.</small>
            </div>
            
            <hr class="text-muted my-4">
            <button type="submit" name="tombol" class="btn btn-primary px-5 fw-bold rounded-pill">Simpan Perubahan</button>
        </form>

    </div>
</div>

<?php 
if(isset($_POST['tombol'])){
    $nis = $_POST['nis'];
    $nama_anggota = $_POST['nama_anggota'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $kelas = $_POST['kelas'];

    // LOGIKA PERBAIKAN PASSWORD
    // Jika kolom password diisi (tidak kosong), maka ikut di-update
    if(!empty($password)) {
        $query = "UPDATE anggota SET nis='$nis', nama_anggota='$nama_anggota', username='$username', password='$password', kelas='$kelas' WHERE id_anggota='$id'";
    } else {
        // Jika kolom password kosong, update data lain TANPA menyentuh password
        $query = "UPDATE anggota SET nis='$nis', nama_anggota='$nama_anggota', username='$username', kelas='$kelas' WHERE id_anggota='$id'";
    }

    $data = mysqli_query($koneksi, $query);

    if($data){
        echo "<script> alert('Data anggota berhasil diperbarui!'); window.location.assign('?halaman=data_anggota');</script>";
    }else{
        echo "<script> alert('Gagal memperbarui data!'); window.location.assign('?halaman=edit_anggota&id=$id');</script>";
    }
}
?>