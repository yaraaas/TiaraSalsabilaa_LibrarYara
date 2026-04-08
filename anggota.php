<?php include 'koneksi.php'; proteksi(); include 'header.php'; 
if(isset($_POST['add'])){
    $n = $_POST['nama']; $t = $_POST['telp'];
    mysqli_query($conn, "INSERT INTO anggota (nama, telepon) VALUES ('$n','$t')");
    echo "<script>Swal.fire('Selesai', 'Anggota terdaftar!', 'success');</script>";
}
?>
<div class="container">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card-yara p-4">
                <h5 class="fw-bold mb-4">Daftar Anggota 🎀</h5>
                <form method="POST">
                    <input type="text" name="nama" class="form-control mb-3" placeholder="Nama Lengkap" required>
                    <input type="text" name="telp" class="form-control mb-4" placeholder="Nomor Telepon" required>
                    <button name="add" class="btn btn-premium w-100">Daftarkan ✨</button>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card-yara p-4">
                <table class="table table-borderless align-middle">
                    <thead><tr class="text-muted"><th>Nama</th><th>Telepon</th></tr></thead>
                    <tbody>
                        <?php $agt = mysqli_query($conn, "SELECT * FROM anggota ORDER BY id_anggota DESC");
                        while($ra = mysqli_fetch_assoc($agt)){ ?>
                        <tr class="border-bottom"><td><div class="fw-bold"><?= $ra['nama'] ?></div></td><td><?= $ra['telepon'] ?></td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>