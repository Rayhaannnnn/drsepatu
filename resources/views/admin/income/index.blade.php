@extends('layouts.admin')
@section('title', 'Laporan Pemasukan')
@section('page-title', 'Laporan Pemasukan Bisnis')
@section('page-subtitle', 'Analisis pendapatan, distribusi layanan, dan metode pembayaran')

@section('content')
<!-- Filter Bar -->
<div class="card p-4 sm:p-5 mb-6 border border-slate-200/80">
    <form method="GET" class="flex flex-wrap gap-3 items-end">
        <div>
            <label class="label text-[11px]">Rentang Waktu</label>
            <select name="period" id="periodSelect" onchange="this.form.submit()" class="input-field py-2 text-xs">
                <option value="day" {{ $period === 'day' ? 'selected' : '' }}>Hari Ini</option>
                <option value="month" {{ $period === 'month' ? 'selected' : '' }}>Bulanan</option>
                <option value="year" {{ $period === 'year' ? 'selected' : '' }}>Tahunan</option>
            </select>
        </div>
        @if($period === 'month')
        <div>
            <label class="label text-[11px]">Bulan</label>
            <select name="month" class="input-field py-2 text-xs">
                @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $i => $m)
                    <option value="{{ $i+1 }}" {{ $month == $i+1 ? 'selected' : '' }}>{{ $m }}</option>
                @endforeach
            </select>
        </div>
        @endif
        @if(in_array($period, ['month', 'year']))
        <div>
            <label class="label text-[11px]">Tahun</label>
            <select name="year" class="input-field py-2 text-xs">
                @for($y = date('Y'); $y >= date('Y')-3; $y--)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <button type="submit" class="btn-primary py-2 px-4 text-xs font-bold">
            Tampilkan Data
        </button>
        @endif
    </form>
</div>

<!-- Financial Summary Cards -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-8">
    <div class="stat-card bg-gradient-to-br from-blue-700 to-indigo-800 text-white shadow-md">
        <div class="text-blue-200 text-xs font-bold uppercase tracking-wider mb-2">Pemasukan Periode Ini</div>
        <div class="text-2xl sm:text-3xl font-black">Rp {{ number_format($totalIncome, 0, ',', '.') }}</div>
        <div class="text-blue-200/90 text-xs mt-2 flex items-center gap-1.5">
            <span>●</span>
            <span>{{ $period === 'day' ? 'Pendapatan Hari Ini' : ($period === 'month' ? 'Bulan ' . $month . '/' . $year : 'Tahun ' . $year) }}</span>
        </div>
    </div>

    <div class="stat-card border border-slate-200/80">
        <div class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Total Pendapatan All-Time</div>
        <div class="text-2xl sm:text-3xl font-black text-slate-900">Rp {{ number_format($totalAllTime, 0, ',', '.') }}</div>
        <div class="text-slate-400 text-xs mt-2">Seluruh transaksi lunas sejak beroperasi</div>
    </div>

    <div class="stat-card border border-slate-200/80">
        <div class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Total Transaksi Lunas</div>
        <div class="text-2xl sm:text-3xl font-black text-slate-900">{{ $totalOrdersPaid }} <span class="text-base font-normal text-slate-400">Order</span></div>
        <div class="text-emerald-600 text-xs font-semibold mt-2">Tingkat keberhasilan pembayaran 100%</div>
    </div>
</div>

<!-- Chart & Service Breakdown -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
    <!-- Chart -->
    @if($period !== 'day' && !empty($chartLabels))
    <div class="xl:col-span-2 card p-6 border border-slate-200/80">
        <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
            <div>
                <h3 class="font-extrabold text-slate-900 text-base sm:text-lg">
                    Grafik Pemasukan ({{ $period === 'month' ? 'Harian' : 'Bulanan' }})
                </h3>
                <p class="text-xs text-slate-400">Fluktuasi pendapatan pada periode terpilih</p>
            </div>
        </div>
        <div class="h-68">
            <canvas id="incomeChart"></canvas>
        </div>
    </div>
    @endif

    <!-- Service Breakdown -->
    <div class="card p-6 border border-slate-200/80">
        <h3 class="font-extrabold text-slate-900 text-base mb-1">Performa Paket Layanan</h3>
        <p class="text-xs text-slate-400 mb-6">Distribusi berdasarkan paket yang dipilih</p>

        <div class="space-y-4">
            @forelse($serviceBreakdown as $sb)
            <div class="p-3 bg-slate-50/70 rounded-xl border border-slate-100">
                <div class="flex justify-between text-xs font-bold text-slate-800 mb-1">
                    <span>
                        @if($sb->service_type === 'fast_clean') ⚡ Fast Clean
                        @elseif($sb->service_type === 'deep_clean') 🧼 Deep Clean
                        @else ✨ Suede Treatment @endif
                    </span>
                    <span class="text-blue-600">{{ $sb->count }} Order</span>
                </div>
                <div class="text-xs font-black text-slate-900 mb-2">Rp {{ number_format($sb->total, 0, ',', '.') }}</div>
                <div class="w-full bg-slate-200/80 rounded-full h-1.5">
                    <div class="bg-blue-600 h-1.5 rounded-full"
                         style="width: {{ $totalOrdersPaid > 0 ? ($sb->count / $totalOrdersPaid * 100) : 0 }}%"></div>
                </div>
            </div>
            @empty
            <p class="text-slate-400 text-xs text-center py-6">Belum ada data transaksi lunas pada periode ini</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Payment Method Breakdown -->
