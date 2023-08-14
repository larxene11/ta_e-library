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
		<h5>Laporan Anggota Perpustakaan</h4>
		<h6>Perpustakaan SMA Negeri 2 Kuta</h6>
	</center>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>NIS</th>
				<th>Nama</th>
				<th>Jurusan</th>
				<th>No Telepon</th>
				<th>Email</th>
                <th>Password</th>
			</tr>
		</thead>
		<tbody>
			@foreach($siswa as $items)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{$items->nis_nip}}</td>
				<td>{{$items->name}}</td>
				<td>{{$items->jurusan_jabatan}}</td>
				<td>{{$items->tlp}}</td>
				<td>{{$items->email}}</td>
                <td>{{$items->password}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>