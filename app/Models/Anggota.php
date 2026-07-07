<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
 
class Anggota extends Model
{
    use HasFactory;
 
    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'anggota';
 
    /**
     * Kolom yang dapat diisi secara mass assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_anggota',
        'nama',
        'email',
        'telepon',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'tanggal_daftar',
        'status',
    ];
 
    /**
     * Tipe casting untuk atribut.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_daftar' => 'date',
    ];

    /**
     * Accessor untuk menghitung umur.
     */
   public function getKategoriUsiaAttribute()
{
    if($this->umur < 20){
        return 'Remaja';
    }

    if($this->umur <= 50){
        return 'Dewasa';
    }

    return 'Senior';
}
 
    /**
     * Accessor untuk lama menjadi anggota (dalam hari).
     */
    public function scopeTerdaftarBulanIni($query)
{
    return $query
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year);
}
 
    /**
     * Scope untuk filter anggota aktif.
     */
    public function getStatusBadgeAttribute()
{
    if($this->status == 'Aktif'){
        return '<span class="badge bg-success">Aktif</span>';
    }

    return '<span class="badge bg-secondary">Nonaktif</span>';
}
 
    /**
     * Scope untuk filter berdasarkan jenis kelamin.
     */
    public function scopeJenisKelamin($query,$jk)
    {
        return $query->where('jenis_kelamin',$jk);
    }
}