<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();

        $productsSales = Product::withCount(['orderItems as total_sales' => function ($query) {
            $query->select(DB::raw("COALESCE(SUM(quantity), 0)"));
        }])->get();

        $latestOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalOrders',
            'productsSales',
            'latestOrders'
        ));
    }
}