<div class="card p-6 mb-8 border border-slate-200/80">
    <h3 class="font-extrabold text-slate-900 text-base mb-1">Distribusi Metode Pembayaran</h3>
    <p class="text-xs text-slate-400 mb-5">Metode yang paling sering digunakan customer</p>

    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-3">
        @foreach([
            ['method' => 'cash', 'label' => 'Cash', 'icon' => '💵'],
            ['method' => 'transfer_bca', 'label' => 'BCA', 'icon' => '🏦'],
            ['method' => 'transfer_mandiri', 'label' => 'Mandiri', 'icon' => '🏦'],
            ['method' => 'gopay', 'label' => 'GoPay', 'icon' => '🟢'],
            ['method' => 'ovo', 'label' => 'OVO', 'icon' => '🟣'],
            ['method' => 'dana', 'label' => 'DANA', 'icon' => '🔵'],
            ['method' => 'qris', 'label' => 'QRIS', 'icon' => '📲'],
        ] as $pm)
        @php $pmData = $paymentBreakdown->where('payment_method', $pm['method'])->first(); @endphp
        <div class="p-3.5 bg-slate-50/70 rounded-xl text-center border border-slate-100 hover:border-slate-200 transition-colors">
            <div class="text-xl mb-1">{{ $pm['icon'] }}</div>
            <div class="text-[11px] font-bold text-slate-700">{{ $pm['label'] }}</div>
            <div class="text-base font-black text-slate-900 mt-1">{{ $pmData?->count ?? 0 }}x</div>
            <div class="text-[10px] text-blue-600 font-semibold mt-0.5">Rp {{ number_format($pmData?->total ?? 0, 0, ',', '.') }}</div>
        </div>
        @endforeach
    </div>
</div>

<!-- Transaction Table -->
<div class="card border border-slate-200/80 overflow-hidden">
    <div class="p-5 border-b border-slate-100">
        <h3 class="font-extrabold text-slate-900 text-base">Rincian Transaksi Selesai</h3>
        <p class="text-xs text-slate-400">Daftar transaksi berstatus lunas</p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50/80 border-b border-slate-100">
                <tr>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">No. Pesanan</th>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">Pelanggan</th>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">Layanan</th>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">Pembayaran</th>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">Nominal</th>
                    <th class="text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider py-3.5 px-4">Waktu</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-xs">
                @forelse($orders as $order)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="py-3 px-4">
                        <a href="{{ route('admin.orders.show', $order) }}" class="font-mono font-bold text-blue-600 hover:underline">
                            {{ $order->order_number }}
                        </a>
                    </td>
                    <td class="py-3 px-4 font-semibold text-slate-800">{{ $order->user->name }}</td>
                    <td class="py-3 px-4 text-slate-600">{{ $order->service_label }} ({{ $order->shoe_quantity }} psg)</td>
                    <td class="py-3 px-4 text-slate-600">{{ $order->payment_method_label }}</td>
                    <td class="py-3 px-4 font-black text-emerald-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td class="py-3 px-4 text-slate-400 text-[11px]">{{ $order->created_at->format('d/m/Y H:i') }} WIB</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-12 text-center text-slate-400">Tidak ada riwayat transaksi pada periode ini</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@if($period !== 'day' && !empty($chartLabels))
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const labels = @json($chartLabels);
    const data = @json($chartData);
    window.initChart('incomeChart', labels, data);
});
</script>
@endpush
@endif
