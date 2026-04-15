<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <h4 class="mb-0 fw-bold">Tambah Data Anggota</h4>
    <a href="?halaman=data_anggota" class="btn btn-secondary btn-sm">Kembali</a>
</div>

<div class="card border-0 shadow-sm rounded-4 bg-white">
    <div class="card-body p-4 p-md-5">
        
        <form action="#" method="post">
            <div class="mb-3">
                <label class="form-label text-muted small">NIS</label>
                <input type="number" name="nis" class="form-control" placeholder="Masukkan Nomor Induk Siswa" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label text-muted small">Nama Anggota</label>
                <input type="text" name="nama_anggota" class="form-control" placeholder="Nama Lengkap Siswa" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-muted small">Kelas</label>
                <input type="text" name="kelas" class="form-control" placeholder="Contoh: XII RPL 1" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label text-muted small">Username Login</label>
                <input type="text" name="username" class="form-control" placeholder="Buat Username" required>
            </div>
            
            <div class="mb-4">
                <label class="form-label text-muted small">Password Login</label>
                <input type="password" name="password" class="form-control" placeholder="Buat Password" required>
            </div>
            
            <hr class="text-muted my-4">
            <button type="submit" name="tombol" class="btn btn-primary px-5 fw-bold rounded-pill">Simpan Data Anggota</button>
        </form>

    </div>
</div>

<?php 
if(isset($_POST['tombol'])){
    include '../koneksi.php';
    $nis = $_POST['nis'];
    $nama_anggota = $_POST['nama_anggota'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $kelas = $_POST['kelas'];
    
    $query = "INSERT INTO anggota(nis, nama_anggota, username, password, kelas) VALUES ('$nis', '$nama_anggota', '$username', '$password', '$kelas')";
    $data = mysqli_query($koneksi, $query);
    
    if($data){
        echo "<script> alert('Data anggota berhasil ditambahkan!'); window.location.assign('?halaman=data_anggota');</script>";
    }else{
        echo "<script> alert('Gagal menyimpan data anggota!'); window.location.assign('?halaman=input_anggota');</script>";
    }
}   
?>