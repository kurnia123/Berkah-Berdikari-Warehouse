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
	header("Content-Disposition: attachment; filename=Data Laporan Pengeluaran Barang.xls");
    require "../conf/init.php";
    cek();
	?>

	<table border="1">
		<tr>
			<th>No</th>
			<th>No. Faktur</th>
			<th>Pelanggan</th>
			<th>Tanggal</th>
			<th>Jumlah Barang</th>
			<th>Jumlah Bayar</th>
			<th>Kasir</th>
		</tr>
		<?php 
		$no = 1;
        $sql = "select trafaktur, trapelanggan, tratanggal, tratotal, (select count(trafaktur) from transaksi_detail where trafaktur=t.trafaktur ) as jumbarang, username
            from transaksi t 
            inner join user u on u.userid = t.userid order by tratanggal desc" ;

        $data = query($sql);

		while($d = mysqli_fetch_array($data)){
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $d['trafaktur']; ?></td>
			<td><?php echo $d['trapelanggan']; ?></td>
			<td><?php echo $d['tratanggal']; ?></td>
			<td><?php echo $d['tratotal']; ?></td>
			<td><?php echo $d['jumbarang']; ?></td>
			<td><?php echo $d['username']; ?></td>
		</tr>
		<?php 
		}
		?>
	</table>
</body>
</html>