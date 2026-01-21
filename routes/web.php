<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Shop routes
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{slug}', [ShopController::class, 'show'])->name('shop.show');

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth.register');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add')->middleware('auth.register');
Route::put('/cart/update', [CartController::class, 'update'])->name('cart.update')->middleware('auth.register');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove')->middleware('auth.register');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear')->middleware('auth.register');

// Checkout routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware('auth.register');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('auth.register');
Route::get('/checkout/success/{orderId}', [CheckoutController::class, 'success'])->name('checkout.success')->middleware('auth.register');

// User orders routes
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth.register');
Route::get('/orders/{orderNumber}', [OrderController::class, 'show'])->name('orders.show')->middleware('auth.register');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create');
    Route::get('/products/{product}', [AdminController::class, 'showProduct'])->name('products.show');
    Route::get('/products/{product}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::patch('/products/{product}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}', [AdminController::class, 'deleteProduct'])->name('products.delete');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('categories.create');
    Route::get('/categories/{category}', [AdminController::class, 'showCategory'])->name('categories.show');
    Route::get('/categories/{category}/edit', [AdminController::class, 'editCategory'])->name('categories.edit');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::patch('/categories/{category}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminController::class, 'deleteCategory'])->name('categories.delete');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [AdminController::class, 'showOrder'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.update-status');
    Route::delete('/orders/{order}', [AdminController::class, 'deleteOrder'])->name('orders.delete');
    Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::patch('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    
    // Contact Messages routes (View Only)
    Route::get('/contact-messages', [AdminController::class, 'contactMessages'])->name('contact-messages');
    Route::get('/contact-messages/{contactMessage}/details', [AdminController::class, 'getMessageDetails'])->name('contact-messages.details');
    Route::post('/contact-messages/{contactMessage}/mark-read', [AdminController::class, 'markMessageAsRead'])->name('contact-messages.mark-read');
    
    // Notifications routes
    Route::get('/notifications', [AdminController::class, 'getNotifications'])->name('notifications');
    Route::post('/notifications/{notification}/mark-read', [AdminController::class, 'markNotificationAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [AdminController::class, 'markAllNotificationsAsRead'])->name('notifications.mark-all-read');
});

// Static pages
Route::get('/about', function () { return view('pages.about'); })->name('about');
Route::get('/services', function () { return view('pages.services'); })->name('services');
Route::get('/blog', function () { return view('pages.blog'); })->name('blog');
Route::get('/contact', function () { return view('pages.contact'); })->name('contact');
Route::post('/contact', [ShopController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/explore', [ShopController::class, 'explore'])->name('explore');

// Test email route (remove in production)
Route::get('/test-email', function () {
    try {
        $message = new \stdClass();
        $message->full_name = 'Test User';
        $message->email = 'test@example.com';
        $message->subject = 'Test Subject';
        $message->message = 'This is a test message from contact form.';
        $message->created_at = now();
        
        return new \App\Mail\ContactReplyMail($message);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
})->name('test.email');

// Dashboard route for authenticated users
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
