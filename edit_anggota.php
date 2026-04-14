<?php 
include 'koneksi.php'; 
proteksi(); 
include 'header.php'; 

// 1. CEK ID: Pastikan ada ID yang mau diedit
if(!isset($_GET['id'])) {
    header("Location: anggota.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM anggota WHERE id_anggota = '$id'");
$data = mysqli_fetch_assoc($query);

// Jika ID tidak ditemukan di database
if(!$data) {
    header("Location: anggota.php");
    exit;
}

// 2. PROSES UPDATE
if(isset($_POST['update'])){
    $n = mysqli_real_escape_string($conn, $_POST['nama']); 
    $t = mysqli_real_escape_string($conn, $_POST['telp']);
    
    $update = mysqli_query($conn, "UPDATE anggota SET nama='$n', telepon='$t' WHERE id_anggota='$id'");
    
    if($update) {
        echo "<script>
            Swal.fire({
                title: 'Updated!',
                text: 'Profil anggota berhasil diperbarui',
                icon: 'success',
                confirmButtonColor: '#FF85A2'
            }).then(() => { window.location='anggota.php'; });
        </script>";
    }
}
?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">

<style>
    :root {
        --base-cream: #FFF9F6;
        --soft-pink: #FDE2E4;
        --accent-pink: #FF85A2;
        --text-dark: #4A3F3F;
    }

    body { background-color: var(--base-cream); font-family: 'Plus Jakarta Sans', sans-serif; color: var(--text-dark); }
    
    .container { max-width: 600px; padding-top: 80px; }

    .card-edit {
        background: #fff;
        border-radius: 35px;
        border: 1px solid rgba(255, 133, 162, 0.15);
        box-shadow: 0 25px 50px rgba(74, 63, 63, 0.05);
        padding: 45px;
    }

    .title-serif {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        font-style: italic;
        text-align: center;
        margin-bottom: 35px;
    }

    .form-label {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        color: var(--accent-pink);
        margin-bottom: 10px;
    }

    .form-control {
        border-radius: 15px;
        border: 1px solid var(--soft-pink);
        padding: 12px 20px;
        background-color: #FDFBFA;
    }

    .form-control:focus {
        border-color: var(--accent-pink);
        box-shadow: 0 0 0 4px rgba(255, 133, 162, 0.1);
        background-color: #fff;
    }

    .btn-save {
        background: var(--accent-pink);
        color: white;
        border-radius: 15px;
        padding: 15px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        transition: 0.3s;
    }

    .btn-save:hover {
        background: #FF6B8E;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(255, 133, 162, 0.2);
    }

    .btn-cancel {
        color: #A39393;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        display: block;
        text-align: center;
        margin-top: px;
        transition: 0.3s;
    }

    .btn-cancel:hover { color: var(--text-dark); }
</style>

<div class="container pb-5">
    <div class="card-edit animate__animated animate__fadeInUp">
        <h3 class="title-serif">Edit Profile</h3>
        
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">FULL NAME</label>
                <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
            </div>
            
            <div class="mb-4">
                <label class="form-label">PHONE NUMBER</label>
                <input type="text" name="telp" class="form-control" value="<?= $data['telepon'] ?>" required>
            </div>
            
            <button name="update" type="submit" class="btn btn-save w-100">Save Changes</button>
            
            <a href="anggota.php" class="btn-cancel">Discard Changes</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
