<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Data Jurusan
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
        <?php if ($_SESSION['level'] == 'Administrator') { ?>
            <div>
                <a href="index.php?page=jurusan/input_jurusan" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Data Jurusan</a>
            </div>
            <?php } ?>
            <br>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jurusan</th>
                        <th>Sarana dan Prasarana</th>
                        <th>Akreditasi</th>
                        <th>Jenjang</th>
                        <?php if ($_SESSION['level'] == 'Administrator') { ?>
                            <th>Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>


                    <?php
                    include "jurusan/proses/koneksi.php";
                    $no = 1;
                    $query = "SELECT j.kode, j.nm_jurusan, j.sarpras, j.akreditasi, jj.nm_jenjang AS jenjang, a.nm_akre AS akreditasi_nama
                    FROM jurusan j
                    INNER JOIN tb_jenjang jj ON j.jj = jj.id_jenjang
                    INNER JOIN tb_akreditasi a ON j.akreditasi = a.id_akre";
                    $result = mysqli_query($koneksi, $query);

                    // Tampilkan data jurusan ke dalam tabel
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                        <tr>
                            <td>
                                <?php echo $no++; ?>
                            </td>
                            <td>
                                <?php echo $row['nm_jurusan'] ?>
                            </td>
                            <td>
                                <?php echo $row['sarpras'] ?>
                            </td>
                            <td>
                                <?php echo $row['akreditasi_nama'] ?>
                            </td>
                            <td>
                                <?php echo $row['jenjang'] ?>
                            </td>
                            <?php if ($_SESSION['level'] == 'Administrator') { ?>
                            <td>
                                <a href="index.php?page=jurusan/edit&kode=<?php echo $row['kode'] ?>" title="Ubah"
                                    class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="index.php?page=jurusan/hapus&kode=<?php echo $row['kode'] ?>"
                                    onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus"
                                    class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                            <?php } ?>
                        </tr>

                        <?php
                    }
                    ?>
                </tbody>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<!-- /.card-body -->