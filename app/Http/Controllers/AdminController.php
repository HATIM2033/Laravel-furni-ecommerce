<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\ContactMessage;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Get summary statistics
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();
        $totalOrders = Order::count();
        
        // Get recent orders with user and items
        $recentOrders = Order::with('user', 'orderItems')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        // Get latest users
        $latestUsers = User::orderBy('created_at', 'desc')->take(5)->get();
        
        // Get latest products
        $latestProducts = Product::with('category')->orderBy('created_at', 'desc')->take(5)->get();
        
        return view('admin.dashboard-new', compact(
            'totalProducts',
            'totalCategories', 
            'totalUsers',
            'totalOrders',
            'recentOrders',
            'latestUsers',
            'latestProducts'
        ));
    }
    
    /**
     * Display all products.
     */
    public function products()
    {
        $products = Product::with('category')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.products-new', compact('products'));
    }
    
    /**
     * Show create product form.
     */
    public function createProduct()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.product-create', compact('categories'));
    }
    
    /**
     * Show product details.
     */
    public function showProduct(Product $product)
    {
        $product->load('category');
        return view('admin.product-details', compact('product'));
    }
    
    /**
     * Show edit product form.
     */
    public function editProduct(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.product-edit', compact('product', 'categories'));
    }
    
    /**
     * Store new product.
     */
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|file|image|max:2048|mimes:jpeg,png,jpg,gif,webp',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);
        
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Debug: Log image info
            \Log::info('Image upload attempt:', [
                'original_name' => $image->getClientOriginalName(),
                'mime_type' => $image->getMimeType(),
                'size' => $image->getSize(),
                'extension' => $image->getClientOriginalExtension(),
                'is_valid' => $image->isValid(),
            ]);
            
            if ($image->isValid()) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('products'), $imageName);
                $imagePath = 'products/' . $imageName;
                
                \Log::info('Image uploaded successfully:', ['path' => $imagePath]);
            } else {
                \Log::error('Image upload failed:', [
                    'error' => $image->getErrorMessage(),
                    'error_code' => $image->getError(),
                ]);
                
                return redirect()->back()
                    ->withErrors(['image' => 'Image upload failed: ' . $image->getErrorMessage()])
                    ->withInput();
            }
        }
        
        // Generate unique slug
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $counter = 1;
        
        // Check if slug already exists
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        // Debug: Log the final slug
        \Log::info('Generated slug: ' . $slug . ' for product: ' . $request->name);
        
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'slug' => $slug,
            'sku' => $request->sku ?? 'SKU-' . strtoupper(Str::random(8)),
            'is_active' => $request->boolean('is_active', true),
            'is_featured' => $request->boolean('is_featured', false),
        ]);
        
        return redirect()->route('admin.products')->with('success', 'Product created successfully!');
    }
    
    /**
     * Update product.
     */
