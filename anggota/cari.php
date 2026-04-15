<?php  
    $cari = isset($_POST['cari']) ? $_POST['cari'] : '';
?>

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 sticky-top bg-white p-3 rounded-4 shadow-sm mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">Hasil Pencarian</h4>
        <p class="text-muted mb-0 small">Menampilkan hasil untuk: <strong class="text-primary">"<?= $cari ?>"</strong></p>
    </div>
    
    <form action="?halaman=cari" method="post" class="m-0">
        <div class="input-group" style="width: 350px;">
            <input type="text" name="cari" value="<?= $cari ?>" class="form-control border-end-0 bg-light py-2 px-4 rounded-start-pill" placeholder="Cari judul buku..." required style="box-shadow: none;">
            <button type="submit" class="btn btn-light border border-start-0 rounded-end-pill px-3 text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </div>
    </form>
</div>

<div class="row g-4 mt-1">
    <?php 
    include '../koneksi.php';
    
    $data_buku = mysqli_query($koneksi, "SELECT * FROM buku WHERE judul_buku LIKE '%$cari%' ORDER BY id_buku DESC");
    
    if(mysqli_num_rows($data_buku) > 0) {
        foreach ($data_buku as $buku) { ?>
        
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card book-card border-0 shadow-sm h-100 rounded-4 bg-white p-2">
                
                <div class="book-cover-wrapper rounded-3 mb-3 position-relative bg-light" style="height: 250px;">
                    
                    <?php if(isset($buku['cover']) && $buku['cover'] != "") { ?>
                        <img src="../cover/<?= $buku['cover'] ?>" alt="<?= $buku['judul_buku'] ?>" class="book-cover-img w-100 h-100" style="object-fit: cover;">
                    <?php } else { ?>
                        <div class="w-100 h-100 d-flex justify-content-center align-items-center text-secondary opacity-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.814 5 1c-.5.163-2.148.52-2.92.83C1.196 2.186 1 2.452 1 2.82v11c0 .346.196.63.49.79.28.15.59.18.91.07.72-.25 2.14-.64 2.92-.83.58-.14 2.01-.28 2.92.56.91-.84 2.34-.7 2.92-.56.78.19 2.2.58 2.92.83.32.11.63.08.91-.07.29-.16.49-.44.49-.79v-11c0-.368-.196-.634-.49-.81-.77-.31-2.42-.67-2.92-.83-.58-.186-2.01-.064-2.92.783z"/>
                            </svg>
                        </div>
                    <?php } ?>

                    <div class="position-absolute top-0 end-0 p-2">
                        <?php if($buku['stok'] > 0){ ?>
                            <span class="badge bg-success shadow-sm rounded-pill px-3 py-2 fw-medium small">
                                Tersedia: <?= $buku['stok'] ?>
                            </span>
                        <?php } else { ?>
                            <span class="badge bg-danger shadow-sm rounded-pill px-3 py-2 fw-medium small">
                                Stok Habis
                            </span>
                        <?php } ?>
                    </div>
                </div>

                <div class="card-body d-flex flex-column p-1 px-2 pb-2">
                    <h6 class="fw-bold text-dark mb-3" style="line-height: 1.4; font-size: 1.05rem;"><?= $buku['judul_buku'] ?></h6>
                    
                    <div class="d-flex flex-column gap-2 mb-4 mt-auto">
                        <div class="d-flex align-items-center text-muted small">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-person me-2 text-primary" viewBox="0 0 16 16"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/></svg>
                            <span class="text-truncate"><?= $buku['pengarang'] ?></span>
                        </div>
                        <div class="d-flex align-items-center text-muted small">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-building me-2 text-primary" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"/><path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"/></svg>
                            <span class="text-truncate"><?= $buku['penerbit'] ?> (<?= $buku['tahun_terbit'] ?>)</span>
                        </div>
                    </div>
                    
                    <?php if($buku['stok'] > 0){ ?>
                        <a href="?halaman=peminjaman&id=<?= $buku['id_buku'] ?>" class="btn btn-primary w-100 rounded-pill py-2 fw-medium" onclick="return confirm('Pinjam buku <?= $buku['judul_buku'] ?> ?')">Pinjam Sekarang</a>
                    <?php }else{ ?>
                        <a href="#" class="btn btn-light text-muted w-100 rounded-pill py-2 fw-medium disabled" style="background-color: #f8f9fa;">Sedang Kosong</a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php } 
    } else { ?>
        
        <div class="col-12 mt-4">
            <div class="card border-0 shadow-sm rounded-4 bg-white text-center py-5">
                <div class="card-body py-5">
                    <div class="mb-4 text-muted opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Buku Tidak Ditemukan</h5>
                    <p class="text-muted mb-4">Maaf, buku dengan kata kunci <strong>"<?= $cari ?>"</strong> tidak tersedia di koleksi kami saat ini.</p>
                    <a href="dashboard.php" class="btn btn-outline-primary rounded-pill px-4">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
        
    <?php } ?>
</div>