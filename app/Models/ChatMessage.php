<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sender_id',
        'order_id',
        'message',
        'image_path',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Customer thread this message belongs to.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * User who authored this message (either customer or admin).
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Optional related order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Check if sent by an admin.
     */
    public function isFromAdmin(): bool
    {
        return $this->sender && $this->sender->isAdmin();
    }

    /**
     * Check if sent by customer.
     */
    public function isFromCustomer(): bool
    {
        return $this->sender && $this->sender->isCustomer();
    }
}
