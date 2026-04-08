<?php include 'koneksi.php'; proteksi(); include 'header.php'; 
if(isset($_POST['add'])){
    $j = $_POST['judul']; $p = $_POST['pengarang']; $s = $_POST['stok'];
    mysqli_query($conn, "INSERT INTO buku (judul, pengarang, stok) VALUES ('$j','$p','$s')");
    echo "<script>Swal.fire('Berhasil', 'Koleksi diperbarui!', 'success');</script>";
}
?>
<div class="container">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card-yara p-4">
                <h5 class="fw-bold mb-4">Tambah Buku 📖</h5>
                <form method="POST">
                    <input type="text" name="judul" class="form-control mb-3" placeholder="Judul Buku" required>
                    <input type="text" name="pengarang" class="form-control mb-3" placeholder="Pengarang" required>
                    <input type="number" name="stok" class="form-control mb-4" placeholder="Jumlah Stok" required>
                    <button name="add" class="btn btn-premium w-100">Simpan 🎀</button>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card-yara p-4">
                <table class="table table-borderless align-middle">
                    <thead><tr class="text-muted"><th>Judul & Pengarang</th><th>Stok</th></tr></thead>
                    <tbody>
                        <?php $rb = mysqli_query($conn, "SELECT * FROM buku ORDER BY id_buku DESC");
                        while($b = mysqli_fetch_assoc($rb)){ ?>
                        <tr class="border-bottom">
                            <td><div class="fw-bold"><?= $b['judul'] ?></div><div class="small text-muted"><?= $b['pengarang'] ?></div></td>
                            <td><span class="badge rounded-pill bg-pink text-dark border p-2"><?= $b['stok'] ?> Pcs</span></td>
                        </tr><?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>