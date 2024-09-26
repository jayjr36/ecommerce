@extends('layouts.admin')

@section('content')
<div class="container" style="width: 60%; margin: auto; margin-top: 2rem;">
    <div class="col-md-12">
        <h2 class="text-center mb-4">Add New Category</h2>
        <form action="{{ route('categories.store') }}" method="POST" style="border: 1px solid #ced4da; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" required placeholder="Enter category name">
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Create Category</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to Categories</a>
            </div>
        </form>
    </div>
</div>
@endsection
