<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $orders = [
            [
                'order_number' => 'ORD-' . date('Ymd') . '-001',
                'user_id' => 2,
                'service_type' => 'fast_clean',
                'shoe_quantity' => 1,
                'is_pickup' => false,
                'pickup_fee' => 0,
                'service_price' => 35000,
                'total_price' => 35000,
                'payment_method' => 'transfer_bca',
                'payment_status' => 'paid',
                'status' => 'done',
                'shoe_brand' => 'Nike',
                'shoe_color' => 'Putih',
                'done_at' => now()->subDays(2),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(2),
            ],
            [
                'order_number' => 'ORD-' . date('Ymd') . '-002',
                'user_id' => 2,
                'service_type' => 'deep_clean',
                'shoe_quantity' => 2,
                'is_pickup' => true,
                'pickup_address' => 'Jl. Demo No. 5, Jakarta',
                'pickup_fee' => 15000,
                'service_price' => 130000,
                'total_price' => 145000,
                'payment_method' => 'gopay',
                'payment_status' => 'paid',
                'status' => 'process',
                'shoe_brand' => 'Adidas',
                'shoe_color' => 'Hitam',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'order_number' => 'ORD-' . date('Ymd') . '-003',
                'user_id' => 2,
                'service_type' => 'suede_treatment',
                'shoe_quantity' => 1,
                'is_pickup' => false,
                'pickup_fee' => 0,
                'service_price' => 95000,
                'total_price' => 95000,
                'payment_method' => 'cash',
                'payment_status' => 'pending',
                'status' => 'on_hold',
                'shoe_brand' => 'New Balance',
                'shoe_color' => 'Abu-abu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}
