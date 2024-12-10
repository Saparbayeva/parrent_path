@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Edit Resource</h1>

        <form action="{{ route('resources.update', $resource->id) }}" method="POST" enctype="multipart/form-data" class="p-4 border rounded shadow">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $resource->name }}" required>
            </div>
            
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ $resource->slug }}" required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" rows="4" class="form-control" required>{{ $resource->description }}</textarea>
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if ($resource->image)
                    <div class="mt-2">
                        <img src="{{ Storage::url($resource->image) }}" alt="Resource Image" class="img-thumbnail" width="150">
                    </div>
                @endif
            </div>
            
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('resources.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
