<?php
include "component/koneksi.php";
$pesannama = "";
$pesanuser = "";
$pesanpass = "";
$pesanlevel = "";
$pesan = "";

if (isset($_POST['edit'])) {
	$id = $_POST['id'];
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
		$data = ("UPDATE tb_login SET nama='$nama', username='$username', password='$password', level='$level' WHERE id='$id'");
		$hasil = mysqli_query($koneksi, $data);
		echo '<script>window.location.href = "index.php?page=datauser";</script>';
	}
}
?>
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Edit Data User
		</h3>
	</div>
	<?php
	include "proses/koneksi.php";

	// Ambil kode nim dari URL
	$kode = $_GET['kode'];

	// Query untuk mendapatkan data mahasiswa berdasarkan nim
	$q = mysqli_query($koneksi, "SELECT * FROM tb_login WHERE id='$kode'");

	// Periksa apakah ada hasil dari query atau tidak
	if (mysqli_num_rows($q) > 0) {
		$ary = mysqli_fetch_array($q);
	} else {
		echo "Data user tidak ditemukan.";
		exit; // Berhenti eksekusi script jika data tidak ditemukan
	}
	?>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">
			<input type='hidden' class="form-control" name="id" value="<?php echo $ary['id']; ?>" />
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama User</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $ary['nama']; ?>" />
					<p class="col-form-label" style="color: red;">
						<?php echo $pesannama ?>
					</p>
				</div>
			</div>
			<br>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Username</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="username" name="username" value="<?php echo $ary['username']; ?>"  />
					<p class="col-form-label" style="color: red;">
						<?php echo $pesanuser ?>
					</p>
				</div>
			</div>
			<br>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Password</label>
				<div class="col-sm-6">
					<input type="password" class="form-control" id="pass" name="password" value="<?php echo $ary['password']; ?>"  />
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
						<option value="">-- Pilih Level --</option>
						<?php
						$selectedAdmin = ($ary['level'] == "Administrator") ? "selected" : "";
						$selectedUser = ($ary['level'] == "User") ? "selected" : "";
						?>
						<option value="Administrator" <?php echo $selectedAdmin; ?>>Administrator</option>
						<option value="User" <?php echo $selectedUser; ?>>User</option>
					</select>
					<p class="col-form-label" style="color: red;">
						<?php echo $pesanlevel ?>
					</p>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="edit" value="Simpan" class="btn btn-success">
			<a href="?page=datauser" title="Kembali" class="btn btn-secondary">Batal</a>
			<p class="text-left" style="color: red;">
				<?php echo $pesan ?>
			</p>
		</div>
	</form>
</div>