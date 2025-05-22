@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="flash-alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1 class="mb-4 text-center">Our Products</h1>

    <!-- Category Bar -->
    <div class="category-bar mb-4 p-3 bg-light rounded shadow-sm">
        <h3 class="mb-3 text-center text-primary">Categories</h3>
        <ul class="nav nav-pills flex-column flex-sm-row justify-content-center">
            <li class="nav-item">
                <a href="{{ route('products.index') }}" class="nav-link {{ request('category') ? '' : 'active' }}">
                    All Products
                </a>
            </li>
            @foreach($categories as $category)
                <li class="nav-item">
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" class="nav-link {{ request('category') == $category->id ? 'active' : '' }}">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Products Grid -->
    <div class="row g-4">
        @foreach($products as $product)
            <div class="col-sm-6 col-md-4 d-flex">
                <div class="card shadow-sm flex-fill d-flex flex-column">
                    <img src="{{ $product->image ?? 'https://via.placeholder.com/300x200' }}" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center">{{ $product->name }}</h5>
                        <p class="text-success text-center mb-3"><strong>${{ number_format($product->price, 2) }}</strong></p>
                        
                        <!-- Add stock status -->
                        <p class="text-center mb-3">
                            @if($product->quantity > 10)
                                <span class="badge bg-success">
                                    In Stock
                                    <br><small>{{ $product->quantity }} available</small>
                                </span>
                            @elseif($product->quantity > 0)
                                <span class="badge bg-warning">
                                    Low Stock
                                    <br><small>Only {{ $product->quantity }} left</small>
                                </span>
                            @else
                                <span class="badge bg-danger">Out of Stock</span>
                            @endif
                        </p>

                        <div class="mt-auto">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary w-100 mb-2">
                                View Details
                            </a>

                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form">
                                @csrf
                                <button type="submit" class="btn btn-success w-100 add-to-cart-button" {{ $product->quantity <= 0 ? 'disabled' : '' }}>
                                    {{ $product->quantity > 0 ? 'Add to Cart' : 'Out of Stock' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>

</div>
@endsection

@push('scripts')
<script>
    //  5 seconds
    setTimeout(function() {
        let alert = document.getElementById('flash-alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
        }
    }, 5000);

   
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.add-to-cart-form').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const button = form.querySelector('.add-to-cart-button');
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token')
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) throw new Error('Failed to add to cart');
                    return response.text();
                })
                .then(data => {
                    button.innerText = 'Added!';
                    button.disabled = true;
                    button.classList.remove('btn-success');
                    button.classList.add('btn-secondary');
                })
                .catch(error => {
                    console.error('Error adding to cart:', error);
                });
            });
        });
    });
</script>
@endpush
