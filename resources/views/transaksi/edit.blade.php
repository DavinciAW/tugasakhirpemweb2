@extends('layouts.app')

@section('title','Edit Transaksi')

@section('content')

<div class="card shadow">

    <div class="card-header">

        <h3>

            Edit Transaksi

        </h3>

    </div>

    <div class="card-body">

        <form action="{{ route('transaksi.update',$transaksi->id) }}" method="POST">

            @csrf
            @method('PUT')

            @include('transaksi._form')

        </form>

    </div>

</div>

@endsection