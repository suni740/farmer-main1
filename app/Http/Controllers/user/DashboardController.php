<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to access the dashboard.');
        }

        // Count only non-deleted orders
        $totalOrders = Order::where('user_id', $user->id)->count();

        // Sum total price of non-deleted orders
        $totalSpent = Order::where('user_id', $user->id)->sum('total_price');

        // Get latest non-deleted orders
        $recentOrders = Order::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('totalOrders', 'totalSpent', 'recentOrders'));
    }

    public function deleteOrder($id)
    {
        $order = Order::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

        $order->delete();

        return redirect()->back()->with('success', 'Order deleted successfully.');
    }
}
