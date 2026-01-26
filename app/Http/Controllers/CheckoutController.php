<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
        
        $cartTotal = 0;
        $cartItems = [];
        
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $details['quantity'],
                    'subtotal' => $product->price * $details['quantity']
                ];
                $cartTotal += $product->price * $details['quantity'];
            }
        }
        
        $user = Auth::user();
        
        return view('checkout.index', compact('cartItems', 'cartTotal', 'user'));
    }
    
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
        
        $request->validate([
            'shipping_address' => 'required|array',
            'shipping_address.street' => 'required|string',
            'shipping_address.city' => 'required|string',
            'shipping_address.state' => 'required|string',
            'shipping_address.zip' => 'required|string',
            'payment_method' => 'required|string|in:cash_on_delivery',
        ]);
        
        $user = Auth::user();
        $cartTotal = 0;
        
        // Calculate cart total
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $cartTotal += $product->price * $details['quantity'];
            }
        }
        
        // Create order
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'total_amount' => $cartTotal,
            'shipping_amount' => 0,
            'tax_amount' => 0,
            'discount_amount' => 0,
            'status' => 'pending',
            'payment_status' => 'pending',
            'payment_method' => 'cash_on_delivery', // Always COD
            'shipping_address' => $request->shipping_address,
            'billing_address' => $request->billing_address ?? $request->shipping_address,
        ]);
        
        // Create order items
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_image' => $product->image,
                    'price' => $product->price,
                    'quantity' => $details['quantity'],
                    'total' => $product->price * $details['quantity'],
                ]);
                
                // Update product stock
                $product->stock -= $details['quantity'];
                $product->save();
            }
        }
        
        // Clear cart
        session()->forget('cart');
        
        return redirect()->route('checkout.success', $order->id)->with('success', 'Order placed successfully!');
    }
    
    public function success($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);
        
        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('checkout.success', compact('order'));
    }
}
