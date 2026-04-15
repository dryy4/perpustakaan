<?php 
$server = "localhost";
$user = "root";
$password = "";
$database = "perpustakaan";

$koneksi = mysqli_connect($server, $user, $password, $database);
if(!$koneksi){
    echo"koneksi gagal: ".mysqli_error($koneksi);
}
?>