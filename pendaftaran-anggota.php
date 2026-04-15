<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Anggota - Perpustakaan Digital Sekolah</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container min-vh-100 d-flex justify-content-center align-items-center py-5">
        
        <div class="col-12 col-md-8 col-lg-5">
            
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    
                    <form action="#" method="post">
                        <div class="text-center mb-4">
                            <h4 class="fw-bold text-primary mb-1">Pendaftaran Anggota</h4>
                            <p class="text-muted small">Aplikasi Perpustakaan Digital Sekolah</p>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nis" class="form-control rounded-3" id="floatingNis" placeholder="NIS" required autocomplete="off">
                            <label for="floatingNis" class="text-muted">Nomor Induk Siswa (NIS)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="nama_anggota" class="form-control rounded-3" id="floatingNama" placeholder="Nama Anggota" required autocomplete="off">
                            <label for="floatingNama" class="text-muted">Nama Lengkap</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="username" class="form-control rounded-3" id="floatingUsername" placeholder="Username" required autocomplete="off">
                            <label for="floatingUsername" class="text-muted">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword" class="text-muted">Password</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" name="kelas" class="form-control rounded-3" id="floatingKelas" placeholder="Kelas" required autocomplete="off">
                            <label for="floatingKelas" class="text-muted">Kelas (Contoh: X-A)</label>
                        </div>
                        <button type="submit" name="tombol" class="btn btn-primary btn-lg w-100 mb-4 fw-semibold rounded-3 shadow-sm">
                            Daftar Sekarang
                        </button>
                        <div class="text-center mt-3 border-top pt-4">
                            <p class="text-muted small mb-2">Sudah memiliki akun?</p>
                            <div class="d-flex justify-content-center gap-3">
                                <a href="login-anggota.php" class="text-decoration-none text-primary small fw-bold">
                                    Login Anggota
                                </a>
                                <span class="text-muted small">|</span>
                                <a href="login-admin.php" class="text-decoration-none text-secondary small text-hover-primary">
                                    Login Admin
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php 

if(isset($_POST['tombol'])){
    include 'koneksi.php';
    $nis = $_POST['nis'];
    $nama_anggota = $_POST['nama_anggota'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $kelas = $_POST['kelas'];
    
    $query = "INSERT INTO anggota(nis, nama_anggota, username, password, kelas) VALUES ('$nis', '$nama_anggota', '$username', '$password', '$kelas')";
    $data = mysqli_query($koneksi, $query);
    
    if($data){
        session_start();
        $_SESSION['id_anggota'] = mysqli_insert_id($koneksi);
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['nama_anggota'] = $nama_anggota;
        echo"<script>alert('Pendaftaran Berhasil'); window.location.assign('anggota/dashboard.php');</script>";
    }else{
        echo"<script>alert('Pendaftaran Gagal'); window.location.assign('pendaftaran-anggota.php');</script>";
    }
}
?>