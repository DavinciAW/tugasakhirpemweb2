@extends('layouts.app')

@section('title','Detail Transaksi')

@section('content')

<div class="card">

    <div class="card-header">

        <h3>Detail Transaksi</h3>

    </div>

    <div class="card-body">

    @if($transaksi->status == 'Dipinjam' && now()->gt($transaksi->tanggal_kembali))

<div class="alert alert-danger mb-3">
    <i class="bi bi-exclamation-triangle-fill"></i>

    <strong>Peringatan!</strong>

    Buku ini sudah terlambat dikembalikan selama

    <strong>{{ now()->diffInDays($transaksi->tanggal_kembali) }} hari</strong>.
</div>

@endif

        <table class="table">

            <tr>

                <th>Anggota</th>

                <td>{{ $transaksi->anggota->nama }}</td>

            </tr>

            <tr>

                <th>Buku</th>

                <td>{{ $transaksi->buku->judul }}</td>

            </tr>

            <tr>

                <th>Tanggal Pinjam</th>

                <td>{{ $transaksi->tanggal_pinjam }}</td>

            </tr>

            <tr>

                <th>Tanggal Kembali</th>

                <td>{{ $transaksi->tanggal_kembali }}</td>

            </tr>

            <tr>

                <th>Status</th>

                <td>{{ $transaksi->status }}</td>

            </tr>

            <tr>

                <th>Denda</th>

                <td>

                     Rp {{ number_format($transaksi->denda,0,',','.') }}

                </td>

             </tr>

        </table>

        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">

            Kembali

        </a>

    </div>

</div>


@if($transaksi->status=='Dipinjam')

<form action="{{ route('transaksi.kembalikan',$transaksi->id) }}"
      method="POST">

    @csrf

    @method('PUT')

    <button class="btn btn-success">

        Kembalikan Buku

    </button>

</form>

@endif
@endsection