<div class="d-flex justify-content-between align-items-center mb-3 mt-2">
    <h4 class="mb-0 fw-bold">Data Anggota Perpustakaan</h4>
    <a href="?halaman=input_anggota" class="btn btn-primary rounded-pill px-4">+ Tambah Anggota</a>
</div>

<div class="table-responsive bg-white p-3 rounded-4 shadow-sm border-0">
    <table class="table table-hover align-middle text-center mb-0">
        <thead class="table-light">
            <tr class="fw-bold text-muted small text-uppercase">
                <th class="py-3">No</th>
                <th class="py-3">NIS</th>
                <th class="py-3">Nama Anggota</th>
                <th class="py-3">Kelas</th>
                <th class="py-3">Username</th>
                <th class="py-3">Password</th>
                <th class="py-3">Kelola</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $no = 1;
            include '../koneksi.php';
            $query = "SELECT * FROM anggota ORDER BY id_anggota DESC";
            $data = mysqli_query($koneksi, $query);
            
            if(mysqli_num_rows($data) > 0) {
                foreach($data as $anggota){ ?>
                <tr class="border-bottom">
                    <td class="text-muted"><?= $no++; ?></td>
                    <td class="fw-semibold"><?= $anggota['nis'] ?></td>
                    <td class="text-start"><?= $anggota['nama_anggota'] ?></td>
                    <td><?= $anggota['kelas'] ?></td>
                    <td><span class="badge bg-secondary bg-opacity-10 text-dark border"><?= $anggota['username'] ?></span></td>
                    
                    <td><span class="text-muted small fst-italic">*** Terenkripsi ***</span></td>
                    
                    <td>
                        <a href="?halaman=edit_anggota&id=<?= $anggota['id_anggota'] ?>" class="btn btn-warning btn-sm rounded-pill px-3">Edit</a>
                        <a href="?halaman=hapus_anggota&id=<?= $anggota['id_anggota'] ?>" onclick="return confirm('Yakin ingin menghapus anggota <?= $anggota['nama_anggota'] ?>?')" class="btn btn-danger btn-sm rounded-pill px-3">Hapus</a>
                    </td>
                </tr>
            <?php } 
            } else { ?>
                <tr>
                    <td colspan="7" class="py-5 text-muted">Belum ada data anggota.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>