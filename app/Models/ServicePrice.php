<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_type',
        'service_name',
        'price_per_pair',
        'description',
        'estimated_days',
        'is_active',
    ];

    protected $casts = [
        'price_per_pair' => 'decimal:2',
        'is_active' => 'boolean',
    ];
}
