@extends('layouts.admin')
@section('title', 'Detail Pesanan #' . $order->order_number)
@section('page-title', 'Detail Pesanan')
@section('page-subtitle', $order->order_number)

@section('content')
<div class="max-w-5xl">
    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium mb-6 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Daftar Pesanan
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Info Card -->
            <div class="card p-6">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-black text-gray-900">{{ $order->order_number }}</h2>
                        <p class="text-sm text-gray-500">{{ $order->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div class="flex flex-col items-end gap-2">
                        <span class="{{ $order->status_badge_class }} text-sm px-4 py-1.5">{{ $order->status_label }}</span>
                        @if($order->payment_status === 'paid')
                            <span class="badge-done">Lunas</span>
                        @elseif($order->payment_status === 'pending')
                            <span class="badge-onhold">Belum Bayar</span>
                        @else
                            <span class="badge-cancelled">Gagal</span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Layanan</p>
                        <p class="font-bold text-gray-900 text-lg">{{ $order->service_label }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Jumlah Pasang</p>
                        <p class="font-bold text-gray-900 text-lg">{{ $order->shoe_quantity }} pasang</p>
                    </div>
                    @if($order->shoe_brand)
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Merek Sepatu</p>
                        <p class="font-medium text-gray-900">{{ $order->shoe_brand }}</p>
                    </div>
                    @endif
                    @if($order->shoe_color)
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Warna Sepatu</p>
                        <p class="font-medium text-gray-900">{{ $order->shoe_color }}</p>
                    </div>
                    @endif
                </div>

                <!-- Pricing Breakdown -->
                <div class="mt-6 p-4 bg-gray-50 rounded-xl">
                    <h4 class="font-semibold text-gray-700 mb-3">Rincian Harga</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Biaya Layanan ({{ $order->shoe_quantity }} pasang)</span>
                            <span class="font-medium">Rp {{ number_format($order->service_price, 0, ',', '.') }}</span>
                        </div>
                        @if($order->is_pickup)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Biaya Pickup</span>
                            <span class="font-medium">Rp {{ number_format($order->pickup_fee, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between pt-2 border-t border-gray-200">
                            <span class="font-bold text-gray-900">Total</span>
                            <span class="font-black text-blue-600 text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
                    <div class="p-3 bg-blue-50 rounded-xl">
                        <p class="text-xs text-gray-500 mb-1">Metode Pembayaran</p>
                        <p class="font-semibold text-gray-900">{{ $order->payment_method_label }}</p>
                    </div>
                    <div class="p-3 bg-{{ $order->is_pickup ? 'orange' : 'green' }}-50 rounded-xl">
                        <p class="text-xs text-gray-500 mb-1">Metode Pengambilan</p>
                        <p class="font-semibold text-gray-900">{{ $order->is_pickup ? '🚗 Pickup' : '🚶 Antar Sendiri' }}</p>
                    </div>
                </div>

                @if($order->is_pickup && $order->pickup_address)
                <div class="mt-4 p-3 bg-orange-50 border border-orange-200 rounded-xl">
                    <p class="text-xs font-semibold text-orange-800 mb-1">Alamat Pickup</p>
                    <p class="text-sm text-orange-900">{{ $order->pickup_address }}</p>
                </div>
                @endif

                @if($order->notes)
                <div class="mt-4 p-3 bg-gray-50 rounded-xl">
                    <p class="text-xs font-semibold text-gray-600 mb-1">Catatan Customer</p>
                    <p class="text-sm text-gray-700">{{ $order->notes }}</p>
                </div>
                @endif

                @if($order->estimated_done_at)
                <div class="mt-4 p-3 bg-blue-50 rounded-xl">
                    <p class="text-xs font-semibold text-blue-700 mb-1">Estimasi Selesai</p>
                    <p class="text-sm font-medium text-blue-900">{{ $order->estimated_done_at->format('d F Y') }}</p>
                </div>
                @endif
            </div>

            <!-- Admin Notes & Status Update -->
            @if($order->admin_notes)
            <div class="card p-6">
                <h3 class="font-bold text-gray-900 mb-3">Catatan Admin</h3>
                <p class="text-gray-700 text-sm bg-blue-50 p-4 rounded-xl">{{ $order->admin_notes }}</p>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Customer Info -->
            <div class="card p-6">
                <h3 class="font-bold text-gray-900 mb-4">Info Pelanggan</h3>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr($order->user->name, 0, 2)) }}
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">{{ $order->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $order->user->email }}</p>
                    </div>
                </div>
                <div class="space-y-2 text-sm">
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        {{ $order->user->phone ?? 'Tidak ada' }}
                    </div>
                </div>
            </div>

            <!-- Update Status -->
            <div class="card p-6">
                <h3 class="font-bold text-gray-900 mb-4">Update Status Pesanan</h3>
                <form method="POST" action="{{ route('admin.orders.update-status', $order) }}">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-4">
                        <div>
                            <label class="label">Status Baru</label>
                            <select name="status" class="input-field text-sm py-2" required>
                                <option value="on_hold" {{ $order->status === 'on_hold' ? 'selected' : '' }}>🕐 On Hold</option>
                                <option value="process" {{ $order->status === 'process' ? 'selected' : '' }}>⚙️ Proses</option>
                                <option value="done" {{ $order->status === 'done' ? 'selected' : '' }}>✅ Selesai</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>❌ Dibatalkan</option>
                            </select>
                        </div>
                        <div>
                            <label class="label">Catatan Admin (opsional)</label>
                            <textarea name="admin_notes" rows="3" class="input-field text-sm py-2" placeholder="Tambahkan catatan...">{{ $order->admin_notes }}</textarea>
                        </div>
                        <button type="submit" class="btn-primary w-full text-sm py-2">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>

            <!-- Update Payment -->
            <div class="card p-6">
                <h3 class="font-bold text-gray-900 mb-4">Update Pembayaran</h3>
                <form method="POST" action="{{ route('admin.orders.update-payment', $order) }}">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-3">
                        <select name="payment_status" class="input-field text-sm py-2">
                            <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                            <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>✅ Lunas</option>
                            <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>❌ Gagal</option>
                        </select>
                        <button type="submit" class="btn-success w-full text-sm py-2">
                            Update Pembayaran
                        </button>
                    </div>
                </form>
            </div>

            <!-- Delete -->
            <form method="POST" action="{{ route('admin.orders.destroy', $order) }}"
                  onsubmit="return confirm('Hapus pesanan ini? Tindakan tidak bisa dibatalkan.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger w-full text-sm py-2">
                    🗑️ Hapus Pesanan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
