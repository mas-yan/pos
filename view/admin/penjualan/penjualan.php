
<script type="text/javascript">
	function fundiskon() {
		var total = Number(document.getElementById('total').value);
		var diskon = Number(document.getElementById('diskon').value);
		var bayar = document.getElementById('bayar').value;		

		var resdisk = total * diskon;
		var result_diskon = resdisk / Number(100);
		var potongan = document.getElementById('potongan').value = result_diskon;
		var result_sub = Number(total) - Number(potongan);
		var sub_total = document.getElementById('sub_total').value = result_sub;

		if (!isNaN(sub_total)) {
			var total_bayar = Number(bayar) - Number(sub_total);
			var kembali = document.getElementById('kembali').value = total_bayar;
		}else{
			var total_bayar = Number(bayar) - Number(total);
			var kembali = document.getElementById('kembali').value = total_bayar;
		}

		if (kembali < 0) {
			var validasi = document.getElementById('validasi').innerHTML = '*Uang pelanggan kurang';
			document.getElementById('cetak').disabled = 'true';
		}else{
			document.getElementById('cetak').removeAttribute('disabled');
			var validasi = document.getElementById('validasi').innerHTML = '';
		}
	}
</script>

<?php 

// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

include_once 'kode_pj.php';
$kode = $_GET['kode'];

?>

<div class="row">
	<form action="" method="post">
		<div class="col-md-2">
			<input type="text" name="kode" value="<?= $kode ?>" class="form-control" readonly></input>
		</div>
		<div class="col-md-2">
			<input type="text" name="kode_barcode" required autofocus class="form-control"></input>
		</div>
		<div class="col-md-2">
			<button class="btn btn-primary" name="simpan" type="submit">Tambahkan</button>
		</div>
	</form>
</div>

<?php 

if (isset($_POST['simpan'])) {

	$kode = mysqli_real_escape_string($conn,$_POST['kode']);
	$kode_barcode = mysqli_real_escape_string($conn,$_POST['kode_barcode']);

	$jumlah = 1;
	$barang = mysqli_query($conn, "SELECT * FROM tb_barang WHERE kd_barcode = '$kode_barcode' ");

	$date = date('Y-m-d');
	while ($data = mysqli_fetch_assoc($barang)) {
		
		$harga_jual = $data['harga_jual'];
		$total = $jumlah * $harga_jual;
		$sisa = $data['stok'];

		if ($sisa == 0) {
			?>
			<script type="text/javascript">
				alert('stok habis');
				document.location='?page=penjualan&kode=<?= $kode ?>';
			</script>
			<?php
		}else{
			mysqli_query($conn,"INSERT INTO tb_penjualan VALUES(
				'','$kode','$kode_barcode','$jumlah','$total','$date',''
				)");
		}
	}
}

?>

