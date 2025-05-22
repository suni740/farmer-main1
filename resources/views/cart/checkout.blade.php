@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>

    @if(empty($cart))
        <p>Your cart is empty.</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Shop</a>
    @else
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Available Stock</th>
                    <th>Price Each</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $canCheckout = true;
                    $stockErrors = [];
                @endphp

                @foreach($cart as $id => $item)
                    @php
                        $product = App\Models\Product::find($id);
                        if (!$product || $product->quantity < $item['quantity']) {
                            $canCheckout = false;
                            $stockErrors[] = $item['name'];
                        }
                    @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>
                            @if($product && $product->quantity < $item['quantity'])
                                <span class="text-danger">Only {{ $product->quantity }} available</span>
                            @else
                                <span class="text-success">In Stock</span>
                            @endif
                        </td>
                        <td>${{ number_format($item['price'], 2) }}</td>
                        <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if(!empty($stockErrors))
            <div class="alert alert-danger">
                The following items have insufficient stock:
                <ul>
                    @foreach($stockErrors as $product)
                        <li>{{ $product }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center">
            <h4>Total: ${{ number_format($total, 2) }}</h4>

            <form action="{{ route('cart.placeOrder') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success" {{ !$canCheckout ? 'disabled' : '' }}>
                    Place Order
                </button>
            </form>

            {{-- <form action="{{ route('cart.placeOrder') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Place Order</button>
            </form> --}}
        </div>
    @endif
</div>
@endsection
