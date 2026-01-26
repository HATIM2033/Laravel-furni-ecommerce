<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders.
     */
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders()->orderBy('created_at', 'desc')->paginate(10);
        
        return view('orders.index', compact('orders'));
    }
    
    /**
     * Display the specified order details.
     */
    public function show($orderNumber)
    {
        $user = Auth::user();
        $order = Order::with('orderItems.product')
            ->where('order_number', $orderNumber)
            ->where('user_id', $user->id)
            ->firstOrFail();
            
        return view('orders.show', compact('order'));
    }
    
    /**
     * Cancel the specified order.
     */
    public function cancel($orderNumber)
    {
        $user = Auth::user();
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', $user->id)
            ->firstOrFail();
        
        // Check if order can be cancelled (only pending or processing orders)
        if (!in_array($order->status, ['pending', 'processing'])) {
            return redirect()->back()->with('error', 'This order cannot be cancelled. Only pending or processing orders can be cancelled.');
        }
        
        // Update order status and payment status
        $order->status = 'cancelled';
        $order->payment_status = 'cancelled';
        $order->save();
        
        // Restore product stock
        foreach ($order->orderItems as $item) {
            $product = $item->product;
            if ($product) {
                $product->stock += $item->quantity;
                $product->save();
            }
        }
        
        return redirect()->route('orders.show', $order->order_number)
            ->with('success', 'Order cancelled successfully. No payment is required and your items have been restocked.');
    }
}
