<?php
include "component/koneksi.php";
$pesannama = "";
$pesanuser = "";
$pesanpass = "";
$pesanlevel = "";
$pesan = "";

if (isset($_POST['daftar'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    if (empty($nama) && empty($username) && empty($password) && empty($level)) {
        $pesannama = "Nama harus diisi";
        $pesanuser = "Username harus diisi";
        $pesanpass = "Password harus diisi";
        $pesanlevel = "Level harus diisi";
    } elseif (empty($nama) && empty($username)) {
        $pesannama = "Nama harus diisi";
        $pesanuser = "Username harus diisi";
    } elseif (empty($nama) && empty($password)) {
        $pesannama = "Nama harus diisi";
        $pesanpass = "Password harus diisi";
    } elseif (empty($nama) && empty($level)) {
        $pesannama = "Nama harus diisi";
        $pesanlevel = "Level harus diisi";
    } elseif (empty($username) && empty($password)) {
        $pesanuser = "Username harus diisi";
        $pesanpass = "Password harus diisi";
    } elseif (empty($username) && empty($level)) {
        $pesanuser = "Username harus diisi";
        $pesanlevel = "Level harus diisi";
    } elseif (empty($password) && empty($level)) {
        $pesanpass = "Password harus diisi";
        $pesanlevel = "Level harus diisi";
    } elseif (empty($nama)) {
        $pesannama = "Nama harus diisi";
    } elseif (empty($username)) {
        $pesanuser = "Username harus diisi";
    } elseif (empty($password)) {
        $pesanpass = "Password harus diisi";
    } elseif (empty($level)) {
        $pesanlevel = "Level harus diisi";
        } else {
            // Periksa apakah username dan level sudah ada di database
            $check_query = "SELECT * FROM tb_login WHERE username = '$username' AND level ='$level'";
            $check_result = mysqli_query($koneksi, $check_query);

            if (mysqli_num_rows($check_result) > 0) {
                $pesan = "Username sudah ada. Silakan pilih username lain.";
            } else {
                // Jika username belum ada, lakukan pendaftaran
                $data = "INSERT INTO tb_login (nama, username, password, level) VALUES ('$nama', '$username', '$password','$level')";
                $hasil = mysqli_query($koneksi, $data);
            echo '<script>window.location.href = "index.php?page=datauser";</script>';
                // header("location: ../index.php?page=datauser");
        }
    }
}
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Tambah Data User
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama User</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nama_pengguna" name="nama" placeholder="Nama user">
                    <p class="col-form-label" style="color: red;">
                        <?php echo $pesannama ?>
                    </p>
                </div>
            </div>
            <br>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    <p class="col-form-label" style="color: red;">
                        <?php echo $pesanuser ?>
                    </p>
                </div>
            </div>

            <br>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="pass" name="password">
                    <input id="mybutton" onclick="change()" type="checkbox" class="form-checkbox"> Lihat Password
                    <p class="col-form-label" style="color: red;">
                        <?php echo $pesanpass ?>
                    </p>
                </div>
                <script>
                    function change() {
                        var x = document.getElementById("pass");
                        var btn = document.getElementById("mybutton");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                    }
                </script>
            </div>
            <br>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Level</label>
                <div class="col-sm-4">
                    <select name="level" id="level" class="form-control">
                        <option value="">- Pilih -</option>
                        <option value="Administrator">Administrator</option>
                        <option value="User">User</option>
                    </select>
                    <p class="col-form-label" style="color: red;">
                        <?php echo $pesanlevel ?>
                    </p>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <input type="submit" name="daftar" value="Simpan" class="btn btn-info">
            <a href="?page=datauser" title="Kembali" class="btn btn-secondary">Batal</a>
            <p class="text-left" style="color: red;">
                <?php echo $pesan ?>
            </p>
        </div>
    </form>
</div>