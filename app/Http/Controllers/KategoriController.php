<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    private $kategori_list = [
        [
            'id' => 1,
            'nama' => 'Programming',
            'deskripsi' => 'Buku pemrograman dan coding',
            'jumlah_buku' => 25
        ],
        [
            'id' => 2,
            'nama' => 'Database',
            'deskripsi' => 'Buku tentang database dan SQL',
            'jumlah_buku' => 18
        ],
        [
            'id' => 3,
            'nama' => 'Jaringan',
            'deskripsi' => 'Buku jaringan komputer',
            'jumlah_buku' => 15
        ],
        [
            'id' => 4,
            'nama' => 'Desain Grafis',
            'deskripsi' => 'Buku desain grafis dan multimedia',
            'jumlah_buku' => 12
        ],
        [
            'id' => 5,
            'nama' => 'Artificial Intelligence',
            'deskripsi' => 'Buku AI dan Machine Learning',
            'jumlah_buku' => 20
        ]
    ];

    public function index()
    {
        $kategori_list = $this->kategori_list;

        return view('kategori.index', compact('kategori_list'));
    }

    public function show($id)
    {
        $kategori = collect($this->kategori_list)->firstWhere('id', $id);

        if (!$kategori) {
            abort(404);
        }

        $buku_list = [
            [
                'judul' => 'Belajar Laravel',
                'pengarang' => 'Ahmad',
                'tahun' => 2023
            ],
            [
                'judul' => 'PHP Dasar',
                'pengarang' => 'Budi',
                'tahun' => 2022
            ],
            [
                'judul' => 'Web Programming',
                'pengarang' => 'Andi',
                'tahun' => 2024
            ]
        ];

        return view('kategori.show', compact('kategori', 'buku_list'));
    }

    public function search($keyword)
    {
        $hasil = collect($this->kategori_list)->filter(function ($item) use ($keyword) {
            return str_contains(strtolower($item['nama']), strtolower($keyword));
        });

        return view('kategori.search', [
            'keyword' => $keyword,
            'hasil' => $hasil
        ]);
    }
}