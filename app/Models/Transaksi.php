<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';

    protected $fillable = [
    'anggota_id',
    'buku_id',
    'tanggal_pinjam',
    'tanggal_kembali',
    'tanggal_dikembalikan',
    'status',
    'denda',
];

    /**
     * Relasi ke anggota.
     */
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    /**
     * Relasi ke buku.
     */
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
    
}