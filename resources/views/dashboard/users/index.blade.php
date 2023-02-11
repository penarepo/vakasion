@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Users List</h1>
</div>
<div class="table-responsive">
    <a href="/dashboard/users/create" class="btn btn-primary mb-3">Create New User</a>
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <table class="table table-striped table-sm" id="tbldefault">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->nama_role }}</td>
                    <td>
                        <a href="/dashboard/users/{{ $user->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
                        <a href="/dashboard/users/{{ $user->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                        <form action="/dashboard/users/{{ $user->id }}" method="POST" class="d-inline">
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
