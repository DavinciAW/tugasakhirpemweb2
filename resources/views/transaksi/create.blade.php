@extends('layouts.app')

@section('title','Tambah Transaksi')

@section('content')

<div class="card shadow">

    <div class="card-header">

        <h3>

            <i class="bi bi-plus-circle"></i>

            Tambah Transaksi

        </h3>

    </div>

    <div class="card-body">

        <form action="{{ route('transaksi.store') }}" method="POST">

            @csrf

            @include('transaksi._form')

        </form>

    </div>

</div>

@endsection