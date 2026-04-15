<h4>Tambah Data Buku</h4>
<form action="#" method="post" enctype="multipart/form-data" class="mt-3">
    <input type="text" name="judul_buku" class="form-control mb-2" placeholder="Judul Buku" required>
    <input type="text" name="pengarang" class="form-control mb-2" placeholder="Pengarang" required>
    <input type="text" name="penerbit" class="form-control mb-2" placeholder="Penerbit" required>
    <input type="number" name="tahun_terbit" maxLength="4" class="form-control mb-3" placeholder="Tahun Terbit" required>
    <div class="mb-3">
    <label class="form-label text-muted small">Jumlah Stok Buku</label>
    <input type="number" name="stok" class="form-control" placeholder="Contoh: 15" required>
    </div>
    
    <label class="text-muted small">Upload Cover Buku (JPG/PNG)</label>
    <input type="file" name="cover" class="form-control mb-3" accept="image/*" required>
    
    <button type="submit" name="tombol" class="btn btn-primary w-100">Simpan Data Buku</button>
</form>

<?php 
if(isset($_POST['tombol'])){
    include '../koneksi.php';

    $judul_buku = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $status = "tersedia";
    $stok = $_POST['stok'];

    $nama_file = $_FILES['cover']['name'];
    $tmp_name = $_FILES['cover']['tmp_name'];
    
    $nama_cover_baru = uniqid() . "-" . $nama_file;    
    
    $lokasi_simpan = '../cover/' . $nama_cover_baru;

        if(move_uploaded_file($tmp_name, $lokasi_simpan)){
        
        
        $query ="INSERT INTO buku (judul_buku, pengarang, penerbit, tahun_terbit, stok, status, cover) 
        VALUES ('$judul_buku', '$pengarang', '$penerbit', '$tahun_terbit', '$stok', '$status', '$nama_cover_baru')"; 
        $data = mysqli_query($koneksi, $query);

        if($data){
            echo "<script> alert('Data dan cover berhasil disimpan!'); window.location.assign('?halaman=data_buku');</script>";
        }else{
            echo "<script> alert('Gagal menyimpan ke database'); window.location.assign('?halaman=input_buku');</script>";
        }
        
    } else {
        echo "<script> alert('Gagal mengupload cover buku!'); window.location.assign('?halaman=input_buku');</script>";
    }
}   
?>