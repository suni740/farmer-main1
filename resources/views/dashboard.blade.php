@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">

            <div class="col-md-10">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title mb-3"> Welcome back, <strong>{{ Auth::user()->name }}</strong>!</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded mb-3 border">
                                    <h5>Total Orders</h5>
                                    <p class="fs-4 text-success">{{ $totalOrders }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded mb-3 border">
                                    <h5>Total Spent</h5>
                                    <p class="fs-4 text-primary">₹{{ number_format($totalSpent, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-4"> Recent Orders</h4>

                        @if($recentOrders->isEmpty())
                            <div class="alert alert-info">
                                You haven’t placed any orders yet.
                            </div>
                        @else
                            <ul class="list-group">
                                @foreach ($recentOrders as $order)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>Order ID:</strong> #{{ $order->id }}<br>
                                                <strong>Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}
                                            </div>
                                            <div class="text-end">
                                                <strong>Total:</strong><br>
                                                <span class="text-success fs-5">₹{{ number_format($order->total_price, 2) }}</span><br>
                                                <form action="{{ route('user.order.delete', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger mt-2">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
