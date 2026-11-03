<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'service_type',
        'shoe_quantity',
        'is_pickup',
        'pickup_address',
        'pickup_fee',
        'service_price',
        'total_price',
        'payment_method',
        'payment_status',
        'status',
        'notes',
        'admin_notes',
        'shoe_brand',
        'shoe_color',
        'estimated_done_at',
        'done_at',
    ];

    protected $casts = [
        'is_pickup' => 'boolean',
        'service_price' => 'decimal:2',
        'pickup_fee' => 'decimal:2',
        'total_price' => 'decimal:2',
        'estimated_done_at' => 'datetime',
        'done_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getServiceLabelAttribute(): string
    {
        return match($this->service_type) {
            'fast_clean' => 'Fast Clean',
            'deep_clean' => 'Deep Clean',
            'suede_treatment' => 'Suede Treatment',
            default => ucfirst($this->service_type),
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'on_hold' => 'On Hold',
            'process' => 'Proses',
            'done' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => ucfirst($this->status),
        };
    }

    public function getPaymentMethodLabelAttribute(): string
    {
        return match($this->payment_method) {
            'cash' => 'Cash / Tunai',
            'transfer_bca' => 'Transfer BCA',
            'transfer_mandiri' => 'Transfer Mandiri',
            'transfer_bni' => 'Transfer BNI',
            'gopay' => 'GoPay',
            'ovo' => 'OVO',
            'dana' => 'DANA',
            'qris' => 'QRIS',
            default => $this->payment_method,
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            'on_hold' => 'badge-onhold',
            'process' => 'badge-process',
            'done' => 'badge-done',
            'cancelled' => 'badge-cancelled',
            default => 'badge-onhold',
        };
    }

    public static function generateOrderNumber(): string
    {
        $date = date('Ymd');
        $prefix = "ORD-{$date}-";

        $latestOrder = self::where('order_number', 'like', "{$prefix}%")
            ->orderBy('order_number', 'desc')
            ->first();

        $seq = 1;
        if ($latestOrder) {
            $parts = explode('-', $latestOrder->order_number);
            $lastSeq = end($parts);
            if (is_numeric($lastSeq)) {
                $seq = (int) $lastSeq + 1;
            }
        }

        while (self::where('order_number', $prefix . str_pad($seq, 3, '0', STR_PAD_LEFT))->exists()) {
            $seq++;
        }

        return $prefix . str_pad($seq, 3, '0', STR_PAD_LEFT);
    }
}
