<?php
include "proses/koneksi.php";
$pesanjurusan = "";
$pesansarpras = "";
$pesanjenjang = "";
$pesanakre = "";
$pesan = "";

if (isset($_POST['Ubah'])) {
  $kode = $_POST['kode'];
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
    $data = ("UPDATE jurusan SET nm_jurusan='$jurusan', sarpras='$sarpras', akreditasi='$akre', jj='$jenjang' WHERE kode='$kode'");
    $hasil = mysqli_query($koneksi, $data);

    mysqli_query($koneksi, $data);

    echo '<script>window.location.href = "index.php?page=jurusan";</script>';
  }
}
?>
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fa fa-edit"></i> Edit Data Jurusan
    </h3>
  </div>
  <?php
  include "proses/koneksi.php";
  // Ambil kode jurusan dari URL
  $kode = $_GET['kode'];
  $query_jenjang = "SELECT * FROM tb_jenjang";
  $result_jenjang = mysqli_query($koneksi, $query_jenjang);
  $query_jurusan = "SELECT * FROM jurusan WHERE kode='$kode'";
  $query_akre = "SELECT * FROM tb_akreditasi";
  $result_akre = mysqli_query($koneksi, $query_akre);

  // Query untuk mendapatkan data jurusan berdasarkan kode
  $q = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE kode='$kode'");

  // Periksa apakah ada hasil dari query atau tidak
  if (mysqli_num_rows($q) > 0) {
    $ary = mysqli_fetch_array($q);
  } else {
    echo "Data jurusan tidak ditemukan.";
    exit; // Berhenti eksekusi script jika data tidak ditemukan
  }
  ?>
  <form action="" method="post" enctype="multipart/form-data">

    <div class="card-body">
      <input type='hidden' class="form-control" name="kode" value="<?php echo $ary['kode']; ?>" />

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nama Jurusan</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="" name="jurusan" value="<?php echo $ary['nm_jurusan']; ?>" />
          <p class="col-form-label" style="color: red;">
            <?php echo $pesanjurusan ?>
          </p>
        </div>
      </div>
      <br>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Sarana & Prasarana</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="" name="sarpras" value="<?php echo $ary['sarpras']; ?>" />
          <p class="col-form-label" style="color: red;">
            <?php echo $pesansarpras ?>
          </p>
        </div>
      </div>
      <br>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Akreditasi</label>
        <div class="col-sm-6">
          <select name="akre" id="akre" class="form-control">
          <option value="">- Pilih -</option>
            <?php
            // Tampilkan data akreditasi dalam pilihan dropdown
            while ($row_akre = mysqli_fetch_assoc($result_akre)) {
              $selected = ($ary['akreditasi'] == $row_akre['id_akre']) ? "selected" : "";
              echo "<option value='" . $row_akre['id_akre'] . "' $selected>" . $row_akre['nm_akre'] . "</option>";
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
          <select name="jenjang" id="jenjang" class="form-control" ?>">
          <option value="">- Pilih -</option>
            <?php
            // Tampilkan data jenjang dalam pilihan dropdown
            while ($row_jenjang = mysqli_fetch_assoc($result_jenjang)) {
              $selected = ($ary['jj'] == $row_jenjang['id_jenjang']) ? "selected" : "";
              echo "<option value='" . $row_jenjang['id_jenjang'] . "' $selected>" . $row_jenjang['nm_jenjang'] . "</option>";
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
      <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
      <a href="?page=jurusan" title="Kembali" class="btn btn-secondary">Batal</a>
    </div>
  </form>
</div>