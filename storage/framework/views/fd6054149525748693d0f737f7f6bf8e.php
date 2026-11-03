<?php $__env->startSection('title', 'Kelola Pesanan'); ?>
<?php $__env->startSection('page-title', 'Kelola Pesanan'); ?>
<?php $__env->startSection('page-subtitle', 'Semua pesanan masuk'); ?>

<?php $__env->startSection('content'); ?>
<!-- Filter Bar -->
<div class="card p-4 mb-6">
    <form method="GET" class="flex flex-wrap gap-3 items-end">
        <div class="flex-1 min-w-48">
            <label class="label text-xs">Cari Pesanan</label>
            <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                class="input-field py-2 text-sm" placeholder="No. pesanan, nama pelanggan...">
        </div>
        <div>
            <label class="label text-xs">Status</label>
            <select name="status" class="input-field py-2 text-sm">
                <option value="">Semua Status</option>
                <option value="on_hold" <?php echo e(request('status') === 'on_hold' ? 'selected' : ''); ?>>On Hold</option>
                <option value="process" <?php echo e(request('status') === 'process' ? 'selected' : ''); ?>>Proses</option>
                <option value="done" <?php echo e(request('status') === 'done' ? 'selected' : ''); ?>>Selesai</option>
                <option value="cancelled" <?php echo e(request('status') === 'cancelled' ? 'selected' : ''); ?>>Dibatalkan</option>
            </select>
        </div>
        <div>
            <label class="label text-xs">Layanan</label>
            <select name="service" class="input-field py-2 text-sm">
                <option value="">Semua Layanan</option>
                <option value="fast_clean" <?php echo e(request('service') === 'fast_clean' ? 'selected' : ''); ?>>Fast Clean</option>
                <option value="deep_clean" <?php echo e(request('service') === 'deep_clean' ? 'selected' : ''); ?>>Deep Clean</option>
                <option value="suede_treatment" <?php echo e(request('service') === 'suede_treatment' ? 'selected' : ''); ?>>Suede Treatment</option>
            </select>
        </div>
        <button type="submit" class="btn-primary py-2 px-4 text-sm">
            Filter
        </button>
        <?php if(request()->hasAny(['search', 'status', 'service'])): ?>
            <a href="<?php echo e(route('admin.orders.index')); ?>" class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold py-2 px-4 rounded-xl text-sm transition-colors">
                Reset
            </a>
        <?php endif; ?>
    </form>
</div>

<!-- Orders Table -->
<div class="card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-4 px-4">No. Pesanan</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-4 px-4">Pelanggan</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-4 px-4">Layanan</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-4 px-4">Total</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-4 px-4">Pembayaran</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-4 px-4">Status</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-4 px-4">Tanggal</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-4 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-blue-50/30 transition-colors">
                    <td class="py-4 px-4">
                        <span class="font-mono text-sm font-bold text-blue-700"><?php echo e($order->order_number); ?></span>
                        <?php if($order->is_pickup): ?>
                            <div class="text-xs text-orange-500 font-medium mt-0.5">🚗 Pickup</div>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-4">
                        <div class="font-medium text-gray-900 text-sm"><?php echo e($order->user->name); ?></div>
                        <div class="text-xs text-gray-500"><?php echo e($order->user->phone); ?></div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-sm font-medium text-gray-900"><?php echo e($order->service_label); ?></div>
                        <div class="text-xs text-gray-500"><?php echo e($order->shoe_quantity); ?> pasang
                            <?php if($order->shoe_brand): ?>• <?php echo e($order->shoe_brand); ?><?php endif; ?>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="font-bold text-gray-900 text-sm">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></div>
                        <div class="text-xs text-gray-500"><?php echo e($order->payment_method_label); ?></div>
                    </td>
                    <td class="py-4 px-4">
                        <?php if($order->payment_status === 'paid'): ?>
                            <span class="badge-done">Lunas</span>
                        <?php elseif($order->payment_status === 'pending'): ?>
                            <span class="badge-onhold">Pending</span>
                        <?php else: ?>
                            <span class="badge-cancelled">Gagal</span>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-4">
                        <span class="<?php echo e($order->status_badge_class); ?>"><?php echo e($order->status_label); ?></span>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-xs text-gray-500"><?php echo e($order->created_at->format('d/m/Y')); ?></div>
                        <div class="text-xs text-gray-400"><?php echo e($order->created_at->format('H:i')); ?></div>
                    </td>
                    <td class="py-4 px-4">
                        <a href="<?php echo e(route('admin.orders.show', $order)); ?>"
                           class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold py-1.5 px-3 rounded-lg transition-colors">
                            Detail
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="py-16 text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <p class="text-gray-400 font-medium">Tidak ada pesanan ditemukan</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($orders->hasPages()): ?>
    <div class="px-6 py-4 border-t border-gray-100">
        <?php echo e($orders->appends(request()->query())->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ray/Documents/Project/dr-sepatu/resources/views/admin/orders/index.blade.php ENDPATH**/ ?>