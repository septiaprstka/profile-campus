<?php
include "proses/koneksi.php";

$id = $_GET['id']; // Mengambil id user dari URL

// Periksa apakah id valid (ada di tabel tb_login)
$q = mysqli_query($koneksi, "SELECT * FROM tb_login WHERE id='$id'");
if (mysqli_num_rows($q) > 0) {
    // Hapus data login berdasarkan id
    mysqli_query($koneksi, "DELETE FROM tb_login WHERE id='$id'");
} else {
    // Tampilkan pesan jika id tidak ditemukan
    echo "Data mahasiswa tidak ditemukan.";
}

header('location:../index.php?page=datauser');
?>
