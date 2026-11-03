<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_price');
        $totalOrders = Order::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $pendingOrders = Order::whereIn('status', ['on_hold', 'process'])->count();

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        $ordersByStatus = [
            'on_hold' => Order::where('status', 'on_hold')->count(),
            'process' => Order::where('status', 'process')->count(),
            'done' => Order::where('status', 'done')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        // Monthly revenue for chart (last 7 months)
        $isSqlite = DB::connection()->getDriverName() === 'sqlite';
        $monthExpr = $isSqlite ? "CAST(strftime('%m', created_at) AS INTEGER)" : "MONTH(created_at)";
        $yearExpr = $isSqlite ? "CAST(strftime('%Y', created_at) AS INTEGER)" : "YEAR(created_at)";

        $monthlyRevenue = Order::where('payment_status', 'paid')
            ->where('created_at', '>=', now()->subMonths(6))
            ->selectRaw("{$monthExpr} as month, {$yearExpr} as year, SUM(total_price) as total")
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $chartLabels = [];
        $chartData = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $label = $months[$date->month - 1] . ' ' . $date->year;
            $chartLabels[] = $label;
            $revenue = $monthlyRevenue->where('month', $date->month)->where('year', $date->year)->first();
            $chartData[] = $revenue ? (float) $revenue->total : 0;
        }

        $todayRevenue = Order::where('payment_status', 'paid')
            ->whereDate('created_at', today())
            ->sum('total_price');

        return view('admin.dashboard.index', compact(
            'totalRevenue', 'totalOrders', 'totalCustomers', 'pendingOrders',
            'recentOrders', 'ordersByStatus', 'chartLabels', 'chartData', 'todayRevenue'
        ));
    }
}
