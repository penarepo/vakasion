@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tahun Akademik</h1>
</div>
<div class="table-responsive">
    <a href="/dashboard/tahunakademiks/create" class="btn btn-primary mb-3">Create New Tahun Akademik</a>
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <table class="table table-striped table-sm" id="tbldefault">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kode</th>
                <th scope="col">Nama Tahun</th>
                <th scope="col">Batas Nilai UTS</th>
                <th scope="col">Batas Nilai UAS</th>
                <th scope="col">Active</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tahunakademiks as $tahunakademik)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tahunakademik->kode_tahun }}</td>
                    <td>{{ $tahunakademik->nama_tahun }}</td>
                    <td>{{ $tahunakademik->tgl_batas_uts }}</td>
                    <td>{{ $tahunakademik->tgl_batas_uas }}</td>
                    <td>{{ $tahunakademik->is_active }}</td>
                    <td>
                        <a href="/dashboard/tahunakademiks/{{ $tahunakademik->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                        <form action="/dashboard/tahunakademiks/{{ $tahunakademik->id }}" method="POST" class="d-inline">
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
