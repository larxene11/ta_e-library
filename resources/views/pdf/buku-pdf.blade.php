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
		<h5>Laporan Buku</h4>
		<h6>Perpustakaan SMA Negeri 2 Kuta</h6>
	</center>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Kode Buku</th>
				<th>Judul</th>
				<th>Pengarang</th>
				<th>Penerbit</th>
				<th>Tahun Terbit</th>
                <th>Tahun Pengadaan</th>
                <th>Sumber Pengadaan</th>
			</tr>
		</thead>
		<tbody>
			@foreach($books as $items)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{$items->kode_buku}}</td>
				<td>{{$items->judul}}</td>
				<td>{{$items->pengarang}}</td>
				<td>{{$items->penerbit}}</td>
				<td>{{$items->tahun_terbit}}</td>
                <td>{{$items->tahun}}</td>
                <td>{{$items->dana}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>