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
		<h5>Laporan Kunjungan Perpustakaan</h4>
		<h6>Perpustakaan SMA Negeri 2 Kuta</h6>
	</center>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>NIS</th>
				<th>Nama</th>
				<th>Alasan Berkunjung</th>
				<th>Tanggal Berkunjung</th>
			</tr>
		</thead>
		<tbody>
			@foreach($kunjungan as $items)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{$items->nis}}</td>
				<td>{{$items->nama}}</td>
				<td>{{$items->alasan_berkunjung}}</td>
				<td>{{$items->tgl_berkunjung}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>