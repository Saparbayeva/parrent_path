@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Users</h1>
        @if(auth()->user()->hasRole('admin'))
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create New User</a>
@endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                                <span class="badge bg-primary">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td>
    @if(auth()->user()->hasRole('admin'))
        <!-- View button -->
        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">View</a>

        <!-- Delete button -->
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        </form>
    @endif
</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
