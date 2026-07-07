<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pencarian Kategori</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>

Hasil pencarian:
<span class="text-danger">
{{ $keyword }}
</span>

</h2>

@if($hasil->count())

<div class="row">

@foreach($hasil as $kategori)

<div class="col-md-4 mb-3">

<div class="card">

<div class="card-body">

<h4>

{!! str_ireplace(
$keyword,
"<mark>$keyword</mark>",
$kategori['nama']
) !!}

</h4>

<p>{{ $kategori['deskripsi'] }}</p>

<span class="badge bg-primary">

{{ $kategori['jumlah_buku'] }} Buku

</span>

</div>

</div>

</div>

@endforeach

</div>

@else

<div class="alert alert-danger">

Kategori tidak ditemukan.

</div>

@endif

</div>

</body>
</html>