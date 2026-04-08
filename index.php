<?php include 'koneksi.php'; include 'header.php';
if (isset($_POST['login'])) {
    $u = mysqli_real_escape_string($conn, $_POST['user']); 
    $p = md5($_POST['pass']);
    $res = mysqli_query($conn, "SELECT * FROM admin WHERE username='$u' AND password='$p'");
    if (mysqli_num_rows($res) > 0) {
        $d = mysqli_fetch_assoc($res);
        $_SESSION['admin_id'] = $d['id_admin'];
        header("Location: dashboard.php");
    } else { echo "<script>Swal.fire('Error', 'Akses ditolak, Yara!', 'error');</script>"; }
}
?>
<div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="card-yara p-5 text-center shadow-lg animate__animated animate__zoomIn" style="max-width: 400px; width: 100%;">
        <div class="mb-4"><i class="fas fa-spa fa-3x" style="color: #FFB6C1;"></i></div>
        <h2 class="fw-bold mb-4" style="font-family: 'Playfair Display';">LibrarYara Login</h2>
        <form method="POST">
            <input type="text" name="user" class="form-control mb-3" placeholder="Username" required>
            <input type="password" name="pass" class="form-control mb-4" placeholder="Password" required>
            <button name="login" class="btn btn-premium w-100 p-3 shadow">Masuk ke Perpustakaan ✨</button>
        </form>
    </div>
</div>