<!DOCTYPE html>
<html>
<head>
	<title>Export Data Ke Excel</title>
</head>
<body>

	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Laporan Pengeluaran Barang.xls");
    require "../conf/init.php";
    cek();
	?>

	<center>
		<h1>Laporan Data Barang Keluar</h1>
		<h4>Tanggal 01 Juni 2021 S.d 30 Oktober 2021</h4>
	</center>

	<table border="1">
		<tr>
			<th>No</th>
			<th>ID</th>
			<th>No. Faktur</th>
			<th>Pelanggan</th>
			<th>Tanggal</th>
			<th>Produk</th>
			<th>Jum. Barang</th>
			<th>Harga</th>
			<th>Operator</th>
		</tr>
		<?php 
		$no = 1;
        $sql = "SELECT td.tdid, t.trafaktur, t.trapelanggan, t.tratanggal, p.pronama, td.tdjumlah, p.proharga, u.username
				FROM transaksi_detail td
				INNER JOIN transaksi t
				ON td.trafaktur = t.trafaktur
				INNER JOIN produk p
				ON td.proid = p.proid
				INNER JOIN user u
				ON t.userid = u.userid" ;

        $data = query($sql);

		while($row = mysqli_fetch_array($data)){
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $row['tdid'] ;?></td>
			<td><?php echo $row['trafaktur'] ;?></td>
			<td><?php echo $row['trapelanggan'] ;?></td>
			<td><?php echo $row['tratanggal'] ;?></td>
			<td><?php echo $row['pronama'] ;?></td>
			<td><?php echo $row['tdjumlah'] ;?></td>
			<td><?php echo $row['proharga'] ;?></td>
			<td><?php echo $row['username'] ;?></td>
		</tr>
		<?php 
		}
		?>
	</table>
</body>
</html>