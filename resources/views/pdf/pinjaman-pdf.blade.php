<!DOCTYPE html>
<html>
<head>
	<title>Export PDF</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center style="margin-bottom: 20px">
		<h5>Laporan Pinjaman Buku</h4>
		<h6>Perpustakaan SMA Negeri 2 Kuta</h6>
	</center>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Kode Buku</th>
				<th>NIS</th>
				<th>Tanggal Pinjaman</th>
				<th>Tanggal Kembali</th>
				<th>Denda</th>
			</tr>
		</thead>
		<tbody>
			@forelse($pinjaman as $items)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{$items->kode_buku}}</td>
				<td>{{$items->nis}}</td>
				<td>{{$items->tgl_pinjaman}}</td>
				<td>{{$items->tgl_pengembalian}}</td>
				<td>{{$items->denda}}</td>
			</tr>
			@empty
			<tr><td>Data Kosong</td></tr>
			@endforelse
		</tbody>
	</table>
 
</body>
</html>