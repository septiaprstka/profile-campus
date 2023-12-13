<?php
include "proses/koneksi.php";

$pesanjurusan = "";
$pesankelas = "";

if (isset($_POST['Simpan'])) {
    if (isset($_POST['nm_jurusan'])) {
        $id_kelas = $_POST['id_kelas'];
        $jurusan = $_POST['nm_jurusan'];
    } else {
        $jurusan = "";
    }

    if (isset($_POST['kelas'])) {
        $kelas = $_POST['kelas'];
    } else {
        $kelas = "";
    }

    // Cek apakah data jurusan sudah ada di database
    $checkJurusan = mysqli_query($koneksi, "SELECT * FROM tb_kelas WHERE nm_jurusan='$jurusan'");
    if (mysqli_num_rows($checkJurusan) > 0) {
        $pesanjurusan = "Jurusan sudah ada, silakan pilih jurusan lain.";
    }

    // Cek apakah data kelas sudah ada di database
    $checkKelas = mysqli_query($koneksi, "SELECT * FROM tb_kelas WHERE kelas='$kelas'");
    if (mysqli_num_rows($checkKelas) > 0) {
        $pesankelas = "Kelas sudah ada, silakan pilih kelas lain.";
    }

    if (empty($jurusan) && empty($kelas)) {
        $pesanjurusan = "Jurusan harus diisi";
        $pesankelas = "Kelas harus diisi";
    } elseif (empty($jurusan)) {
        $pesanjurusan = "Jurusan harus diisi";
    } elseif (empty($kelas)) {
        $pesankelas = "Kelas harus diisi";
    } elseif (mysqli_num_rows($checkJurusan) == 0 && mysqli_num_rows($checkKelas) == 0) {
        // Jika data jurusan dan kelas belum ada di database, lanjutkan proses penyimpanan
        $q = "UPDATE tb_kelas SET kelas='$kelas', nm_jurusan='$jurusan' WHERE id_kelas='$id_kelas'";

        if (mysqli_query($koneksi, $q)) {
            echo '<script>window.location.href = "index.php?page=kelas";</script>';
        }
    }
}
?>

<div class="card">
    <div class="card-body">
        <?php
        include "proses/koneksi.php";
        $kode = $_REQUEST['kode'];
        $q = mysqli_query($koneksi, "SELECT * FROM tb_kelas WHERE id_kelas='$kode'");
        $ary = mysqli_fetch_array($q);
        ?>
        <h3 class="card-title"><i class="fa fa-edit"></i> Update Data Kelas</h3>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $ary['id_kelas'] ?>" name="id_kelas">
            <br><br>
            <?php
            // Ambil data jurusan dari database
            $query = "SELECT * FROM jurusan";
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
                        <option value="" disabled>Pilih jurusan</option>
                        <?php
                        foreach ($data_array as $data) {
                            $nm_jurusan = $data['nm_jurusan'];
                            $selected = ($nm_jurusan == $ary['nm_jurusan']) ? 'selected' : '';
                            echo "<option value='$nm_jurusan' $selected>$nm_jurusan</option>";
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
                    <select class="form-control" id="defaultFormControlSelect" name="kelas" required>
                        <option value="" disabled <?php if (empty($ary['kelas'])) {
                            echo 'selected';
                        } ?>>Pilih Kelas
                        </option>
                        <option value="Pagi" <?php if ($ary['kelas'] == 'Pagi') {
                            echo 'selected';
                        } ?>>Pagi</option>
                        <option value="Sore" <?php if ($ary['kelas'] == 'Sore') {
                            echo 'selected';
                        } ?>>Sore</option>
                    </select>
                </div>
            </div>
            <br><br>
            <div class="card-footer">
                <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
                <a href="?page=kelas" title="Kembali" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
