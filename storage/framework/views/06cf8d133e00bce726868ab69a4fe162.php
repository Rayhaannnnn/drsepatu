<?php $__env->startSection('title', 'Pesanan Saya'); ?>
<?php $__env->startSection('page-title', 'Pesanan Saya'); ?>
<?php $__env->startSection('page-subtitle', 'Semua riwayat pesanan Anda'); ?>

<?php $__env->startSection('content'); ?>
<!-- Filter -->
<div class="flex flex-wrap gap-2 mb-6">
    <a href="<?php echo e(route('customer.orders.index')); ?>"
       class="px-4 py-2 rounded-xl text-sm font-semibold transition-colors <?php echo e(!request('status') ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200'); ?>">
        Semua
    </a>
    <?php $__currentLoopData = ['on_hold' => 'On Hold', 'process' => 'Diproses', 'done' => 'Selesai', 'cancelled' => 'Dibatalkan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(route('customer.orders.index', ['status' => $val])); ?>"
       class="px-4 py-2 rounded-xl text-sm font-semibold transition-colors <?php echo e(request('status') === $val ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200'); ?>">
        <?php echo e($label); ?>

    </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="space-y-4">
    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="card p-6 hover:shadow-lg transition-all duration-300">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl flex-shrink-0
                    <?php if($order->service_type === 'fast_clean'): ?> bg-blue-100
                    <?php elseif($order->service_type === 'deep_clean'): ?> bg-indigo-100
                    <?php else: ?> bg-purple-100 <?php endif; ?>">
                    <?php if($order->service_type === 'fast_clean'): ?> ⚡
                    <?php elseif($order->service_type === 'deep_clean'): ?> 🧼
                    <?php else: ?> ✨ <?php endif; ?>
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="font-mono font-bold text-blue-700 text-sm"><?php echo e($order->order_number); ?></span>
                        <span class="<?php echo e($order->status_badge_class); ?>"><?php echo e($order->status_label); ?></span>
                        <?php if($order->payment_status === 'paid'): ?>
                            <span class="badge-done">Lunas</span>
                        <?php elseif($order->payment_status === 'pending'): ?>
                            <span class="badge-onhold">Belum Bayar</span>
                        <?php endif; ?>
                    </div>
                    <p class="font-semibold text-gray-900 mt-0.5"><?php echo e($order->service_label); ?> · <?php echo e($order->shoe_quantity); ?> pasang</p>
                    <div class="flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-500 mt-1">
                        <span><?php echo e($order->created_at->format('d M Y')); ?></span>
                        <?php if($order->is_pickup): ?>
                            <span class="text-orange-500">🚗 Pickup</span>
                        <?php else: ?>
                            <span>🚶 Antar Sendiri</span>
                        <?php endif; ?>
                        <span><?php echo e($order->payment_method_label); ?></span>
                        <?php if($order->shoe_brand): ?>
                            <span><?php echo e($order->shoe_brand); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="font-black text-gray-900 text-lg">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></p>
                    <?php if($order->estimated_done_at && in_array($order->status, ['on_hold', 'process'])): ?>
                        <p class="text-xs text-gray-500">Est: <?php echo e($order->estimated_done_at->format('d M Y')); ?></p>
                    <?php endif; ?>
                </div>
                <a href="<?php echo e(route('customer.orders.show', $order)); ?>"
                   class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded-xl transition-colors whitespace-nowrap">
                    Detail
                </a>
            </div>
        </div>

        <!-- Progress bar for active orders -->
        <?php if(in_array($order->status, ['on_hold', 'process'])): ?>
        <div class="mt-4 pt-4 border-t border-gray-100">
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                <span>Progress Pesanan:</span>
                <span class="font-semibold text-blue-600"><?php echo e($order->status === 'on_hold' ? '33%' : '66%'); ?></span>
            </div>
            <div class="flex items-center gap-2">
                <div class="flex-1 bg-gray-100 rounded-full h-2">
                    <div class="bg-blue-500 h-2 rounded-full transition-all duration-500"
                         style="width: <?php echo e($order->status === 'on_hold' ? '33' : '66'); ?>%"></div>
                </div>
            </div>
            <div class="flex justify-between text-xs text-gray-400 mt-1">
                <span class="<?php echo e($order->status === 'on_hold' ? 'text-blue-600 font-semibold' : 'text-green-600 font-semibold'); ?>">Diterima</span>
                <span class="<?php echo e($order->status === 'process' ? 'text-blue-600 font-semibold' : ''); ?>">Proses</span>
                <span>Selesai</span>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="card p-16 text-center">
        <div class="text-6xl mb-4">👟</div>
        <h3 class="font-bold text-gray-900 text-xl mb-2">Belum Ada Pesanan</h3>
        <p class="text-gray-500 mb-6">Yuk mulai pesan layanan cuci sepatu Dr. Sepatu!</p>
        <a href="<?php echo e(route('customer.orders.create')); ?>" class="btn-primary inline-block">
            Pesan Sekarang
        </a>
    </div>
    <?php endif; ?>
</div>

<?php if($orders->hasPages()): ?>
<div class="mt-6">
    <?php echo e($orders->links()); ?>

</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ray/Documents/Project/dr-sepatu/resources/views/customer/orders/index.blade.php ENDPATH**/ ?>