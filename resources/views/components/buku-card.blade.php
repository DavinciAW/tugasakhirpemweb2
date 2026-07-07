<div class="card shadow-sm h-100">

    <div class="card-body">

        <div class="text-center mb-3">

            <i class="bi bi-book-fill display-2 text-primary"></i>

        </div>

        <span class="badge bg-primary">

            {{ $buku->kategori }}

        </span>

        <h5 class="mt-3">

            {{ $buku->judul }}

        </h5>

        <p class="text-muted">

            {{ $buku->pengarang }}

        </p>

        <hr>

        <p>

            <strong>Harga :</strong>

            {{ $buku->harga_format }}

        </p>

        <p>

            <strong>Stok :</strong>

            {{ $buku->stok }}

        </p>

        {!! $buku->status_stok_badge !!}

    </div>

    @if($showActions)

    <div class="card-footer text-center">

        <a
            href="{{ route('buku.show',$buku->id) }}"
            class="btn btn-primary btn-sm">

            Detail

        </a>

        <a
            href="{{ route('buku.edit',$buku->id) }}"
            class="btn btn-warning btn-sm">

            Edit

        </a>

    </div>

    @endif

</div>