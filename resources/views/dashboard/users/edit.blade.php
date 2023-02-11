@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit User</h1>
</div>
<div class="col-lg-6">
    <form method="POST" action="/dashboard/users/{{ $user->id }}">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                placeholder="Name" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="username">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                id="username" placeholder="Username"
                value="{{ old('username',$user->username) }}" required>
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                placeholder="name@example.com" value="{{ old('email',$user->email) }}" required>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="id_role">Role</label>
            <select class="form-select" name="id_role">
                @foreach($roles as $role)
                    @if(old('role',$user->id_role) == $role->id)
                        <option value={{ $user->id_role }} selected>{{ $role->nama_role }}</option>
                    @else
                        <option value={{ $role->id }}>{{ $role->nama_role }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="/dashboard/users" class="btn btn-info">Cancel</a>
    </form>
</div>

@endsection
