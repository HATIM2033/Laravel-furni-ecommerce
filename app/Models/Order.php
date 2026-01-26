<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'shipping_amount',
        'tax_amount',
        'discount_amount',
        'status',
        'payment_status',
        'payment_method',
        'shipping_address',
        'billing_address',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'shipping_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'shipping_address' => 'array',
        'billing_address' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        // Auto-update payment status when order status changes
        static::updating(function ($order) {
            // If order is being marked as completed, set payment status to paid
            if ($order->status === 'completed' && $order->isDirty('status')) {
                $order->payment_status = 'paid';
            }
            
            // If order is being marked as cancelled, set payment status to cancelled
            if ($order->status === 'cancelled' && $order->isDirty('status')) {
                $order->payment_status = 'cancelled';
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedTotalAttribute()
    {
        return '$' . number_format($this->total_amount, 2);
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    public function canBeCancelled()
    {
        return in_array($this->status, ['pending', 'processing']);
    }

    public function isPaid()
    {
        return $this->payment_status === 'paid';
    }

    public function getPaymentStatusBadgeAttribute()
    {
        if ($this->payment_status === 'paid') {
            return '<span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Paid</span>';
        } elseif ($this->payment_status === 'cancelled') {
            return '<span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i>Cancelled</span>';
        } else {
            return '<span class="badge bg-warning"><i class="fas fa-clock me-1"></i>Pending</span>';
        }
    }

    public function getStatusBadgeAttribute()
    {
        $colors = [
            'pending' => 'warning',
            'processing' => 'info', 
            'completed' => 'success',
            'cancelled' => 'danger'
        ];

        $icons = [
            'pending' => 'clock',
            'processing' => 'truck',
            'completed' => 'check-circle',
            'cancelled' => 'times-circle'
        ];

        $color = $colors[$this->status] ?? 'secondary';
        $icon = $icons[$this->status] ?? 'question-circle';

        return '<span class="badge bg-' . $color . '"><i class="fas fa-' . $icon . ' me-1"></i>' . ucfirst($this->status) . '</span>';
    }
}
