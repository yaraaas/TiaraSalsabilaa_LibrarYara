<?php include 'koneksi.php'; proteksi(); include 'header.php'; ?>
<div class="container">
    <div class="card-yara p-4 shadow-sm animate__animated animate__fadeIn">
        <h5 class="fw-bold mb-4">Laporan Aktivitas 📊</h5>
        <table class="table table-hover">
            <thead class="text-muted small"><tr><th>NAMA</th><th>BUKU</th><th>PINJAM</th><th>DENDA</th><th>STATUS</th></tr></thead>
            <tbody>
                <?php $l = mysqli_query($conn, "SELECT t.*, a.nama, b.judul FROM transaksi t JOIN anggota a ON t.id_anggota=a.id_anggota JOIN buku b ON t.id_buku=b.id_buku ORDER BY id_transaksi DESC");
                while($rl = mysqli_fetch_assoc($l)) { ?>
                    <tr class="align-middle border-bottom">
                        <td class="fw-bold"><?=$rl['nama']?></td>
                        <td><?=$rl['judul']?></td>
                        <td><small><?=$rl['tgl_pinjam']?></small></td>
                        <td class="text-danger fw-bold">Rp <?=number_format($rl['denda'])?></td>
                        <td><span class="badge p-2 px-3 rounded-pill <?=$rl['status']=='Kembali'?'bg-success-subtle text-success':'bg-warning-subtle text-warning'?>"><?=$rl['status']?></span></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>