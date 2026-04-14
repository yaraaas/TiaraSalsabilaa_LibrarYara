<?php 
include 'koneksi.php'; 
proteksi(); 
include 'header.php'; 
?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,900;1,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --accent-pink: #FF85A2;
        --soft-blush: #FFCBD1;
        --deep-espresso: #2D2424;
        --bg-gradient: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
        --glass: rgba(255, 255, 255, 0.7);
    }

    body {
        background: var(--bg-gradient);
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--deep-espresso);
        min-height: 100vh;
    }

    .container { max-width: 1200px; padding-top: 60px; }

    /* Floating Header Style */
    .header-box {
        display: flex;
        align-items: center;
        background: var(--glass);
        backdrop-filter: blur(10px);
        padding: 30px;
        border-radius: 30px;
        border: 1px solid rgba(255,255,255,0.5);
        margin-bottom: 40px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.02);
    }

    .header-flower {
        width: 70px;
        margin-right: 25px;
        animation: heartBeat 3s infinite;
    }

    .header-title h1 {
        font-family: 'Playfair Display', serif;
        font-weight: 900;
        font-size: 2.8rem;
        margin: 0;
        background: linear-gradient(to right, #2D2424, #FF85A2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Table Gallery Card */
    .gallery-card {
        background: var(--glass);
        backdrop-filter: blur(15px);
        border-radius: 40px;
        border: 1px solid rgba(255,255,255,0.6);
        box-shadow: 0 40px 100px rgba(0,0,0,0.03);
        padding: 40px;
        overflow: hidden;
    }

    .custom-table { width: 100%; border-collapse: separate; border-spacing: 0 15px; }
    .custom-table thead th {
        padding: 10px 25px;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--accent-pink);
        font-weight: 800;
        border: none;
    }

    .custom-table tbody tr {
        background: white;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 5px 15px rgba(0,0,0,0.01);
    }

    .custom-table tbody tr:hover {
        transform: scale(1.02) translateY(-5px);
        box-shadow: 0 20px 40px rgba(255, 133, 162, 0.1);
        z-index: 10;
    }

    .custom-table td {
        padding: 25px;
        border: none;
    }

    .custom-table td:first-child { border-radius: 20px 0 0 20px; }
    .custom-table td:last-child { border-radius: 0 20px 20px 0; }

    /* Visual Elements */
    .user-avatar {
        width: 45px;
        height: 45px;
        background: #FFF0F3;
        color: var(--accent-pink);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        font-weight: 800;
        margin-right: 15px;
    }

    .book-tag {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 1.1rem;
        display: block;
    }

    .status-badge {
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .bg-returned { background: #E6F4EA; color: #1E7E34; }
    .bg-active { 
        background: #FFF0F3; 
        color: var(--accent-pink);
        box-shadow: 0 0 15px rgba(255, 133, 162, 0.3);
    }

    .fine-text { font-weight: 800; color: #D63384; }

    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #f1f1f1; }
    ::-webkit-scrollbar-thumb { background: var(--soft-blush); border-radius: 10px; }
</style>

<div class="container pb-5">
    <div class="header-box animate__animated animate__fadeInDown">

        <div class="header-title">
            <p class="mb-1 text-uppercase fw-bold" style="letter-spacing: 4px; font-size: 0.7rem; color: #888;">°༺❤︎༻°</p>
            <h1>Activity Archives</h1>
        </div>
    </div>

    <div class="gallery-card animate__animated animate__fadeInUp">
        <div class="table-responsive">
            <table class="custom-table align-middle">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Collection</th>
                        <th>Borrowed</th>
                        <th>Indemnity</th>
                        <th class="text-center">State</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $query = "SELECT t.*, a.nama, b.judul 
                              FROM transaksi t 
                              JOIN anggota a ON t.id_anggota=a.id_anggota 
                              JOIN buku b ON t.id_buku=b.id_buku 
                              ORDER BY id_transaksi DESC";
                    $result = mysqli_query($conn, $query);
                    while($rl = mysqli_fetch_assoc($result)) { 
                        $is_returned = ($rl['status'] == 'Kembali');
                        $initial = strtoupper(substr($rl['nama'], 0, 1));
                    ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar"><?= $initial ?></div>
                                <div>
                                    <div class="fw-bold"><?= $rl['nama'] ?></div>
                                    <small class="text-muted">ID: #<?= str_pad($rl['id_anggota'], 3, '0', STR_PAD_LEFT) ?></small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="book-tag"><?= $rl['judul'] ?></span>
                            <small class="text-muted" style="font-size: 0.7rem;">LibrarYara</small>
                        </td>
                        <td>
                            <div class="fw-bold" style="font-size: 0.9rem;"><?= date('M d, Y', strtotime($rl['tgl_pinjam'])) ?></div>
                            <small class="text-muted">Standard Term</small>
                        </td>
                        <td>
                            <span class="fine-text"><?= $rl['denda'] > 0 ? 'Rp '.number_format($rl['denda'],0,',','.') : '<span style="color:#ccc; font-weight:400">No Fines</span>' ?></span>
                        </td>
                        <td class="text-center">
                            <span class="status-badge <?= $is_returned ? 'bg-returned' : 'bg-active' ?>">
                                <?= $is_returned ? '✦ Settled' : '✧ Ongoing' ?>
                            </span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