<div class="row" style="margin-top: 20px">
	<div class="col-md-">
		<!-- BORDERED TABLE -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Data Barang</h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Barcode</th>
							<th>Nama Barang</th>
							<th>Harga</th>
							<th>Jumlah</th>
							<th>Total</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sql = "SELECT * FROM tb_penjualan,tb_barang WHERE tb_penjualan.kd_barcode = tb_barang.kd_barcode AND kd_penjualan = '$kode' ";
						$no = 1;
						$total_bayar = 0;
						$query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
						while ($data = mysqli_fetch_assoc($query)) :?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $data['kd_barcode'] ?></td>
							<td><?= $data['nama_barang'] ?></td>
							<td><?= $data['harga_jual'] ?></td>
							<td><?= $data['jumlah'] ?></td>
							<td><?= $data['total'] ?></td>
							<td>
								<form action="" method="post" style="display: inline;">
									<input type="hidden" name="id" value="<?= $data['id_penjualan'] ?>"></input>
									<input type="hidden" name="jumlah" value="<?= $data['jumlah'] ?>"></input>
									<input type="hidden" name="kd" value="<?= $data['kd_barcode'] ?>"></input>
									<button type="submit" data-toggle="tooltip" data-placement="bottom" title="Add" name="tambah" class="btn btn-primary"><i class="fa fa-plus"></i></button>
									| 
									<button type="submit" name="kurang" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Remove"><i class="fa fa-minus"></i></a></button>
									| 
									<button type="submit" name="hapus" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Clear"><i class="fa fa-times"></i></a></button>
								</form>
							</td>
						</tr>
	<?php

	$total_bayar += $data['total'];
	endwhile;

	if (isset($_POST['tambah'])) {
		
		$kd = $_POST['kd'];
		$id = $_POST['id'];

		$stok = mysqli_query($conn,"SELECT * FROM tb_barang WHERE kd_barcode = '$kd' ")or die(mysqli_error($conn));
		$data = mysqli_fetch_assoc($stok);
		$harga = $data['harga_jual'];

		if ($data['stok'] > 0) {
			$up_tambah = mysqli_query($conn,"UPDATE tb_penjualan SET jumlah = (jumlah+1) WHERE id_penjualan = '$id' ")or die(mysqli_error($conn));
			$bar_stok = mysqli_query($conn,"UPDATE tb_barang SET stok = (stok-1) WHERE kd_barcode = '$kd'")or die(mysqli_error($conn));
			$uptot = mysqli_query($conn,"UPDATE tb_penjualan SET total = (total+$harga) WHERE id_penjualan = '$id' ")or die(mysqli_error($conn));
			?>
			<script type="text/javascript">
				document.location='?page=penjualan&kode=<?= $kode ?>';
			</script>
			<?php
		}else{
			?>
			<script type="text/javascript">
				alert('stok habis');
				document.location='?page=penjualan&kode=<?= $kode ?>';
			</script>
			<?php
		}
	}

	if (isset($_POST['kurang'])) {
		$kd = $_POST['kd'];
		$id = $_POST['id'];

		$minus = mysqli_query($conn,"SELECT * FROM tb_penjualan,tb_barang WHERE tb_penjualan.id_penjualan = '$id' AND tb_barang.kd_barcode = '$kd' ")or die(mysqli_error($conn));
		$data = mysqli_fetch_assoc($minus);

		$harga = $data['harga_jual'];

		if ($data['jumlah'] > 0) {
			
			$up_jumlah = mysqli_query($conn,"UPDATE tb_penjualan SET jumlah = (jumlah-1) WHERE id_penjualan = '$id' ")or die(mysqli_error($conn));
			$bar_stok = mysqli_query($conn,"UPDATE tb_barang SET stok = (stok+1) WHERE kd_barcode = '$kd'")or die(mysqli_error($conn));
			$uptot = mysqli_query($conn,"UPDATE tb_penjualan SET total = (total-$harga) WHERE id_penjualan = '$id' ")or die(mysqli_error($conn));
			?>
			<script type="text/javascript">
				document.location='?page=penjualan&kode=<?= $kode ?>';
			</script>
			<?php
		}else{
			?>
			<script type="text/javascript">
				alert('jumlah barang yang di beli kosong');
				document.location='?page=penjualan&kode=<?= $kode ?>';
			</script>
			<?php
		}
	}

	if (isset($_POST['hapus'])) {
		$id = $_POST['id'];
		$kd = $_POST['kd'];
		$jumlah = $_POST['jumlah'];
		$del = mysqli_query($conn,"DELETE FROM tb_penjualan WHERE id_penjualan = '$id' ");
		$up = mysqli_query($conn,"UPDATE tb_barang SET stok = (stok + $jumlah) WHERE kd_barcode = '$kd'");
		if ($up && $del) {
			?>
			<script type="text/javascript">
				document.location='?page=penjualan&kode=<?= $kode ?>';
			</script>
			<?php
		}
	}
	?>
					</tbody>
					<form action="" method="post">
						<input type="hidden" name="kode" value="<?= $kode ?>" class="form-control" readonly></input>
						<tr>
							<th colspan="5" style="text-align: right;">Total</th>
							<td>
								<input type="number" id="total" name="total" class="form-control" value="<?= $total_bayar ?>" readonly></input>
							</td>
						</tr>
						<tr>
							<th colspan="5" style="text-align: right;">Diskon</th>
							<td>
								<input type="number" id="diskon" onkeyup="fundiskon()" name="diskon" class="form-control"></input>
							</td>
						</tr>
						<tr>
							<th colspan="5" style="text-align: right;">Potongan Diskon</th>
							<td>
								<input type="number" id="potongan" readonly name="potongan" class="form-control"></input>
							</td>
						</tr>
						<tr>
							<th colspan="5" style="text-align: right;">Sub Total</th>
							<td>
								<input type="number" id="sub_total" readonly name="sub_total" class="form-control"></input>
							</td>
						</tr>
						<tr>
							<th colspan="5" style="text-align: right;">Bayar</th>
							<td>
								<input type="number" id="bayar" required onkeyup="fundiskon()" name="bayar" class="form-control"></input>
							</td>
						</tr>
						<tr>
							<th colspan="5" style="text-align: right;">kembalian</th>
							<td>
								<input type="number" id="kembali" readonly name="kembali" class="form-control" aria-describedby="validasi">
								<small id="validasi" class="form-text text-muted text-danger text-italic"></small>
							</td>
						</tr>
						<tr>
							<th colspan="5" style="text-align: right;">Nama Pelanggan</th>
							<td>
								<input type="text" name="nama" class="form-control"></input>
							</td>
						</tr>
						<tr>
							<td colspan="6" style="text-align: right;">
								<button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" id="batal" name="batal">Batal</button>
								| 
								<button class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Cetak Struk" id="cetak" name="cetak">Cetak Struk</button>
							</td>
						</form>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- END BORDERED TABLE -->

<?php 
if (isset($_POST['cetak'])) {
	$kode = $_POST['kode'];
	$bayar = mysqli_real_escape_string($conn,$_POST['bayar']);
	$kembali = mysqli_real_escape_string($conn,$_POST['kembali']);
	$diskon = mysqli_real_escape_string($conn,$_POST['diskon']);
	$potongan = mysqli_real_escape_string($conn,$_POST['potongan']);
	$total = mysqli_real_escape_string($conn,$_POST['total']);
	$nama = mysqli_real_escape_string($conn,$_POST['nama']);
	$sql_cetak = "INSERT INTO detail_penjualan VALUES (
	'','$kode','$bayar','$kembali','$diskon','$potongan','$total'
	)";
	$query_cetak = mysqli_query($conn,$sql_cetak) or die(mysqli_error($conn));
	$insert_pel = mysqli_query($conn,"INSERT INTO tb_pelanggan VALUES ('','$nama')") or die(mysqli_error($conn));
	$id = mysqli_insert_id($conn);
	$up_pen = mysqli_query($conn,"UPDATE tb_penjualan SET id_pelanggan = '$id' WHERE kd_penjualan = '$kode'") or die(mysqli_error($conn));

	if ($insert_pel && $query_cetak && $up_pen) {
		?>
		<script type="text/javascript">
			alert('ok');
		</script>
		<?php
	}
}

?>