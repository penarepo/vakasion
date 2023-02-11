@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Pengisian Nilai</h1>
</div>
<div class="col-lg-12">
    <form method="POST" action="/dashboard/pengisiannilai/update/{{ $data->id }}">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="name">Kode Matakuliah</label>
                    <input type="text" class="form-control @error('kode_mk') is-invalid @enderror" name="kode_mk" id="kode_mk"
                        placeholder="Kode Matakuliah" value="{{ old('kode_mk', $data->kode_mk) }}" disabled>
                    @error('kode_mk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="nama_mk">Nama MK</label>
                    <input type="text" class="form-control @error('nama_mk') is-invalid @enderror" name="nama_mk" id="nama_mk"
                        placeholder="Nama Matakuliah" value="{{ old('name', $data->nama_mk) }}" disabled>
                    @error('nama_mk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="nama_kelas">Kelas</label>
                    <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror" name="nama_kelas" id="nama_kelas"
                        placeholder="Kelas" value="{{ old('nama_kelas', $data->nama_kelas) }}" disabled>
                    @error('nama_kelas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                 </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" id="nip"
                        placeholder="NIP" value="{{ old('nip', $data->nip) }}" disabled>
                    @error('nip')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tgl_pengisian_nilai_uts">Tgl Pengisian UTS</label>
                    <input type="datetime-local" class="form-control @error('tgl_pengisian_nilai_uts') is-invalid @enderror" name="tgl_pengisian_nilai_uts" id="tgl_pengisian_nilai_uts"
                        value="{{ old('tgl_pengisian_nilai_uts', $data->tgl_pengisian_nilai_uts) }}">
                    @error('tgl_pengisian_nilai_uts')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="dosen_pengajar">Nama Dosen</label>
                    <input type="text" class="form-control @error('dosen_pengajar') is-invalid @enderror" name="dosen_pengajar" id="dosen_pengajar"
                        placeholder="Dosen Pengajar" value="{{ old('dosen_pengajar', $data->dosen_pengajar) }}" disabled>
                    @error('dosen_pengajar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                 </div>

                 <div class="mb-3">
                    <label for="tgl_pengisian_nilai_uas">Tgl Pengisian UAS</label>
                    <input type="datetime-local" class="form-control @error('tgl_pengisian_nilai_uas') is-invalid @enderror" name="tgl_pengisian_nilai_uas" id="tgl_pengisian_nilai_uas"
                        value="{{ old('tgl_pengisian_nilai_uas', $data->tgl_pengisian_nilai_uas) }}">
                    @error('tgl_pengisian_nilai_uas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ url()->previous() }}" class="btn btn-info">Cancel</a>
    </form>
</div>

@endsection
