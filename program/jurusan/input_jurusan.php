<?php
include "proses/koneksi.php";
$pesanjurusan = "";
$pesansarpras = "";
$pesanjenjang = "";
$pesanakre = "";
$pesan = "";

if (isset($_POST['input'])) {
    $jurusan = $_POST['jurusan'];
    $sarpras = $_POST['sarpras'];
    $jenjang = $_POST['jenjang'];
    $akre = $_POST['akre'];

    if (empty($jurusan) && empty($sarpras) && empty($jenjang) && empty($akre)) {
        $pesanjurusan = "Jurusan harus diisi";
        $pesansarpras = "Sarana dan prasarana harus diisi";
        $pesanjenjang = "Jenjang harus diisi";
        $pesanakre = "Akreditasi harus diisi";
    } elseif (empty($jurusan) && empty($sarpras)) {
        $pesanjurusan = "Jurusan harus diisi";
        $pesansarpras = "Sarana dan prasarana harus diisi";
    } elseif (empty($jurusan) && empty($jenjang)) {
        $pesanjurusan = "Jurusan harus diisi";
        $pesanjenjang = "Jenjang harus diisi";
    } elseif (empty($jurusan) && empty($akre)) {
        $pesanjurusan = "Jurusan harus diisi";
        $pesanakre = "Akreditasi harus diisi";
    } elseif (empty($sarpras) && empty($jenjang)) {
        $pesansarpras = "Sarana dan prasarana harus diisi";
        $pesanjenjang = "Jenjang harus diisi";
    } elseif (empty($sarpras) && empty($akre)) {
        $pesansarpras = "Sarana dan prasarana harus diisi";
        $pesanakre = "Akreditasi harus diisi";
    } elseif (empty($jenjang) && empty($akre)) {
        $pesanjenjang = "Password harus diisi";
        $pesanakre = "Akreditasi harus diisi";
    } elseif (empty($jurusan)) {
        $pesanjurusan = "Jurusan harus diisi";
    } elseif (empty($sarpras)) {
        $pesansarpras = "Sarana dan prasarana harus diisi";
    } elseif (empty($jenjang)) {
        $pesanjenjang = "Jenjang harus diisi";
    } elseif (empty($akre)) {
        $pesanakre = "Akreditasi harus diisi";
    } else {
        $check_query = "SELECT * FROM jurusan WHERE nm_jurusan = '$jurusan'";
        $check_result = mysqli_query($koneksi, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $pesan = "Jurusan sudah ada. Silahkan masukkan jurusan yang lain.";
        } else {
            $q = "INSERT INTO jurusan (kode, nm_jurusan, sarpras, akreditasi, jj) VALUES (NULL, '$jurusan', '$sarpras', '$akre', '$jenjang')";
            mysqli_query($koneksi, $q);
            echo '<script>window.location.href = "index.php?page=jurusan";</script>';
        }
    }
}

// Ambil data jenjang dari tabel tb_jenjang
$query_jenjang = "SELECT * FROM tb_jenjang";
$query_akre = "SELECT * FROM tb_akreditasi";
$result_jenjang = mysqli_query($koneksi, $query_jenjang);
$result_akre = mysqli_query($koneksi, $query_akre);
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Tambah Jurusan
        </h3>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Jurusan</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="" name="jurusan" placeholder="Nama jurusan" />
                    <p class="col-form-label" style="color: red;">
                        <?php echo $pesanjurusan ?>
                        <?php echo $pesan ?>
                    </p>
                </div>
            </div>
            <br>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Sarana & Prasarana</label>
                <div class="col-sm-6">
                    <textarea type="text" class="form-control" id="" name="sarpras"
                        placeholder="Sarana dan Prasarana"></textarea>
                    <p class="col-form-label" style="color: red;">
                        <?php echo $pesansarpras ?>
                    </p>
                </div>
            </div>
            <br>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Akreditasi</label>
                <div class="col-sm-4">
                    <select name="akre" id="akre" class="form-control">
                        <option value="">- Pilih -</option>
                        <?php
                        // Tampilkan data akreditasi dalam pilihan dropdown
                        while ($row = mysqli_fetch_assoc($result_akre)) {
                            echo "<option value='" . $row['id_akre'] . "'>" . $row['nm_akre'] . "</option>";
                        }
                        ?>
                    </select>
                    <p class="col-form-label" style="color: red;">
                        <?php echo $pesanakre ?>
                    </p>
                </div>
            </div>
            <br>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenjang</label>
                <div class="col-sm-4">
                    <select name="jenjang" id="jenjang" class="form-control">
                        <option value="">- Pilih -</option>
                        <?php
                        // Tampilkan data jenjang dalam pilihan dropdown
                        while ($row = mysqli_fetch_assoc($result_jenjang)) {
                            echo "<option value='" . $row['id_jenjang'] . "'>" . $row['nm_jenjang'] . "</option>";
                        }
                        ?>
                    </select>
                    <p class="col-form-label" style="color: red;">
                        <?php echo $pesanjenjang ?>
                    </p>
                </div>
            </div>
            <br>

        </div>
        <div class="card-footer">
            <input type="submit" name="input" value="Simpan" class="btn btn-info">
            <a href="?page=jurusan" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>