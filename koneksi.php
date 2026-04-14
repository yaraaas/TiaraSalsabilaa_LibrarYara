<?php
$conn = mysqli_connect("localhost", "root", "", "libraryara");
session_start();

// Fungsi untuk mengunci halaman agar tidak bisa diakses tanpa login
function proteksi() {
    if (!isset($_SESSION['admin_id'])) {
        header("Location: index.php");
        exit;
    }
}
?>
