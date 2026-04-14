<?php 
include 'koneksi.php'; 
proteksi(); 
include 'header.php'; 

if(isset($_POST['add'])){
    $j = mysqli_real_escape_string($conn, $_POST['judul']); 
    $p = mysqli_real_escape_string($conn, $_POST['pengarang']); 
    $s = mysqli_real_escape_string($conn, $_POST['stok']);
    
    mysqli_query($conn, "INSERT INTO buku (judul, pengarang, stok) VALUES ('$j','$p','$s')");
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Arsip Diperbarui',
                showConfirmButton: false,
                timer: 2000,
                background: '#fff5f7'
            }).then(() => { window.location='buku.php'; });
        });
    </script>";
}
?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&family=Playfair+Display:ital,wght@0,800;1,800&family=Instrument+Serif:ital@1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --soft-pink: #FFB7C5;
        --deep-rose: #FF85A2;
        --dark-coffee: #2D2424;
        --glass-bg: rgba(255, 255, 255, 0.6);
    }

    body {
        background: #fdfbfb;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--dark-coffee);
    }

    .main-wrapper {
        max-width: 1300px;
        margin: 40px auto;
        padding: 0 30px;
    }

    /* Hero Section Table Header */
    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 40px;
    }

    .main-title {
        font-family: 'Playfair Display', serif;
        font-size: 4rem;
        line-height: 0.9;
        letter-spacing: -2px;
    }

    .main-title span {
        font-family: 'Instrument Serif', serif;
        font-style: italic;
        color: var(--deep-rose);
    }

    /* Bento Layout Grid */
    .bento-container {
        display: grid;
        grid-template-columns: 350px 1fr;
        gap: 30px;
        align-items: start;
    }

    /* Floating Input Card */
    .sticky-form {
        position: sticky;
        top: 40px;
        background: var(--dark-coffee);
        color: white;
        padding: 40px;
        border-radius: 50px;
        box-shadow: 0 30px 60px rgba(0,0,0,0.15);
    }

    .form-label-custom {
        font-size: 0.65rem;
        font-weight: 800;
        letter-spacing: 2px;
        color: var(--soft-pink);
        margin-bottom: 10px;
        display: block;
    }

    .minimal-input {
        width: 100%;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 20px;
        padding: 15px 20px;
        color: white;
        margin-bottom: 20px;
        transition: 0.3s;
    }

    .minimal-input:focus {
        background: rgba(255,255,255,0.1);
        border-color: var(--soft-pink);
        outline: none;
    }

    .btn-submit-luxury {
        width: 100%;
        background: var(--deep-rose);
        border: none;
        padding: 18px;
        border-radius: 25px;
        color: white;
        font-weight: 800;
        font-size: 0.75rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-top: 10px;
        transition: 0.4s;
    }

    .btn-submit-luxury:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 20px rgba(255, 133, 162, 0.4);
    }

    /* Gallery List Section */
    .gallery-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border-radius: 60px;
        padding: 50px;
        border: 1px solid white;
    }

    .table-clean thead th {
        border: none;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        color: var(--deep-rose);
        padding-bottom: 30px;
    }

    .book-item-row {
        border-bottom: 1px solid rgba(0,0,0,0.03);
        transition: 0.4s;
    }

    .book-item-row:hover {
        background: white;
        transform: translateX(15px);
    }

    .book-meta h5 {
        font-family: 'Playfair Display', serif;
        font-weight: 800;
        margin: 0;
        font-size: 1.3rem;
    }

    .count-chip {
        background: white;
        padding: 8px 18px;
        border-radius: 100px;
        font-weight: 800;
        font-size: 0.8rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    /* Decorations */
    .ribbon-floating {
        position: absolute;
        top: -20px;
        right: 40px;
        font-size: 3rem;
        color: var(--soft-pink);
        opacity: 0.6;
        animation: swing 3s infinite ease-in-out;
    }

    @keyframes swing {
        0%, 100% { transform: rotate(10deg); }
        50% { transform: rotate(25deg); }
    }
</style>

<div class="main-wrapper">
    <div class="header-content animate__animated animate__fadeIn">
        <h1 class="main-title">Book <span>Archive.</span></h1>
        <div class="text-end pb-2">
            <span class="badge rounded-pill px-4 py-2" style="background:var(--dark-coffee); font-size: 10px; letter-spacing: 2px;">
                est. 2026 — yara's ੈ♡‧₊˚
            </span>
        </div>
    </div>

    <div class="bento-container">
        <div class="sticky-form animate__animated animate__fadeInLeft">
            <i class="fa-solid fa-ribbon ribbon-floating"></i>
            <h4 class="fw-bold mb-4" style="letter-spacing: -1px;">New Entry</h4>
            <form method="POST">
                <div class="mb-1">
                    <label class="form-label-custom">TITLE</label>
                    <input type="text" name="judul" class="minimal-input" placeholder="Tulis judul buku..." required>
                </div>
                <div class="mb-1">
                    <label class="form-label-custom">AUTHOR</label>
                    <input type="text" name="pengarang" class="minimal-input" placeholder="Nama pengarang..." required>
                </div>
                <div class="mb-1">
                    <label class="form-label-custom">STOK</label>
                    <input type="number" name="stok" class="minimal-input" placeholder="00" required>
                </div>
                <button name="add" class="btn btn-submit-luxury">Archive Now</button>
            </form>
            
            <div class="mt-5 pt-4 border-top border-secondary opacity-50">
                <p class="small fw-bold mb-1">Total Collection</p>
                <h2 class="fw-800"><?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM buku")) ?> Items</h2>
            </div>
        </div>

        <div class="gallery-card animate__animated animate__fadeInRight">
            <div class="table-responsive">
                <table class="table table-borderless align-middle table-clean">
                    <thead>
                        <tr>
                            <th>Literary Details</th>
                            <th class="text-end">Inventory</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $rb = mysqli_query($conn, "SELECT * FROM buku ORDER BY id_buku DESC");
                        while($b = mysqli_fetch_assoc($rb)){ 
                        ?>
                        <tr class="book-item-row">
                            <td class="py-4">
                                <div class="book-meta">
                                    <span class="text-uppercase small opacity-40 fw-800" style="letter-spacing: 1.5px;">Book Code #<?= $b['id_buku'] ?></span>
                                    <h5><?= $b['judul'] ?></h5>
                                    <span class="fst-italic opacity-60">written by <?= $b['pengarang'] ?></span>
                                </div>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex align-items-center">
                                    <span class="count-chip me-3">
                                        <i class="fa-solid fa-layer-group me-2" style="color:var(--deep-rose)"></i>
                                        <?= $b['stok'] ?> <small class="opacity-50">PCS</small>
                                    </span>
                                    <button class="btn btn-dark rounded-circle" style="width:35px; height:35px; padding:0;">
                                        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
