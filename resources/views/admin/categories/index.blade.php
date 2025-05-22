@extends('layouts.app')

@section('content')
<div class="container">
    <h2> Categories</h2>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">Add Category</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Products</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->products->count() }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3">No categories found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection