<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        // Check if product is in stock
        if ($product->quantity < 1) {
            return response()->json([
                'message' => 'This product is out of stock.',
                'type' => 'error'
            ], 422);
        }

        $cart = session()->get('cart', []);
        $productId = $product->id;

       
        $currentQty = isset($cart[$productId]) ? $cart[$productId]['quantity'] : 0;
        $newQty = $currentQty + 1;

        
        if ($newQty > $product->quantity) {
            return response()->json([
                'message' => 'Not enough stock available.',
                'type' => 'error'
            ], 422);
        }

        // Update or add cart item
        $cart[$productId] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $newQty,
            'image' => $product->image
        ];

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Product added to cart!',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = max(1, (int) $request->input('quantity', 1));
            session(['cart' => $cart]);
        }

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session(['cart' => $cart]);
        }

        return redirect()->back()->with('success', 'Product removed!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('cart.checkout', compact('cart', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to place an order.');
        }

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();

        try {
            $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $total,
            ]);

            foreach ($cart as $productId => $item) {
                $product = Product::find($productId);

                if (!$product || $product->quantity < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$item['name']}");
                }

                // Reduce stock
                $product->decrement('quantity', $item['quantity']);

                // Create order item
                $order->items()->create([
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('dashboard')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Order failed: ' . $e->getMessage());
        }
    }
}
