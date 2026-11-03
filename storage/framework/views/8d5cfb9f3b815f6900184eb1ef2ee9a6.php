<?php $__env->startSection('title', 'Laporan Pemasukan'); ?>
<?php $__env->startSection('page-title', 'Laporan Pemasukan'); ?>
<?php $__env->startSection('page-subtitle', 'Tracking pemasukan bisnis Dr. Sepatu'); ?>

<?php $__env->startSection('content'); ?>
<!-- Filter -->
<div class="card p-4 mb-6">
    <form method="GET" class="flex flex-wrap gap-3 items-end">
        <div>
            <label class="label text-xs">Periode</label>
            <select name="period" id="periodSelect" onchange="this.form.submit()" class="input-field py-2 text-sm">
                <option value="day" <?php echo e($period === 'day' ? 'selected' : ''); ?>>Hari Ini</option>
                <option value="month" <?php echo e($period === 'month' ? 'selected' : ''); ?>>Bulanan</option>
                <option value="year" <?php echo e($period === 'year' ? 'selected' : ''); ?>>Tahunan</option>
            </select>
        </div>
        <?php if($period === 'month'): ?>
        <div>
            <label class="label text-xs">Bulan</label>
            <select name="month" class="input-field py-2 text-sm">
                <?php $__currentLoopData = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($i+1); ?>" <?php echo e($month == $i+1 ? 'selected' : ''); ?>><?php echo e($m); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <?php endif; ?>
        <?php if(in_array($period, ['month', 'year'])): ?>
        <div>
            <label class="label text-xs">Tahun</label>
            <select name="year" class="input-field py-2 text-sm">
                <?php for($y = date('Y'); $y >= date('Y')-3; $y--): ?>
                    <option value="<?php echo e($y); ?>" <?php echo e($year == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <button type="submit" class="btn-primary py-2 px-4 text-sm">Tampilkan</button>
        <?php endif; ?>
    </form>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
    <div class="stat-card bg-gradient-to-br from-blue-600 to-blue-800 text-white">
        <div class="text-blue-200 text-sm font-medium mb-2">Pemasukan Periode Ini</div>
        <div class="text-3xl font-black">Rp <?php echo e(number_format($totalIncome, 0, ',', '.')); ?></div>
        <div class="text-blue-300 text-xs mt-1"><?php echo e($period === 'day' ? 'Hari ini' : ($period === 'month' ? 'Bulan ini' : 'Tahun ini')); ?></div>
    </div>

    <div class="stat-card">
        <div class="text-gray-500 text-sm font-medium mb-2">Total Pemasukan All Time</div>
        <div class="text-2xl font-black text-gray-900">Rp <?php echo e(number_format($totalAllTime, 0, ',', '.')); ?></div>
        <div class="text-gray-400 text-xs mt-1">Sejak awal operasi</div>
    </div>

    <div class="stat-card">
        <div class="text-gray-500 text-sm font-medium mb-2">Total Order Lunas</div>
        <div class="text-2xl font-black text-gray-900"><?php echo e($totalOrdersPaid); ?></div>
        <div class="text-gray-400 text-xs mt-1">Transaksi berhasil</div>
    </div>
</div>

<!-- Chart & Breakdown -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
    <!-- Chart -->
    <?php if($period !== 'day' && !empty($chartLabels)): ?>
    <div class="xl:col-span-2 card p-6">
        <h3 class="font-bold text-gray-900 text-lg mb-4">
            Grafik Pemasukan <?php echo e($period === 'month' ? 'Per Hari' : 'Per Bulan'); ?>

        </h3>
        <div class="h-64">
            <canvas id="incomeChart"></canvas>
        </div>
    </div>
    <?php endif; ?>

    <!-- Service Breakdown -->
    <div class="card p-6">
        <h3 class="font-bold text-gray-900 text-lg mb-4">Breakdown Per Layanan</h3>
        <div class="space-y-4">
            <?php $__empty_1 = true; $__currentLoopData = $serviceBreakdown; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="font-medium text-gray-700">
                        <?php if($sb->service_type === 'fast_clean'): ?> ⚡ Fast Clean
                        <?php elseif($sb->service_type === 'deep_clean'): ?> 🧼 Deep Clean
                        <?php else: ?> ✨ Suede Treatment <?php endif; ?>
                    </span>
                    <span class="font-bold text-gray-900"><?php echo e($sb->count); ?>x</span>
                </div>
                <div class="text-xs text-blue-600 font-semibold mb-1">Rp <?php echo e(number_format($sb->total, 0, ',', '.')); ?></div>
                <div class="w-full bg-gray-100 rounded-full h-2">
                    <div class="bg-blue-500 h-2 rounded-full transition-all duration-500"
                         style="width: <?php echo e($totalOrdersPaid > 0 ? ($sb->count / $totalOrdersPaid * 100) : 0); ?>%"></div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-400 text-sm text-center py-4">Belum ada data</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Payment Method Breakdown -->
<div class="card p-6 mb-8">
    <h3 class="font-bold text-gray-900 text-lg mb-4">Breakdown Metode Pembayaran</h3>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <?php $__currentLoopData = [
            ['method' => 'cash', 'label' => 'Cash', 'icon' => '💵'],
            ['method' => 'transfer_bca', 'label' => 'BCA', 'icon' => '🏦'],
            ['method' => 'transfer_mandiri', 'label' => 'Mandiri', 'icon' => '🏦'],
            ['method' => 'gopay', 'label' => 'GoPay', 'icon' => '📱'],
            ['method' => 'ovo', 'label' => 'OVO', 'icon' => '📱'],
            ['method' => 'dana', 'label' => 'DANA', 'icon' => '📱'],
            ['method' => 'qris', 'label' => 'QRIS', 'icon' => '📲'],
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $pmData = $paymentBreakdown->where('payment_method', $pm['method'])->first(); ?>
        <div class="p-4 bg-gray-50 rounded-xl text-center border border-gray-100">
            <div class="text-2xl mb-1"><?php echo e($pm['icon']); ?></div>
            <div class="text-xs font-semibold text-gray-600"><?php echo e($pm['label']); ?></div>
            <div class="text-lg font-black text-gray-900"><?php echo e($pmData?->count ?? 0); ?></div>
            <div class="text-xs text-blue-600">Rp <?php echo e(number_format($pmData?->total ?? 0, 0, ',', '.')); ?></div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<!-- Transaction Table -->
<div class="card overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="font-bold text-gray-900 text-lg">Daftar Transaksi</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase py-3 px-4">No. Pesanan</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase py-3 px-4">Pelanggan</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase py-3 px-4">Layanan</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase py-3 px-4">Pembayaran</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase py-3 px-4">Total</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase py-3 px-4">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-blue-50/30 transition-colors">
                    <td class="py-3 px-4">
                        <a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="font-mono text-blue-600 hover:underline text-sm font-semibold"><?php echo e($order->order_number); ?></a>
                    </td>
                    <td class="py-3 px-4 text-sm text-gray-900"><?php echo e($order->user->name); ?></td>
                    <td class="py-3 px-4 text-sm text-gray-600"><?php echo e($order->service_label); ?></td>
                    <td class="py-3 px-4 text-sm text-gray-600"><?php echo e($order->payment_method_label); ?></td>
                    <td class="py-3 px-4 font-bold text-green-700 text-sm">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></td>
                    <td class="py-3 px-4 text-xs text-gray-500"><?php echo e($order->created_at->format('d/m/Y H:i')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="py-12 text-center text-gray-400">Tidak ada transaksi</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php if($period !== 'day' && !empty($chartLabels)): ?>
<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const labels = <?php echo json_encode($chartLabels, 15, 512) ?>;
    const data = <?php echo json_encode($chartData, 15, 512) ?>;
    window.initChart('incomeChart', labels, data);
});
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ray/Documents/Project/dr-sepatu/resources/views/admin/income/index.blade.php ENDPATH**/ ?>