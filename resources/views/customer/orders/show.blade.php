@extends('layouts.customer')
@section('title', 'Detail Pesanan ' . $order->order_number)
@section('page-title', 'Detail Pesanan')
@section('page-subtitle', 'Informasi lengkap status pesanan #' . $order->order_number)

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('customer.orders.index') }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-blue-600 font-semibold text-xs mb-6 transition-colors group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        <span>Kembali ke Daftar Pesanan</span>
    </a>

    <!-- Status Header Banner -->
    <div class="card p-6 sm:p-8 mb-6 text-center text-white relative overflow-hidden shadow-lg
        @if($order->status === 'done') bg-gradient-to-br from-emerald-600 to-teal-700
        @elseif($order->status === 'process') bg-gradient-to-br from-blue-600 to-indigo-700
        @elseif($order->status === 'cancelled') bg-gradient-to-br from-rose-600 to-slate-800
        @else bg-gradient-to-br from-amber-600 to-orange-700 @endif">
        
        <div class="text-5xl mb-3">
            @if($order->status === 'on_hold') 🕐
            @elseif($order->status === 'process') ⚙️
            @elseif($order->status === 'done') 🎉
            @else ❌ @endif
        </div>

        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-white/20 backdrop-blur-md mb-2">
            Status: {{ $order->status_label }}
        </span>
        <h2 class="text-xl sm:text-2xl font-black tracking-tight">{{ $order->order_number }}</h2>
        
        <p class="text-white/90 text-xs sm:text-sm mt-2 max-w-md mx-auto leading-relaxed">
            @if($order->status === 'on_hold')
                Pesanan Anda telah diterima dan sedang menunggu giliran konfirmasi serta penjemputan oleh tim kami.
            @elseif($order->status === 'process')
                Sepatu Anda sedang dalam tahap pencucian mendalam. 
                @if($order->estimated_done_at)
                    <br><strong class="font-bold underline">Estimasi selesai: {{ $order->estimated_done_at->format('d F Y') }}</strong>
                @endif
            @elseif($order->status === 'done')
                Sepatu Anda telah selesai dicuci dan siap diambil atau sedang dalam perjalanan diantar kembali!
            @else
                Pesanan ini telah dibatalkan. Hubungi admin kami jika ada pertanyaan.
            @endif
        </p>
    </div>

    <!-- Stepper Tracker -->
    @if($order->status !== 'cancelled')
    <div class="card p-6 mb-6 border border-slate-200/80">
        <h3 class="font-extrabold text-slate-900 text-sm mb-6 pb-2 border-b border-slate-100 flex items-center justify-between">
            <span>Pelacakan Pesanan</span>
            <span class="text-xs font-semibold text-blue-600">Real-time update</span>
        </h3>
        
        <div class="grid grid-cols-3 gap-2 text-center relative">
            <!-- Step 1: On Hold -->
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold mb-2 shadow-xs
                    {{ in_array($order->status, ['on_hold', 'process', 'done']) ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-400' }}">
                    ✓
                </div>
                <span class="text-xs font-bold text-slate-800">Diterima</span>
                <span class="text-[10px] text-slate-400">Order masuk</span>
            </div>

            <!-- Step 2: Process -->
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold mb-2 shadow-xs
                    {{ in_array($order->status, ['process', 'done']) ? 'bg-blue-600 text-white' : ($order->status === 'on_hold' ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-400') }}">
                    @if(in_array($order->status, ['process', 'done'])) ✓ @else 2 @endif
                </div>
                <span class="text-xs font-bold text-slate-800">Pencucian</span>
                <span class="text-[10px] text-slate-400">Treatment ahli</span>
            </div>

            <!-- Step 3: Done -->
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold mb-2 shadow-xs
                    {{ $order->status === 'done' ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-400' }}">
                    @if($order->status === 'done') ✓ @else 3 @endif
                </div>
                <span class="text-xs font-bold text-slate-800">Selesai</span>
                <span class="text-[10px] text-slate-400">Siap digunakan</span>
            </div>
        </div>
    </div>
    @endif

    <!-- Order Details Card -->
    <div class="card p-6 sm:p-7 mb-6 border border-slate-200/80">
        <h3 class="font-extrabold text-slate-900 text-sm mb-4 pb-3 border-b border-slate-100">Rincian Transaksi</h3>
        
        <div class="space-y-3 text-xs sm:text-sm">
            <div class="flex justify-between items-center py-1.5 border-b border-slate-50">
                <span class="text-slate-500">Paket Layanan</span>
                <span class="font-bold text-slate-900">{{ $order->service_label }}</span>
            </div>
            <div class="flex justify-between items-center py-1.5 border-b border-slate-50">
                <span class="text-slate-500">Jumlah Pasang</span>
                <span class="font-bold text-slate-900">{{ $order->shoe_quantity }} pasang</span>
            </div>
            @if($order->shoe_brand)
            <div class="flex justify-between items-center py-1.5 border-b border-slate-50">
                <span class="text-slate-500">Merek Sepatu</span>
                <span class="font-bold text-slate-900">{{ $order->shoe_brand }}</span>
            </div>
            @endif
            @if($order->shoe_color)
            <div class="flex justify-between items-center py-1.5 border-b border-slate-50">
                <span class="text-slate-500">Warna Sepatu</span>
                <span class="font-bold text-slate-900">{{ $order->shoe_color }}</span>
            </div>
            @endif
            <div class="flex justify-between items-center py-1.5 border-b border-slate-50">
                <span class="text-slate-500">Metode Pengambilan</span>
                <span class="font-bold text-slate-900">{{ $order->is_pickup ? '🚗 Pickup Kurir' : '🚶 Antar ke Outlet' }}</span>
            </div>
            <div class="flex justify-between items-center py-1.5 border-b border-slate-50">
                <span class="text-slate-500">Metode Pembayaran</span>
                <span class="font-bold text-slate-900">{{ $order->payment_method_label }}</span>
            </div>
            <div class="flex justify-between items-center py-1.5 border-b border-slate-50">
                <span class="text-slate-500">Status Pembayaran</span>
                <span class="{{ $order->payment_status === 'paid' ? 'badge-done' : ($order->payment_status === 'pending' ? 'badge-onhold' : 'badge-cancelled') }}">
                    {{ $order->payment_status === 'paid' ? '● Lunas' : ($order->payment_status === 'pending' ? '○ Belum Bayar' : '✕ Gagal') }}
                </span>
            </div>
            <div class="flex justify-between items-center py-1.5 border-b border-slate-50">
                <span class="text-slate-500">Biaya Layanan Cuci</span>
                <span class="font-semibold text-slate-900">Rp {{ number_format($order->service_price, 0, ',', '.') }}</span>
            </div>
            @if($order->is_pickup && $order->pickup_fee > 0)
            <div class="flex justify-between items-center py-1.5 border-b border-slate-50">
                <span class="text-slate-500">Biaya Penjemputan</span>
                <span class="font-semibold text-amber-600">+ Rp {{ number_format($order->pickup_fee, 0, ',', '.') }}</span>
            </div>
            @endif
            <div class="flex justify-between items-baseline pt-3">
                <span class="font-bold text-slate-900 text-sm sm:text-base">Total Pembayaran</span>
                <span class="font-black text-blue-600 text-xl sm:text-2xl">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    @if($order->is_pickup && $order->pickup_address)
    <div class="card p-5 mb-6 border border-amber-200/80 bg-amber-50/40">
        <h4 class="font-bold text-slate-900 text-xs uppercase tracking-wider mb-1.5 text-amber-900 flex items-center gap-1.5">
            <span>📍</span> Alamat Penjemputan (Pickup)
        </h4>
        <p class="text-xs sm:text-sm text-slate-800 leading-relaxed">{{ $order->pickup_address }}</p>
    </div>
    @endif

    @if($order->notes)
    <div class="card p-5 mb-6 border border-slate-200/80">
        <h4 class="font-bold text-slate-700 text-xs uppercase tracking-wider mb-1.5 flex items-center gap-1.5">
            <span>📝</span> Catatan Anda
        </h4>
        <p class="text-xs sm:text-sm text-slate-700 leading-relaxed">{{ $order->notes }}</p>
    </div>
    @endif

    @if($order->admin_notes)
    <div class="card p-5 mb-6 border border-blue-200/80 bg-blue-50/50">
        <h4 class="font-bold text-blue-900 text-xs uppercase tracking-wider mb-1.5 flex items-center gap-1.5">
            <span>💬</span> Pesan dari Admin
        </h4>
        <p class="text-xs sm:text-sm text-blue-900 leading-relaxed">{{ $order->admin_notes }}</p>
    </div>
    @endif

    <!-- WhatsApp Support CTA -->
    <div class="card p-6 text-center border border-slate-200/80 bg-slate-50/80">
        <p class="text-xs text-slate-500 mb-3">Butuh bantuan atau ingin konfirmasi jadwal penjemputan?</p>
        <a href="https://wa.me/6281234567890?text=Halo%20Dr.%20Sepatu,%20saya%20ingin%20menanyakan%20status%20pesanan%20nomor%20{{ $order->order_number }}"
           target="_blank"
           class="inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-bold py-2.5 px-6 rounded-xl text-xs transition-all shadow-sm shadow-emerald-500/20">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            Chat WhatsApp Customer Care
        </a>
    </div>
</div>
@endsection