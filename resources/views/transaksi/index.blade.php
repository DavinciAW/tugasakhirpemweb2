@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>
        <i class="bi bi-arrow-left-right"></i>
        Daftar Transaksi
    </h2>

    <div>
        <a href="{{ route('transaksi.laporan') }}" class="btn btn-secondary">
            <i class="bi bi-file-earmark-text"></i>
            Laporan
        </a>

        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Tambah Transaksi
        </a>
    </div>

</div>


@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="card shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                <tr>

                    <th>No</th>

                    <th>Anggota</th>

                    <th>Buku</th>

                    <th>Tgl Pinjam</th>

                    <th>Tgl Kembali</th>

                    <th>Status</th>

                    <th width="220">Aksi</th>

                </tr>

                </thead>

                <tbody>

                @forelse($transaksi as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->anggota->nama }}</td>

                    <td>{{ $item->buku->judul }}</td>

                    <td>{{ $item->tanggal_pinjam }}</td>

                    <td>{{ $item->tanggal_kembali }}</td>

                    <td>

    @if($item->status == 'Dipinjam')

        @if(now()->gt($item->tanggal_kembali))

            <span class="badge bg-danger">
                Terlambat {{ now()->diffInDays($item->tanggal_kembali) }} Hari
            </span>

        @else

            <span class="badge bg-warning text-dark">
                Dipinjam
            </span>

        @endif

    @else

        <span class="badge bg-success">
            Dikembalikan
        </span>

    @endif

</td>

                    <td>

                        <a href="{{ route('transaksi.show',$item->id) }}"
                           class="btn btn-info btn-sm">

                            <i class="bi bi-eye"></i> Detail

                        </a>

                        <a href="{{ route('transaksi.edit',$item->id) }}"
                           class="btn btn-warning btn-sm">

                            <i class="bi bi-pencil"></i> Edit

                        </a>

                        @if($item->status=='Dipinjam')

                        <form action="{{ route('transaksi.kembalikan',$item->id) }}"
                              method="POST"
                              style="display:inline;">

                            @csrf
                            @method('PUT')

                            <button class="btn btn-success btn-sm">

                                <i class="bi bi-check-circle"></i> Retur

                            </button>

                        </form>

                        @endif

                        <form action="{{ route('transaksi.destroy',$item->id) }}"
                              method="POST"
                              style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus transaksi ini?')">

                                <i class="bi bi-trash"></i> Hapus

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7" class="text-center">

                        Belum ada transaksi.

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        {{ $transaksi->links() }}

    </div>

</div>

@endsection