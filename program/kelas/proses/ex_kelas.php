<?php 
$kelas = $_POST['kelas'];
$nm_jurusan = $_POST['nm_jurusan'];

include "koneksi.php";

$q = "INSERT INTO tb_kelas (kelas) VALUES('$kelas')";
$q = "INSERT INTO tb_kelas (kelas, nm_jurusan) VALUES ('$kelas', '$nm_jurusan')";

mysqli_query($koneksi, $q);
 echo "Data Berhasil Di Tambahkan";
 echo '<br>';
 echo '<a href="index.php?page=kelas"><button class="btn btn-outline-primary" type="submit" name="input" id="button-addon1">Kembali</button></a>';
echo "Data Berhasil Ditambahkan";
echo '<br>';
echo '<a href="index.php?page=kelas"><button class="btn btn-outline-primary" type="submit" name="input" id="button-addon1">Kembali</button></a>';
?>