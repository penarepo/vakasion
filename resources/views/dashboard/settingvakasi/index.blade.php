@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Setting Vakasi</h1>
</div>
<div class="table-responsive">
    <a href="/dashboard/settingvakasis/create" class="btn btn-primary mb-3">Create Setting Vakasi</a>
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <table class="table table-striped table-sm" id="tbldefault">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kode Setting</th>
                <th scope="col">Honor Soal Tepat Waktu</th>
                <th scope="col">Honor Soal Terlambat</th>
                <th scope="col">Honor Pengawas</th>
                <th scope="col">Honor Pembuat Soal</th>
                <th scope="col">Active</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($settingvakasis as $settingvakasi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $settingvakasi->kode_setting }}</td>
                    <td>{{ $settingvakasi->honor_soal }}</td>
                    <td>{{ $settingvakasi->honor_soal_lewat }}</td>
                    <td>{{ $settingvakasi->honor_pengawas }}</td>
                    <td>{{ $settingvakasi->honor_pembuat_soal }}</td>
                    <td>{{ $settingvakasi->is_active }}</td>
                    <td>
                        <a href="/dashboard/settingvakasis/edit/{{ $settingvakasi->id }}" class="badge bg-warning"><span data-feather="edit"></span></a>
                        <form action="/dashboard/settingvakasis/delete/{{ $settingvakasi->id }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="/js/dtsetting.js"></script>
@endsection
