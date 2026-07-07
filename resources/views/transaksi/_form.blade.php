<div class="mb-3">

    <label>Anggota</label>

    <select name="anggota_id" class="form-select">

        @foreach($anggota as $a)

        <option value="{{ $a->id }}"
        {{ old('anggota_id',$transaksi->anggota_id ?? '')==$a->id?'selected':'' }}>

            {{ $a->nama }}

        </option>

        @endforeach

    </select>

</div>

<div class="mb-3">

    <label>Buku</label>

    <select name="buku_id" class="form-select">

        @foreach($buku as $b)

        <option value="{{ $b->id }}"
        {{ old('buku_id',$transaksi->buku_id ?? '')==$b->id?'selected':'' }}>

            {{ $b->judul }} (Stok : {{ $b->stok }})

        </option>

        @endforeach

    </select>

</div>

<div class="mb-3">

    <label>Tanggal Pinjam</label>

    <input type="date"
           name="tanggal_pinjam"
           class="form-control"
           value="{{ old('tanggal_pinjam',$transaksi->tanggal_pinjam ?? date('Y-m-d')) }}">
</div>

<div class="mb-3">

    <label>Tanggal Kembali</label>

    <input type="date"
           name="tanggal_kembali"
           class="form-control"
           value="{{ old('tanggal_kembali',$transaksi->tanggal_kembali ?? '') }}">
</div>

<button class="btn btn-primary">

    <i class="bi bi-save"></i>

    Simpan

</button>

<a href="{{ route('transaksi.index') }}" class="btn btn-secondary">

    Kembali

</a>