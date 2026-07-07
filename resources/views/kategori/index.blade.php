<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kategori</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h1 class="mb-4">Daftar Kategori Buku</h1>

    <div class="row">

        @foreach($kategori_list as $kategori)

        <div class="col-md-4 mb-4">

            <div class="card h-100 shadow">

                <div class="card-body">

                    <h4>{{ $kategori['nama'] }}</h4>

                    <p>{{ $kategori['deskripsi'] }}</p>

                    <span class="badge bg-primary">
                        {{ $kategori['jumlah_buku'] }} Buku
                    </span>

                </div>

                <div class="card-footer">

                    <a href="/kategori/{{ $kategori['id'] }}" class="btn btn-success">
                        Detail
                    </a>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

</body>
</html>