@extends('layouts.admin')
@section('title', 'Detail Pesanan #' . $order->order_number)
@section('page-title', 'Detail Pesanan')
@section('page-subtitle', 'Manajemen pesanan #' . $order->order_number)

@section('content')
<div class="max-w-5xl mx-auto">
    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-blue-600 font-semibold text-xs mb-6 transition-colors group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        <span>Kembali ke Daftar Pesanan</span>
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Info Card -->
            <div class="card p-6 sm:p-7 border border-slate-200/80">
                <div class="flex items-start justify-between mb-6 pb-4 border-b border-slate-100">
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="text-xl font-black text-slate-900 tracking-tight">{{ $order->order_number }}</h2>
                        </div>
                        <p class="text-xs text-slate-400 mt-1">Dipesan pada {{ $order->created_at->format('d F Y, H:i') }} WIB</p>
                    </div>
                    <div class="flex flex-col items-end gap-1.5">
                        <span class="{{ $order->status_badge_class }}">{{ $order->status_label }}</span>
                        @if($order->payment_status === 'paid')
                            <span class="badge-done text-[10px]">● Lunas</span>
                        @elseif($order->payment_status === 'pending')
                            <span class="badge-onhold text-[10px]">○ Belum Bayar</span>
                        @else
                            <span class="badge-cancelled text-[10px]">✕ Gagal</span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 sm:gap-6 mb-6">
                    <div class="p-4 bg-slate-50/70 rounded-xl border border-slate-100">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Paket Layanan</p>
                        <p class="font-extrabold text-slate-900 text-base">{{ $order->service_label }}</p>
                    </div>
                    <div class="p-4 bg-slate-50/70 rounded-xl border border-slate-100">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Jumlah Pasang</p>
                        <p class="font-extrabold text-slate-900 text-base">{{ $order->shoe_quantity }} Pasang</p>
                    </div>
                    @if($order->shoe_brand)
                    <div class="p-4 bg-slate-50/70 rounded-xl border border-slate-100">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Merek Sepatu</p>
                        <p class="font-bold text-slate-900 text-sm">{{ $order->shoe_brand }}</p>
                    </div>
                    @endif
                    @if($order->shoe_color)
                    <div class="p-4 bg-slate-50/70 rounded-xl border border-slate-100">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Warna Sepatu</p>
                        <p class="font-bold text-slate-900 text-sm">{{ $order->shoe_color }}</p>
                    </div>
                    @endif
                </div>

                <!-- Price Breakdown -->
                <div class="p-5 bg-slate-900 text-white rounded-2xl mb-6">
                    <h4 class="font-bold text-xs uppercase tracking-wider text-slate-400 mb-3">Rincian Finansial</h4>
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between text-slate-300">
                            <span>Biaya Paket ({{ $order->shoe_quantity }} pasang)</span>
                            <span class="font-bold text-white">Rp {{ number_format($order->service_price, 0, ',', '.') }}</span>
                        </div>
                        @if($order->is_pickup)
                        <div class="flex justify-between text-slate-300">
                            <span>Biaya Pickup</span>
                            <span class="font-bold text-amber-400">+ Rp {{ number_format($order->pickup_fee, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between pt-3 border-t border-slate-800 text-sm">
                            <span class="font-bold text-white">Total Tagihan</span>
                            <span class="font-black text-blue-400 text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 text-xs">
                    <div class="p-3.5 bg-blue-50/60 rounded-xl border border-blue-100/60">
                        <p class="text-[10px] font-semibold text-slate-400 mb-0.5 uppercase tracking-wider">Metode Pembayaran</p>
                        <p class="font-bold text-blue-900">{{ $order->payment_method_label }}</p>
                    </div>
                    <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-100">
                        <p class="text-[10px] font-semibold text-slate-400 mb-0.5 uppercase tracking-wider">Metode Pengambilan</p>
                        <p class="font-bold text-slate-800">{{ $order->is_pickup ? '🚗 Pickup Kurir' : '🚶 Drop ke Toko' }}</p>
                    </div>
                </div>

                @if($order->is_pickup && $order->pickup_address)
                <div class="mt-4 p-4 bg-amber-50/60 border border-amber-200/80 rounded-xl">
                    <p class="text-[10px] font-bold text-amber-800 uppercase tracking-wider mb-1">📍 Alamat Lengkap Pickup</p>
                    <p class="text-xs text-amber-950 leading-relaxed">{{ $order->pickup_address }}</p>
                </div>
                @endif

                @if($order->notes)
                <div class="mt-4 p-4 bg-slate-50 rounded-xl border border-slate-100">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">📝 Catatan Pelanggan</p>
                    <p class="text-xs text-slate-700 leading-relaxed">{{ $order->notes }}</p>
                </div>
                @endif

                @if($order->estimated_done_at)
                <div class="mt-4 p-3.5 bg-blue-50 rounded-xl border border-blue-200/70 text-xs text-blue-900 flex items-center justify-between">
                    <span class="font-medium">Target Estimasi Selesai:</span>
                    <span class="font-bold">{{ $order->estimated_done_at->format('d F Y') }}</span>
                </div>
                @endif
            </div>

            @if($order->admin_notes)
            <div class="card p-5 border border-blue-200/80 bg-blue-50/40">
                <h4 class="font-bold text-blue-900 text-xs uppercase tracking-wider mb-1.5">Catatan Admin Saat Ini</h4>
                <p class="text-xs text-blue-950 leading-relaxed">{{ $order->admin_notes }}</p>
            </div>
            @endif
        </div>

        <!-- Sidebar Actions -->
        <div class="space-y-6">
            <!-- Customer Card -->
            <div class="card p-6 border border-slate-200/80">
                <h3 class="font-extrabold text-slate-900 text-sm mb-4 pb-2 border-b border-slate-100">Info Pelanggan</h3>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xs shadow-xs">
                        {{ strtoupper(substr($order->user->name, 0, 2)) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="font-bold text-slate-900 text-sm truncate">{{ $order->user->name }}</p>
                        <p class="text-[11px] text-slate-400 truncate">{{ $order->user->email }}</p>
                    </div>
                </div>
                <div class="space-y-2 text-xs">
                    <div class="flex items-center gap-2 text-slate-600">
                        <span>📱 WhatsApp:</span>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->user->phone) }}" target="_blank" class="font-bold text-blue-600 hover:underline">
                            {{ $order->user->phone ?? 'Tidak ada' }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Update Order Status Form -->
            <div class="card p-6 border border-slate-200/80">
                <h3 class="font-extrabold text-slate-900 text-sm mb-4 pb-2 border-b border-slate-100">Update Status Pesanan</h3>
                <form method="POST" action="{{ route('admin.orders.update-status', $order) }}">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-4">
                        <div>
                            <label class="label">Status Baru</label>
                            <select name="status" class="input-field py-2 text-xs" required>
                                <option value="on_hold" {{ $order->status === 'on_hold' ? 'selected' : '' }}>🕐 On Hold (Antrean)</option>
                                <option value="process" {{ $order->status === 'process' ? 'selected' : '' }}>⚙️ Proses Pencucian</option>
                                <option value="done" {{ $order->status === 'done' ? 'selected' : '' }}>✅ Selesai Dicuci</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>❌ Dibatalkan</option>
                            </select>
                        </div>
                        <div>
                            <label class="label">Catatan Admin (Tampil ke Customer)</label>
                            <textarea name="admin_notes" rows="3" class="input-field py-2 text-xs" placeholder="Contoh: Sepatu telah dijemput kurir...">{{ $order->admin_notes }}</textarea>
                        </div>
                        <button type="submit" class="btn-primary w-full text-xs py-2.5 font-bold">
                            Simpan Perubahan Status
                        </button>
                    </div>
                </form>
            </div>

            <!-- Update Payment Status Form -->
            <div class="card p-6 border border-slate-200/80">
                <h3 class="font-extrabold text-slate-900 text-sm mb-4 pb-2 border-b border-slate-100">Update Status Pembayaran</h3>
                <form method="POST" action="{{ route('admin.orders.update-payment', $order) }}">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-3">
                        <select name="payment_status" class="input-field py-2 text-xs">
                            <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>⏳ Belum Bayar (Pending)</option>
                            <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>✅ Lunas (Paid)</option>
                            <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>✕ Gagal / Ditolak (Failed)</option>
                        </select>
                        <button type="submit" class="btn-success w-full text-xs py-2.5 font-bold">
                            Perbarui Status Pembayaran
                        </button>
                    </div>
                </form>
            </div>

            <!-- Delete Order Form -->
            <form method="POST" action="{{ route('admin.orders.destroy', $order) }}"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan #{{ $order->order_number }}? Tindakan ini tidak dapat dibatalkan.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger w-full text-xs py-2 font-semibold">
                    Hapus Pesanan Ini
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
