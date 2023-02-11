@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create new Setting Vakasi</h1>
</div>
<div class="col-lg-12">
    <form method="POST" action="/dashboard/settingvakasis">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="kode_setting">Kode Setting</label>
                    <input type="text" class="form-control @error('kode_setting') is-invalid @enderror" name="kode_setting"
                        id="kode_setting" placeholder="Kode Setting Vakasi"
                        value="{{ old('kode_setting') }}" required>
                    @error('kode_setting')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="honor_soal">Honor Soal Tepat Waktu</label>
                    <input type="number" class="form-control @error('honor_soal') is-invalid @enderror" name="honor_soal"
                        id="honor_soal" placeholder="honor_soal" value="{{ old('honor_soal') }}"
                        required>
                    @error('honor_soal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="honor_pembuat_soal">Honor Pembuat Soal</label>
                    <input type="number" class="form-control @error('honor_pembuat_soal') is-invalid @enderror"
                        name="honor_pembuat_soal" id="honor_pembuat_soal" placeholder="honor_pembuat_soal"
                        value="{{ old('honor_pembuat_soal') }}">
                    @error('honor_pembuat_soal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="honor_pengawas">Honor Pengawas</label>
                    <input type="number" class="form-control @error('honor_pengawas') is-invalid @enderror"
                        name="honor_pengawas" id="honor_pengawas" placeholder="honor_pengawas"
                        value="{{ old('honor_pengawas') }}">
                    @error('honor_pengawas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="honor_soal_lewat">Honor Soal Terlambat</label>
                    <input type="number" class="form-control @error('honor_soal_lewat') is-invalid @enderror"
                        name="honor_soal_lewat" id="honor_soal_lewat" placeholder="honor_soal_lewat"
                        value="{{ old('honor_soal_lewat') }}">
                    @error('honor_soal_lewat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
               
                <div class="mb-3">
                    <label for="role">Active?</label>
                    <select class="form-select" name="is_active">
                        <option value="T" selected>Tidak</option>
                        <option value="Y">Ya</option>
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="/dashboard/settingvakasis" class="btn btn-info">Cancel</a>
    </form>
</div>

@endsection
