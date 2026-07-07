<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Buku;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    /**
     * Menampilkan daftar transaksi.
     */
    public function index()
    {
        $transaksi = Transaksi::with(['anggota', 'buku'])
            ->latest()
            ->paginate(10);

        return view('transaksi.index', compact('transaksi'));
    }

    /**
     * Menampilkan form tambah transaksi.
     */
    public function create()
    {
        
        $anggota = Anggota::where('status', 'Aktif')->get();
http://localhost:8000/anggota
        $buku = Buku::where('stok', '>', 0)->get();

        return view('transaksi.create', compact('anggota', 'buku'));
       
    }


    /**
     * Menyimpan transaksi baru.
     */
    public function store(Request $request)
    {

        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'buku_id' => 'required|exists:buku,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()
                ->withInput()
                ->with('error', 'Stok buku habis.');
        }

        Transaksi::create([
            'anggota_id' => $request->anggota_id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'Dipinjam',
        ]);

        $buku->decrement('stok');

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail transaksi.
     */
    public function show(string $id)
    {
        $transaksi = Transaksi::with(['anggota', 'buku'])->findOrFail($id);

        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $anggota = Anggota::where('status', 'Aktif')->get();

        $buku = Buku::all();

        return view('transaksi.edit', compact(
            'transaksi',
            'anggota',
            'buku'
        ));
    }

    /**
     * Update transaksi.
     */

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'buku_id' => 'required|exists:buku,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'anggota_id' => $request->anggota_id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Menghapus transaksi.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->status == 'Dipinjam') {

            $buku = Buku::find($transaksi->buku_id);

            if ($buku) {
                $buku->increment('stok');
            }
        }

        $transaksi->delete();

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }

    /**
     * Mengembalikan buku.
     */
    public function kembalikan($id)
{
    $transaksi = Transaksi::findOrFail($id);

    if ($transaksi->status == 'Dikembalikan') {

        return redirect()
            ->back()
            ->with('error', 'Buku sudah dikembalikan.');

    }

    $hariTerlambat = 0;

    if (now()->gt($transaksi->tanggal_kembali)) {

        $hariTerlambat = now()->diffInDays($transaksi->tanggal_kembali);

    }

    $denda = $hariTerlambat * 5000;

    $transaksi->update([

        'status' => 'Dikembalikan',

        'tanggal_dikembalikan' => now(),

        'denda' => $denda,

    ]);

    $transaksi->buku->increment('stok');

    return redirect()
        ->route('transaksi.index')
        ->with('success', 'Buku berhasil dikembalikan.');
}

public function laporan(Request $request)
{
    $query = Transaksi::with(['anggota', 'buku']);

    // Filter tanggal
    if ($request->filled('dari')) {
        $query->whereDate('tanggal_pinjam', '>=', $request->dari);
    }

    if ($request->filled('sampai')) {
        $query->whereDate('tanggal_pinjam', '<=', $request->sampai);
    }

    // Filter status
    if ($request->status && $request->status != 'Semua') {
        $query->where('status', $request->status);
    }

    // Filter anggota
    if ($request->anggota_id) {
        $query->where('anggota_id', $request->anggota_id);
    }

    $transaksi = $query->latest()->get();

    $anggota = Anggota::all();

    $totalTransaksi = $transaksi->count();

    $totalDenda = $transaksi->sum('denda');

    return view('transaksi.laporan', compact(
        'transaksi',
        'anggota',
        'totalTransaksi',
        'totalDenda'
    ));
}

public function exportPdf(Request $request)
{
    $query = Transaksi::with(['anggota', 'buku']);

    if ($request->filled('dari')) {
        $query->whereDate('tanggal_pinjam', '>=', $request->dari);
    }

    if ($request->filled('sampai')) {
        $query->whereDate('tanggal_pinjam', '<=', $request->sampai);
    }

    if ($request->status && $request->status != 'Semua') {
        $query->where('status', $request->status);
    }

    if ($request->anggota_id) {
        $query->where('anggota_id', $request->anggota_id);
    }

    $transaksi = $query->get();

    $totalDenda = $transaksi->sum('denda');

    $pdf = Pdf::loadView('transaksi.laporan_pdf', compact(
        'transaksi',
        'totalDenda'
    ));

    return $pdf->download('laporan_transaksi.pdf');
}
}