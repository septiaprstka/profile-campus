<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Data User
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <a href="index.php?page=datauser/input_datauser" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Data</a>
            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include "datauser/proses/koneksi.php";
                    $no = 1;
                    $data = mysqli_query($koneksi, "SELECT * FROM tb_login");
                    while ($row = mysqli_fetch_array($data)) {
                        ?>

                        <tr>
                            <td>
                                <?php echo $no++; ?>
                            </td>
                            <td>
                                <?php echo $row['nama'] ?>
                            </td>
                            <td>
                                <?php echo $row['username'] ?>
                            </td>
                            <td>
                                <?php echo $row['level'] ?>
                            </td>
                            <td>
                                <a href="index.php?page=datauser/edit&kode=<?php echo $row['id'] ?>" title="Ubah"
                                    class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="datauser/hapus.php?id=<?php echo $row['id'] ?>"
                                    onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus"
                                    class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        <?php
                    }
                    ?>
                </tbody>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- /.card-body -->