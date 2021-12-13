<div class="row">
	<div class="col-md-">
		<!-- BORDERED TABLE -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Data User</h3>
			</div>
			<div class="panel-body">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah" style="margin-bottom: 20px"><i class="fa fa-plus"></i> Tambah user</button>
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Username</th>
							<th>Password</th>
							<th>Status</th>
							<th>Level</th>
							<th>foto</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody >
						<?php
						$sql = "SELECT * FROM tb_user";
						$no = 1;
						$query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
						while ($data = mysqli_fetch_assoc($query)) :?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $data['nama'] ?></td>
							<td><?= $data['username'] ?></td>
							<td><i>tidak di tampilkan</i></td>
							<td><?= $data['status'] ?></td>
							<td><?= $data['level'] ?></td>
							<td><img style="width: 50px;height: 50px" src="img/<?= $data['foto'] ?>"></td>
							<td class="text-center">
								<button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit<?= $data['id_user'] ?>"><i class="fa fa-edit"></i></button>
								<form action="" method="post" enctype="multipart/form-data" style="display: inline;">
									<input type="hidden" name="id" value="<?= $data['id_user'] ?>"></input><input type="hidden" name="fotdir" value="<?= $data['foto'] ?>"></input>
									 | 
									<button type="submit" name="hapus" onclick="return confirm('yakin ingin menghapus data')" class="btn btn-danger"><i class="fa fa-trash"></i></a></button>
								</form>
							</td>
						</tr>
						<!-- Modal Edit-->
<div class="modal fade" id="edit<?= $data['id_user']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Edit user</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" enctype="multipart/form-data" action="">
					<input type="hidden" name="status" value="Aktif"></input>
					<input type="hidden" name="id_user" value="<?= $data['id_user'] ?>"></input>
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" required name="nama" value="<?= $data['nama'] ?>" class="form-control" placeholder="Masukkan Nama user" id="nama">
						</div>
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" required value="<?= $data['username'] ?>" name="username" class="form-control" placeholder="Masukkan Nama user" id="username">
						</div>
						<div class="form-group">
							<label for="password">Password </label><small><i> (Untuk mengubah Password Pastikan sudah ada persetujuan dengan user)</i></small>
							<input type="password" name="password" class="form-control" placeholder="Masukkan password" id="password">
							<small style="color: red"><i>kosongkan jika tidak ingin mengganti password</i></small>
						</div>
						<div class="form-group">
							<label for="level">level</label>
							<select class="form-control show-tick" required name="level" id="level">
							<option value="Admin"<?php if ($data['level'] == 'Admin') {echo "selected";} ?>>Admin</option>
							<option value="Kasir" <?php if ($data['level'] == 'Kasir') {echo "selected";} ?>>Kasir</option>
							</select>
						</div>
						<div class="form-group">
							<label for="gambar">gambar</label>
							<img id="gambar" class="form-control" style="width: 50px;height: 50px" src="img/<?= $data['foto'] ?>">
						</div>
						<div class="form-group">
							<label for="foto">Foto</label>
							<input type="file" class="form-control-file" name="foto" id="foto">
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" id="tombol" name="edit" class="btn btn-primary">Ubah</button>
				</form>
			</div>
		</div>
	</div>
</div>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
<!-- END BORDERED TABLE -->

<!-- Modal Tambah-->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Tambah user</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" enctype="multipart/form-data" action="">
					<input type="hidden" name="status" value="Aktif"></input>
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" required name="nama" class="form-control" placeholder="Masukkan Nama user" id="nama">
						</div>
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" required name="username" class="form-control" placeholder="Masukkan Nama user" id="username">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" required name="password" class="form-control" placeholder="Masukkan password" id="password">
						</div>
						<div class="form-group">
							<label for="level">level</label>
							<select class="form-control" required name="level" id="level">
								<option value="">-- PILIH --</option>
								<option value="Admin">Admin</option>
								<option value="Kasir">Kasir</option>
							</select>
						</div>
						<div class="form-group">
							<label for="foto">Foto</label>
							<input type="file" class="form-control-file" name="foto" id="foto">
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" id="tombol" name="tambah" class="btn btn-primary">Tambah</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 

