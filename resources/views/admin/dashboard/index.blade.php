@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan bisnis Dr. Sepatu')

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full">Total</span>
        </div>
        <div class="text-2xl font-black text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        <div class="text-sm text-gray-500 mt-1">Total Pemasukan</div>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <span class="text-xs font-medium text-indigo-600 bg-indigo-50 px-2 py-1 rounded-full">{{ $totalOrders }} order</span>
        </div>
        <div class="text-2xl font-black text-gray-900">{{ $totalOrders }}</div>
        <div class="text-sm text-gray-500 mt-1">Total Pesanan</div>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full">Pelanggan</span>
        </div>
        <div class="text-2xl font-black text-gray-900">{{ $totalCustomers }}</div>
        <div class="text-sm text-gray-500 mt-1">Total Pelanggan</div>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="text-xs font-medium text-yellow-600 bg-yellow-50 px-2 py-1 rounded-full">Aktif</span>
        </div>
        <div class="text-2xl font-black text-gray-900">{{ $pendingOrders }}</div>
        <div class="text-sm text-gray-500 mt-1">Pesanan Aktif</div>
    </div>
</div>

<!-- Charts & Status -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
    <!-- Revenue Chart -->
    <div class="xl:col-span-2 card p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="font-bold text-gray-900 text-lg">Grafik Pemasukan</h3>
                <p class="text-sm text-gray-500">7 bulan terakhir</p>
            </div>
            <div class="text-sm font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
                Rp {{ number_format($todayRevenue, 0, ',', '.') }} hari ini
            </div>
        </div>
        <div class="h-64">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <!-- Order Status -->
    <div class="card p-6">
        <h3 class="font-bold text-gray-900 text-lg mb-6">Status Pesanan</h3>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                    <span class="text-sm text-gray-600">On Hold</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-24 bg-gray-100 rounded-full h-2">
                        <div class="bg-yellow-400 h-2 rounded-full" style="width: {{ $totalOrders > 0 ? ($ordersByStatus['on_hold'] / $totalOrders * 100) : 0 }}%"></div>
                    </div>
                    <span class="text-sm font-semibold text-gray-900 w-8 text-right">{{ $ordersByStatus['on_hold'] }}</span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">Proses</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-24 bg-gray-100 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $totalOrders > 0 ? ($ordersByStatus['process'] / $totalOrders * 100) : 0 }}%"></div>
                    </div>
                    <span class="text-sm font-semibold text-gray-900 w-8 text-right">{{ $ordersByStatus['process'] }}</span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">Selesai</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-24 bg-gray-100 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: {{ $totalOrders > 0 ? ($ordersByStatus['done'] / $totalOrders * 100) : 0 }}%"></div>
                    </div>
                    <span class="text-sm font-semibold text-gray-900 w-8 text-right">{{ $ordersByStatus['done'] }}</span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                    <span class="text-sm text-gray-600">Dibatalkan</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-24 bg-gray-100 rounded-full h-2">
                        <div class="bg-red-400 h-2 rounded-full" style="width: {{ $totalOrders > 0 ? ($ordersByStatus['cancelled'] / $totalOrders * 100) : 0 }}%"></div>
                    </div>
                    <span class="text-sm font-semibold text-gray-900 w-8 text-right">{{ $ordersByStatus['cancelled'] }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 space-y-2">
            <a href="{{ route('admin.orders.index') }}?status=on_hold" class="block w-full text-center bg-yellow-50 hover:bg-yellow-100 text-yellow-800 font-semibold py-2 px-4 rounded-xl text-sm transition-colors border border-yellow-200">
                Lihat Pesanan On Hold ({{ $ordersByStatus['on_hold'] }})
            </a>
            <a href="{{ route('admin.income') }}" class="block w-full text-center bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold py-2 px-4 rounded-xl text-sm transition-colors border border-blue-200">
                Lihat Laporan Pemasukan
            </a>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="card p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="font-bold text-gray-900 text-lg">Pesanan Terbaru</h3>
        <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors">
            Lihat Semua →
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-3 px-2">No. Pesanan</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-3 px-2">Pelanggan</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-3 px-2">Layanan</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-3 px-2">Total</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-3 px-2">Status</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-3 px-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($recentOrders as $order)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="py-4 px-2">
                        <span class="font-mono text-sm font-semibold text-blue-600">{{ $order->order_number }}</span>
                    </td>
                    <td class="py-4 px-2">
                        <div class="font-medium text-gray-900 text-sm">{{ $order->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $order->user->phone }}</div>
                    </td>
                    <td class="py-4 px-2">
                        <span class="text-sm text-gray-700">{{ $order->service_label }}</span>
                        <div class="text-xs text-gray-500">{{ $order->shoe_quantity }} pasang</div>
                    </td>
                    <td class="py-4 px-2">
                        <span class="font-semibold text-gray-900 text-sm">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </td>
                    <td class="py-4 px-2">
                        <span class="{{ $order->status_badge_class }}">{{ $order->status_label }}</span>
                    </td>
                    <td class="py-4 px-2">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors">
                            Detail →
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-12 text-center text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Belum ada pesanan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const labels = @json($chartLabels);
    const data = @json($chartData);
    window.initChart('revenueChart', labels, data);
});
</script>
@endpush
