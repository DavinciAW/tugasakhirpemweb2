<?php
 
namespace App\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\KodeBukuFormat;
use Illuminate\Validation\Rule;
 
class StoreBukuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
 
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   public function rules(): array
{
    return [

        'kode_buku' => [
            'required',
            'string',
            'max:20',
            'unique:buku,kode_buku',
            new KodeBukuFormat(),
        ],

        'judul' => [
            'required',
            'string',
            'max:200',
        ],

        'kategori' => [
            'required',
            'in:Programming,Database,Web Design,Networking,Data Science',
        ],

        'pengarang' => [
            'required',
            'string',
            'max:100',
        ],

        'penerbit' => [
            'required',
            'string',
            'max:100',
        ],

        'tahun_terbit' => [
            'required',
            'integer',
            'min:1900',
            'max:' . date('Y'),
        ],

        'isbn' => [
            'nullable',
            'string',
            'max:20',
        ],

        'bahasa' => [
            'required',
            Rule::when(
                $this->kategori == 'Programming',
                ['in:Inggris']
            ),
        ],

        'harga' => [
            'required',
            'numeric',
            'min:0',
        ],

        'stok' => [
            'required',
            'integer',
            'min:0',
            Rule::when(
                $this->tahun_terbit < 2000,
                ['max:5']
            ),
        ],

        'deskripsi' => [
            'nullable',
            'string',
        ],

    ];
}
 
    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'bahasa.in' => 'Buku kategori Programming harus menggunakan bahasa Inggris.',

'stok.max' => 'Buku yang terbit sebelum tahun 2000 maksimal memiliki stok 5.',
        ];
    }
 
    /**
     * Get custom attribute names.
     */
    public function attributes(): array
    {
        return [
            'kode_buku' => 'kode buku',
            'judul' => 'judul buku',
            'kategori' => 'kategori',
            'pengarang' => 'nama pengarang',
            'penerbit' => 'nama penerbit',
            'tahun_terbit' => 'tahun terbit',
            'isbn' => 'ISBN',
            'harga' => 'harga',
            'stok' => 'stok',
            'bahasa' => 'bahasa',
        ];
    }
}