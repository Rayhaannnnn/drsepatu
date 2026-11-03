<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'month');
        $year = $request->get('year', date('Y'));
        $month = $request->get('month', date('m'));

        $query = Order::where('payment_status', 'paid');

        if ($period === 'day') {
            $query->whereDate('created_at', today());
            $totalIncome = $query->sum('total_price');
            $orders = $query->with('user')->latest()->get();
            $chartLabels = [];
            $chartData = [];
        } elseif ($period === 'month') {
            $query->whereYear('created_at', $year)->whereMonth('created_at', $month);
            $totalIncome = $query->sum('total_price');
            $orders = $query->with('user')->latest()->get();

            $isSqlite = DB::connection()->getDriverName() === 'sqlite';
            $dayExpr = $isSqlite ? "CAST(strftime('%d', created_at) AS INTEGER)" : "DAY(created_at)";

            // Daily breakdown
            $dailyRevenue = Order::where('payment_status', 'paid')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->selectRaw("{$dayExpr} as day, SUM(total_price) as total")
                ->groupBy('day')
                ->orderBy('day')
                ->get()
                ->keyBy('day');

            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $chartLabels = range(1, $daysInMonth);
            $chartData = collect(range(1, $daysInMonth))->map(fn($d) => (float)($dailyRevenue[$d]->total ?? 0))->toArray();
        } else { // year
            $isSqlite = DB::connection()->getDriverName() === 'sqlite';
            $monthExpr = $isSqlite ? "CAST(strftime('%m', created_at) AS INTEGER)" : "MONTH(created_at)";

            $query->whereYear('created_at', $year);
            $totalIncome = $query->sum('total_price');
            $orders = $query->with('user')->latest()->get();

            $monthlyRevenue = Order::where('payment_status', 'paid')
                ->whereYear('created_at', $year)
                ->selectRaw("{$monthExpr} as month, SUM(total_price) as total")
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->keyBy('month');

            $monthNames = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'];
            $chartLabels = $monthNames;
            $chartData = collect(range(1, 12))->map(fn($m) => (float)($monthlyRevenue[$m]->total ?? 0))->toArray();
        }

        // Service breakdown
        $serviceBreakdown = Order::where('payment_status', 'paid')
            ->selectRaw('service_type, COUNT(*) as count, SUM(total_price) as total')
            ->groupBy('service_type')
            ->get();

        // Payment method breakdown
        $paymentBreakdown = Order::where('payment_status', 'paid')
            ->selectRaw('payment_method, COUNT(*) as count, SUM(total_price) as total')
            ->groupBy('payment_method')
            ->get();

        $totalAllTime = Order::where('payment_status', 'paid')->sum('total_price');
        $totalOrdersPaid = Order::where('payment_status', 'paid')->count();

        return view('admin.income.index', compact(
            'totalIncome', 'orders', 'chartLabels', 'chartData',
            'period', 'year', 'month', 'serviceBreakdown', 'paymentBreakdown',
            'totalAllTime', 'totalOrdersPaid'
        ));
    }
}
