<?php
$pesanjurusan = "";
$pesankelas = "";

if (isset($_POST['Simpan'])) {
    if (isset($_POST['nm_jurusan'])) {
        $jurusan = $_POST['nm_jurusan'];
    } else {
        $jurusan = "";
    }

    if (isset($_POST['kelas'])) {
        $kelas = $_POST['kelas'];
    } else {
        $kelas = "";
    }

    if (empty($jurusan) && empty($kelas)) {
        $pesanjurusan = "Jurusan harus diisi";
        $pesankelas = "Kelas harus diisi";
    } elseif (empty($jurusan)) {
        $pesanjurusan = "Jurusan harus diisi";
    } elseif (empty($kelas)) {
        $pesankelas = "Kelas harus diisi";
    } else {
        // Lakukan pengecekan apakah jurusan dan kelas telah ada sebelumnya di database
        $q_check = "SELECT * FROM tb_kelas WHERE nm_jurusan='$jurusan' AND kelas='$kelas'";
        $result_check = mysqli_query($koneksi, $q_check);

        if (mysqli_num_rows($result_check) > 0) {
            // Jika data telah ada, tampilkan pesan error
            $pesanjurusan = "Jurusan dan kelas sudah ada";
            $pesankelas = "Jurusan dan kelas sudah ada";
        } else {
            // Jika data belum ada, tambahkan data ke database
            $jurusan = mysqli_real_escape_string($koneksi, $jurusan);
            $kelas = mysqli_real_escape_string($koneksi, $kelas);

            $q = "INSERT INTO tb_kelas (kelas, nm_jurusan) VALUES ('$kelas', '$jurusan')";
            $hasil = mysqli_query($koneksi, $q);

            echo '<script>window.location.href = "index.php?page=kelas";</script>';
        }
    }
}
?>
<div class="card">
    <div class="card-body">

        <h3 class="card-title"> <i class="fa fa-edit"></i> Input Data Kelas</h3>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <br>
                <?php
                $query = "SELECT nm_jurusan FROM jurusan";
                $result = mysqli_query($koneksi, $query);
                $data_array = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $data_array[] = $row;
                }
                ?>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-6">
                        <select name="nm_jurusan" class="form-control">
                            <option value="" disabled selected>Pilih jurusan</option>
                            <?php
                            $sql = "SELECT nm_jurusan FROM jurusan";
                            foreach ($data_array as $data) {
                                $nm_jurusan = $data['nm_jurusan'];
                                echo "<option value='$nm_jurusan'>$nm_jurusan</option>";
                            }
                            ?>
                        </select>
                        <p class="col-form-label" style="color: red;">
                            <?php echo $pesanjurusan ?>
                        </p>
                    </div>
                </div>

                <br>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-6">
                        <select class="form-control" id="defaultFormControlSelect" name="kelas">
                            <option value="" disabled selected>Pilih Kelas</option>
                            <option value="Pagi">Pagi</option>
                            <option value="Sore">Sore</option>
                        </select>
                        <p class="col-form-label" style="color: red;">
                            <?php echo $pesankelas ?>
                        </p>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
                <a href="?page=kelas" title="Kembali" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