if (isset($_POST['tambah'])) {

	// mengambil data foto dengan kode paling besar
$query_foto = mysqli_query($conn, "SELECT max(foto) as kodeFoto FROM tb_user");
$data_foto = mysqli_fetch_array($query_foto);
$id_foto = $data_foto['kodeFoto'];

// mengambil angka dari kode foto terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
$urutan = (int) substr($id_foto, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;

// membentuk kode foto baru
// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya foto 
$huruf = "FTO";
$id_foto = $huruf . sprintf("%03s", $urutan);

	// mengambil data yg dikirim dari form
	$nama = mysqli_real_escape_string($conn,$_POST['nama']);
	$username = mysqli_real_escape_string($conn,$_POST['username']);
	$password = md5(mysqli_real_escape_string($conn,$_POST['password']));
	$status = mysqli_real_escape_string($conn,$_POST['status']);
	$level = mysqli_real_escape_string($conn,$_POST['level']);

	$foto = $_FILES['foto']['name'];
	$lokasi = $_FILES['foto']['tmp_name'];
	$ukuran = $_FILES['foto']['size'];

	// apakah yg di upload adalah gambar
	$ekstensi = ['jpg','png','jpeg'];
	$ekstensigambar = explode('.', $foto);
	$ekstensigambar = strtolower(end($ekstensigambar));

	// jika yg diupload berdasarkan ekstensi
	// maka akan berhasil
	if (in_array($ekstensigambar, $ekstensi)) {

		// jika yg di upload kurang dari 1mb maka akan berhasil
		if ($ukuran < 1000000) {

			// mengirim data ke db
			// $eksup = $id_foto.'.'.$ekstensigambar;
			$upload = move_uploaded_file($lokasi, 'img/'.$id_foto);
			$sql_tambah = "INSERT INTO tb_user VALUES('','$nama','$username','$password','$status','$level','$id_foto')";

			$query_tambah = mysqli_query($conn,$sql_tambah) or die(mysqli_error($conn));

			// jika berhasil akan tampil
			if ($query_tambah) {
				?>
				<script type="text/javascript">
					alert('data berhasil ditambah');
					document.location='<?= baseUrl('view/admin?page=user') ?>';
				</script>
				<?php
				// jika gagal
			}else{
				?>
				<script type="text/javascript">
					alert('data gagal ditambah');
					document.location='<?= baseUrl('view/admin?page=user') ?>';
				</script>
				<?php
			}

		// jika gambar lebih dari 1mb maka gagal
		}else{

			?>
			<script type="text/javascript">
				alert('file harus kurang dari 1mb');
			</script>
			<?php
		}

	// jika file bukan termasuk ekstensi maka gagal
	}else{
		?>
		<script type="text/javascript">
			alert('file harus berekstensi jpg,png,jpeg');
		</script>
		<?php
	}
}

// jika hapus di klik
if (isset($_POST['hapus'])) {

	// mengambil informasi dari form
	$id = $_POST['id'];
	$foto = $_POST['fotdir'];

	// menghapus file di direktori
	unlink('img/'.$foto);
	// sql hapus
	$hapus = mysqli_query($conn,"DELETE FROM tb_user WHERE id_user = '$id' ") or die(mysqli_error($conn));

	// jika berhasil maka data akan terhapus
	if ($hapus) {
		?>
		<script type="text/javascript">
			alert('data berhasil dihapus');
			document.location='<?= baseUrl('view/admin?page=user') ?>';
		</script>
		<?php
	}else{
		?>
		<script type="text/javascript">
			alert('data gagal dihapus');
			document.location='<?= baseUrl('view/admin?page=user') ?>';
		</script>
		<?php
	}
}

// jika edit di klik
if (isset($_POST['edit'])) {



// mengambil informasi dari form
	$id_user = $_POST['id_user'];
	$nama = mysqli_real_escape_string($conn,$_POST['nama']);
	$username = mysqli_real_escape_string($conn,$_POST['username']);
	$password = md5(mysqli_real_escape_string($conn,$_POST['password']));
	$status = mysqli_real_escape_string($conn,$_POST['status']);
	$level = mysqli_real_escape_string($conn,$_POST['level']);
	$sql_ubah = null;

	// mengambil data foto dengan kode paling besar
	$query_foto = mysqli_query($conn, "SELECT foto FROM tb_user WHERE id_user = $id_user");
	$data_foto = mysqli_fetch_assoc($query_foto);
	$id_foto = $data_foto['foto'];

	$foto = $_FILES['foto']['name'];
	$lokasi = $_FILES['foto']['tmp_name'];
	$ukuran = $_FILES['foto']['size'];

	// apakah yg di upload adalah gambar
	$ekstensi = ['jpg','png','jpeg'];
	$ekstensigambar = explode('.', $foto);
	$ekstensigambar = strtolower(end($ekstensigambar));


	
	// jika password dan gambar tidak diubah
	if ($password == null && empty($lokasi)) {
		$sql_ubah = "UPDATE tb_user SET nama = '$nama', username = '$username', level = '$level' WHERE id_user = '$id_user' ";

	// jika password dan gambar diubah
	}elseif ($password != null && !empty($lokasi)) {
		if (in_array($ekstensigambar, $ekstensi)) {
			if ($ukuran < 1000000) {
						// $eksup = $id_foto.'.'.$ekstensigambar;
				$upload = move_uploaded_file($lokasi, 'img/'.$id_foto);
				$sql_ubah = "UPDATE tb_user SET nama = '$nama', username = '$username', password = '$password',level = '$level',foto = '$id_foto' WHERE id_user = '$id_user' ";
			}else{

				?>
				<script type="text/javascript">
					alert('file harus kurang dari 1mb');
				</script>
				<?php
			}
		}else{
			?>
			<script type="text/javascript">
				alert('file harus berekstensi jpg,png,jpeg');
			</script>
			<?php
		}

	// jika password tidak diubah dan gambar diubah
	}elseif ($password == null && !empty($lokasi)) {
		if (in_array($ekstensigambar, $ekstensi)) {
			if ($ukuran < 1000000) {
						// $eksup = $id_foto.'.'.$ekstensigambar;
				$upload = move_uploaded_file($lokasi, 'img/'.$id_foto);
				$sql_ubah = "UPDATE tb_user SET nama = '$nama', username = '$username',level = '$level',foto = '$id_foto' WHERE id_user = '$id_user' ";
			}else{

				?>
				<script type="text/javascript">
					alert('file harus kurang dari 1mb');
				</script>
				<?php
			}
		}else{
			?>
			<script type="text/javascript">
				alert('file harus berekstensi jpg,png,jpeg');
			</script>
			<?php
		}

	// jika password diubah dan gambar tidak diubah
	}elseif ($password != null && empty($lokasi)) {
		$sql_ubah = "UPDATE tb_user SET nama = '$nama', username = '$username', password = '$password',level = '$level' WHERE id_user = '$id_user' ";
	}

	// jika benar maka data akan terubah
	if ($sql_ubah != null) {
		$query_ubah = mysqli_query($conn,$sql_ubah) or die(mysqli_error($conn));

		if ($query_ubah) {
			?>
			<script type="text/javascript">
				alert('data berhasil diubah');
				document.location='<?= baseUrl('view/admin?page=user') ?>';
			</script>
			<?php
		}else{
			?>
			<script type="text/javascript">
				alert('data gagal diubah');
				document.location='<?= baseUrl('view/admin?page=user') ?>';
			</script>
			<?php
		}
	}

}
?>