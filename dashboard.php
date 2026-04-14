<?php 
include 'koneksi.php'; 
proteksi(); 
include 'header.php'; 

// Data Intelligence
$b = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM buku"));
$a = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM anggota"));
$p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM transaksi WHERE status='Dipinjam'"));
?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;1,600&family=Instrument+Serif:ital@1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --coquette-pink: #FFB7C5;
        --soft-rose: #FF85A2;
        --aesthetic-white: #FFFBFC;
        --glass: rgba(255, 255, 255, 0.7);
        --text-dark: #3D3335;
    }

    body {
        background: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--text-dark);
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* Ambient Background Decor */
    .blob {
        position: fixed;
        width: 500px;
        height: 500px;
        background: var(--coquette-pink);
        filter: blur(120px);
        border-radius: 50%;
        z-index: -1;
        opacity: 0.3;
        animation: move 20s infinite alternate;
    }

    @keyframes move {
        from { transform: translate(-10%, -10%); }
        to { transform: translate(20%, 20%); }
    }

    .container-genz {
        max-width: 1200px;
        margin: 50px auto;
        padding: 0 25px;
    }

    /* Header Branding */
    .brand-suite {
        text-align: center;
        margin-bottom: 60px;
    }

    .brand-title {
        font-family: 'Playfair Display', serif;
        font-size: 4.5rem;
        font-weight: 600;
        margin: 0;
        letter-spacing: -2px;
    }

    .brand-title span {
        font-family: 'Instrument Serif', serif;
        font-style: italic;
        color: var(--soft-rose);
    }

    /* Minimalist Glass Cards */
    .card-glass {
        background: var(--glass);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 40px;
        padding: 40px;
        transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .card-glass:hover {
        transform: translateY(-10px);
        background: rgba(255, 255, 255, 0.9);
        box-shadow: 0 25px 50px rgba(255, 183, 197, 0.2);
    }

    .stat-label {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: var(--soft-rose);
        display: block;
        margin-bottom: 15px;
    }

    .stat-value {
        font-size: 4rem;
        font-weight: 800;
        line-height: 1;
        margin: 0;
    }

    /* Bento Box Layout */
    .bento-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
        margin-top: 40px;
    }

    .quick-btn {
        background: white;
        padding: 20px;
        border-radius: 25px;
        text-decoration: none;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 15px;
        font-weight: 600;
        margin-bottom: 15px;
        border: 1px solid transparent;
        transition: 0.3s;
    }

    .quick-btn:hover {
        background: var(--soft-rose);
        color: white;
        transform: translateX(10px);
    }

    .quick-btn i { font-size: 1.2rem; }

    /* Table Styling */
    .table-aesthetic th {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        padding-bottom: 20px;
        opacity: 0.5;
    }

    /* Ribbon Icon Decor */
    .ribbon-icon {
        position: absolute;
        top: -15px;
        right: 20px;
        font-size: 2rem;
        color: var(--coquette-pink);
        transform: rotate(15deg);
    }

    #clock {
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--soft-rose);
        background: #fff;
        padding: 8px 20px;
        border-radius: 100px;
        display: inline-block;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.03);
    }
</style>

<div class="blob"></div>

<div class="container-genz">
    <div class="brand-suite animate__animated animate__fadeIn">
        <div id="clock">00:00:00</div>
        <h1 class="brand-title">Librar<span>Yara.</span></h1>
        <p class="opacity-50 fw-medium">‎₊˚⊹ 𐦍༘⋆₊ ⊹</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
            <div class="card-glass">
                <i class="fa-solid fa-ribbon ribbon-icon"></i>
                <span class="stat-label">Total Books</span>
                <h2 class="stat-value"><?= number_format($b['t']) ?></h2>
            </div>
        </div>
        <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
            <div class="card-glass">
                <i class="fa-solid fa-heart ribbon-icon"></i>
                <span class="stat-label">Members</span>
                <h2 class="stat-value"><?= number_format($a['t']) ?></h2>
            </div>
        </div>
        <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
            <div class="card-glass">
                <i class="fa-solid fa-star ribbon-icon"></i>
                <span class="stat-label">On Loan</span>
                <h2 class="stat-value"><?= number_format($p['t']) ?></h2>
            </div>
        </div>
    </div>

    <div class="bento-grid">
        <div class="card-glass animate__animated animate__fadeInLeft">
            <h5 class="fw-bold mb-4" style="font-family:'Playfair Display'">Activity Feed</h5>
            <div class="table-responsive">
                <table class="table table-borderless table-aesthetic align-middle">
                    <thead>
                        <tr>
                            <th>Member</th>
                            <th>Book Title</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $recent = mysqli_query($conn, "SELECT t.*, a.nama, b.judul FROM transaksi t JOIN anggota a ON t.id_anggota=a.id_anggota JOIN buku b ON t.id_buku=b.id_buku ORDER BY id_transaksi DESC LIMIT 4");
                        while($r = mysqli_fetch_assoc($recent)){
                        ?>
                        <tr>
                            <td class="fw-bold py-3"><?= $r['nama'] ?></td>
                            <td class="fst-italic opacity-75"><?= $r['judul'] ?></td>
                            <td class="small opacity-50"><?= date('d M', strtotime($r['tgl_pinjam'])) ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="animate__animated animate__fadeInRight">
            <h6 class="stat-label mb-3">Quick Menu</h6>
            <a href="buku.php" class="quick-btn">
                <i class="fa-solid fa-plus"></i> Add New Book
            </a>
            <a href="transaksi.php" class="quick-btn">
                <i class="fa-solid fa-paper-plane"></i> New Transaction
            </a>
            <a href="laporan.php" class="quick-btn">
                <i class="fa-solid fa-chart-pie"></i> View Reports
            </a>
            
            <div class="mt-4 p-4 text-center card-glass" style="border-radius: 30px;">
                <p class="small m-0 opacity-50">the arcive of </p>
                <p class="fw-bold m-0" style="color:var(--soft-rose)">yara's library</p>
            </div>
        </div>
    </div>
</div>

<script>
    function updateClock() {
        const now = new Date();
        const options = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
        document.getElementById('clock').innerText = now.toLocaleTimeString('en-US', options) + " WIB";
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>
