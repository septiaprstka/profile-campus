ini form kelas
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Data Kelas</h2>
<a href="index.php?page=kelas/form_kelas" >Tambah</a>
<table>
    <tr>
        <th>kelas</th>
    </tr>
<?php 
    include "proses/koneksi.php";
    $data = mysqli_query($koneksi, "SELECT * FROM tb_kelas");

    while($row = mysqli_fetch_array($data)){
?>
<tr>
    <td><?php echo $row['kelas'] ?></td>
</tr>
<?php
    }
    ?>
</table>
</body>
</html>