<?php
include "proses/koneksi.php";

$pesannim = "";
$pesannama = "";
$pesanjurusan = "";
$pesankelas = "";
$pesangender = "";
$pesannotelp = "";
$pesanalamat = "";
$pesanfoto = "";
$pesan = "";

if (isset($_POST['Ubah'])) {
  $id = $_POST['id'];
  $nim = $_POST['nim'];
  $nama = $_POST['nama'];
  $jurusan = $_POST['jurusan'];
  $kelas = $_POST['kelas'];
  $jeniskelamin = isset($_POST['jeniskelamin']) ? $_POST['jeniskelamin'] : '';
  $notelp = $_POST['notelp'];
  $alamat = $_POST['alamat'];

  // Validasi form sebelum menyimpan data
  if (empty($nama)) {
    $pesannama = "Nama harus diisi";
  }
  if (empty($jurusan)) {
    $pesanjurusan = "Jurusan harus diisi";
  }
  if (empty($kelas)) {
    $pesankelas = "Kelas harus diisi";
  }
  if (empty($jeniskelamin)) {
    $pesangender = "Gender harus diisi";
  }
  if (empty($notelp)) {
    $pesannotelp = "No Telp harus diisi";
  }
  if (empty($alamat)) {
    $pesanalamat = "Alamat harus diisi";
  }

  // Jika tidak ada pesan error, lanjutkan dengan penyimpanan data
  if (empty($pesannama) && empty($pesanjurusan) && empty($pesankelas) && empty($pesangender) && empty($pesannotelp) && empty($pesanalamat)) {

    // Periksa apakah data mahasiswa dengan ID yang diberikan ada di database
    if ($_FILES['foto']['name'] != "") {
      // ambil nama gambar lama
      $q = mysqli_query($koneksi, "SELECT foto FROM tb_mahasiswa WHERE id='$id'");
      $ary = mysqli_fetch_array($q);
      $gambar = $ary['foto'];
      // hapus gambar lama jika ada
      if (!empty($gambar)) {
        unlink("mahasiswa/foto/" . $gambar);
      }
      // upload gambar baru
      $namafoto = basename($_FILES["foto"]["name"]);
      $target_file = "mahasiswa/foto/" . basename($_FILES["foto"]["name"]);
      $upload = move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
      // update nama gambar ke gambar baru
      $namafotobaru = $_FILES["foto"]["name"];
      mysqli_query($koneksi, "UPDATE tb_mahasiswa SET foto='$namafotobaru' WHERE id='$id'");
    }

    // Perbarui data di database
    $query = "UPDATE tb_mahasiswa SET nim='$nim', nama='$nama', jenis_kelamin='$jeniskelamin', no_telp='$notelp', alamat='$alamat', kode=$jurusan, id_kelas=$kelas WHERE id=$id";
    mysqli_query($koneksi, $query);

    echo '<script type="text/javascript">';
    echo 'window.location.href = "index.php?page=mahasiswa";';
    echo '</script>';
  }
}
?>
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fa fa-edit"></i> Edit Data Mahasiswa
    </h3>
  </div>
  <?php
  include "proses/koneksi.php";

  // Ambil kode nim dari URL
  $kode = $_REQUEST['kode'];

  // Query untuk mendapatkan data mahasiswa berdasarkan nim
  $q = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE id='$kode'");

  // Periksa apakah ada hasil dari query atau tidak
  if (mysqli_num_rows($q) > 0) {
    $ary = mysqli_fetch_array($q);
  } else {
    echo "Data mahasiswa tidak ditemukan.";
    exit; // Berhenti eksekusi script jika data tidak ditemukan
  }
  ?>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="card-body">
      <input type='hidden' class="form-control" name="id" value="<?php echo $ary['id']; ?>" />
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nim</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $ary['nim']; ?>" readonly />
        </div>
      </div>
      <br>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nama Mahasiswa</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $ary['nama']; ?>" />
          <p class="col-form-label" style="color: red;">
            <?php echo $pesannama ?>
          </p>
        </div>
      </div>
      <br>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Jurusan</label>
        <div class="col-sm-4">
          <select name="jurusan" id="jurusan" class="form-control">
            <option value="">- Pilih -</option>
            <?php
            // Ambil kode nim dari URL
            $kode = $_REQUEST['kode'];

            // Query untuk mendapatkan data mahasiswa berdasarkan nim
            $q = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE id='$kode'");

            if (mysqli_num_rows($q) > 0) {
              $ary = mysqli_fetch_array($q);
              $selectedJurusan = $ary['kode'];
            } else {
              echo "Data mahasiswa tidak ditemukan.";
              exit; // Berhenti eksekusi script jika data tidak ditemukan
            }

            //ambil data jurusan
            $query = "SELECT * FROM jurusan ";
            $hasil = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_array($hasil)) {
              $selected = ($row['kode'] == $selectedJurusan) ? 'selected' : '';
              ?>
              <option value="<?= $row['kode'] ?>" <?= $selected ?>>
                <?= $row['nm_jurusan'] ?>
              </option>
              <?php
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
        <div class="col-sm-4">
          <select name="kelas" id="kelas" class="form-control">
            <option value="">- Pilih -</option>
            <?php
            // Ambil kode nim dari URL
            $kode = $_REQUEST['kode'];

            // Query untuk mendapatkan data mahasiswa berdasarkan nim
            $q = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE id='$kode'");

            if (mysqli_num_rows($q) > 0) {
              $ary = mysqli_fetch_array($q);
              $selectedKelas = $ary['id_kelas'];
            } else {
              echo "Data mahasiswa tidak ditemukan.";
              exit; // Berhenti eksekusi script jika data tidak ditemukan
            }

            // Ambil data dari database
            $query_kelas = "SELECT * FROM tb_kelas";
            $hasil_kelas = mysqli_query($koneksi, $query_kelas);
            while ($row_kelas = mysqli_fetch_array($hasil_kelas)) {
              $selected = ($row_kelas['id_kelas'] == $selectedKelas) ? 'selected' : '';
              ?>
              <option value="<?php echo $row_kelas['id_kelas'] ?>" <?= $selected ?>>
                <?php echo $row_kelas['kelas'] ?>
              </option>
              <?php
            }
            ?>
          </select>
          <p class="col-form-label" style="color: red;">
            <?php echo $pesankelas ?>
          </p>
        </div>
      </div>
      <br>

      <?php
      $q = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE id='$kode'");

      if (mysqli_num_rows($q) > 0) {
        $ary = mysqli_fetch_array($q);
      }
      ?>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
        <div class="col-sm-4">
          <div class="form-check">
          <input name="jeniskelamin" value="Laki-Laki" class="form-check-input" type="radio" id="defaultRadio1" <?php echo ($ary['jenis_kelamin'] == 'Laki-Laki') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="defaultRadio1"> Laki-Laki </label>
          </div>
          <div class="form-check">
          <input name="jeniskelamin" value="Perempuan" class="form-check-input" type="radio" id="defaultRadio2" <?php echo ($ary['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="defaultRadio2"> Perempuan </label>
          </div>
          <p class="col-form-label" style="color: red;">
            <?php echo $pesangender ?>
          </p>
        </div>
      </div>
      <br>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">No Telp</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="notelp" name="notelp" value="<?php echo $ary['no_telp']; ?>">
          <p class="col-form-label" style="color: red;">
            <?php echo $pesannotelp ?>
          </p>
        </div>
      </div>
      <br>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $ary['alamat']; ?>">
          <p class="col-form-label" style="color: red;">
            <?php echo $pesanalamat ?>
          </p>
        </div>
      </div>
      <br>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Foto</label>
        <div class="col-sm-6">

          <input type="file" class="form-control" id="foto" name="foto" />
          <br>
          <?php if (!empty($ary['foto'])): ?>
            <img src="mahasiswa/foto/<?php echo $ary['foto']; ?>" alt="Current Image"
              style="max-width: 200px; max-height: 200px;">
          <?php else: ?>
            <p>No Image Found</p>
          <?php endif; ?>
        </div>
      </div>
      <br>

    </div>
    <div class="card-footer">
      <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
      <a href="?page=mahasiswa" title="Kembali" class="btn btn-secondary">Batal</a>
    </div>
  </form>
</div>