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

<?php 
$id = $_GET['id'];
$sql = "SELECT * FROM tb_barang WHERE kode_barang = '$id' ";
$query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
$data = mysqli_fetch_assoc($query);
 ?>
<form method="post" action="">
	<div class="form-group">
		<label for="Kode_barang">Kode Barang</label>
		<input type="text" required name="kodebrg" readonly class="form-control" value="<?= $data['kode_barang'] ?>" id="Kode_barang">
	</div>
	<div class="form-group">
		<label for="kode_barcode">Kode Barcode</label>
		<input type="text" required name="kode_barcode" class="form-control" value="<?= $data['kd_barcode'] ?>" id="kode_barcode">
	</div>
	<div class="form-group">
		<label for="nama_barang">Nama Barang</label>
		<input type="text" required name="namabrg" class="form-control" value="<?= $data['nama_barang'] ?>" id="nama_barang">
	</div>
	<div class="form-group">
		<label for="stok">Stok</label>
		<input type="number" class="form-control" required name="stok" value="<?= $data['stok'] ?>" id="stok">
	</div>
	<div class="form-group">
		<label for="satuan">Satuan</label>
		<select class="form-control show-tick" required name="satuan" id="satuan">
			<option value="Lusin"<?php if ($data['satuan'] == 'Lusin') {echo "selected";} ?>>Lusin</option>
			<option value="Pack" <?php if ($data['satuan'] == 'Pack') {echo "selected";} ?>>Pack</option>
			<option value="Pcs"	 <?php if ($data['satuan'] == 'Pcs') {echo "selected";} ?>>Pcs</option>
		</select>
	</div>
	<div class="form-group">
		<label for="harga_beli">Harga_beli</label>
		<input type="number" onkeyup="sum()" required name="hrgbl" class="form-control" value="<?= $data['harga_beli'] ?>" id="harga_beli">
	</div>
	<div class="form-group">
		<label for="harga_jual">Harga Jual</label>
		<input type="number" onkeyup="sum()" required name="hrgjual" class="form-control" value="<?= $data['harga_jual'] ?>" id="harga_jual">
	</div>
	<div class="form-group">
		<label for="profit">profit</label>
		<input type="number" readonly required name="profit" class="form-control" value="<?= $data['profit'] ?>" id="profit">
		<small id="validasi" class="form-text text-muted text-danger text-italic"></small>
	</div>
	<button type="submit" id="tombol" name="ubah" class="btn btn-primary">Ubah</button>
	<a href="?page=barang"class="btn btn-danger">Batal</a>
</form>

<?php 

if (isset($_POST['ubah'])) {

	$kodebrg = mysqli_real_escape_string($conn,$_POST['kodebrg']);
	$kode_barcode = mysqli_real_escape_string($conn,$_POST['kode_barcode']);
	$namabrg = mysqli_real_escape_string($conn,$_POST['namabrg']);
	$satuan = mysqli_real_escape_string($conn,$_POST['satuan']);
	$stok = mysqli_real_escape_string($conn,$_POST['stok']);
	$hrgbl = mysqli_real_escape_string($conn,$_POST['hrgbl']);
	$hrgjual = mysqli_real_escape_string($conn,$_POST['hrgjual']);
	$profit = mysqli_real_escape_string($conn,$_POST['profit']);

	$sql_tambah = "UPDATE tb_barang SET kd_barcode = '$kode_barcode', nama_barang = '$namabrg',satuan = '$satuan',stok = '$stok',harga_beli = '$hrgbl',harga_jual = '$hrgjual',profit = '$profit' WHERE kode_barang = '$kodebrg' ";

	$query_tambah = mysqli_query($conn,$sql_tambah) or die(mysqli_error($conn));

	if ($query_tambah) {
		?>
		<script type="text/javascript">
			alert('data berhasil diubah');
			document.location='<?= baseUrl('view/admin?page=barang') ?>';
		</script>
		<?php
	}else{
		?>
		<script type="text/javascript">
			alert('data gagal diubah');
			document.location='<?= baseUrl('view/admin?page=barang') ?>';
		</script>
		<?php
	}

}

 ?>