<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::insert([

            [
                'nama_kategori'=>'Programming',
                'deskripsi'=>'Buku pemrograman',
                'icon'=>'code-slash',
                'warna'=>'primary'
            ],

            [
                'nama_kategori'=>'Database',
                'deskripsi'=>'Buku Database',
                'icon'=>'database',
                'warna'=>'success'
            ],

            [
                'nama_kategori'=>'Web Design',
                'deskripsi'=>'Buku Web Design',
                'icon'=>'palette',
                'warna'=>'info'
            ],

            [
                'nama_kategori'=>'Networking',
                'deskripsi'=>'Buku Networking',
                'icon'=>'wifi',
                'warna'=>'warning'
            ],

            [
                'nama_kategori'=>'Data Science',
                'deskripsi'=>'Buku Data Science',
                'icon'=>'graph-up',
                'warna'=>'danger'
            ]

        ]);
    }
}