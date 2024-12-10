@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1>User Details</h1>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Roles</th>
                <td>
                    @foreach ($user->roles as $role)
                        <span class="badge bg-primary">{{ $role->name }}</span>
                    @endforeach
                </td>
            </tr>
        </table>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
    </div>
@endsection
