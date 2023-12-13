<div class="card">
    <div class="card-body">
        <h3 class="card-title"> <i class="fa fa-table"></i> Data Kelas</h3>
        <?php
        $no = 1;
        if ($_SESSION['level'] == 'Administrator') {
            ?>
            <br>
            <div>
                <a href="index.php?page=kelas/form_kelas" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Data Kelas</a>
            </div>
        <?php } ?>
        <br>
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jurusan</th>
                        <th>Kelas</th>
                        <?php if ($_SESSION['level'] == 'Administrator') { ?>
                            <th>Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>
                <?php
                include "kelas/proses/koneksi.php";
                $data = mysqli_query($koneksi, "SELECT * FROM tb_kelas");
                while ($row = mysqli_fetch_array($data)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $no++; ?>
                        </td>
                        <td>
                            <?php echo $row['nm_jurusan']; ?>
                        </td>
                        <td>
                            <?php echo $row['kelas']; ?>
                        </td>
                        <?php if ($_SESSION['level'] == 'Administrator') { ?>

                            <td>
                                <a href="index.php?page=kelas/edit&kode=<?php echo $row['id_kelas']; ?>" title="Ubah"
                                    class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="kelas/hapus.php?kode=<?php echo $row['id_kelas']; ?>"
                                    onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus"
                                    class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        <?php } ?>

                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>