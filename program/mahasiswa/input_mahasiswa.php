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

if (isset($_POST['Simpan'])) {
  $nim = $_POST['nim'];
  $nama = $_POST['nama'];
  $jurusan = $_POST['jurusan'];
  $kelas = $_POST['kelas'];
  $jeniskelamin = isset($_POST['jeniskelamin']) ? $_POST['jeniskelamin'] : '';
  $notelp = $_POST['notelp'];
  $alamat = $_POST['alamat'];
  if (empty($nim)) {
    $pesannim = "Nim harus diisi";
  }
  if (empty($nama)) {
    $pesannama = "Nama harus diisi";
  }
  if (empty($jurusan)) {
    $pesanjurusan = "Jurusan harus diisi";
  }
  if (empty($kelas)) {
    $pesankelas = "Kelas harus diisi";
  }
  if (empty($gender)) {
    $pesangender = "Gender harus diisi";
  }
  if (empty($notelp)) {
    $pesannotelp = "No Telp harus diisi";
  }
  if (empty($alamat)) {
    $pesanalamat = "Alamat harus diisi";
  }

   else {
    $namafile = basename($_FILES['foto']['name']);
    $target_file = "mahasiswa/foto/" . basename($_FILES["foto"]["name"]);

    $upload = move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

    $q = "INSERT INTO tb_mahasiswa (nim, nama, jenis_kelamin, no_telp, alamat, foto, kode, id_kelas) VALUES ('$nim','$nama','$jeniskelamin','$notelp', '$alamat','$namafile','$jurusan','$kelas')";


    mysqli_query($koneksi, $q);

    echo '<script>window.location.href = "index.php?page=mahasiswa";</script>';
}
}

?>

<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fa fa-edit"></i> Tambah Data Mahasiswa
    </h3>
  </div>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="card-body">
      <div class="form-group row">
        <div class="col-sm-6">
          <input type="hidden" class="form-control" id="" name="id" placeholder="Nim" d>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nim</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="" name="nim" placeholder="Nim" >
          <p class="col-form-label" style="color: red;">
                        <?php echo $pesannim ?>
                    </p>
        </div>
      </div>
      <br>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nama Mahasiswa</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa" >
          <p class="col-form-label" style="color: red;">
                        <?php echo $pesannama ?>
                    </p>
        </div>
      </div>
      <br>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Jurusan</label>
        <div class="col-sm-4">
          <select name="jurusan" id="jurusan" class="form-control" >
            <option value="">- Pilih -</option>
            <?php
            //ambil data jurusan
            $query = "SELECT * FROM jurusan";
            $hasil = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_array($hasil)) {
              ?>
              <option value="<?= $row['kode'] ?>">
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
          <select name="kelas" id="kelas" class="form-control" >
            <option value="">- Pilih -</option>
            <?php
            //ambil data dari database
            $query = "SELECT * FROM tb_kelas";
            $hasil = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_array($hasil)) {
              ?>
              <option value="<?php echo $row['id_kelas'] ?>">
                <?php echo $row['kelas'] ?>
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

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
        <div class="col-sm-4">
          <div class="form-check">
            <input name="jeniskelamin" class="form-check-input" type="radio" value="Laki-Laki" id="defaultRadio1">
            <label class="form-check-label" for="defaultRadio1"> Laki-Laki </label>
          </div>
          <div class="form-check">
            <input name="jeniskelamin" class="form-check-input" type="radio" value="Perempuan" id="defaultRadio2">
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
          <input type="text" class="form-control" id="notelp" name="notelp" placeholder="No Telp" >
          <p class="col-form-label" style="color: red;">
                        <?php echo $pesannotelp ?>
                    </p>
        </div>
      </div>
      <br>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" >
          <p class="col-form-label" style="color: red;">
                        <?php echo $pesanalamat ?>
                    </p>
        </div>
      </div>
      <br>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Foto</label>
        <div class="col-sm-6">
          <input type="file" class="form-control" id="foto" name="foto" placeholder="" >
          
        </div>
      </div>
      <br>


    </div>
    <div class="card-footer">
      <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
      <a href="?page=mahasiswa" title="Kembali" class="btn btn-secondary">Batal</a>
    </div>
  </form>
</div>