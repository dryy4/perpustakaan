<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm rounded-4 mb-5">
        <div class="card-header bg-primary text-white rounded-top-4 py-3">
            <h5 class="mb-0">Persetujuan Peminjaman Baru (Member ingin Pinjam)</h5>
        </div>
        <div class="table-responsive p-3">
            <table class="table table-hover align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>No</th>
                        <th>NIS/Nama</th>
                        <th>Buku</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    include '../koneksi.php';
                    $no = 1;
                    $q1 = mysqli_query($koneksi, "SELECT * FROM transaksi JOIN buku ON transaksi.id_buku=buku.id_buku JOIN anggota ON transaksi.id_anggota=anggota.id_anggota WHERE transaksi.status='menunggu_persetujuan'");
                    while($row = mysqli_fetch_assoc($q1)){ ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><strong><?= $row['nis'] ?></strong><br><small><?= $row['nama_anggota'] ?></small></td>
                        <td><?= $row['judul_buku'] ?></td>
                        <td>
                            <a href="?halaman=proses_validasi&aksi=setujui_pinjam&id=<?= $row['id_transaksi'] ?>&buku=<?= $row['id_buku'] ?>" class="btn btn-sm btn-success rounded-pill px-3">Setujui</a>
                            <a href="?halaman=proses_validasi&aksi=tolak_pinjam&id=<?= $row['id_transaksi'] ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3">Tolak</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-5">
        <div class="card-header bg-warning text-white rounded-top-4 py-3">
            <h5 class="mb-0">Konfirmasi Pengembalian (Verifikasi Fisik Buku)</h5>
        </div>
        <div class="table-responsive p-3">
            <table class="table table-hover align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>No</th>
                        <th>NIS/Nama</th>
                        <th>Buku</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $q2 = mysqli_query($koneksi, "SELECT * FROM transaksi JOIN buku ON transaksi.id_buku=buku.id_buku JOIN anggota ON transaksi.id_anggota=anggota.id_anggota WHERE transaksi.status='menunggu_kembali'");
                    while($row = mysqli_fetch_assoc($q2)){ ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><strong><?= $row['nis'] ?></strong><br><small><?= $row['nama_anggota'] ?></small></td>
                        <td><?= $row['judul_buku'] ?></td>
                        <td>
                            <div class="alert alert-info py-1 px-2 mb-0 d-inline-block small">Pastikan buku fisik sudah diterima!</div>
                            <a href="?halaman=proses_validasi&aksi=konfirmasi_kembali&id=<?= $row['id_transaksi'] ?>&buku=<?= $row['id_buku'] ?>" class="btn btn-sm btn-primary rounded-pill px-3">Buku Sudah Kembali</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-5">
        <div class="card-header bg-success text-white rounded-top-4 py-3">
            <h5 class="mb-0">Data Peminjaman Aktif</h5>
        </div>
    <table class="table table-bordered mt-3 bg-white shadow-sm">
        <tr class="fw-bold bg-light">
            <td>No</td><td>Nis</td><td>Nama Anggota</td><td>Buku</td><td>Tgl Pinjam</td><td>Status</td>
        </tr>
        <?php 
        $no = 1;
        $q3 = mysqli_query($koneksi, "SELECT * FROM transaksi JOIN buku ON transaksi.id_buku=buku.id_buku JOIN anggota ON transaksi.id_anggota=anggota.id_anggota WHERE transaksi.status='peminjaman'");
        foreach($q3 as $row){ ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nis'] ?></td>
            <td><?= $row['nama_anggota'] ?></td>
            <td><?= $row['judul_buku'] ?></td>
            <td><?= date('d-M-Y', strtotime($row['tgl_pinjam'])) ?></td>
            <td><span class="badge bg-info">Sedang Dipinjam</span></td>
        </tr>
        <?php } ?>
    </table>
</div>