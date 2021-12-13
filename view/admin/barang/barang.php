<script type="text/javascript">
	function sum() {
		var harga_beli = document.getElementById('harga_beli').value;
		var harga_jual = document.getElementById('harga_jual').value;
		var result = parseInt(harga_jual) - parseInt(harga_beli);

		if (!isNaN(result)) {
			var profit = document.getElementById('profit').value = result;
		}
		if (profit < 1) {
			var validasi = document.getElementById('validasi').innerHTML = '*harga jual harus lebih tinggi dari harga beli';
			document.getElementById('tombol').disabled = 'true';
		}else{
			document.getElementById('tombol').removeAttribute('disabled');
			var validasi = document.getElementById('validasi').innerHTML = '';
		}
	}
</script>

<div class="row">
	<div class="col-md-">
		<!-- BORDERED TABLE -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Data Barang</h3>
			</div>
			<div class="panel-body">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah" style="margin-bottom: 20px"><i class="fa fa-plus"></i> Tambah Barang</button>
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Barang</th>
							<th>Kode Barcode</th>
							<th>Nama Barang</th>
							<th>Stok</th>
							<th>Harga Beli</th>
							<th>Harga Jual</th>
							<th>Profit</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody >
						<?php
						$sql = "SELECT * FROM tb_barang";
						$no = 1;
						$query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
						while ($data = mysqli_fetch_assoc($query)) :?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $data['kode_barang'] ?></td>
							<td><?= $data['kd_barcode'] ?></td>
							<td><?= $data['nama_barang'] ?></td>
							<?php
							if ($data['stok'] < 6) {
							 	echo "<td style='color: red'>".$data['stok']." ".$data['satuan']. "</td>";
							 }else{
							 	echo "<td style='color: green'>".$data['stok']." ".$data['satuan']. "</td>";
							 }
							 ?>
							<td><?= $data['harga_beli'] ?></td>
							<td><?= $data['harga_jual'] ?></td>
							<td><?= $data['profit'] ?></td>
							<td>
								<a href="?page=barang&aksi=ubah_barang&id=<?= $data['kode_barang'] ?>"class="btn btn-success"><i class="fa fa-edit"></i></a>
								<form action="" method="post" style="display: inline;">
									<input type="hidden" name="id" value="<?= $data['kode_barang'] ?>"></input> | 
									<button type="submit" name="hapus" onclick="return confirm('yakin ingin menghapus data')" class="btn btn-danger"><i class="fa fa-trash"></i></a></button>
								</form>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
<!-- END BORDERED TABLE -->

<?php

// mengambil data barang dengan kode paling besar
$query_brg = mysqli_query($conn, "SELECT max(kode_barang) as kodeTerbesar FROM tb_barang");
$data_brg = mysqli_fetch_array($query_brg);
$kodeBarang = $data_brg['kodeTerbesar'];

// mengambil angka dari kode barang terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
$urutan = (int) substr($kodeBarang, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;

// membentuk kode barang baru
// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
$huruf = "BRG";
$kodeBarang = $huruf . sprintf("%03s", $urutan);
?>
<!-- Modal -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="">
					<div class="form-group">
						<label for="Kode_barang">Kode Barang</label>
						<input type="text" required name="kodebrg" readonly class="form-control" value="<?= $kodeBarang ?>" id="Kode_barang">
					</div>
					<div class="form-group">
						<label for="kode_barcode">Kode Barcode</label>
						<input type="text" required name="kode_barcode" class="form-control" placeholder="Masukkan Kode Barang" id="kode_barcode">
					</div>
					<div class="form-group">
						<label for="nama_barang">Nama Barang</label>
						<input type="text" required name="namabrg" class="form-control" placeholder="Masukkan Nama Barang" id="nama_barang">
					</div>
					<div class="form-group">
						<label for="stok">Stok</label>
						<input type="number" required name="stok" class="form-control" placeholder="Masukkan Stok" id="stok">
					</div>
					<div class="form-group">
						<label for="satuan">Satuan</label>
						<select class="form-control" required name="satuan" id="satuan">
							<option value="">-- PILIH --</option>
							<option value="Lusin">LUSIN</option>
							<option value="Pack">PACK</option>
							<option value="Pcs">PCS</option>
						</select>
					</div>
					<div class="form-group">
						<label for="harga_beli">Harga_beli</label>
						<input type="number" required name="hrgbl" onkeyup="sum()" class="form-control" placeholder="Masukkan Harga Beli" id="harga_beli">
					</div>
					<div class="form-group">
						<label for="harga_jual">Harga Jual</label>
						<input type="number" required onkeyup="sum()" name="hrgjual" class="form-control" placeholder="Masukkan Harg Jual" id="harga_jual">
					</div>
					<div class="form-group">
						<label for="profit">profit</label>
						<input type="number" required name="profit" value="0" readonly class="form-control" id="profit" aria-describedby="validasi">
						<small id="validasi" class="form-text text-muted text-danger text-italic"></small>
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

	$kodebrg = mysqli_real_escape_string($conn,$_POST['kodebrg']);
	$kode_barcode = mysqli_real_escape_string($conn,$_POST['kode_barcode']);
	$namabrg = mysqli_real_escape_string($conn,$_POST['namabrg']);
	$satuan = mysqli_real_escape_string($conn,$_POST['satuan']);
	$stok = mysqli_real_escape_string($conn,$_POST['stok']);
	$hrgbl = mysqli_real_escape_string($conn,$_POST['hrgbl']);
	$hrgjual = mysqli_real_escape_string($conn,$_POST['hrgjual']);
	$profit = mysqli_real_escape_string($conn,$_POST['profit']);

	$sql_tambah = "INSERT INTO tb_barang VALUES(
	'$kodebrg','$kode_barcode','$namabrg','$satuan','$hrgbl','$stok','$hrgjual','$profit')";

	$query_tambah = mysqli_query($conn,$sql_tambah) or die(mysqli_error($conn));

	if ($query_tambah) {
		?>
		<script type="text/javascript">
			alert('data berhasil ditambah');
			document.location='<?= baseUrl('view/admin?page=barang') ?>';
		</script>
		<?php
	}else{
		?>
		<script type="text/javascript">
			alert('data gagal ditambah');
			document.location='<?= baseUrl('view/admin?page=barang') ?>';
		</script>
		<?php
	}

}

if (isset($_POST['hapus'])) {
	$id = $_POST['id'];
	$hapus = mysqli_query($conn,"DELETE FROM tb_barang WHERE kode_barang = '$id' ") or die(mysqli_error($conn));
	if ($hapus) {
		?>
		<script type="text/javascript">
			alert('data berhasil dihapus');
			document.location='<?= baseUrl('view/admin?page=barang') ?>';
		</script>
		<?php
	}else{
		?>
		<script type="text/javascript">
			alert('data gagal dihapus');
			document.location='<?= baseUrl('view/admin?page=barang') ?>';
		</script>
		<?php
	}
}

 ?>