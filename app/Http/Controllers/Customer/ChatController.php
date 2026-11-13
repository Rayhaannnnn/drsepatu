<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    /**
     * Display chat page for customer.
     */
    public function index()
    {
        $user = auth()->user();
        
        // Mark admin messages as read when opening chat
        ChatMessage::where('user_id', $user->id)
            ->where('sender_id', '!=', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = ChatMessage::with(['sender', 'order'])
            ->where('user_id', $user->id)
            ->orderBy('id', 'asc')
            ->get();

        $activeOrders = $user->orders()
            ->latest()
            ->take(5)
            ->get();

        return view('customer.chat.index', compact('messages', 'activeOrders'));
    }

    /**
     * API: Fetch messages for polling.
     */
    public function fetch(Request $request)
    {
        $user = auth()->user();
        $afterId = $request->query('after_id', 0);

        // Mark incoming messages as read
        ChatMessage::where('user_id', $user->id)
            ->where('sender_id', '!=', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $query = ChatMessage::with(['sender', 'order'])
            ->where('user_id', $user->id);

        if ($afterId > 0) {
            $query->where('id', '>', $afterId);
        }

        $messages = $query->orderBy('id', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'messages' => $messages->map(function ($msg) use ($user) {
                return [
                    'id' => $msg->id,
                    'message' => $msg->message,
                    'image_url' => $msg->image_path ? asset('storage/' . $msg->image_path) : null,
                    'is_me' => $msg->sender_id === $user->id,
                    'sender_name' => $msg->sender_id === $user->id ? 'Saya' : ($msg->sender->name ?? 'Admin Dr. Sepatu'),
                    'sender_role' => $msg->sender->role ?? 'admin',
                    'order_id' => $msg->order_id,
                    'order_number' => $msg->order ? $msg->order->order_number : null,
                    'time' => $msg->created_at->format('H:i'),
                    'created_at_human' => $msg->created_at->diffForHumans(),
                ];
            }),
            'unread_count' => 0,
        ]);
    }

    /**
     * API: Send a new message from customer.
     */
    public function send(Request $request)
    {
        $request->validate([
            'message' => 'nullable|string|max:2000',
            'image' => 'nullable|image|max:5120', // max 5MB
            'order_id' => 'nullable|exists:orders,id',
        ]);

        if (empty($request->message) && !$request->hasFile('image')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pesan atau foto tidak boleh kosong.',
            ], 422);
        }

        $user = auth()->user();
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('chat_images', 'public');
        }

        $msg = ChatMessage::create([
            'user_id' => $user->id,
            'sender_id' => $user->id,
            'order_id' => $request->order_id ?: null,
            'message' => $request->message ?? '(Mengirim foto sepatu)',
            'image_path' => $imagePath,
            'is_read' => false,
        ]);

        $msg->load(['sender', 'order']);

        return response()->json([
            'status' => 'success',
            'message' => [
                'id' => $msg->id,
                'message' => $msg->message,
                'image_url' => $msg->image_path ? asset('storage/' . $msg->image_path) : null,
                'is_me' => true,
                'sender_name' => 'Saya',
                'sender_role' => 'customer',
                'order_id' => $msg->order_id,
                'order_number' => $msg->order ? $msg->order->order_number : null,
                'time' => $msg->created_at->format('H:i'),
                'created_at_human' => $msg->created_at->diffForHumans(),
            ],
        ]);
    }

    /**
     * API: Unread count check for customer badge.
     */
    public function unreadCount()
    {
        $user = auth()->user();
        $count = ChatMessage::where('user_id', $user->id)
            ->where('sender_id', '!=', $user->id)
            ->where('is_read', false)
            ->count();

        return response()->json([
            'unread_count' => $count,
        ]);
    }
}