public function updateProduct(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'sku' => 'nullable|string|max:100|unique:products,sku,'.$product->id,
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ]);
    
    $imagePath = $product->image;
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('products'), $imageName);
        $imagePath = 'products/' . $imageName;
    }
    
    // Generate unique slug if name changed
    $slug = Str::slug($request->name);
    if ($slug !== $product->slug) {
        $originalSlug = $slug;
        $counter = 1;
        
        while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
    } else {
        $slug = $product->slug;
    }
    
    $product->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'category_id' => $request->category_id,
        'image' => $imagePath,
        'slug' => $slug,
        'sku' => $request->sku ?? $product->sku,
        'is_active' => $request->boolean('is_active'),      // ← Hadi li bدلti
        'is_featured' => $request->boolean('is_featured'),  // ← Hadi li bدلti
    ]);
    
    return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
}
    
    /**
     * Delete product.
     */
    public function deleteProduct(Product $product)
    {
        // Delete image if exists
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        
        $product->delete();
        
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }
    
    /**
     * Display all categories.
     */
    public function categories()
    {
        $categories = Category::withCount('products')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.categories-new', compact('categories'));
    }
    
    /**
     * Show create category form.
     */
    public function createCategory()
    {
        return view('admin.category-create');
    }
    
    /**
     * Show category details.
     */
    public function showCategory(Category $category)
    {
        $category->load('products');
        return view('admin.category-details', compact('category'));
    }
    
    /**
     * Show edit category form.
     */
    public function editCategory(Category $category)
    {
        return view('admin.category-edit', compact('category'));
    }
    
    /**
     * Store new category.
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        
        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'is_active' => $request->boolean('is_active', true),
        ]);
        
        return redirect()->route('admin.categories')->with('success', 'Category created successfully!');
    }
    
    /**
     * Update category.
     */
    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'is_active' => $request->boolean('is_active', true),
        ]);
        
        return redirect()->route('admin.categories')->with('success', 'Category updated successfully!');
    }
    
    /**
     * Delete category.
     */
    public function deleteCategory(Category $category)
    {
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories')->with('error', 'Cannot delete category with products!');
        }
        
        $category->delete();
        
        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully!');
    }
    
    /**
     * Display all users.
     */
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.users-new', compact('users'));
    }
    
    /**
     * Display all orders.
     */
    public function orders()
    {
        $orders = Order::with('user', 'orderItems')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.orders-new', compact('orders'));
    }
    
    /**
     * Show order details.
     */
    public function showOrder(Order $order)
    {
        $order->load('user', 'orderItems.product', 'orderItems.product.category');
        return view('admin.order-details', compact('order'));
    }
    
    /**
     * Update order status.
     */
    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);
        
        $order->status = $request->status;
        $order->save();
        
        return redirect()->back()->with('success', 'Order status updated successfully!');
    }
    
    /**
     * Delete order.
     */
    public function deleteOrder(Order $order)
    {
        $order->orderItems()->delete();
        $order->delete();
        
        return redirect()->route('admin.orders')->with('success', 'Order deleted successfully!');
    }
    
    /**
     * Show user details.
     */
    public function showUser(User $user)
    {
        $user->load('orders', 'orders.orderItems');
        return view('admin.user-details', compact('user'));
    }
    
    /**
     * Show edit user form.
     */
    public function editUser(User $user)
    {
        return view('admin.user-edit', compact('user'));
    }
    
    /**
     * Update user information.
     */
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
            'phone' => 'nullable|string|max:20',
        ]);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->phone = $request->phone;
        $user->save();
        
        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }
    
    /**
     * Delete user.
     */
    public function deleteUser(User $user)
    {
        // Prevent deletion of self
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users')->with('error', 'You cannot delete your own account!');
        }
        
        $user->delete();
        
        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }
    
    /**
     * Display all contact messages.
     */
    public function contactMessages()
    {
        $messages = ContactMessage::latest()->get();
        return view('admin.contact-messages', compact('messages'));
    }
    
    /**
     * Get message details for modal.
     */
    public function getMessageDetails(ContactMessage $contactMessage)
    {
        return response()->json([
            'success' => true,
            'message' => [
                'id' => $contactMessage->id,
                'full_name' => $contactMessage->full_name,
                'email' => $contactMessage->email,
                'subject' => $contactMessage->subject,
                'message' => $contactMessage->message,
                'created_at' => $contactMessage->created_at->format('F j, Y, g:i a'),
                'is_replied' => $contactMessage->is_replied
            ]
        ]);
    }
    
    /**
     * Mark a contact message as read.
     */
    public function markMessageAsRead(Request $request, ContactMessage $contactMessage)
    {
        $contactMessage->update(['is_replied' => true]);
        
        return response()->json([
            'success' => true,
            'message' => 'Message marked as read'
        ]);
    }
    
    /**
     * Reply to a contact message.
     */
    public function replyToMessage(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'reply' => 'required|string|min:10|max:2000',
        ]);
        
        try {
            // Send reply email
            \Mail::to($contactMessage->email)->send(new \App\Mail\ContactReplyMail($contactMessage, $request->reply));
            
            // Mark message as replied and save reply
            $contactMessage->markAsReplied($request->reply);
            
            return response()->json([
                'success' => true,
                'message' => 'Reply sent successfully!'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send reply. Please try again.'
            ], 500);
        }
    }
    
    /**
     * Delete a contact message.
     */
    public function deleteMessage(ContactMessage $contactMessage)
    {
        try {
            $contactMessage->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Message deleted successfully!'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete message. Please try again.'
            ], 500);
        }
    }
    
    /**
     * Get notifications for admin.
     */
    public function getNotifications()
    {
        $notifications = Notification::latest()
            ->take(10)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'url' => $notification->url,
                    'is_read' => $notification->is_read,
                    'created_at' => $notification->created_at->toISOString(),
                ];
            });
        
        return response()->json([
            'notifications' => $notifications,
            'unread_count' => Notification::unread()->count(),
        ]);
    }
    
    /**
     * Mark notification as read.
     */
    public function markNotificationAsRead(Request $request, Notification $notification)
    {
        $notification->markAsRead();
        
        return response()->json([
            'success' => true,
            'message' => 'Notification marked as read'
        ]);
    }
    
    /**
     * Mark all notifications as read.
     */
    public function markAllNotificationsAsRead()
    {
        Notification::unread()->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'All notifications marked as read'
        ]);
    }
}
