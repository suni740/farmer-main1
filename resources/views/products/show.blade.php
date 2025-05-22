@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- later-->
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

    <div class="row">
        <div class="col-md-6">
            <img src="{{ $product->image ?? 'https://via.placeholder.com/500x400' }}" alt="{{ $product->name }}" class="img-fluid rounded shadow-sm">
        </div>

        <div class="col-md-6">
            <h2 class="mb-3">{{ $product->name }}</h2>
            <h4 class="text-success mb-3">${{ number_format($product->price, 2) }}</h4>
            
            <!-- Add stock status -->
            <div class="mb-4">
                @if($product->quantity > 10)
                    <div class="stock-status alert alert-success d-inline-block">
                        <i class="fas fa-check-circle"></i> In Stock
                        <br><small>{{ $product->quantity }} units available</small>
                    </div>
                @elseif($product->quantity > 0)
                    <div class="stock-status alert alert-warning d-inline-block">
                        <i class="fas fa-exclamation-circle"></i> Low Stock
                        <br><small>Only {{ $product->quantity }} {{ Str::plural('unit', $product->quantity) }} left</small>
                    </div>
                @else
                    <div class="stock-status alert alert-danger d-inline-block">
                        <i class="fas fa-times-circle"></i> Out of Stock
                    </div>
                @endif
            </div>

            <p class="mb-4">{{ $product->description }}</p>

            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form">
                @csrf
                <button type="submit" class="btn btn-success btn-lg add-to-cart-button" {{ $product->quantity <= 0 ? 'disabled' : '' }}>
                    {{ $product->quantity > 0 ? 'Add to Cart' : 'Out of Stock' }}
                </button>
            </form>

            <div class="mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    //  5 seconds
    setTimeout(function () {
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
