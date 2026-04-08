<?php 
include 'admin/koneksi.php'; 

// ✨ SET YOUR BRAND NAME HERE ✨
$store_name = "Etheral Pieces"; 

// Smart Filter Logic
$kat_aktif = isset($_GET['kat']) ? mysqli_real_escape_string($koneksi, $_GET['kat']) : '';
$cari_aktif = isset($_GET['cari']) ? mysqli_real_escape_string($koneksi, $_GET['cari']) : '';

$query = "SELECT * FROM produk";
if($cari_aktif != '') {
    $query .= " WHERE nama_produk LIKE '%$cari_aktif%'";
} elseif($kat_aktif != '') {
    $query .= " WHERE kategori = '$kat_aktif'";
}
$query .= " ORDER BY id_produk DESC";
$ambil = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $store_name; ?> — Lovely Treasures 🌸</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --bloom-pink: #ff8fa3;
            --soft-petal: #ffb3c1;
            --ethereal-white: #fffcf9;
            --vintage-text: #5c4d4d;
            --glass-white: rgba(255, 255, 255, 0.7);
        }

        body { 
            background: linear-gradient(135deg, #fffcf9 0%, #fff0f3 50%, #f0f4ff 100%);
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: var(--vintage-text);
            min-height: 100vh;
        }

        /* Lovely Navbar */
        .navbar {
            background: var(--glass-white) !important;
            backdrop-filter: blur(20px);
            border-bottom: 2px solid var(--soft-petal);
            padding: 1rem 0;
        }
        .navbar-brand { 
            font-weight: 800; 
            color: var(--bloom-pink) !important; 
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .btn-admin-access {
            background: white;
            color: var(--bloom-pink) !important;
            border: 1.5px solid var(--soft-petal);
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.75rem;
            text-decoration: none;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(255, 143, 163, 0.1);
        }
        .btn-admin-access:hover {
            background: var(--bloom-pink);
            color: white !important;
            transform: translateY(-2px);
        }

        /* Search Area */
        .search-area { max-width: 500px; margin: 40px auto; position: relative; }
        .pearl-input {
            border-radius: 50px; border: 1.5px solid var(--soft-petal); 
            padding: 15px 25px 15px 55px;
            background: white; box-shadow: 0 10px 30px rgba(255, 143, 163, 0.08);
            width: 100%; transition: 0.4s;
        }
        .pearl-input:focus { border-color: var(--bloom-pink); outline: none; box-shadow: 0 0 20px rgba(255, 143, 163, 0.2); }
        .bi-search-pink { position: absolute; left: 22px; top: 50%; transform: translateY(-50%); color: var(--bloom-pink); font-size: 1.2rem; }

        /* Kategori Dinamis */
        .category-shelf { 
            display: flex; gap: 12px; overflow-x: auto; 
            padding: 10px 0 40px 0; justify-content: center; 
            scrollbar-width: none; 
        }
        .category-shelf::-webkit-scrollbar { display: none; }
        
        .chip-lovely {
            padding: 10px 22px; background: white; border-radius: 50px;
            text-decoration: none; color: #a18a8a; font-weight: 700; font-size: 0.8rem;
            border: 1.5px solid #ffe5ec; transition: 0.4s ease;
            white-space: nowrap; text-transform: uppercase;
        }
        .chip-lovely.active, .chip-lovely:hover {
            background: var(--bloom-pink); color: white; border-color: var(--bloom-pink);
            transform: translateY(-3px); box-shadow: 0 10px 20px rgba(255, 143, 163, 0.2);
        }

        /* Kartu Produk Horizontal */
        .boutique-card {
            background: white; border-radius: 30px; display: flex;
            height: 190px; margin-bottom: 25px; transition: 0.5s;
            overflow: hidden; border: 1px solid rgba(255, 143, 163, 0.1);
            position: relative;
        }
        .boutique-card:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 25px 50px rgba(255, 143, 163, 0.15);
        }

        .image-frame { width: 190px; height: 100%; padding: 15px; flex-shrink: 0; }
        .image-frame img { 
            width: 100%; height: 100%; object-fit: cover; 
            border-radius: 20px; transition: 0.5s;
        }
        .boutique-card:hover img { transform: scale(1.1); }

        .details-frame { padding: 20px 25px 20px 10px; display: flex; flex-direction: column; justify-content: center; flex-grow: 1; }
        
        /* Badge Kategori */
        .tagline { 
            font-size: 0.6rem; font-weight: 800; 
            color: var(--bloom-pink); background: #fff0f3;
            padding: 4px 12px; border-radius: 50px;
            text-transform: uppercase; letter-spacing: 1px; 
            margin-bottom: 8px; display: inline-block; width: fit-content;
        }
        
        .title-text { font-weight: 800; font-size: 1.15rem; color: #333; margin: 0; line-height: 1.2; }
        
        .price-text { 
            font-weight: 800; 
            background: linear-gradient(to right, #ff8fa3, #ff4d6d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.4rem; margin-top: 5px; 
        }

        .btn-adopt {
            margin-top: 12px; color: var(--bloom-pink); text-decoration: none;
            font-weight: 800; font-size: 0.8rem; display: flex; align-items: center; gap: 6px; transition: 0.3s;
        }
        .btn-adopt:hover { color: #ff4d6d; transform: translateX(5px); }

        footer { padding: 60px 0; text-align: center; opacity: 0.5; font-weight: 800; font-size: 0.7rem; letter-spacing: 4px; color: var(--bloom-pink); text-transform: uppercase; }
    </style>
</head>
<body>

<nav class="navbar sticky-top">
  <div class="container d-flex justify-content-between align-items-center">
    <a class="navbar-brand" href="index.php">
        <i class="bi bi-flower1 me-2"></i><?php echo $store_name; ?>
    </a>
    <a href="admin/login.php" class="btn-admin-access">
        <i class="bi bi-person-heart me-1"></i> ADMIN ACCESS
    </a>
  </div>
</nav>

<div class="container mt-2">
    <div class="search-area">
        <form action="index.php" method="get">
            <i class="bi bi-search bi-search-pink"></i>
            <input type="text" name="cari" class="form-control pearl-input" placeholder="Search for magic..." value="<?= $cari_aktif ?>">
        </form>
    </div>

    <div class="category-shelf">
        <a href="index.php" class="chip-lovely <?= ($kat_aktif == '') ? 'active' : '' ?>">
            <i class="bi bi-stars"></i> All
        </a>

        <?php 
        $q_kat = mysqli_query($koneksi, "SELECT DISTINCT kategori FROM produk WHERE kategori != ''");
        
        while($k = mysqli_fetch_array($q_kat)){
            $active = ($kat_aktif == $k['kategori']) ? 'active' : '';
            
            // Logika Ikon Berdasarkan Nama Kategori
            $kat_lower = strtolower($k['kategori']);
            $icon = 'bi-bookmark-heart'; // Default

            if (strpos($kat_lower, 'home') !== false) {
                $icon = 'bi-house-heart';
            } elseif (strpos($kat_lower, 'access') !== false) {
                $icon = 'bi-gem';
            } elseif (strpos($kat_lower, 'elect') !== false) {
                $icon = 'bi-cpu';
            } elseif (strpos($kat_lower, 'fash') !== false) {
                $icon = 'bi-bag-heart';
            }
            
            echo "<a href='index.php?kat=".$k['kategori']."' class='chip-lovely $active'>
                    <i class='bi $icon me-1'></i> ".$k['kategori']."
                  </a>";
        }
        ?>
    </div>

    <div class="row">
        <?php 
        if(mysqli_num_rows($ambil) > 0) {
            while($p = mysqli_fetch_array($ambil)){ 
        ?>
        <div class="col-12 col-lg-6">
            <div class="boutique-card">
                <div class="image-frame">
                    <img src="admin/gambar/<?php echo $p['gambar']; ?>" alt="Product Item">
                </div>
                <div class="details-frame">
                    <span class="tagline"><?php echo $p['kategori']; ?></span>
                    <h5 class="title-text text-truncate"><?php echo $p['nama_produk']; ?></h5>
                    <div class="price-text">Rp <?php echo number_format($p['harga'], 0, ',', '.'); ?></div>
                    
                    <a href="https://wa.me/628888225949?text=Hi%20Admin,%20I'm%20interested%20in%20<?php echo urlencode($p['nama_produk']); ?>%20🌸" target="_blank" class="btn-adopt">
                        ADOPT THIS PIECE <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php 
            } 
        } else {
            echo "<div class='col-12 text-center py-5 opacity-50'>— The boutique is currently quiet —</div>";
        }
        ?>
    </div>
</div>

<footer>
    © 2026 <?php echo $store_name; ?> — Crafted with LOVE 🌸
</footer>

</body>
</html>