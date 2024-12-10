@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2>{{ $resource->name }}</h2>
            </div>
            <div class="card-body">
                <p class="mb-4">{{ $resource->description }}</p>
                @if ($resource->image)
                    <div class="mb-3">
                        <img src="{{ Storage::url($resource->image) }}" alt="Resource Image" class="img-fluid rounded shadow" style="max-width: 300px;">
                    </div>
                @endif
                <a href="{{ route('resources.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
