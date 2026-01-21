<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::active()->featured()->take(3)->get();
        $latestProducts = Product::active()->latest()->take(3)->get();
        
        return view('home', compact('featuredProducts', 'latestProducts'));
    }
}
