<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fa fa-table"></i> Data Mahasiswa
    </h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="table-responsive">
    <?php if ($_SESSION['level'] == 'Administrator') { ?>
      <div>
        <a href="index.php?page=mahasiswa/input_mahasiswa" class="btn btn-primary">
          <i class="fa fa-edit"></i> Tambah Data</a>
      </div>
      <?php } ?>
      <br>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <?php $no = 1; ?>
          <tr>
            <th>No</th>
            <th>Nim</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Kelas</th>
            <th>Gender</th>
            <th>No.Telp</th>
            <th>Alamat</th>
            <th>Foto</th>
            <?php if ($_SESSION['level'] == 'Administrator') { ?>
              <th>Aksi</th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>

          <?php
          include "mahasiswa/proses/koneksi.php";
          $data = mysqli_query($koneksi, "SELECT a.id, a.nim, a.nama, b.nm_jurusan, c.kelas, a.jenis_kelamin, a.no_telp, a.alamat, a.foto
          FROM tb_mahasiswa a, jurusan b, tb_kelas c WHERE b.kode = a.kode AND a.id_kelas = c.id_kelas");

          while ($row = mysqli_fetch_array($data)) {

            ?>
            <tr>
              <td>
                <?php echo $no++; ?>
              </td>
              <td>
                <?php echo $row['nim'] ?>
              </td>
              <td>
                <?php echo $row['nama'] ?>
              </td>
              <td>
                <?php echo $row['nm_jurusan'] ?>
              </td>
              <td>
                <?php echo $row['kelas'] ?>
              </td>
              <td>
                <?php echo $row['jenis_kelamin'] ?>
              </td>
              <td>
                <?php echo $row['no_telp'] ?>
              </td>
              <td>
                <?php echo $row['alamat'] ?>
              </td>
              <td>
                <a href="mahasiswa/foto/<?php echo $row['foto'] ?>">Download</a>
              </td>
              <?php if ($_SESSION['level'] == 'Administrator') { ?>
              <td>
                <div class="button-container" style="display: flex; gap: 5px;">
                  <a href="index.php?page=mahasiswa/edit&kode=<?php echo $row['id'] ?>" title="Ubah"
                    class="btn btn-success btn-sm">
                    <i class="fa fa-edit"></i>
                  </a>
                  <a href="index.php?page=mahasiswa/hapus&kode=<?php echo $row['id'] ?>"
                    onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus"
                    class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i>
                  </a>
                </div>
              </td>
              <?php
          }
        }
          ?>
            </tr>

            
        </tbody>
        </tfoot>
      </table>
    </div>
  </div>
  <!-- /.card-body -->