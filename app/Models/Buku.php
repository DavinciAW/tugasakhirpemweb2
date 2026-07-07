<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
 
class Buku extends Model
{
    use HasFactory;
 
    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'buku';
 
    /**
     * Kolom yang dapat diisi secara mass assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_buku',
        'judul',
        'kategori',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'harga',
        'stok',
        'deskripsi',
        'bahasa',
    ];
 
    /**
     * Tipe casting untuk atribut.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tahun_terbit' => 'integer',
        'harga' => 'decimal:2',
        'stok' => 'integer',
    ];

    /**
    * Accessor untuk badge status stok.
    */
    public function getStatusStokBadgeAttribute(): string
    {
        if ($this->stok == 0) {
            return '<span class="badge bg-danger">Habis</span>';
        } elseif ($this->stok <= 5) {
            return '<span class="badge bg-warning">Menipis</span>';
        } elseif ($this->stok <= 15) {
            return '<span class="badge bg-info">Sedang</span>';
        }

        return '<span class="badge bg-success">Aman</span>';
    }

    /**
     * Accessor untuk label tahun buku.
    */
    public function getTahunLabelAttribute(): string
    {
        return $this->tahun_terbit >= 2024
            ? 'Buku Baru'
            : 'Buku Lama';
    }
 
    /**
     * Accessor untuk format harga.
     */
    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
 
    /**
     * Accessor untuk status ketersediaan.
     */
    public function getTersediaAttribute(): bool
    {
        return $this->stok > 0;
    }
 
    /**
     * Scope untuk filter buku tersedia.
     */
    public function scopeTersedia($query)
    {
        return $query->where('stok', '>', 0);
    }
 
    /**
     * Scope untuk filter berdasarkan kategori.
     */
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
    * Scope buku dengan stok menipis.
    */
    public function scopeStokMenipis(Builder $query): Builder
    {
        return $query->where('stok', '<', 5);
    }

    /**
    * Scope filter harga.
    */
    public function scopeHargaRange(Builder $query, $min, $max): Builder
    {
        return $query->whereBetween('harga', [$min, $max]);
    }

    /**
    * Scope buku terbaru.
    */
    public function scopeTerbaru(Builder $query): Builder
    {
        return $query->where('tahun_terbit', '>=', 2024);
    }
}