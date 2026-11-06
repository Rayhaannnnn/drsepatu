@extends('layouts.admin')
@section('title', 'Kelola Pesanan')
@section('page-title', 'Kelola Pesanan Pelanggan')
@section('page-subtitle', 'Kelola status pencucian, pembayaran, dan rincian pesanan masuk')

@section('content')
<!-- Filter & Search Bar -->
<div class="card p-4 sm:p-5 mb-6 border border-slate-200/80">
    <form method="GET" class="flex flex-wrap gap-3 items-end">
        <div class="flex-1 min-w-[200px]">
            <label class="label text-[11px]">Cari Pesanan</label>
            <input type="text" name="search" value="{{ request('search') }}"
                class="input-field py-2 text-xs" placeholder="No. pesanan, nama pelanggan, merek sepatu...">
        </div>
        <div class="w-36">
            <label class="label text-[11px]">Status Cucian</label>
            <select name="status" class="input-field py-2 text-xs">
                <option value="">Semua Status</option>
                <option value="on_hold" {{ request('status') === 'on_hold' ? 'selected' : '' }}>On Hold</option>
                <option value="process" {{ request('status') === 'process' ? 'selected' : '' }}>Proses</option>
                <option value="done" {{ request('status') === 'done' ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>
        <div class="w-40">
            <label class="label text-[11px]">Paket Layanan</label>
            <select name="service" class="input-field py-2 text-xs">
                <option value="">Semua Layanan</option>
                <option value="fast_clean" {{ request('service') === 'fast_clean' ? 'selected' : '' }}>Fast Clean</option>
                <option value="deep_clean" {{ request('service') === 'deep_clean' ? 'selected' : '' }}>Deep Clean</option>
                <option value="suede_treatment" {{ request('service') === 'suede_treatment' ? 'selected' : '' }}>Suede Treatment</option>
            </select>
        </div>
        <div class="flex items-center gap-2">
            <button type="submit" class="btn-primary py-2 px-4 text-xs font-bold">
                Filter Data
            </button>
            @if(request()->hasAny(['search', 'status', 'service']))
                <a href="{{ route('admin.orders.index') }}" class="btn-secondary py-2 px-3 text-xs">
                    Reset
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Orders Table -->
<div class="card border border-slate-200/80 overflow-hidden shadow-xs">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50/80 border-b border-slate-100">
                <tr>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">No. Pesanan</th>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">Pelanggan</th>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">Layanan</th>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">Total</th>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">Pembayaran</th>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">Status</th>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">Waktu</th>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-xs">
                @forelse($orders as $order)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="py-3.5 px-4">
                        <span class="font-mono font-black text-slate-900">{{ $order->order_number }}</span>
                        @if($order->is_pickup)
                            <div class="text-[10px] text-amber-600 font-bold mt-0.5">🚗 Pickup</div>
                        @else
                            <div class="text-[10px] text-slate-400 mt-0.5">🚶 Drop-off</div>
                        @endif
                    </td>
                    <td class="py-3.5 px-4">
                        <div class="font-bold text-slate-800">{{ $order->user->name }}</div>
                        <div class="text-[11px] text-slate-400">{{ $order->user->phone ?? '-' }}</div>
                    </td>
                    <td class="py-3.5 px-4">
                        <div class="font-semibold text-slate-800">{{ $order->service_label }}</div>
                        <div class="text-[11px] text-slate-400">{{ $order->shoe_quantity }} pasang
                            @if($order->shoe_brand)· {{ $order->shoe_brand }}@endif
                        </div>
                    </td>
                    <td class="py-3.5 px-4">
                        <div class="font-black text-slate-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                        <div class="text-[10px] text-slate-400">{{ $order->payment_method_label }}</div>
                    </td>
                    <td class="py-3.5 px-4">
                        @if($order->payment_status === 'paid')
                            <span class="badge-done text-[10px]">● Lunas</span>
                        @elseif($order->payment_status === 'pending')
                            <span class="badge-onhold text-[10px]">○ Pending</span>
                        @else
                            <span class="badge-cancelled text-[10px]">✕ Gagal</span>
                        @endif
                    </td>
                    <td class="py-3.5 px-4">
                        <span class="{{ $order->status_badge_class }}">{{ $order->status_label }}</span>
                    </td>
                    <td class="py-3.5 px-4 text-slate-500 text-[11px]">
                        <div>{{ $order->created_at->format('d/m/Y') }}</div>
                        <div class="text-slate-400">{{ $order->created_at->format('H:i') }} WIB</div>
                    </td>
                    <td class="py-3.5 px-4">
                        <a href="{{ route('admin.orders.show', $order) }}"
                           class="btn-primary py-1.5 px-3 text-[11px] font-bold">
                            Kelola
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="py-16 text-center text-slate-400">
                        <div class="text-4xl mb-2">🔍</div>
                        <p class="font-semibold text-slate-600">Tidak ada pesanan ditemukan</p>
                        <p class="text-xs text-slate-400 mt-1">Coba gunakan kata kunci pencarian atau filter yang berbeda.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($orders->hasPages())
    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
        {{ $orders->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection
