@extends('layouts.admin')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Resources</h1>
        <a href="{{ route('resources.create') }}" class="btn btn-primary mb-3">Create New Resource</a>

        @if ($resources->isEmpty())
            <div class="alert alert-info">No resources found. Please add some!</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resources as $resource)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ route('resources.show', $resource->id) }}" class="text-decoration-none">
                                        {{ $resource->name }}
                                    </a>
                                </td>
                                <td>{{ Str::limit($resource->description, 50) }}</td>
                                <td>{!! $resource->getStatusText() !!} </td>
                                <td>
                                    <a href="{{ route('resources.edit', $resource->id) }}" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    @if (\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                        <a href="{{ route('approve', $resource->id) }}" class="btn btn-success btn-sm">
                                            Approve
                                        </a>
                                        <a href="{{ route('reject', $resource->id) }}" class="btn btn-danger btn-sm">
                                            Reject
                                        </a>
                                    @endif

                                    <form action="{{ route('resources.destroy', $resource->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this resource?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
