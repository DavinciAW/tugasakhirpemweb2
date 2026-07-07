<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <div class="row">


                        <div class="col-md-4">

                            <div class="card border-danger">

                                <div class="card-body">

                                    <h5 class="card-title text-danger">

                                        <i class="bi bi-exclamation-triangle"></i>
                                        Buku Terlambat

                                    </h5>


                                    <h2>
                                        {{ $jumlahTerlambat }}
                                    </h2>


                                    <p>
                                        transaksi terlambat
                                    </p>


                                </div>

                            </div>

                        </div>


                    </div>


                    <hr>


                    <h4>
                        Daftar Anggota Terlambat
                    </h4>


                    @if($jumlahTerlambat > 0)

                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th>Anggota</th>
                                    <th>Buku</th>
                                    <th>Terlambat</th>
                                </tr>
                            </thead>


                            <tbody>

                            @foreach($bukuTerlambat as $item)

                                <tr>

                                    <td>
                                        {{ $item->anggota->nama }}
                                    </td>


                                    <td>
                                        {{ $item->buku->judul }}
                                    </td>


                                    <td>

                                        {{ now()->diffInDays($item->tanggal_kembali) }}
                                        hari

                                    </td>


                                </tr>

                            @endforeach

                            </tbody>

                        </table>


                    @else

                        <div class="alert alert-success">

                            Tidak ada buku terlambat.

                        </div>


                    @endif


                </div>

            </div>


        </div>

    </div>


</x-app-layout>