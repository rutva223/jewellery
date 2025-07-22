<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'cost',
        'minimum_order_amount',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'cost' => 'decimal:2',
        'minimum_order_amount' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByOrderAmount($query, $amount)
    {
        return $query->where(function ($q) use ($amount) {
            $q->whereNull('minimum_order_amount')
              ->orWhere('minimum_order_amount', '<=', $amount);
        });
    }

    public function isEligible($orderAmount)
    {
        if ($this->minimum_order_amount && $orderAmount < $this->minimum_order_amount) {
            return false;
        }

        return true;
    }

    public function getDisplayCostAttribute()
    {
        return $this->cost == 0 ? 'Free' : '₹' . number_format($this->cost, 2);
    }
}
