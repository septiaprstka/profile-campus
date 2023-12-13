<?php 
$kode = $_REQUEST['kode'];

include "proses/koneksi.php";

mysqli_query($koneksi, "DELETE FROM tb_kelas WHERE id_kelas ='$kode'");

header("location:../index.php?page=kelas");