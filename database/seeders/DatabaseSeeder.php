<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ServicePrice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin Dr. Sepatu',
            'email' => 'admin@drsepatu.com',
            'password' => Hash::make('12345'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Contoh No. 1, Jakarta',
        ]);

        // Create Sample Customer
        User::create([
            'name' => 'Customer Demo',
            'email' => 'customer@drsepatu.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '089876543210',
            'address' => 'Jl. Demo No. 5, Jakarta',
        ]);

        // Service Prices
        ServicePrice::insert([
            [
                'service_type' => 'fast_clean',
                'service_name' => 'Fast Clean',
                'price_per_pair' => 35000,
                'description' => 'Cuci cepat 1 hari untuk sepatu daily wear. Pembersihan eksternal menyeluruh, penggunaan sikat dan sabun khusus, pengeringan dengan angin.',
                'estimated_days' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_type' => 'deep_clean',
                'service_name' => 'Deep Clean',
                'price_per_pair' => 65000,
                'description' => 'Pembersihan mendalam untuk noda membandel. Termasuk pembersihan dalam, luar, sol, dan whitening. Proses 2-3 hari.',
                'estimated_days' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_type' => 'suede_treatment',
                'service_name' => 'Suede Treatment',
                'price_per_pair' => 95000,
                'description' => 'Perawatan khusus untuk material suede dan nubuck. Menggunakan produk premium untuk menjaga tekstur dan warna asli sepatu.',
                'estimated_days' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Sample Orders
        $this->call(OrderSeeder::class);
    }
}
