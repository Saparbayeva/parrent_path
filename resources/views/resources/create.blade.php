@extends('layouts.admin')
@section('content')
    <h1>Create Resource</h1>
    <form action="{{ route('resources.store') }}" method="POST" enctype="multipart/form-data" class="p-4 border rounded shadow">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter resource name" required>
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter resource slug" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" rows="4" class="form-control" placeholder="Enter description" required></textarea>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="image" id="image" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
    <a href="{{ route('resources.index') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
