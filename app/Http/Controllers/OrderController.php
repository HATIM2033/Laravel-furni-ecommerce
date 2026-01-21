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
}
