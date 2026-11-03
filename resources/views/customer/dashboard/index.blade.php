@extends('layouts.customer')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Hai, {{ auth()->user()->name }}! 👋')

@section('content')
<!-- Stats -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="card p-5 text-center">
        <div class="text-2xl font-black text-blue-600">{{ $stats['total'] }}</div>
        <div class="text-sm text-gray-500 mt-1">Total Order</div>
    </div>
    <div class="card p-5 text-center">
        <div class="text-2xl font-black text-yellow-600">{{ $stats['on_hold'] }}</div>
        <div class="text-sm text-gray-500 mt-1">On Hold</div>
    </div>
    <div class="card p-5 text-center">
        <div class="text-2xl font-black text-blue-600">{{ $stats['process'] }}</div>
        <div class="text-sm text-gray-500 mt-1">Diproses</div>
    </div>
    <div class="card p-5 text-center">
        <div class="text-2xl font-black text-green-600">{{ $stats['done'] }}</div>
        <div class="text-sm text-gray-500 mt-1">Selesai</div>
    </div>
</div>

<!-- Quick Order Banner -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl p-8 mb-8 text-white relative overflow-hidden">
    <div class="absolute right-0 top-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="relative z-10">
        <h2 class="text-2xl font-black mb-2">Sepatu Butuh Dicuci? 👟</h2>
        <p class="text-blue-100 mb-6">Fast Clean, Deep Clean, atau Suede Treatment — kami siap membantu!</p>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('customer.orders.create') }}" class="bg-white text-blue-700 hover:bg-blue-50 font-bold py-3 px-6 rounded-xl transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                ➕ Pesan Sekarang
            </a>
            <a href="{{ route('customer.orders.index') }}" class="bg-white/10 border border-white/30 hover:bg-white/20 text-white font-semibold py-3 px-6 rounded-xl transition-all">
                Lihat Semua Pesanan
            </a>
        </div>
    </div>
</div>

<!-- Total Spent -->
<div class="card p-6 mb-8 flex items-center justify-between bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100">
    <div>
        <p class="text-sm text-gray-600">Total Pengeluaran Anda</p>
        <p class="text-3xl font-black text-green-700 mt-1">Rp {{ number_format($totalSpent, 0, ',', '.') }}</p>
        <p class="text-xs text-gray-500 mt-1">Dari seluruh order yang sudah lunas</p>
    </div>
    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center">
        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    </div>
</div>

<!-- Recent Orders -->
<div class="card p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="font-bold text-gray-900 text-lg">Pesanan Terbaru</h3>
        <a href="{{ route('customer.orders.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors">
            Lihat Semua →
        </a>
    </div>

    @forelse($recentOrders as $order)
    <div class="flex items-center justify-between py-4 border-b border-gray-50 last:border-0 hover:bg-gray-50 -mx-2 px-2 rounded-xl transition-colors">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl
                @if($order->service_type === 'fast_clean') bg-blue-100
                @elseif($order->service_type === 'deep_clean') bg-indigo-100
                @else bg-purple-100 @endif">
                @if($order->service_type === 'fast_clean') ⚡
                @elseif($order->service_type === 'deep_clean') 🧼
                @else ✨ @endif
            </div>
            <div>
                <p class="font-semibold text-gray-900 text-sm">{{ $order->order_number }}</p>
                <p class="text-xs text-gray-500">{{ $order->service_label }} · {{ $order->shoe_quantity }} pasang</p>
                <p class="text-xs text-gray-400">{{ $order->created_at->format('d M Y') }}</p>
            </div>
        </div>
        <div class="text-right">
            <p class="font-bold text-gray-900 text-sm">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
            <span class="{{ $order->status_badge_class }} mt-1 inline-block">{{ $order->status_label }}</span>
        </div>
    </div>
    @empty
    <div class="text-center py-12">
        <div class="text-6xl mb-4">👟</div>
        <h3 class="font-bold text-gray-900 mb-2">Belum ada pesanan</h3>
        <p class="text-gray-500 text-sm mb-6">Yuk mulai cuci sepatu pertama Anda!</p>
        <a href="{{ route('customer.orders.create') }}" class="btn-primary inline-block">
            Pesan Sekarang
        </a>
    </div>
    @endforelse
</div>
@endsection
