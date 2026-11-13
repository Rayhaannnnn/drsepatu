<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Chat thread messages where this user is the customer.
     */
    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class, 'user_id');
    }

    /**
     * Chat messages authored/sent by this user.
     */
    public function sentChatMessages()
    {
        return $this->hasMany(ChatMessage::class, 'sender_id');
    }

    /**
     * Unread messages count for this user.
     */
    public function unreadChatCount(): int
    {
        if ($this->isAdmin()) {
            // Count unread customer messages sent to admin
            return ChatMessage::whereHas('sender', function ($query) {
                $query->where('role', 'customer');
            })->where('is_read', false)->count();
        }

        // Count unread admin replies to this customer
        return ChatMessage::where('user_id', $this->id)
            ->where('sender_id', '!=', $this->id)
            ->where('is_read', false)
            ->count();
    }
}
