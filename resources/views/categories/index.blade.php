@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <h2>Categories</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning edit-btn" data-url="{{ route('categories.edit', $category->id) }}" data-title="Category">Edit</button>
                            {{-- <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a> --}}
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
