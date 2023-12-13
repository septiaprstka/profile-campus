<?php
include "proses/koneksi.php";

$kode = $_GET['kode']; // Mengambil id mahasiswa dari URL

// Periksa apakah id valid (ada di tabel tb_mahasiswa)
$q = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE id='$kode'");
if (mysqli_num_rows($q) > 0) {
    // Hapus data mahasiswa berdasarkan id
    mysqli_query($koneksi, "DELETE FROM tb_mahasiswa WHERE id='$kode'");
} 
echo '<script>window.location.href = "index.php?page=mahasiswa";</script>';


?>