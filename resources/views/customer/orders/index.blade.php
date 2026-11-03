@extends('layouts.customer')
@section('title', 'Pesanan Saya')
@section('page-title', 'Pesanan Saya')
@section('page-subtitle', 'Semua riwayat pesanan Anda')

@section('content')
<!-- Filter -->
<div class="flex flex-wrap gap-2 mb-6">
    <a href="{{ route('customer.orders.index') }}"
       class="px-4 py-2 rounded-xl text-sm font-semibold transition-colors {{ !request('status') ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200' }}">
        Semua
    </a>
    @foreach(['on_hold' => 'On Hold', 'process' => 'Diproses', 'done' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $val => $label)
    <a href="{{ route('customer.orders.index', ['status' => $val]) }}"
       class="px-4 py-2 rounded-xl text-sm font-semibold transition-colors {{ request('status') === $val ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200' }}">
        {{ $label }}
    </a>
    @endforeach
</div>

<div class="space-y-4">
    @forelse($orders as $order)
    <div class="card p-6 hover:shadow-lg transition-all duration-300">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl flex-shrink-0
                    @if($order->service_type === 'fast_clean') bg-blue-100
                    @elseif($order->service_type === 'deep_clean') bg-indigo-100
                    @else bg-purple-100 @endif">
                    @if($order->service_type === 'fast_clean') ⚡
                    @elseif($order->service_type === 'deep_clean') 🧼
                    @else ✨ @endif
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="font-mono font-bold text-blue-700 text-sm">{{ $order->order_number }}</span>
                        <span class="{{ $order->status_badge_class }}">{{ $order->status_label }}</span>
                        @if($order->payment_status === 'paid')
                            <span class="badge-done">Lunas</span>
                        @elseif($order->payment_status === 'pending')
                            <span class="badge-onhold">Belum Bayar</span>
                        @endif
                    </div>
                    <p class="font-semibold text-gray-900 mt-0.5">{{ $order->service_label }} · {{ $order->shoe_quantity }} pasang</p>
                    <div class="flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-500 mt-1">
                        <span>{{ $order->created_at->format('d M Y') }}</span>
                        @if($order->is_pickup)
                            <span class="text-orange-500">🚗 Pickup</span>
                        @else
                            <span>🚶 Antar Sendiri</span>
                        @endif
                        <span>{{ $order->payment_method_label }}</span>
                        @if($order->shoe_brand)
                            <span>{{ $order->shoe_brand }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="font-black text-gray-900 text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    @if($order->estimated_done_at && in_array($order->status, ['on_hold', 'process']))
                        <p class="text-xs text-gray-500">Est: {{ $order->estimated_done_at->format('d M Y') }}</p>
                    @endif
                </div>
                <a href="{{ route('customer.orders.show', $order) }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded-xl transition-colors whitespace-nowrap">
                    Detail
                </a>
            </div>
        </div>

        <!-- Progress bar for active orders -->
        @if(in_array($order->status, ['on_hold', 'process']))
        <div class="mt-4 pt-4 border-t border-gray-100">
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                <span>Progress Pesanan:</span>
                <span class="font-semibold text-blue-600">{{ $order->status === 'on_hold' ? '33%' : '66%' }}</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="flex-1 bg-gray-100 rounded-full h-2">
                    <div class="bg-blue-500 h-2 rounded-full transition-all duration-500"
                         style="width: {{ $order->status === 'on_hold' ? '33' : '66' }}%"></div>
                </div>
            </div>
            <div class="flex justify-between text-xs text-gray-400 mt-1">
                <span class="{{ $order->status === 'on_hold' ? 'text-blue-600 font-semibold' : 'text-green-600 font-semibold' }}">Diterima</span>
                <span class="{{ $order->status === 'process' ? 'text-blue-600 font-semibold' : '' }}">Proses</span>
                <span>Selesai</span>
            </div>
        </div>
        @endif
    </div>
    @empty
    <div class="card p-16 text-center">
        <div class="text-6xl mb-4">👟</div>
        <h3 class="font-bold text-gray-900 text-xl mb-2">Belum Ada Pesanan</h3>
        <p class="text-gray-500 mb-6">Yuk mulai pesan layanan cuci sepatu Dr. Sepatu!</p>
        <a href="{{ route('customer.orders.create') }}" class="btn-primary inline-block">
            Pesan Sekarang
        </a>
    </div>
    @endforelse
</div>

@if($orders->hasPages())
<div class="mt-6">
    {{ $orders->links() }}
</div>
@endif
@endsection
