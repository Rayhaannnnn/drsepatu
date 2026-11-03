<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $recentOrders = Order::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'total' => Order::where('user_id', $user->id)->count(),
            'on_hold' => Order::where('user_id', $user->id)->where('status', 'on_hold')->count(),
            'process' => Order::where('user_id', $user->id)->where('status', 'process')->count(),
            'done' => Order::where('user_id', $user->id)->where('status', 'done')->count(),
        ];

        $totalSpent = Order::where('user_id', $user->id)->where('payment_status', 'paid')->sum('total_price');

        return view('customer.dashboard.index', compact('recentOrders', 'stats', 'totalSpent'));
    }
}
