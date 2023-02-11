@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Vakasi Nilai</h1>
</div>
<div class="table-responsive">
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#importExcel">
        Import Excel
    </button>
    @if ($errors->has('file'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $errors->first('file') }}</strong>
    </div>
    @endif

    @if ($sukses = Session::get('sukses'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $sukses }}</strong>
    </div>
    @endif
    <table class="table table-striped table-sm" id="tblVakasi">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Periode</th>
                <th scope="col">Kode MK</th>
                <th scope="col">Nama MK</th>
                <th scope="col">Kelas</th>
                <th scope="col">NIP</th>
                <th scope="col">Dosen Pengajar</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($vakasinilais as $vakasinilai)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $vakasinilai->periode }}</td>
                <td>{{ $vakasinilai->kode_mk }}</td>
                <td>{{ $vakasinilai->nama_mk }}</td>
                <td>{{ $vakasinilai->nama_kelas }}</td>
                <td>{{ $vakasinilai->nip }}</td>
                <td>{{ $vakasinilai->dosen_pengajar }}</td>
                <td>
                    <a href="/dashboard/vakasinilais/{{ $vakasinilai->id }}" class="badge bg-info"><span
                            data-feather="eye"></span></a>
                    <a href="/dashboard/vakasinilais/{{ $vakasinilai->id }}/edit" class="badge bg-warning"><span
                            data-feather="edit"></span></a>
                    <form action="/dashboard/vakasinilais/{{ $vakasinilai->id }}" method="POST" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span
                                data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach --}}
        </tbody>
    </table>

    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="importExcelTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="/import-excel" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Upload File Excel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <label>Pilih file excel</label>
                        <div class="form-group">
                            <input type="file" name="file" id="file" required="required">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="/js/vakasi.js"></script>
@endsection
