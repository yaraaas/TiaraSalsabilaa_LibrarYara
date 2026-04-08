<?php include 'koneksi.php'; proteksi(); include 'header.php'; 
$b = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM buku"));
$a = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM anggota"));
$p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM transaksi WHERE status='Dipinjam'"));
?>
<div class="container py-4">
    <div id="hero" class="carousel slide card-yara overflow-hidden mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?q=80&w=1500" class="d-block w-100" style="height:350px; object-fit:cover;">
                <div class="carousel-caption d-none d-md-block text-start bg-white bg-opacity-75 p-4 rounded-4 text-dark" style="left:5%; bottom:10%;">
                    <h2 class="fw-bold">Selamat Datang, Yara! 🌸</h2>
                    <p>Waktunya menata ilmu dan memanen kebijaksanaan.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4 text-center animate__animated animate__fadeInUp">
        <div class="col-md-4"><div class="card-yara p-4 border-bottom border-4 border-info"><h6>TOTAL BUKU</h6><h2 class="fw-bold"><?= $b['t'] ?></h2></div></div>
        <div class="col-md-4"><div class="card-yara p-4 border-bottom border-4 border-success"><h6>TOTAL ANGGOTA</h6><h2 class="fw-bold"><?= $a['t'] ?></h2></div></div>
        <div class="col-md-4"><div class="card-yara p-4 border-bottom border-4 border-danger"><h6>SEDANG DIPINJAM</h6><h2 class="fw-bold"><?= $p['t'] ?></h2></div></div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>