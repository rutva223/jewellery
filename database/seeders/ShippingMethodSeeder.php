<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShippingMethod;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shippingMethods = [
            [
                'name' => 'Free Shipping',
                'type' => 'free',
                'description' => 'Free shipping on orders above ₹500',
                'cost' => 0.00,
                'minimum_order_amount' => 500.00,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Standard Delivery',
                'type' => 'flat_rate',
                'description' => 'Standard delivery within 5-7 business days',
                'cost' => 50.00,
                'minimum_order_amount' => null,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Express Delivery',
                'type' => 'flat_rate',
                'description' => 'Express delivery within 2-3 business days',
                'cost' => 150.00,
                'minimum_order_amount' => null,
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($shippingMethods as $method) {
            ShippingMethod::updateOrCreate(
                ['name' => $method['name']], 
                $method
            );
        }
    }
}