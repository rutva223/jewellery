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
        'payment_status',
        'payment_method',
        'shipping_status',
        'shipping_address_id',
        'order_notes',
        'razorpay_order_id',
        'coupon_code',
        'discount_amount'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    public function shippingAddress()
    {
        return $this->belongsTo(ShippingAddress::class);
    }
    
    public static function generateOrderNumber()
    {
        $prefix = 'ORD';
        $timestamp = now()->format('YmdHis');
        $random = mt_rand(100, 999);
        
        return $prefix . $timestamp . $random;
    }
}
