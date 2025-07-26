<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'company_name',
        'first_name',
        'last_name',
        'phone',
        'email',
        'address_1',
        'address_2',
        'city',
        'state',
        'country',
        'postcode',
        'order_comments'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
