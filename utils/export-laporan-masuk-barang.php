<!DOCTYPE html>
<html>
<head>
	<title>Export Data Ke Excel</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;

	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>

	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Laporan Pemasukan Barang.xls");
    require "../conf/init.php";
    cek();
	?>

	<table border="1">
		<tr>
			<th>No</th>
			<th>ID</th>
			<th>Nama</th>
			<th>Jumlah</th>
			<th>Harga</th>
			<th>Tanggal</th>
			<th>Supplier</th>
		</tr>
		<?php 
		$no = 1;
        $sql = "SELECT * FROM produk" ;

        $data = query($sql);

		while($d = mysqli_fetch_array($data)){
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $d['proid']; ?></td>
			<td><?php echo $d['pronama']; ?></td>
			<td><?php echo $d['projumlah']; ?></td>
			<td><?php echo $d['proharga']; ?></td>
			<td><?php echo $d['protanggal']; ?></td>
			<td><?php echo $d['prosupplier']; ?></td>
		</tr>
		<?php 
		}
		?>
	</table>
</body>
</html>