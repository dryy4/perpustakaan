<?php 
include '../koneksi.php';
$id = $_GET['id'];
$query_buku = mysqli_query($koneksi,"SELECT * FROM buku WHERE id_buku = '$id'");
$data_buku = mysqli_fetch_array($query_buku);
?>

<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <h4 class="mb-0 fw-bold">Edit Data Buku</h4>
    <a href="?halaman=data_buku" class="btn btn-secondary btn-sm">Kembali</a>
</div>

<div class="card border-0 shadow-sm rounded-4 bg-white">
    <div class="card-body p-4 p-md-5">
        
        <form action="#" method="post" enctype="multipart/form-data">
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label text-muted small">Judul Buku</label>
                        <input value="<?= $data_buku['judul_buku'] ?>" type="text" name="judul_buku" class="form-control" placeholder="Masukkan Judul Buku" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small">Pengarang</label>
                        <input value="<?= $data_buku['pengarang'] ?>" type="text" name="pengarang" class="form-control" placeholder="Nama Pengarang" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small">Penerbit</label>
                        <input value="<?= $data_buku['penerbit'] ?>" type="text" name="penerbit" class="form-control" placeholder="Nama Penerbit" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small">Tahun Terbit</label>
                        <input value="<?= $data_buku['tahun_terbit'] ?>" type="number" name="tahun_terbit" maxLength="4" class="form-control" placeholder="Contoh: 2023" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small">Jumlah Stok Buku</label>
                        <input value="<?= $data_buku['stok'] ?>" type="number" name="stok" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3 text-center p-3 border rounded-3 bg-light">
                        <label class="form-label text-muted small d-block mb-2">Cover Saat Ini</label>
                        <?php if($data_buku['cover'] != "") { ?>
                            <img src="../cover/<?= $data_buku['cover'] ?>" alt="Cover Buku" class="img-fluid rounded shadow-sm mb-3" style="max-height: 200px; object-fit: cover;">
                        <?php } else { ?>
                            <div class="text-muted small mb-3 fst-italic">Belum ada cover</div>
                        <?php } ?>
                        
                        <label class="form-label text-primary small fw-bold">Ganti Cover Buku (Opsional)</label>
                        <input type="file" name="cover_baru" class="form-control form-control-sm" accept="image/*">
                        <small class="text-muted mt-1 d-block" style="font-size: 0.75rem;">Biarkan kosong jika tidak ingin mengubah cover.</small>
                    </div>
                </div>
            </div>

            <hr class="text-muted my-4">
            <button type="submit" name="tombol" class="btn btn-primary px-5 fw-bold rounded-pill">Simpan Perubahan</button>
        </form>

    </div>
</div>

<?php 
if(isset($_POST['tombol'])){
    $judul_buku = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $stok = $_POST['stok'];

    
    if($stok > 0) {
        $status = "tersedia";
    } else {
        $status = "tidak"; 
    }

    $nama_file_baru = $_FILES['cover_baru']['name'];
    $tmp_name = $_FILES['cover_baru']['tmp_name'];

    
    if($nama_file_baru != "") {
    
        $nama_cover_unik = uniqid() . "-" . $nama_file_baru;
        $lokasi_simpan = '../cover/' . $nama_cover_unik;

        if(move_uploaded_file($tmp_name, $lokasi_simpan)){
    
            $cover_lama = $data_buku['cover'];
            if(file_exists("../cover/".$cover_lama) && $cover_lama != ""){
                unlink("../cover/".$cover_lama); 
            }

            
            $query = "UPDATE buku SET 
                        judul_buku = '$judul_buku', 
                        pengarang = '$pengarang', 
                        penerbit = '$penerbit', 
                        tahun_terbit = '$tahun_terbit', 
                        stok = '$stok',
                        status = '$status', 
                        cover = '$nama_cover_unik' 
                        WHERE id_buku='$id'";

        } else {
            echo "<script> alert('Gagal mengupload cover baru!'); window.location.assign('?halaman=edit_buku&id=$id');</script>";
            exit;
        }

    } else {
        $query = "UPDATE buku SET 
                    judul_buku = '$judul_buku', 
                    pengarang = '$pengarang', 
                    penerbit = '$penerbit', 
                    tahun_terbit = '$tahun_terbit',
                    stok = '$stok', 
                    status = '$status' 
                    WHERE id_buku='$id'";
    }

    $data = mysqli_query($koneksi, $query);

    if($data){
        echo "<script> alert('Data berhasil diperbarui!'); window.location.assign('?halaman=data_buku');</script>";
    }else{
        echo "<script> alert('Data gagal diperbarui!'); window.location.assign('?halaman=edit_buku&id=$id');</script>";
    }
}
?>