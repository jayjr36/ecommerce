@extends('layouts.admin')

@section('content')

<div class="container my-4">
    <div class="col-md-6 mx-auto">
        <h2 class="text-center mb-4">Add New Category</h2>
        <form action="{{ route('categories.store') }}" method="POST" class="border p-4 rounded shadow">
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
