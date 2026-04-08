<?php include 'koneksi.php'; proteksi(); include 'header.php'; 
// PINJAM
if(isset($_POST['pinjam'])){
    $b = $_POST['buku']; $a = $_POST['agt'];
    $tp = date('Y-m-d'); $tk = date('Y-m-d', strtotime('+7 days'));
    mysqli_query($conn, "INSERT INTO transaksi (id_buku, id_anggota, tgl_pinjam, tgl_kembali_seharusnya) VALUES ('$b','$a','$tp','$tk')");
    mysqli_query($conn, "UPDATE buku SET stok=stok-1 WHERE id_buku='$b'");
    echo "<script>Swal.fire('Berhasil', 'Buku dipinjamkan 🌸', 'success');</script>";
}
// KEMBALI
if(isset($_GET['kembali'])){
    $id = $_GET['kembali']; $now = date('Y-m-d');
    $q = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM transaksi WHERE id_transaksi='$id'"));
    $denda = (strtotime($now) > strtotime($q['tgl_kembali_seharusnya'])) ? ((strtotime($now) - strtotime($q['tgl_kembali_seharusnya']))/86400)*2000 : 0;
    mysqli_query($conn, "UPDATE transaksi SET tgl_kembali_realitas='$now', denda='$denda', status='Kembali' WHERE id_transaksi='$id'");
    mysqli_query($conn, "UPDATE buku SET stok=stok+1 WHERE id_buku='{$q['id_buku']}'");
    echo "<script>Swal.fire('Selesai', 'Buku kembali. Denda: Rp ".number_format($denda)."', 'info').then(()=>window.location='transaksi.php');</script>";
}
?>
<div class="container">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card-yara p-4">
                <h5 class="fw-bold mb-4">Peminjaman Baru ✨</h5>
                <form method="POST">
                    <select name="buku" class="form-control mb-3"><?php $bk=mysqli_query($conn,"SELECT * FROM buku WHERE stok>0"); while($rbk=mysqli_fetch_assoc($bk)) echo "<option value='{$rbk['id_buku']}'>{$rbk['judul']}</option>"; ?></select>
                    <select name="agt" class="form-control mb-4"><?php $ag=mysqli_query($conn,"SELECT * FROM anggota"); while($rag=mysqli_fetch_assoc($ag)) echo "<option value='{$rag['id_anggota']}'>{$rag['nama']}</option>"; ?></select>
                    <button name="pinjam" class="btn btn-premium w-100 shadow">Konfirmasi Pinjam</button>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card-yara p-4">
                <h5 class="fw-bold mb-4">Sirkulasi Aktif 🌸</h5>
                <table class="table table-borderless">
                    <thead><tr><th>Nama</th><th>Buku</th><th>Deadline</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php $tr = mysqli_query($conn, "SELECT t.*, a.nama, b.judul FROM transaksi t JOIN anggota a ON t.id_anggota=a.id_anggota JOIN buku b ON t.id_buku=b.id_buku WHERE status='Dipinjam'");
                        while($rt = mysqli_fetch_assoc($tr)){ ?>
                        <tr class="border-bottom">
                            <td><div class="fw-bold"><?= $rt['nama'] ?></div></td>
                            <td><?= $rt['judul'] ?></td>
                            <td><span class="badge bg-danger-subtle text-danger p-2 px-3 rounded-pill"><?= $rt['tgl_kembali_seharusnya'] ?></span></td>
                            <td><a href="?kembali=<?= $rt['id_transaksi'] ?>" class="btn btn-sm btn-premium">Return</a></td>
                        </tr><?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>