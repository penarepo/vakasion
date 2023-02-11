@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pengisian Nilai</h1>
</div>
{{-- <form action="">
<div class="container">
    <div class="row text-start">
      <div class="col-sm">
        <div class="mb-3">
            <select name="periode" id="periode" class="form-select">
                <option value="20221">Tahun Akademik</option>
            </select>
        </div>
      </div>
      <div class="col-sm">
        <div class="mb-3">
            <select name="periode" id="periode" class="form-select">
                <option value="20221">Program Studi</option>
            </select>
        </div>
      </div>
      <div class="col-sm">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
</div>
</form> --}}

<div class="table-responsive">
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
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
                <th scope="col">Tgl UTS</th>
                <th scope="col">Tgl UAS</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
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

<script src="/js/pengisiannilai.js"></script>
@endsection
