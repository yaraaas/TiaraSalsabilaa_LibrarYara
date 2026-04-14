<?php 
include 'koneksi.php'; 
proteksi(); 
include 'header.php'; 

// --- LOGIKA PROSES (Sama seperti sebelumnya agar tetap jalan) ---
if(isset($_POST['add'])){
    $n = mysqli_real_escape_string($conn, $_POST['nama']); 
    $t = mysqli_real_escape_string($conn, $_POST['telp']);
    mysqli_query($conn, "INSERT INTO anggota (nama, telepon) VALUES ('$n','$t')");
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success ✨',
                text: 'Anggota baru telah ditambahkan ke koleksi.',
                icon: 'success',
                background: '#fffaff',
                confirmButtonColor: '#FFB7C5'
            }).then(() => { window.location='anggota.php'; });
        });
    </script>";
}
?>

<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Plus+Jakarta+Sans:wght@300;400;600&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">

<style>
    :root {
        --soft-pink: #FFD1DC; /* Pastel Pink */
        --cream: #FFFAFA;     /* Snow White Cream */
        --strawberry: #FF85A2; /* Accent Pink */
        --muted-text: #6B5E5E;
    }

    body { 
        background-color: #fdfcfc; 
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--muted-text);
        letter-spacing: -0.2px;
    }

    /* Header ala Dashboard Notion */
    .dashboard-header {
        max-width: 1000px;
        margin: 60px auto 40px;
        padding: 0 20px;
        border-bottom: 1px solid #f0e6e6;
        padding-bottom: 20px;
    }

    .dashboard-header h1 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 2.8rem;
        color: #333;
    }

    .quote-box {
        font-style: italic;
        color: var(--strawberry);
        font-size: 0.9rem;
        margin-top: 10px;
    }

    /* Card & Container */
    .notion-card {
        background: white;
        border: 1px solid #f1f1f1;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    .section-title {
        font-family: 'Instrument Serif', serif;
        font-size: 1.8rem;
        font-style: italic;
        margin-bottom: 20px;
        color: #444;
    }

    /* Form Styling */
    .form-label {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #999;
    }

    .soft-input {
        border: 1px solid #eee !important;
        border-radius: 8px !important;
        padding: 12px !important;
        background: #fafafa !important;
        font-size: 0.9rem;
    }

    .soft-input:focus {
        border-color: var(--soft-pink) !important;
        background: white !important;
        box-shadow: 0 0 0 4px rgba(255, 209, 220, 0.3) !important;
    }

    .btn-notion {
        background: var(--soft-pink);
        color: #d15a7c;
        border: none;
        font-weight: 600;
        padding: 12px;
        border-radius: 8px;
        transition: 0.3s;
    }

    .btn-notion:hover {
        background: var(--strawberry);
        color: white;
    }

    /* Table & List */
    .table-soft thead th {
        font-size: 0.7rem;
        text-transform: uppercase;
        color: var(--strawberry);
        border: none;
        letter-spacing: 2px;
    }

    .member-item {
        transition: 0.3s;
        border-bottom: 1px solid #fafafa;
    }

    .member-item:hover {
        background: #fff8f9;
    }

    .member-name {
        font-family: 'Instrument Serif', serif;
        font-size: 1.4rem;
        color: #333;
    }

    .badge-soft {
        background: var(--soft-pink);
        color: #d15a7c;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

</style>

<div class="container pb-5">
    <div class="dashboard-header">
        <span style="font-size: 3rem;">🌸</span>
        <h1>Member Directory</h1>
        <p class="quote-box">"Consistency is more important than perfection."</p>
    </div>

    <div class="row g-4 px-3">
        <div class="col-md-4">
            <div class="notion-card">
                <h3 class="section-title">Quick Entry</h3>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="nama" class="form-control soft-input" placeholder="Enter name..." required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Phone</label>
                        <input type="text" name="telp" class="form-control soft-input" placeholder="Contact number..." required>
                    </div>
                    <button name="add" class="btn btn-notion w-100">Add to Archive 🕊️</button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="notion-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="section-title m-0">Members List</h3>
                    <span class="badge-soft">Total: <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM anggota")) ?></span>
                </div>

                <div class="table-responsive">
                    <table class="table table-soft align-middle">
                        <thead>
                            <tr>
                                <th>Identity</th>
                                <th>Contact</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $agt = mysqli_query($conn, "SELECT * FROM anggota ORDER BY id_anggota DESC");
                            while($ra = mysqli_fetch_assoc($agt)){ 
                            ?>
                            <tr class="member-item">
                                <td class="py-3">
                                    <div class="member-name"><?= $ra['nama'] ?></div>
                                    <div style="font-size: 0.7rem; color: #bbb;">UID: ARCH-0<?= $ra['id_anggota'] ?></div>
                                </td>
                                <td>
                                    <span class="small" style="color: #888;"><?= $ra['telepon'] ?></span>
                                </td>
                                <td class="text-end">
                                    <a href="edit_anggota.php?id=<?= $ra['id_anggota'] ?>" style="color: #ccc; margin-right: 10px;"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="anggota.php?hapus=<?= $ra['id_anggota'] ?>" style="color: #ffcad4;"><i class="fa-solid fa-heart-crack"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
