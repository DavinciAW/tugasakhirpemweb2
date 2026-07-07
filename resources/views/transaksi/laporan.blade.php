@extends('layouts.app')

@section('title', 'Laporan Transaksi')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Laporan Transaksi</h3>
    </div>

    <div class="card-body">

        <form method="GET">

            <div class="row">

                <div class="col-md-3">
                    <label>Dari</label>
                    <input
                        type="date"
                        name="dari"
                        class="form-control"
                        value="{{ request('dari') }}">
                </div>

                <div class="col-md-3">
                    <label>Sampai</label>
                    <input
                        type="date"
                        name="sampai"
                        class="form-control"
                        value="{{ request('sampai') }}">
                </div>

                <div class="col-md-3">
                    <label>Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua</option>
                        <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>
                            Dipinjam
                        </option>
                        <option value="Dikembalikan" {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>
                            Dikembalikan
                        </option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Anggota</label>
                    <select name="anggota_id" class="form-select">
                        <option value="">Semua</option>

                        @foreach($anggota as $a)
                            <option value="{{ $a->id }}"
                                {{ request('anggota_id') == $a->id ? 'selected' : '' }}>
                                {{ $a->nama }}
                            </option>
                        @endforeach

                    </select>
                </div>

            </div>

            <br>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Filter
                </button>

                <a href="{{ route('transaksi.laporan.pdf', request()->query()) }}"
   class="btn btn-danger">
    <i class="bi bi-file-earmark-pdf"></i> Export PDF
</a>
            </div>

        </form>

        <hr>

        <table class="table table-bordered">

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
                    <td>Rp {{ number_format($t->denda, 0, ',', '.') }}</td>
                </tr>
                @endforeach

            </tbody>

        </table>

        <div class="mt-3">
            <strong>Total Transaksi :</strong>
            {{ $totalTransaksi }}

            <br>

            <strong>Total Denda :</strong>
            Rp {{ number_format($totalDenda, 0, ',', '.') }}
        </div>

    </div>

</div>

@endsection