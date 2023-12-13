<?php 
include "koneksi.php";

$id_kelas = $_POST['id_kelas'];
$kelas = $_POST['kelas'];
    $id_kelas = $_POST['id_kelas'];
    $kelas = $_POST['kelas'];
    $nm_jurusan = $_POST['nm_jurusan'];

mysqli_query($koneksi, "UPDATE tb_kelas SET kelas='$kelas' WHERE id_kelas='$id_kelas'");
echo "Data Berhasil Di Update";
 echo '<br>';
 echo '<a href="index.php?page=kelas"><button>Kembali</button></a>';
// header("location:../../index.php?page=kelas");
?>
    mysqli_query($koneksi, "UPDATE tb_kelas SET kelas='$kelas', nm_jurusan='$nm_jurusan' WHERE id_kelas='$id_kelas'");
    
    echo "Data Berhasil Di Update";
    echo '<br>';
    echo '<a href="index.php?page=kelas"><button class="btn btn-outline-primary" type="submit" name="input" id="button-addon1">Kembali</button></a>';
?>