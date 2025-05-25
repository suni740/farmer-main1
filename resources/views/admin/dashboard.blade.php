@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4"> Admin Dashboard</h2>

    <!-- Quick Links -->
    <div class="d-flex justify-content-center mb-4">
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary me-2">
             Manage Products
        </a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
             Manage Categories
        </a>
    </div>

    <!-- Summary Cards -->
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Total Products</h5>
                </div>
                <div class="card-body">
                    <h3 class="text-success">{{ $totalProducts }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm border-info">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Total Categories</h5>
                </div>
                <div class="card-body">
                    <h3 class="text-info">{{ $totalCategories }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Total Orders</h5>
                </div>
                <div class="card-body">
                    <h3 class="text-warning">{{ $totalOrders }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Sales Overview -->
    <div class="mt-5">
        <h4 class="mb-3">🛒 Product Sales Overview</h4>

        @if($productsSales->isEmpty())
            <div class="alert alert-warning">
                No sales data available yet.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Sales (Units Sold)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productsSales as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td class="text-end fw-bold">{{ $product->total_sales ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Latest Orders -->
    <div class="mt-5">
        <h4 class="mb-3">🧾 Latest Orders</h4>

        @if($latestOrders->isEmpty())
            <div class="alert alert-info">
                No orders placed yet.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Order ID</th>
                            <th>User</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Total Price</th>
                            <th>Ordered Items</th>
                            <th>Placed At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestOrders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->user->name ?? 'Guest' }}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->phone}}</td>
                                <td>${{ number_format($order->total_price, 2) }}</td>
                                <td>
                                    <ul>
                                        @foreach($order->items as $item)
                                            <li>{{ $item->product->name }} (x{{ $item->quantity }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection