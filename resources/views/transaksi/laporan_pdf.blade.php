<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>Laporan Transaksi</title>

    <style>

        body{
            font-family: DejaVu Sans;
            font-size:12px;
        }

        table{

            width:100%;
            border-collapse:collapse;

        }

        table,th,td{

            border:1px solid black;

        }

        th,td{

            padding:6px;

        }

        h2{

            text-align:center;

        }

    </style>

</head>

<body>

<h2>Laporan Transaksi Perpustakaan</h2>

<table>

<thead>

<tr>

<th>No</th>

<th>Anggota</th>

<th>Buku</th>

<th>Status</th>

<th>Denda</th>

</tr>

</thead>

<tbody>

@foreach($transaksi as $t)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $t->anggota->nama }}</td>

<td>{{ $t->buku->judul }}</td>

<td>{{ $t->status }}</td>

<td>

Rp {{ number_format($t->denda,0,',','.') }}

</td>

</tr>

@endforeach

</tbody>

</table>

<br>

<strong>

Total Denda :

Rp {{ number_format($totalDenda,0,',','.') }}

</strong>

</body>

</html>