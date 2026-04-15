<div class="d-flex justify-content-between align-items-center mb-3 mt-2">
    <h4 class="mb-0">Data Buku</h4>
    <a href="?halaman=input_buku" class="btn btn-primary">+ Tambah Buku</a>
</div>

<div class="table-responsive bg-white p-3 rounded-3 shadow-sm border-0">
    <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-light">
            <tr class="fw-bold">
                <td>No</td>
                <td>Cover</td>
                <td>Judul Buku</td>
                <td>Pengarang</td>
                <td>Penerbit</td>
                <td>Tahun</td>
                <td>Stok</td> 
                <td>Kelola</td>
            </tr>
        </thead>
        <tbody>
        <?php 
        $no = 1 ;
        include '../koneksi.php';
        $query = "SELECT * FROM buku ORDER BY id_buku DESC";
        $data = mysqli_query($koneksi, $query);
        foreach($data as $buku){?>
            <tr>
                <td><?= $no++; ?></td>
                <td>
                    <?php if(!empty($buku['cover'])) { ?>
                        <img src="../cover/<?= $buku['cover'] ?>" alt="Cover" width="60" class="rounded shadow-sm" style="object-fit: cover;">
                    <?php } else { ?>
                        <span class="text-muted small fst-italic">Kosong</span>
                    <?php } ?>
                </td>
                <td class="text-start fw-semibold"><?= $buku['judul_buku'] ?></td>
                <td><?= $buku['pengarang'] ?></td>
                <td><?= $buku['penerbit'] ?></td>
                <td><?= $buku['tahun_terbit'] ?></td>
                <td>
                    <?php if($buku['stok'] > 0) { ?>
                        <span class="badge bg-success rounded-pill px-3 py-2"><?= $buku['stok'] ?> Tersedia</span>
                    <?php } else { ?>
                        <span class="badge bg-danger rounded-pill px-3 py-2">Stok Habis</span>
                    <?php } ?>
                </td>
                <td>
                    <a href="?halaman=edit_buku&id=<?= $buku['id_buku'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?halaman=hapus_buku&id=<?= $buku['id_buku'] ?>" onclick="return confirm('Yakin data dihapus?')" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>