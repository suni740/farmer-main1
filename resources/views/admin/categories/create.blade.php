@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Category</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" class="form-control" id="name"
                   value="{{ old('name') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Create Category</button>
    </form>
</div>
@endsection