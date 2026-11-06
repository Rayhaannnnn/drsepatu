@extends('layouts.customer')
@section('title', 'Pesanan Saya')
@section('page-title', 'Daftar Pesanan Anda')
@section('page-subtitle', 'Pantau status pengerjaan dan riwayat laundry sepatu Anda')

@section('content')
<!-- Filter Bar -->
<div class="flex flex-wrap items-center gap-2 mb-6">
    <a href="{{ route('customer.orders.index') }}"
       class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ !request('status') ? 'bg-blue-600 text-white shadow-sm shadow-blue-500/20' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200' }}">
        Semua Pesanan
    </a>
    @foreach(['on_hold' => '🕐 On Hold', 'process' => '⚙️ Diproses', 'done' => '✅ Selesai', 'cancelled' => '❌ Dibatalkan'] as $val => $label)
    <a href="{{ route('customer.orders.index', ['status' => $val]) }}"
       class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ request('status') === $val ? 'bg-blue-600 text-white shadow-sm shadow-blue-500/20' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200' }}">
        {{ $label }}
    </a>
    @endforeach
</div>

<div class="space-y-4">
    @forelse($orders as $order)
    <div class="card p-5 sm:p-6 hover:shadow-md transition-all duration-200 border border-slate-200/80">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-start sm:items-center gap-3.5">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl flex-shrink-0 mt-0.5 sm:mt-0
                    @if($order->service_type === 'fast_clean') bg-blue-50 text-blue-600
                    @elseif($order->service_type === 'deep_clean') bg-indigo-50 text-indigo-600
                    @else bg-purple-50 text-purple-600 @endif">
                    @if($order->service_type === 'fast_clean') ⚡
                    @elseif($order->service_type === 'deep_clean') 🧼
                    @else ✨ @endif
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="font-mono font-black text-slate-900 text-sm tracking-tight">{{ $order->order_number }}</span>
                        <span class="{{ $order->status_badge_class }}">{{ $order->status_label }}</span>
                        @if($order->payment_status === 'paid')
                            <span class="badge-done text-[10px]">Lunas</span>
                        @elseif($order->payment_status === 'pending')
                            <span class="badge-onhold text-[10px]">Belum Bayar</span>
                        @endif
                    </div>
                    <p class="font-bold text-slate-900 text-sm mt-0.5">{{ $order->service_label }} · {{ $order->shoe_quantity }} pasang</p>
                    <div class="flex flex-wrap gap-x-3 gap-y-1 text-xs text-slate-500 mt-1">
                        <span>📅 {{ $order->created_at->format('d M Y') }}</span>
                        @if($order->is_pickup)
                            <span class="text-amber-600 font-semibold">🚗 Pickup</span>
                        @else
                            <span>🚶 Antar Sendiri</span>
                        @endif
                        <span>💳 {{ $order->payment_method_label }}</span>
                        @if($order->shoe_brand)
                            <span class="text-slate-700 font-medium">👟 {{ $order->shoe_brand }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between sm:justify-end gap-4 pt-3 sm:pt-0 border-t sm:border-t-0 border-slate-100">
                <div class="text-left sm:text-right">
                    <p class="font-black text-slate-900 text-base sm:text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    @if($order->estimated_done_at && in_array($order->status, ['on_hold', 'process']))
                        <p class="text-[11px] text-slate-400">Est. selesai: {{ $order->estimated_done_at->format('d M Y') }}</p>
                    @endif
                </div>
                <a href="{{ route('customer.orders.show', $order) }}"
                   class="btn-primary py-2 px-4 text-xs font-semibold whitespace-nowrap shadow-sm">
                    Lihat Detail
                </a>
            </div>
        </div>

        <!-- Progress step for active orders -->
        @if(in_array($order->status, ['on_hold', 'process']))
        <div class="mt-4 pt-4 border-t border-slate-100">
            <div class="flex items-center justify-between text-xs text-slate-500 mb-2">
                <span class="font-medium">Status Pengerjaan:</span>
                <span class="font-bold text-blue-600">{{ $order->status === 'on_hold' ? 'Menunggu Antrean (33%)' : 'Sedang Dicuci (66%)' }}</span>
            </div>
            <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 h-2 rounded-full transition-all duration-500"
                     style="width: {{ $order->status === 'on_hold' ? '33' : '66' }}%"></div>
            </div>
        </div>
        @endif
    </div>
    @empty
    <div class="card p-12 text-center border border-slate-200/80">
        <div class="text-5xl mb-3">👟</div>
        <h3 class="font-bold text-slate-900 text-base mb-1">Belum Ada Pesanan Ditemukan</h3>
        <p class="text-slate-500 text-xs mb-5">Belum ada data pesanan untuk filter yang Anda pilih.</p>
        <a href="{{ route('customer.orders.create') }}" class="btn-primary py-2.5 px-5 text-xs font-bold inline-block">
            Buat Pesanan Baru
        </a>
    </div>
    @endforelse
</div>

@if($orders->hasPages())
<div class="mt-6">
    {{ $orders->appends(request()->query())->links() }}
</div>
@endif
@endsection
