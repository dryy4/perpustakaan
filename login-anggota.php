<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Anggota - Perpustakaan Digital</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        
        <div class="col-12 col-md-6 col-lg-4">
            
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    
                    <form action="#" method="post">
                        <div class="text-center mb-4">
                            <h4 class="fw-bold text-primary mb-1">Login Anggota</h4>
                            <p class="text-muted small">Aplikasi Perpustakaan Digital Sekolah</p>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="text" name="username" class="form-control rounded-3" id="floatingUsername" placeholder="Username" required autocomplete="off">
                            <label for="floatingUsername" class="text-muted">Username</label>
                        </div>
                        
                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword" class="text-muted">Password</label>
                        </div>
                        
                        <button type="submit" name="tombol" class="btn btn-primary btn-lg w-100 mb-3 fw-semibold rounded-3 shadow-sm">
                            Login
                        </button>
                        
                        <div class="text-center mt-3 border-top pt-4">
                            <div class="d-flex flex-column gap-2">
                                <a href="pendaftaran-anggota.php" class="text-decoration-none text-primary small fw-bold">
                                    Belum punya akun? Daftar di sini
                                </a>
                                <a href="login-admin.php" class="text-decoration-none text-secondary small">
                                    Login sebagai Admin Perpustakaan
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
// Logic PHP tidak diubah sama sekali
if(isset($_POST['tombol'])){
    include 'koneksi.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM anggota WHERE username='$username' AND password='$password'";
    $data = mysqli_query($koneksi, $query);
    if(mysqli_num_rows($data)>0){
        $data = mysqli_fetch_array($data);
        session_start();
        $_SESSION['id_anggota'] = $data['id_anggota'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama_anggota'] = $data['nama_anggota'];
        header("Location:anggota/dashboard.php");
    }else{
        echo"<script>alert('Login Gagal Pastikan Username dan Password benar'); window.location.assign('login-anggota.php');</script>";
    }
}
?>