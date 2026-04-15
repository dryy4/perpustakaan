<h4>Daftar History Peminjaman🧾:</h4>
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-borderless table-hover align-middle mb-0">
            <thead class="table-light border-bottom">
                <tr class="text-muted small text-uppercase">
                    <th class="ps-4 py-3 fw-medium">No</th>
                    <th class="py-3 fw-medium">Judul Buku</th>
                    <th class="py-3 fw-medium">Tanggal Pinjam</th>
                    <th class="py-3 fw-medium">Tanggal Kembali</th>
                </tr>
            </thead>
            <tbody> 
                <?php 
                $no = 1;
                $query = "SELECT * FROM transaksi, buku WHERE buku.id_buku=transaksi.id_buku AND id_anggota=$_SESSION[id_anggota] AND transaksi.status='pengembalian'";
                $data = mysqli_query($koneksi, $query);
                foreach ($data as $peminjaman){ ?>
                <tr class="border-bottom">
                    <td class="ps-4 text-muted"> <?= $no++; ?></td>
                    <td class="fw-semibold text-dark"> <?= $peminjaman['judul_buku'] ?></td>
                    <td><span class="badge bg-light text-dark fw-normal border px-3 py-2 rounded-pill"><?= date('d-M-Y', strtotime($peminjaman['tgl_pinjam'])); ?></span></td>
                    <td><span class="badge bg-light text-dark fw-normal border px-3 py-2 rounded-pill"><?= date('d-M-Y', strtotime($peminjaman['tgl_kembali'])); ?></span></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>