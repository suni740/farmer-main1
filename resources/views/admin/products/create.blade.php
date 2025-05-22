@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Product</h2>

    <form method="POST" action="{{ route('admin.products.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price ($)</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image URL (optional)</label>
            <input type="url" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="0" min="0" required>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="featured" class="form-check-input" id="featured">
            <label class="form-check-label" for="featured">Featured Product</label>
        </div>

        <button type="submit" class="btn btn-success">Add Product</button>
    </form>
</div>
@endsection
