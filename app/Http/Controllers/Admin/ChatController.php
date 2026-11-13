<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Admin Live Chat Dashboard.
     */
    public function index(Request $request)
    {
        $selectedCustomerId = $request->query('customer_id');

        // Fetch all customers who have sent or received messages, plus other customers
        $customers = User::where('role', 'customer')
            ->withCount(['chatMessages as unread_count' => function ($query) {
                $query->whereColumn('sender_id', 'users.id')
                      ->where('is_read', false);
            }])
            ->with(['chatMessages' => function ($query) {
                $query->latest()->limit(1);
            }])
            ->get()
            ->sortByDesc(function ($user) {
                $lastMsg = $user->chatMessages->first();
                return $lastMsg ? $lastMsg->created_at : $user->created_at;
            })
            ->values();

        $selectedCustomer = null;
        if ($selectedCustomerId) {
            $selectedCustomer = User::where('role', 'customer')->find($selectedCustomerId);
        } elseif ($customers->isNotEmpty()) {
            $selectedCustomer = $customers->first();
        }

        $messages = collect();
        if ($selectedCustomer) {
            // Mark customer's messages as read
            ChatMessage::where('user_id', $selectedCustomer->id)
                ->where('sender_id', $selectedCustomer->id)
                ->where('is_read', false)
                ->update(['is_read' => true]);

            $messages = ChatMessage::with(['sender', 'order'])
                ->where('user_id', $selectedCustomer->id)
                ->orderBy('id', 'asc')
                ->get();
        }

        return view('admin.chat.index', compact('customers', 'selectedCustomer', 'messages'));
    }

    /**
     * API: Polling conversation list for admin sidebar.
     */
    public function conversations()
    {
        $customers = User::where('role', 'customer')
            ->withCount(['chatMessages as unread_count' => function ($query) {
                $query->whereColumn('sender_id', 'users.id')
                      ->where('is_read', false);
            }])
            ->with(['chatMessages' => function ($query) {
                $query->latest()->limit(1);
            }])
            ->get()
            ->sortByDesc(function ($user) {
                $lastMsg = $user->chatMessages->first();
                return $lastMsg ? $lastMsg->created_at : $user->created_at;
            })
            ->values();

        $totalUnread = ChatMessage::whereHas('sender', function ($query) {
            $query->where('role', 'customer');
        })->where('is_read', false)->count();

        return response()->json([
            'status' => 'success',
            'total_unread' => $totalUnread,
            'conversations' => $customers->map(function ($c) {
                $lastMsg = $c->chatMessages->first();
                return [
                    'id' => $c->id,
                    'name' => $c->name,
                    'phone' => $c->phone ?? '-',
                    'avatar' => strtoupper(substr($c->name, 0, 1)),
                    'unread_count' => $c->unread_count,
                    'last_message' => $lastMsg ? $lastMsg->message : 'Belum ada pesan',
                    'last_time' => $lastMsg ? $lastMsg->created_at->diffForHumans(null, true) : '',
                ];
            }),
        ]);
    }

    /**
     * API: Fetch messages for selected customer.
     */
    public function fetch(User $customer, Request $request)
    {
        $afterId = $request->query('after_id', 0);
        $admin = auth()->user();

        // Mark unread messages from this customer as read
        ChatMessage::where('user_id', $customer->id)
            ->where('sender_id', $customer->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $query = ChatMessage::with(['sender', 'order'])
            ->where('user_id', $customer->id);

        if ($afterId > 0) {
            $query->where('id', '>', $afterId);
        }

        $messages = $query->orderBy('id', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'customer' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'phone' => $customer->phone ?? '-',
                'address' => $customer->address ?? '-',
                'orders_count' => $customer->orders()->count(),
            ],
            'messages' => $messages->map(function ($msg) use ($admin) {
                return [
                    'id' => $msg->id,
                    'message' => $msg->message,
                    'image_url' => $msg->image_path ? asset('storage/' . $msg->image_path) : null,
                    'is_me' => $msg->sender_id === $admin->id,
                    'sender_name' => $msg->sender_id === $admin->id ? 'Admin' : $msg->sender->name,
                    'sender_role' => $msg->sender->role ?? 'customer',
                    'order_id' => $msg->order_id,
                    'order_number' => $msg->order ? $msg->order->order_number : null,
                    'time' => $msg->created_at->format('H:i'),
                    'created_at_human' => $msg->created_at->diffForHumans(),
                ];
            }),
        ]);
    }

    /**
     * API: Admin sends a reply message to customer.
     */
    public function send(User $customer, Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
            'order_id' => 'nullable|exists:orders,id',
        ]);

        $admin = auth()->user();

        $msg = ChatMessage::create([
            'user_id' => $customer->id,
            'sender_id' => $admin->id,
            'order_id' => $request->order_id ?: null,
            'message' => $request->message,
            'is_read' => false,
        ]);

        $msg->load(['sender', 'order']);

        return response()->json([
            'status' => 'success',
            'message' => [
                'id' => $msg->id,
                'message' => $msg->message,
                'image_url' => null,
                'is_me' => true,
                'sender_name' => 'Admin',
                'sender_role' => 'admin',
                'order_id' => $msg->order_id,
                'order_number' => $msg->order ? $msg->order->order_number : null,
                'time' => $msg->created_at->format('H:i'),
                'created_at_human' => $msg->created_at->diffForHumans(),
            ],
        ]);
    }

    /**
     * API: Total unread count for sidebar badge.
     */
    public function unreadTotal()
    {
        $total = ChatMessage::whereHas('sender', function ($query) {
            $query->where('role', 'customer');
        })->where('is_read', false)->count();

        return response()->json([
            'unread_total' => $total,
        ]);
    }
}

