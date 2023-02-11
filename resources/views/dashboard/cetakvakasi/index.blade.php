@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Vakasi Nilai</h1>
</div>
<div class="table-responsive">

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
                <th scope="col">NIP</th>
                <th scope="col">Dosen Pengajar</th>
                <th scope="col">Program</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
          
        </tbody>
    </table>

</div>

<script src="/js/cetakvakasi.js"></script>
@endsection
