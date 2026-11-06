@extends('layouts.customer')
@section('title', 'Dashboard Pelanggan')
@section('page-title', 'Dashboard Pelanggan')
@section('page-subtitle', 'Selamat datang kembali, ' . auth()->user()->name . '! 👋')

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
    <div class="card p-5 relative overflow-hidden">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Order</span>
            <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold">📦</div>
        </div>
        <div class="text-2xl sm:text-3xl font-black text-slate-900">{{ $stats['total'] }}</div>
        <div class="text-[11px] text-slate-400 mt-1">Semua pesanan Anda</div>
    </div>

    <div class="card p-5 relative overflow-hidden">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">On Hold</span>
            <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm font-bold">🕐</div>
        </div>
        <div class="text-2xl sm:text-3xl font-black text-amber-600">{{ $stats['on_hold'] }}</div>
        <div class="text-[11px] text-slate-400 mt-1">Menunggu antrean</div>
    </div>

    <div class="card p-5 relative overflow-hidden">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Diproses</span>
            <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold">🧼</div>
        </div>
        <div class="text-2xl sm:text-3xl font-black text-blue-600">{{ $stats['process'] }}</div>
        <div class="text-[11px] text-slate-400 mt-1">Sedang dicuci</div>
    </div>

    <div class="card p-5 relative overflow-hidden">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Selesai</span>
            <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm font-bold">✅</div>
        </div>
        <div class="text-2xl sm:text-3xl font-black text-emerald-600">{{ $stats['done'] }}</div>
        <div class="text-[11px] text-slate-400 mt-1">Siap pakai</div>
    </div>
</div>

<!-- Quick Action Banner -->
<div class="bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700 rounded-2xl p-6 sm:p-8 mb-8 text-white relative overflow-hidden shadow-lg shadow-blue-500/10">
    <div class="absolute right-0 top-0 w-80 h-80 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
    <div class="relative z-10 max-w-xl">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-white/15 backdrop-blur-md mb-3 border border-white/20">
            <span>✨</span> Treatment Khusus Hari Ini
        </span>
        <h2 class="text-xl sm:text-2xl font-black mb-2 tracking-tight">Sepatu Kotor Menumpuk? Serahkan Pada Kami!</h2>
        <p class="text-blue-100 text-xs sm:text-sm mb-6 leading-relaxed">
            Pesan sekarang dan nikmati layanan cuci sepatu profesional dengan chemical khusus yang aman untuk semua jenis material.
        </p>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('customer.orders.create') }}" class="bg-white text-blue-700 hover:bg-blue-50 font-bold py-2.5 px-6 rounded-xl transition-all shadow-md hover:shadow-lg text-xs sm:text-sm">
                ➕ Pesan Cuci Baru
            </a>
            <a href="{{ route('customer.orders.index') }}" class="bg-white/10 hover:bg-white/20 border border-white/25 text-white font-semibold py-2.5 px-5 rounded-xl transition-all text-xs sm:text-sm backdrop-blur-md">
                Riwayat Pesanan
            </a>
        </div>
    </div>
</div>

<!-- Total Spent & Summary -->
<div class="card p-6 mb-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-gradient-to-r from-emerald-50/60 via-white to-slate-50 border border-emerald-100/80">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Pengeluaran Anda</p>
            <p class="text-2xl sm:text-3xl font-black text-slate-900 mt-0.5">Rp {{ number_format($totalSpent, 0, ',', '.') }}</p>
            <p class="text-[11px] text-slate-400">Total akumulasi dari order berstatus lunas</p>
        </div>
    </div>
    <a href="{{ route('customer.orders.create') }}" class="btn-primary py-2 px-4 text-xs font-semibold self-end sm:self-center">
        Pesan Lagi
    </a>
</div>

<!-- Recent Orders List -->
<div class="card p-6">
    <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
        <div>
            <h3 class="font-extrabold text-slate-900 text-base sm:text-lg">Pesanan Terbaru</h3>
            <p class="text-xs text-slate-500">5 transaksi terakhir akun Anda</p>
        </div>
        <a href="{{ route('customer.orders.index') }}" class="text-blue-600 hover:text-blue-800 text-xs font-bold transition-colors">
            Lihat Semua →
        </a>
    </div>

    <div class="divide-y divide-slate-100">
        @forelse($recentOrders as $order)
        <div class="flex flex-col sm:flex-row sm:items-center justify-between py-4 gap-3 hover:bg-slate-50/70 -mx-3 px-3 rounded-xl transition-colors">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-xl flex-shrink-0
                    @if($order->service_type === 'fast_clean') bg-blue-50 text-blue-600
                    @elseif($order->service_type === 'deep_clean') bg-indigo-50 text-indigo-600
                    @else bg-purple-50 text-purple-600 @endif">
                    @if($order->service_type === 'fast_clean') ⚡
                    @elseif($order->service_type === 'deep_clean') 🧼
                    @else ✨ @endif
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="font-mono font-bold text-slate-900 text-xs sm:text-sm">{{ $order->order_number }}</span>
                        <span class="{{ $order->status_badge_class }} text-[10px]">{{ $order->status_label }}</span>
                    </div>
                    <p class="text-xs text-slate-600 font-medium mt-0.5">{{ $order->service_label }} · {{ $order->shoe_quantity }} pasang</p>
                    <p class="text-[11px] text-slate-400">{{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                </div>
            </div>

            <div class="flex items-center justify-between sm:justify-end gap-4 border-t sm:border-t-0 pt-2 sm:pt-0 border-slate-100">
                <div class="text-left sm:text-right">
                    <p class="font-black text-slate-900 text-sm">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    <span class="text-[10px] {{ $order->payment_status === 'paid' ? 'text-emerald-600 font-bold' : 'text-amber-600 font-bold' }}">
                        {{ $order->payment_status === 'paid' ? '● Lunas' : '○ Belum Bayar' }}
                    </span>
                </div>
                <a href="{{ route('customer.orders.show', $order) }}"
                   class="btn-secondary py-1.5 px-3 text-xs font-semibold hover:border-blue-400">
                    Detail
                </a>
            </div>
        </div>
        @empty
        <div class="text-center py-12">
            <div class="text-5xl mb-3">👟</div>
            <h3 class="font-bold text-slate-900 text-base mb-1">Belum Ada Pesanan</h3>
            <p class="text-slate-500 text-xs mb-5">Sepatu kotor? Yuk order cuci sepatu pertama Anda sekarang!</p>
            <a href="{{ route('customer.orders.create') }}" class="btn-primary py-2.5 px-5 text-xs font-bold">
                Mulai Pesan Sekarang
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
