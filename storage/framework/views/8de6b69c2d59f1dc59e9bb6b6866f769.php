<?php $__env->startSection('title', 'Detail Pesanan ' . $order->order_number); ?>
<?php $__env->startSection('page-title', 'Detail Pesanan'); ?>
<?php $__env->startSection('page-subtitle', $order->order_number); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl">
    <a href="<?php echo e(route('customer.orders.index')); ?>" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Daftar Pesanan
    </a>

    <!-- Status Card -->
    <div class="card p-8 mb-6 text-center bg-gradient-to-br from-blue-600 to-blue-800 text-white">
        <div class="text-5xl mb-4">
            <?php if($order->status === 'on_hold'): ?> 🕐
            <?php elseif($order->status === 'process'): ?> ⚙️
            <?php elseif($order->status === 'done'): ?> ✅
            <?php else: ?> ❌ <?php endif; ?>
        </div>
        <h2 class="text-2xl font-black mb-1"><?php echo e($order->status_label); ?></h2>
        <p class="text-blue-200 text-sm"><?php echo e($order->order_number); ?></p>
        
        <?php if($order->status === 'on_hold'): ?>
        <p class="text-blue-100 text-sm mt-3">Pesanan Anda sedang menunggu konfirmasi dari tim kami.</p>
        <?php elseif($order->status === 'process'): ?>
        <p class="text-blue-100 text-sm mt-3">Sepatu Anda sedang dalam proses pembersihan. 
            <?php if($order->estimated_done_at): ?>Estimasi selesai: <?php echo e($order->estimated_done_at->format('d F Y')); ?><?php endif; ?>
        </p>
        <?php elseif($order->status === 'done'): ?>
        <p class="text-blue-100 text-sm mt-3">Sepatu Anda sudah bersih dan siap diambil! 🎉</p>
        <?php endif; ?>
    </div>

    <!-- Progress -->
    <div class="card p-6 mb-6">
        <h3 class="font-bold text-gray-900 mb-4">Status Progress</h3>
        <div class="relative">
            <div class="flex items-center justify-between mb-2">
                <?php $__currentLoopData = ['On Hold', 'Proses', 'Selesai']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex flex-col items-center <?php echo e($i < 2 ? 'flex-1' : ''); ?>">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold mb-2
                        <?php if(($order->status === 'done' && $i <= 2) || ($order->status === 'process' && $i <= 1) || ($order->status === 'on_hold' && $i === 0)): ?>
                            bg-blue-600 text-white
                        <?php else: ?>
                            bg-gray-100 text-gray-400
                        <?php endif; ?>">
                        <?php if(($order->status === 'done') || ($order->status === 'process' && $i === 0) || ($order->status === 'on_hold' && $i === 0)): ?>
                            ✓
                        <?php else: ?>
                            <?php echo e($i + 1); ?>

                        <?php endif; ?>
                    </div>
                    <span class="text-xs font-medium <?php echo e($order->status === 'on_hold' && $i === 0 || $order->status === 'process' && $i <= 1 || $order->status === 'done' ? 'text-blue-600' : 'text-gray-400'); ?>"><?php echo e($step); ?></span>
                </div>
                <?php if($i < 2): ?>
                <div class="flex-1 h-0.5 <?php echo e(($order->status === 'process' && $i === 0) || $order->status === 'done' ? 'bg-blue-600' : 'bg-gray-200'); ?> -mt-6 mx-2"></div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <!-- Order Details -->
    <div class="card p-6 mb-6">
        <h3 class="font-bold text-gray-900 mb-6">Detail Pesanan</h3>
        <div class="space-y-4">
            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                <span class="text-gray-500">Layanan</span>
                <span class="font-semibold text-gray-900"><?php echo e($order->service_label); ?></span>
            </div>
            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                <span class="text-gray-500">Jumlah Pasang</span>
                <span class="font-semibold text-gray-900"><?php echo e($order->shoe_quantity); ?> pasang</span>
            </div>
            <?php if($order->shoe_brand): ?>
            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                <span class="text-gray-500">Merek Sepatu</span>
                <span class="font-semibold text-gray-900"><?php echo e($order->shoe_brand); ?></span>
            </div>
            <?php endif; ?>
            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                <span class="text-gray-500">Metode Pengambilan</span>
                <span class="font-semibold text-gray-900"><?php echo e($order->is_pickup ? '🚗 Pickup' : '🚶 Antar Sendiri'); ?></span>
            </div>
            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                <span class="text-gray-500">Metode Pembayaran</span>
                <span class="font-semibold text-gray-900"><?php echo e($order->payment_method_label); ?></span>
            </div>
            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                <span class="text-gray-500">Status Pembayaran</span>
                <span class="<?php echo e($order->payment_status === 'paid' ? 'badge-done' : ($order->payment_status === 'pending' ? 'badge-onhold' : 'badge-cancelled')); ?>">
                    <?php echo e($order->payment_status === 'paid' ? 'Lunas' : ($order->payment_status === 'pending' ? 'Belum Bayar' : 'Gagal')); ?>

                </span>
            </div>
            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                <span class="text-gray-500">Harga Layanan</span>
                <span class="font-semibold">Rp <?php echo e(number_format($order->service_price, 0, ',', '.')); ?></span>
            </div>
            <?php if($order->is_pickup && $order->pickup_fee > 0): ?>
            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                <span class="text-gray-500">Biaya Pickup</span>
                <span class="font-semibold text-orange-600">+ Rp <?php echo e(number_format($order->pickup_fee, 0, ',', '.')); ?></span>
            </div>
            <?php endif; ?>
            <div class="flex justify-between items-center py-3">
                <span class="font-bold text-gray-900 text-lg">Total</span>
                <span class="font-black text-blue-600 text-2xl">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></span>
            </div>
        </div>
    </div>

    <?php if($order->is_pickup && $order->pickup_address): ?>
    <div class="card p-6 mb-6">
        <h3 class="font-bold text-gray-900 mb-2">Alamat Pickup</h3>
        <p class="text-gray-700 bg-orange-50 p-4 rounded-xl text-sm"><?php echo e($order->pickup_address); ?></p>
    </div>
    <?php endif; ?>

    <?php if($order->notes): ?>
    <div class="card p-6 mb-6">
        <h3 class="font-bold text-gray-900 mb-2">Catatan Anda</h3>
        <p class="text-gray-700 bg-gray-50 p-4 rounded-xl text-sm"><?php echo e($order->notes); ?></p>
    </div>
    <?php endif; ?>

    <?php if($order->admin_notes): ?>
    <div class="card p-6 mb-6 border border-blue-200 bg-blue-50">
        <h3 class="font-bold text-blue-900 mb-2">💬 Pesan dari Admin</h3>
        <p class="text-blue-800 text-sm"><?php echo e($order->admin_notes); ?></p>
    </div>
    <?php endif; ?>

    <div class="card p-6 text-center bg-gray-50">
        <p class="text-gray-500 text-sm mb-3">Ada pertanyaan tentang pesanan ini?</p>
        <a href="https://wa.me/6281234567890?text=Halo%20Dr.%20Sepatu,%20saya%20ingin%20menanyakan%20pesanan%20<?php echo e($order->order_number); ?>"
           target="_blank"
           class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-xl transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
            Chat via WhatsApp
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ray/Documents/Project/dr-sepatu/resources/views/customer/orders/show.blade.php ENDPATH**/ ?>