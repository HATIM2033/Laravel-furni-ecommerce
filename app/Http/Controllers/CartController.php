<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Get total quantity of items in cart
     */
    private function getCartQuantity()
    {
        $cart = session()->get('cart', []);
        return array_sum(array_column($cart, 'quantity'));
    }
    
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartTotal = 0;
        
        foreach ($cart as $item) {
            $cartTotal += $item['price'] * $item['quantity'];
        }
        
        return view('cart.index', compact('cart', 'cartTotal'));
    }
    
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        
        // Get quantity from request, default to 1
        $quantity = (int) $request->input('quantity', 1);
        
        // Validate quantity
        if ($quantity < 1) {
            $quantity = 1;
        }
        
        if(isset($cart[$id])) {
            // If product exists, add the new quantity to existing quantity
            $cart[$id]['quantity'] += $quantity;
        } else {
            // If product doesn't exist, add it with the requested quantity
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    
    public function update(Request $request)
    {
        // Accept array of quantities
        $quantities = $request->all();
        $cart = session()->get('cart', []);
        
        foreach ($quantities as $id => $quantity) {
            if (isset($cart[$id])) {
                $quantity = (int) $quantity;
                
                // Validate quantity
                if ($quantity < 1) {
                    $quantity = 1;
                }
                
                $cart[$id]['quantity'] = $quantity;
            }
        }
        
        session()->put('cart', $cart);
        
        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully',
            'cartCount' => $this->getCartQuantity()
        ]);
    }
    
    public function remove(Request $request)
    {
        $id = $request->input('id');
        
        if($id) {
            $cart = session()->get('cart', []);
            
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart',
                'cartCount' => $this->getCartQuantity()
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Invalid request'
        ], 400);
    }
    
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }
    
    /**
     * Get cart count for AJAX requests
     */
    public function getCartCount()
    {
        $cart = session()->get('cart', []);
        $count = array_sum(array_column($cart, 'quantity'));
        
        return response()->json([
            'count' => $count
        ]);
    }
}