<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Aplikasi Perpustakaan Digital Sekolah</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        
        <div class="col-12 col-md-6 col-lg-4">
            
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    
                    <form action="#" method="post">
                        <div class="text-center mb-4">
                            <h4 class="fw-bold text-primary mb-1">Login Admin</h4>
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
                        
                        <div class="text-center mt-2">
                            <a href="login-anggota.php" class="text-decoration-underline text-secondary small text-hover-primary">
                                Login sebagai anggota perpustakaan
                            </a>
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
    include "koneksi.php";
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $data = mysqli_query($koneksi, $query);
    if(mysqli_num_rows($data) > 0){
        $data = mysqli_fetch_array($data);
        session_start();
        $_SESSION['id_admin'] = $data['id_admin'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama_admin'] = $data['nama_admin'];
        header("Location:admin/dashboard.php");
    } else {
        echo "<script>alert('Login Gagal, pastikan username dan password benar!');</script>";
    }
}
?>