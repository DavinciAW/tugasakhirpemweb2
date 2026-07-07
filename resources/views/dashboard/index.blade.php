@extends('layouts.app')

@section('title','Dashboard')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">
        Dashboard Perpustakaan
    </h2>

    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card border-primary shadow">
                <div class="card-body">
                    <h5>Total Buku</h5>
                    <h2>{{ $totalBuku }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-success shadow">
                <div class="card-body">
                    <h5>Buku Tersedia</h5>
                    <h2>{{ $bukuTersedia }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-danger shadow">
                <div class="card-body">
                    <h5>Buku Habis</h5>
                    <h2>{{ $bukuHabis }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card border-info shadow">
                <div class="card-body">
                    <h5>Total Anggota</h5>
                    <h2>{{ $totalAnggota }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-success shadow">
                <div class="card-body">
                    <h5>Anggota Aktif</h5>
                    <h2>{{ $anggotaAktif }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-secondary shadow">
                <div class="card-body">
                    <h5>Nonaktif</h5>
                    <h2>{{ $anggotaNonaktif }}</h2>
                </div>
            </div>
        </div>

    </div>

    <hr>

    <div class="row">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header">
                    5 Buku Terbaru
                </div>

                <ul class="list-group list-group-flush">

                    @foreach($bukuTerbaru as $buku)

                    <li class="list-group-item">

                        {{ $buku->judul }}

                        <span class="badge bg-primary float-end">

                            {{ $buku->kategori }}

                        </span>

                    </li>

                    @endforeach

                </ul>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header">
                    5 Anggota Terbaru
                </div>

                <ul class="list-group list-group-flush">

                    @foreach($anggotaTerbaru as $anggota)

                    <li class="list-group-item">

                        {{ $anggota->nama }}

                        <span class="badge bg-success float-end">

                            {{ $anggota->status }}

                        </span>

                    </li>

                    @endforeach

                </ul>

            </div>

        </div>

    </div>

    <hr>

    <div class="card mt-4 shadow">

        <div class="card-header">

            Quick Menu

        </div>

        <div class="card-body">

            <a href="{{ route('buku.index') }}" class="btn btn-primary">

                Buku

            </a>

            <a href="{{ route('anggota.index') }}" class="btn btn-success">

                Anggota

            </a>

            <a href="{{ route('dashboard') }}" class="btn btn-warning">

                Dashboard

            </a>

        </div>

    </div>

</div>

@endsection