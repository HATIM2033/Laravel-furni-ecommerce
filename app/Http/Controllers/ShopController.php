<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ContactMessage;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::active()->with('category');
        
        if ($request->category) {
            $products->whereHas('category', function($query) use ($request) {
                $query->where('slug', $request->category);
            });
        }
        
        if ($request->search) {
            $products->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
        }
        
        $products = $products->paginate(8);
        $categories = Category::where('is_active', true)->get();
        
        return view('shop.index', compact('products', 'categories'));
    }
    
    public function show($slug)
    {
        $product = Product::active()->with('category')->where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
            
        return view('shop.show', compact('product', 'relatedProducts'));
    }
    
    public function explore()
    {
        $featuredProducts = Product::active()->featured()->take(6)->get();
        $categories = Category::where('is_active', true)->take(4)->get();
        $latestProducts = Product::active()->latest()->take(8)->get();
        
        return view('shop.explore', compact('featuredProducts', 'categories', 'latestProducts'));
    }
    
    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);
        
        $contactMessage = ContactMessage::create([
            'first_name' => $validated['fname'],
            'last_name' => $validated['lname'],
            'email' => $validated['email'],
            'subject' => null, // No subject field in form
            'message' => $validated['message'],
        ]);
        
        // Create notification for admin
        NotificationService::newContactMessage($contactMessage);
        
        return redirect()->route('contact')
            ->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
