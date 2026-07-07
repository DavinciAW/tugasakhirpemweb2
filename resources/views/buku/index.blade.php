@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')

{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>
        <i class="bi bi-book"></i>
        Daftar Buku
    </h1>

    <a href="{{ route('buku.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i>
        Tambah Buku
    </a>
</div>

{{-- Statistik --}}
<div class="row mb-4">

    <div class="col-md-4">
        <div class="card border-primary shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Total Buku</h6>
                    <h2>{{ $totalBuku }}</h2>
                </div>

                <i class="bi bi-book-fill text-primary" style="font-size:50px"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-success shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Buku Tersedia</h6>
                    <h2>{{ $bukuTersedia }}</h2>
                </div>

                <i class="bi bi-check-circle-fill text-success" style="font-size:50px"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-danger shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Buku Habis</h6>
                    <h2>{{ $bukuHabis }}</h2>
                </div>

                <i class="bi bi-x-circle-fill text-danger" style="font-size:50px"></i>
            </div>
        </div>
    </div>

</div>

{{-- Filter --}}
<div class="card mb-4 shadow-sm">

    <div class="card-body">

        <h5 class="mb-3">
            <i class="bi bi-funnel"></i>
            Filter Kategori
        </h5>

        <div class="btn-group">

            <a href="{{ route('buku.index') }}"
               class="btn {{ !isset($kategori) ? 'btn-primary' : 'btn-outline-primary' }}">
                Semua
            </a>

            <a href="{{ route('buku.kategori','Programming') }}"
               class="btn {{ (isset($kategori) && $kategori=='Programming') ? 'btn-primary':'btn-outline-primary' }}">
                Programming
            </a>

            <a href="{{ route('buku.kategori','Database') }}"
               class="btn {{ (isset($kategori) && $kategori=='Database') ? 'btn-primary':'btn-outline-primary' }}">
                Database
            </a>

            <a href="{{ route('buku.kategori','Web Design') }}"
               class="btn {{ (isset($kategori) && $kategori=='Web Design') ? 'btn-primary':'btn-outline-primary' }}">
                Web Design
            </a>

            <a href="{{ route('buku.kategori','Networking') }}"
               class="btn {{ (isset($kategori) && $kategori=='Networking') ? 'btn-primary':'btn-outline-primary' }}">
                Networking
            </a>

            <a href="{{ route('buku.kategori','Data Science') }}"
               class="btn {{ (isset($kategori) && $kategori=='Data Science') ? 'btn-primary':'btn-outline-primary' }}">
                Data Science
            </a>

        </div>

    </div>

</div>

{{-- Search --}}
<div class="card mb-4 shadow-sm">

    <div class="card-body">

        <h5 class="mb-3">
            <i class="bi bi-search"></i>
            Search Advanced
        </h5>

        <form action="{{ route('buku.search') }}" method="GET">

            <div class="row g-3">

                <div class="col-md-4">
                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari judul, pengarang, penerbit..."
                        value="{{ request('keyword') }}">
                </div>

                <div class="col-md-2">
                    <select name="kategori" class="form-select">

                        <option value="">Semua Kategori</option>

                        <option value="Programming">Programming</option>
                        <option value="Database">Database</option>
                        <option value="Web Design">Web Design</option>
                        <option value="Networking">Networking</option>
                        <option value="Data Science">Data Science</option>

                    </select>
                </div>

                <div class="col-md-2">

                    <select name="tahun" class="form-select">

                        <option value="">Semua Tahun</option>

                        @for($i=date('Y'); $i>=2020; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor

                    </select>

                </div>

                <div class="col-md-2">

                    <select name="ketersediaan" class="form-select">

                        <option value="">Semua</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>

                    </select>

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary w-100">

                        <i class="bi bi-search"></i>

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

{{-- Bulk Delete + Export --}}
<form action="{{ route('buku.bulk-delete') }}" method="POST">

    @csrf

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div class="form-check">

            <input
                class="form-check-input"
                type="checkbox"
                id="select-all">

            <label class="form-check-label" for="select-all">
                Pilih Semua
            </label>

        </div>

        <div>

            <button type="submit" class="btn btn-danger">

                <i class="bi bi-trash"></i>

                Hapus Terpilih

            </button>

           

        </div>

    </div>

    <div class="card shadow-sm">

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-dark">

                <tr>
                    <th width="40">
                        #
                    </th>

                    <th>Kode Buku</th>

                    <th>Judul</th>

                    <th>Kategori</th>

                    <th>Pengarang</th>

                    <th>Tahun</th>

                    <th>Harga</th>

                    <th>Stok</th>

                    <th width="220">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

            @forelse($bukus as $buku)

                <tr>

                    <td>

                        <input
                            type="checkbox"
                            class="form-check-input"
                            name="buku_ids[]"
                            value="{{ $buku->id }}">

                    </td>

                    <td>

                        <span class="badge bg-secondary">

                            {{ $buku->kode_buku }}

                        </span>

                    </td>

                    <td>

                        <strong>

                            {{ $buku->judul }}

                        </strong>

                        @if($buku->isbn)

                            <br>

                            <small class="text-muted">

                                ISBN : {{ $buku->isbn }}

                            </small>

                        @endif

                    </td>

                    <td>

                        @php

                            $warna = match($buku->kategori){

                                'Programming' => 'primary',

                                'Database' => 'success',

                                'Web Design' => 'info',

                                'Networking' => 'warning',

                                default => 'danger'

                            };

                        @endphp

                        <span class="badge bg-{{ $warna }}">

                            {{ $buku->kategori }}

                        </span>

                    </td>

                    <td>

                        {{ $buku->pengarang }}

                        <br>

                        <small class="text-muted">

                            {{ $buku->penerbit }}

                        </small>

                    </td>

                    <td>

                        {{ $buku->tahun_terbit }}

                    </td>

                    <td>

                        {{ $buku->harga_format }}

                    </td>

                    <td>

                        @if($buku->stok > 0)

                            <span class="badge bg-success">

                                {{ $buku->stok }}

                            </span>

                        @else

                            <span class="badge bg-danger">

                                Habis

                            </span>

                        @endif

                    </td>

                    <td>

                        <a
                            href="{{ route('buku.show',$buku->id) }}"
                            class="btn btn-sm btn-info text-white">

                            <i class="bi bi-eye"></i> Detail

                        </a>

                        <a
                            href="{{ route('buku.edit',$buku->id) }}"
                            class="btn btn-sm btn-warning">

                            <i class="bi bi-pencil"></i> Edit

                        </a>

                        <form
                            action="{{ route('buku.destroy',$buku->id) }}"
                            method="POST"
                            class="d-inline delete-form">

                            @csrf

                            @method('DELETE')

                            <button
                                type="button"
                                class="btn btn-sm btn-danger btn-delete"
                                data-judul="{{ $buku->judul }}">

                                <i class="bi bi-trash"></i> Hapus

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" class="text-center py-5">

                        <i class="bi bi-book display-4 text-muted"></i>

                        <br><br>

                        <strong>

                            Tidak ada data buku.

                        </strong>

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

</form>

@if($bukus->count())

<div class="text-center mt-4">

    <small class="text-muted">

        Menampilkan

        <strong>{{ $bukus->count() }}</strong>

        buku

    </small>

</div>

@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ==========================
    // SELECT ALL CHECKBOX
    // ==========================
    const selectAll = document.getElementById('select-all');

    if (selectAll) {

        selectAll.addEventListener('change', function () {

            document.querySelectorAll('input[name="buku_ids[]"]').forEach(function (checkbox) {
                checkbox.checked = selectAll.checked;
            });

        });

    }

    // ==========================
    // SWEETALERT DELETE SATU DATA
    // ==========================
    document.querySelectorAll('.btn-delete').forEach(function(button){

        button.addEventListener('click', function(){

            const form = this.closest('form');
            const judul = this.dataset.judul;

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Yakin ingin menghapus buku "' + judul + '" ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result)=>{

                if(result.isConfirmed){

                    form.submit();

                }

            });

        });

    });

    // ==========================
    // KONFIRMASI BULK DELETE
    // ==========================
    const bulkForm = document.querySelector('form[action="{{ route('buku.bulk-delete') }}"]');

    if(bulkForm){

        bulkForm.addEventListener('submit', function(e){

            const checked = document.querySelectorAll('input[name="buku_ids[]"]:checked');

            if(checked.length === 0){

                e.preventDefault();

                Swal.fire({
                    icon:'warning',
                    title:'Oops...',
                    text:'Silakan pilih minimal satu buku.'
                });

                return;

            }

            e.preventDefault();

            Swal.fire({

                title:'Hapus Buku?',
                text:'Anda akan menghapus ' + checked.length + ' buku.',
                icon:'warning',
                showCancelButton:true,
                confirmButtonColor:'#d33',
                cancelButtonColor:'#3085d6',
                confirmButtonText:'Ya, Hapus!',
                cancelButtonText:'Batal'

            }).then((result)=>{

                if(result.isConfirmed){

                    bulkForm.submit();

                }

            });

        });

    }

    // ==========================
    // LOADING BUTTON SEARCH
    // ==========================
    document.querySelectorAll('form').forEach(function(form){

        form.addEventListener('submit', function(){

            const btn = this.querySelector('button[type="submit"]');

            if(btn && !btn.classList.contains('btn-delete')){

                btn.disabled = true;

                btn.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';

            }

        });

    });

});
</script>
@endpush

@endsection