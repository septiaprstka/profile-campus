<?php
include "proses/koneksi.php";

$kode = $_REQUEST['kode']; // Mengambil id user dari URL

// Periksa apakah id valid (ada di tabel tb_login)
$q = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE kode='$kode'");
if (mysqli_num_rows($q) > 0) {
    // Hapus data login berdasarkan id
    mysqli_query($koneksi, "DELETE FROM jurusan WHERE kode='$kode'");
} else {
    // Tampilkan pesan jika id tidak ditemukan
    echo "Data jurusan tidak ditemukan.";
}
echo '<script>window.location.href = "index.php?page=jurusan";</script>';
?>