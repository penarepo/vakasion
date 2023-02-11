@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Tahun Akademik</h1>
</div>
<div class="col-lg-6">
    <form method="POST" action="/dashboard/tahunakademiks/{{ $tahunakademik->id }}">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="kode_tahun">Kode Tahun</label>
            <input type="text" class="form-control @error('kode_tahun') is-invalid @enderror" name="kode_tahun" id="kode_tahun" placeholder="Kode Tahun Akademik" value="{{ old('kode_tahun', $tahunakademik->kode_tahun) }}" required>
            @error('kode_tahun')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nama_tahun">Nama Tahun Akademik</label>
            <input type="text" class="form-control @error('nama_tahun') is-invalid @enderror" name="nama_tahun" id="nama_tahun" placeholder="nama_tahun" value="{{ old('nama_tahun', $tahunakademik->nama_tahun) }}" required>
            @error('nama_tahun')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tgl_batas_uts">Tgl Batas Setor UTS</label>
            <input type="date" class="form-control @error('tgl_batas_uts') is-invalid @enderror" name="tgl_batas_uts" id="tgl_batas_uts" placeholder="tgl_batas_uts" value="{{ old('tgl_batas_uts', $tahunakademik->tgl_batas_uts) }}">
            @error('tgl_batas_uts')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tgl_batas_uas">Tgl Batas Setor UAS</label>
            <input type="date" class="form-control @error('tgl_batas_uas') is-invalid @enderror" name="tgl_batas_uas" id="tgl_batas_uas" placeholder="tgl_batas_uas" value="{{ old('tgl_batas_uas', $tahunakademik->tgl_batas_uas) }}">
            @error('tgl_batas_uas')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="role">Active?</label>
            <select class="form-select" name="is_active">
                <option value="{{ $tahunakademik->is_active }}" selected>{{ $tahunakademik->is_active }}</option>
                <option value="T">Tidak</option>
                <option value="Y">Ya</option>
              </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="/dashboard/tahunakademiks" class="btn btn-info">Cancel</a>
    </form>
</div>

@endsection
