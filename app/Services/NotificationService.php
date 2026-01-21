<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use App\Models\Order;
use App\Models\ContactMessage;

class NotificationService
{
    /**
     * Create notification for new user registration.
     */
    public static function newUser(User $user)
    {
        return Notification::createNotification(
            'new_user',
            'New User Registration',
            "A new user {$user->name} has registered on the platform.",
            route('admin.users.show', $user),
            $user
        );
    }

    /**
     * Create notification for new order.
     */
    public static function newOrder(Order $order)
    {
        return Notification::createNotification(
            'new_order',
            'New Order Placed',
            "New order #{$order->id} placed by {$order->user->name} for $" . number_format($order->total, 2),
            route('admin.orders.show', $order),
            $order
        );
    }

    /**
     * Create notification for new contact message.
     */
    public static function newContactMessage(ContactMessage $message)
    {
        $subject = $message->subject ? $message->subject : 'No subject';
        
        return Notification::createNotification(
            'new_message',
            'New Contact Message',
            "New contact message from {$message->full_name}: {$subject}",
            route('admin.contact-messages'),
            $message
        );
    }

    /**
     * Create notification for order status change.
     */
    public static function orderStatusChanged(Order $order, $oldStatus, $newStatus)
    {
        return Notification::createNotification(
            'order_status_change',
            'Order Status Updated',
            "Order #{$order->id} status changed from {$oldStatus} to {$newStatus}",
            route('admin.orders.show', $order),
            $order
        );
    }

    /**
     * Create notification for product out of stock.
     */
    public static function productOutOfStock($product)
    {
        return Notification::createNotification(
            'product_out_of_stock',
            'Product Out of Stock',
            "Product '{$product->name}' is now out of stock.",
            route('admin.products.show', $product),
            $product
        );
    }

    /**
     * Create custom notification.
     */
    public static function create($type, $title, $message, $url = null, $notifiable = null)
    {
        return Notification::createNotification($type, $title, $message, $url, $notifiable);
    }

    /**
     * Get unread notifications count.
     */
    public static function getUnreadCount()
    {
        return Notification::unread()->count();
    }

    /**
     * Get latest notifications.
     */
    public static function getLatest($limit = 10)
    {
        return Notification::latest()
            ->take($limit)
            ->get();
    }

    /**
     * Mark all notifications as read.
     */
    public static function markAllAsRead()
    {
        return Notification::unread()->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    /**
     * Mark notification as read.
     */
    public static function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        if ($notification) {
            $notification->markAsRead();
            return true;
        }
        return false;
    }
}
