@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('page-title', 'Executive Dashboard')
@section('page-subtitle', 'Ringkasan performa bisnis dan operasional Dr. Sepatu')

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-6 mb-8">
    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Pemasukan</span>
            <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold">💰</div>
        </div>
        <div class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        <div class="flex items-center gap-1.5 text-[11px] text-emerald-600 font-semibold mt-1.5">
            <span>●</span> Transaksi berstatus lunas
        </div>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Pesanan</span>
            <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm font-bold">📦</div>
        </div>
        <div class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">{{ $totalOrders }}</div>
        <div class="flex items-center gap-1 text-[11px] text-slate-400 mt-1.5">
            Semua riwayat pesanan masuk
        </div>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Pelanggan</span>
            <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm font-bold">👥</div>
        </div>
        <div class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">{{ $totalCustomers }}</div>
        <div class="flex items-center gap-1 text-[11px] text-slate-400 mt-1.5">
            Akun customer terdaftar
        </div>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Pesanan Aktif</span>
            <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm font-bold">⏳</div>
        </div>
        <div class="text-2xl sm:text-3xl font-black text-amber-600 tracking-tight">{{ $pendingOrders }}</div>
        <div class="flex items-center gap-1.5 text-[11px] text-amber-600 font-semibold mt-1.5">
            <span>●</span> On hold & sedang dicuci
        </div>
    </div>
</div>

<!-- Charts & Order Status -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
    <!-- Revenue Chart -->
    <div class="xl:col-span-2 card p-6 border border-slate-200/80">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-6 pb-4 border-b border-slate-100">
            <div>
                <h3 class="font-extrabold text-slate-900 text-base sm:text-lg">Tren Pendapatan Bulanan</h3>
                <p class="text-xs text-slate-400">Akumulasi pendapatan 7 bulan terakhir</p>
            </div>
            <div class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-200/60 self-start sm:self-auto">
                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                <span>Hari ini: Rp {{ number_format($todayRevenue, 0, ',', '.') }}</span>
            </div>
        </div>
        <div class="h-68">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <!-- Status Distribution -->
    <div class="card p-6 border border-slate-200/80 flex flex-col justify-between">
        <div>
            <h3 class="font-extrabold text-slate-900 text-base sm:text-lg mb-1">Distribusi Status Pesanan</h3>
            <p class="text-xs text-slate-400 mb-6">Persentase dari total {{ $totalOrders }} pesanan</p>

            <div class="space-y-4">
                <div>
                    <div class="flex items-center justify-between text-xs font-bold text-slate-700 mb-1.5">
                        <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-amber-500"></span> On Hold</span>
                        <span>{{ $ordersByStatus['on_hold'] }} <span class="text-slate-400 font-normal">({{ $totalOrders > 0 ? round($ordersByStatus['on_hold'] / $totalOrders * 100) : 0 }}%)</span></span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-amber-400 h-2 rounded-full" style="width: {{ $totalOrders > 0 ? ($ordersByStatus['on_hold'] / $totalOrders * 100) : 0 }}%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between text-xs font-bold text-slate-700 mb-1.5">
                        <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-blue-600"></span> Proses</span>
                        <span>{{ $ordersByStatus['process'] }} <span class="text-slate-400 font-normal">({{ $totalOrders > 0 ? round($ordersByStatus['process'] / $totalOrders * 100) : 0 }}%)</span></span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $totalOrders > 0 ? ($ordersByStatus['process'] / $totalOrders * 100) : 0 }}%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between text-xs font-bold text-slate-700 mb-1.5">
                        <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Selesai</span>
                        <span>{{ $ordersByStatus['done'] }} <span class="text-slate-400 font-normal">({{ $totalOrders > 0 ? round($ordersByStatus['done'] / $totalOrders * 100) : 0 }}%)</span></span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $totalOrders > 0 ? ($ordersByStatus['done'] / $totalOrders * 100) : 0 }}%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between text-xs font-bold text-slate-700 mb-1.5">
                        <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-rose-500"></span> Dibatalkan</span>
                        <span>{{ $ordersByStatus['cancelled'] }} <span class="text-slate-400 font-normal">({{ $totalOrders > 0 ? round($ordersByStatus['cancelled'] / $totalOrders * 100) : 0 }}%)</span></span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-rose-500 h-2 rounded-full" style="width: {{ $totalOrders > 0 ? ($ordersByStatus['cancelled'] / $totalOrders * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick navigation buttons -->
        <div class="mt-6 pt-5 border-t border-slate-100 space-y-2">
            <a href="{{ route('admin.orders.index', ['status' => 'on_hold']) }}"
               class="block w-full text-center bg-amber-50 hover:bg-amber-100 text-amber-800 font-bold py-2 px-3 rounded-xl text-xs transition-colors border border-amber-200/80">
                ⚡ Tindak Lanjuti On Hold ({{ $ordersByStatus['on_hold'] }})
            </a>
            <a href="{{ route('admin.income') }}"
               class="block w-full text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-2 px-3 rounded-xl text-xs transition-colors">
                Lihat Laporan Lengkap
            </a>
        </div>
    </div>
</div>

<!-- Recent Orders Table -->
<div class="card border border-slate-200/80 overflow-hidden">
    <div class="p-5 sm:p-6 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h3 class="font-extrabold text-slate-900 text-base sm:text-lg">Pesanan Masuk Terbaru</h3>
            <p class="text-xs text-slate-400">5 transaksi pesanan terakhir di sistem</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-800 text-xs font-bold transition-colors">
            Kelola Semua →
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50/80 border-b border-slate-100">
                <tr>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">No. Pesanan</th>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">Pelanggan</th>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">Paket & Qty</th>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">Total Tagihan</th>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">Status</th>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-xs">
                @forelse($recentOrders as $order)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="py-3.5 px-4">
                        <span class="font-mono font-bold text-slate-900">{{ $order->order_number }}</span>
                        @if($order->is_pickup)
                            <span class="block text-[10px] text-amber-600 font-semibold mt-0.5">🚗 Pickup</span>
                        @endif
                    </td>
                    <td class="py-3.5 px-4">
                        <div class="font-bold text-slate-800">{{ $order->user->name }}</div>
                        <div class="text-[11px] text-slate-400">{{ $order->user->phone ?? '-' }}</div>
                    </td>
                    <td class="py-3.5 px-4">
                        <div class="font-medium text-slate-700">{{ $order->service_label }}</div>
                        <div class="text-[11px] text-slate-400">{{ $order->shoe_quantity }} pasang</div>
                    </td>
                    <td class="py-3.5 px-4 font-bold text-slate-900">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </td>
                    <td class="py-3.5 px-4">
                        <span class="{{ $order->status_badge_class }}">{{ $order->status_label }}</span>
                    </td>
                    <td class="py-3.5 px-4">
                        <a href="{{ route('admin.orders.show', $order) }}"
                           class="btn-secondary py-1 px-3 text-xs font-semibold hover:border-blue-500">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-12 text-center text-slate-400">
                        Belum ada pesanan terbaru
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
