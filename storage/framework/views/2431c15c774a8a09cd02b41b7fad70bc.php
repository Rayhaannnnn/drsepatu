<?php $__env->startSection('title', 'Buat Pesanan Baru'); ?>
<?php $__env->startSection('page-title', 'Buat Pesanan Baru'); ?>
<?php $__env->startSection('page-subtitle', 'Pilih layanan dan lengkapi detail pesanan Anda'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl">

<?php if($errors->any()): ?>
<div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-4 rounded-xl">
    <p class="font-semibold mb-2">Harap perbaiki beberapa hal berikut:</p>
    <ul class="list-disc list-inside text-sm space-y-1">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('customer.orders.store')); ?>" id="orderForm">
    <?php echo csrf_field(); ?>

    <!-- STEP 1: Pilih Layanan -->
    <div class="card p-8 mb-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm">1</div>
            <h2 class="text-xl font-bold text-gray-900">Pilih Jenis Layanan</h2>
        </div>

        <input type="hidden" id="service_type" name="service_type" value="<?php echo e(old('service_type')); ?>">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Fast Clean -->
            <div data-service="fast_clean"
                 data-price="<?php echo e($services['fast_clean']->price_per_pair ?? 35000); ?>"
                 data-name="⚡ Fast Clean"
                 class="service-card cursor-pointer border-2 border-gray-200 hover:border-blue-400 hover:bg-blue-50 transition-all duration-200 rounded-2xl p-6 text-center <?php echo e(old('service_type') === 'fast_clean' ? 'border-blue-500 bg-blue-50' : ''); ?>">
                <div class="text-4xl mb-3">⚡</div>
                <h3 class="font-black text-gray-900 text-lg mb-1">Fast Clean</h3>
                <p class="text-xs text-gray-500 mb-3">Cuci cepat, bersih maksimal</p>
                <div class="text-2xl font-black text-blue-600">
                    Rp <?php echo e(number_format($services['fast_clean']->price_per_pair ?? 35000, 0, ',', '.')); ?>

                </div>
                <div class="text-xs text-gray-400 mb-4">/pasang</div>
                <ul class="text-xs text-gray-500 space-y-1 text-left">
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Cuci luar & dalam</li>
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Pengeringan angin</li>
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Selesai 1 hari</li>
                </ul>
                <div class="mt-4 py-1.5 px-3 bg-blue-100 text-blue-700 rounded-lg text-xs font-semibold">
                    Rp <?php echo e(number_format($services['fast_clean']->price_per_pair ?? 35000, 0, ',', '.')); ?>/pasang
                </div>
            </div>

            <!-- Deep Clean -->
            <div data-service="deep_clean"
                 data-price="<?php echo e($services['deep_clean']->price_per_pair ?? 65000); ?>"
                 data-name="🧼 Deep Clean"
                 class="service-card cursor-pointer border-2 border-gray-200 hover:border-blue-400 hover:bg-blue-50 transition-all duration-200 rounded-2xl p-6 text-center relative <?php echo e(old('service_type') === 'deep_clean' ? 'border-blue-500 bg-blue-50' : ''); ?>">
                <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                    🔥 Terlaris
                </div>
                <div class="text-4xl mb-3">🧼</div>
                <h3 class="font-black text-gray-900 text-lg mb-1">Deep Clean</h3>
                <p class="text-xs text-gray-500 mb-3">Pembersihan mendalam total</p>
                <div class="text-2xl font-black text-blue-600">
                    Rp <?php echo e(number_format($services['deep_clean']->price_per_pair ?? 65000, 0, ',', '.')); ?>

                </div>
                <div class="text-xs text-gray-400 mb-4">/pasang</div>
                <ul class="text-xs text-gray-500 space-y-1 text-left">
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Cuci dalam & luar</li>
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Whitening sol</li>
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Selesai 2-3 hari</li>
                </ul>
                <div class="mt-4 py-1.5 px-3 bg-blue-100 text-blue-700 rounded-lg text-xs font-semibold">
                    Rp <?php echo e(number_format($services['deep_clean']->price_per_pair ?? 65000, 0, ',', '.')); ?>/pasang
                </div>
            </div>

            <!-- Suede Treatment -->
            <div data-service="suede_treatment"
                 data-price="<?php echo e($services['suede_treatment']->price_per_pair ?? 95000); ?>"
                 data-name="✨ Suede Treatment"
                 class="service-card cursor-pointer border-2 border-gray-200 hover:border-blue-400 hover:bg-blue-50 transition-all duration-200 rounded-2xl p-6 text-center <?php echo e(old('service_type') === 'suede_treatment' ? 'border-blue-500 bg-blue-50' : ''); ?>">
                <div class="text-4xl mb-3">✨</div>
                <h3 class="font-black text-gray-900 text-lg mb-1">Suede Treatment</h3>
                <p class="text-xs text-gray-500 mb-3">Perawatan material premium</p>
                <div class="text-2xl font-black text-blue-600">
                    Rp <?php echo e(number_format($services['suede_treatment']->price_per_pair ?? 95000, 0, ',', '.')); ?>

                </div>
                <div class="text-xs text-gray-400 mb-4">/pasang</div>
                <ul class="text-xs text-gray-500 space-y-1 text-left">
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Produk khusus suede</li>
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Restore warna asli</li>
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Selesai 3-4 hari</li>
                </ul>
                <div class="mt-4 py-1.5 px-3 bg-blue-100 text-blue-700 rounded-lg text-xs font-semibold">
                    Rp <?php echo e(number_format($services['suede_treatment']->price_per_pair ?? 95000, 0, ',', '.')); ?>/pasang
                </div>
            </div>
        </div>
        <?php $__errorArgs = ['service_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-3 text-red-500 text-sm"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- STEP 2: Detail Sepatu -->
    <div class="card p-8 mb-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm">2</div>
            <h2 class="text-xl font-bold text-gray-900">Detail Sepatu</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="label">Jumlah Pasang <span class="text-red-500">*</span></label>
                <div class="flex items-center gap-3">
                    <button type="button" id="btn_qty_minus" class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-xl font-bold text-lg transition-colors">−</button>
                    <input type="number" id="shoe_quantity" name="shoe_quantity" min="1" max="10"
                        value="<?php echo e(old('shoe_quantity', 1)); ?>"
                        class="input-field text-center font-bold text-lg w-24" readonly>
                    <button type="button" id="btn_qty_plus" class="w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-lg transition-colors">+</button>
                </div>
            </div>

            <div>
                <label class="label">Merek Sepatu (opsional)</label>
                <input type="text" name="shoe_brand" value="<?php echo e(old('shoe_brand')); ?>"
                    class="input-field" placeholder="Nike, Adidas, New Balance...">
            </div>

            <div>
                <label class="label">Warna Sepatu (opsional)</label>
                <input type="text" name="shoe_color" value="<?php echo e(old('shoe_color')); ?>"
                    class="input-field" placeholder="Putih, Hitam, Abu-abu...">
            </div>

            <div>
                <label class="label">Catatan Khusus (opsional)</label>
                <textarea name="notes" rows="3" class="input-field"
                    placeholder="Ada noda khusus, bagian yang perlu diperhatikan..."><?php echo e(old('notes')); ?></textarea>
            </div>
        </div>
    </div>

    <!-- STEP 3: Metode Pengambilan -->
    <div class="card p-8 mb-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm">3</div>
            <h2 class="text-xl font-bold text-gray-900">Metode Pengambilan</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <label id="label_pickup_yes" class="payment-option cursor-pointer flex items-start gap-3 p-4 rounded-xl border-2 border-gray-200 transition-all hover:border-blue-400 <?php echo e(old('is_pickup') == '1' ? 'border-blue-500 bg-blue-50' : ''); ?>" for="pickup_yes">
                <input type="radio" id="pickup_yes" name="is_pickup" value="1"
                    <?php echo e(old('is_pickup') == '1' ? 'checked' : ''); ?>

                    class="w-5 h-5 mt-0.5 text-blue-600 border-gray-300 focus:ring-blue-500">
                <div>
                    <div class="font-bold text-gray-900">🚗 Pickup ke Rumah</div>
                    <div class="text-sm text-gray-500">Kami jemput sepatu Anda</div>
                    <div class="text-sm font-semibold text-orange-600 mt-1">+ Rp 15.000</div>
                </div>
            </label>

            <label id="label_pickup_no" class="payment-option cursor-pointer flex items-start gap-3 p-4 rounded-xl border-2 border-gray-200 transition-all hover:border-blue-400 <?php echo e(old('is_pickup', '0') == '0' ? 'border-blue-500 bg-blue-50' : ''); ?>" for="pickup_no">
                <input type="radio" id="pickup_no" name="is_pickup" value="0"
                    <?php echo e(old('is_pickup', '0') == '0' ? 'checked' : ''); ?>

                    class="w-5 h-5 mt-0.5 text-blue-600 border-gray-300 focus:ring-blue-500">
                <div>
                    <div class="font-bold text-gray-900">🚶 Antar Sendiri</div>
                    <div class="text-sm text-gray-500">Antar ke toko kami</div>
                    <div class="text-sm font-semibold text-green-600 mt-1">Gratis</div>
                </div>
            </label>
        </div>

        <div id="address_section" class="<?php echo e(old('is_pickup') == '1' ? '' : 'hidden'); ?>">
            <label class="label">Alamat Pickup <span class="text-red-500">*</span></label>
            <textarea name="pickup_address" rows="3" class="input-field"
                placeholder="Masukkan alamat lengkap untuk pickup..."><?php echo e(old('pickup_address', auth()->user()->address)); ?></textarea>
        </div>
    </div>

    <!-- STEP 4: Metode Pembayaran -->
    <div class="card p-8 mb-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm">4</div>
            <h2 class="text-xl font-bold text-gray-900">Metode Pembayaran</h2>
        </div>

        <input type="hidden" id="payment_method" name="payment_method" value="<?php echo e(old('payment_method')); ?>">

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <?php $__currentLoopData = [
                ['method' => 'cash', 'label' => 'Cash / Tunai', 'icon' => '💵'],
                ['method' => 'transfer_bca', 'label' => 'Transfer BCA', 'icon' => '🏦'],
                ['method' => 'transfer_mandiri', 'label' => 'Mandiri', 'icon' => '🏦'],
                ['method' => 'transfer_bni', 'label' => 'BNI', 'icon' => '🏦'],
                ['method' => 'gopay', 'label' => 'GoPay', 'icon' => '💚'],
                ['method' => 'ovo', 'label' => 'OVO', 'icon' => '💜'],
                ['method' => 'dana', 'label' => 'DANA', 'icon' => '💙'],
                ['method' => 'qris', 'label' => 'QRIS', 'icon' => '📲'],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div data-payment="<?php echo e($pm['method']); ?>"
                 class="payment-card flex flex-col items-center text-center cursor-pointer p-4 rounded-xl border-2 border-gray-200 hover:border-blue-400 transition-all <?php echo e(old('payment_method') === $pm['method'] ? 'border-blue-500 bg-blue-50' : ''); ?>">
                <div class="text-2xl mb-1"><?php echo e($pm['icon']); ?></div>
                <div class="text-xs font-semibold text-gray-700"><?php echo e($pm['label']); ?></div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-3 text-red-500 text-sm"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Summary & Submit -->
    <div class="card p-8 bg-gradient-to-br from-blue-50 to-white border border-blue-100">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Ringkasan Pesanan</h2>

        <div class="space-y-3 text-sm mb-6">
            <div class="flex justify-between">
                <span class="text-gray-600">Layanan</span>
                <span id="summary_service" class="font-semibold text-gray-900">Belum dipilih</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Jumlah Pasang</span>
                <span id="summary_qty" class="font-semibold text-gray-900">1 pasang</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Harga Layanan</span>
                <span id="summary_service_price" class="font-semibold text-gray-900">Rp 0</span>
            </div>
            <div class="flex justify-between <?php echo e(old('is_pickup') == '1' ? '' : 'hidden'); ?>" id="pickup_fee_row">
                <span class="text-gray-600">Biaya Pickup</span>
                <span class="font-semibold text-orange-600">+ Rp 15.000</span>
            </div>
            <div class="flex justify-between pt-3 border-t border-gray-200">
                <span class="font-bold text-gray-900 text-lg">Total</span>
                <span id="summary_total" class="font-black text-blue-600 text-2xl">Rp 0</span>
            </div>
        </div>

        <button type="submit" class="btn-primary w-full text-lg py-4">
            🛒 Konfirmasi Pesanan
        </button>
        <p class="text-center text-xs text-gray-400 mt-3">Dengan memesan, Anda menyetujui syarat & ketentuan Dr. Sepatu</p>
    </div>
</form>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const serviceInput = document.getElementById('service_type');
    const paymentInput = document.getElementById('payment_method');
    const qtyInput = document.getElementById('shoe_quantity');
    const pickupYes = document.getElementById('pickup_yes');
    const pickupNo = document.getElementById('pickup_no');
    const labelYes = document.getElementById('label_pickup_yes');
    const labelNo = document.getElementById('label_pickup_no');
    const addressSection = document.getElementById('address_section');
    const pickupFeeRow = document.getElementById('pickup_fee_row');

    const summaryService = document.getElementById('summary_service');
    const summaryQty = document.getElementById('summary_qty');
    const summaryServicePrice = document.getElementById('summary_service_price');
    const summaryTotal = document.getElementById('summary_total');

    const serviceCards = document.querySelectorAll('.service-card');
    const paymentCards = document.querySelectorAll('.payment-card');
    const btnMinus = document.getElementById('btn_qty_minus');
    const btnPlus = document.getElementById('btn_qty_plus');

    function formatRupiah(num) {
        return 'Rp ' + Number(num).toLocaleString('id-ID');
    }

    function getSelectedServiceCard() {
        const selected = serviceInput ? serviceInput.value : '';
        if (!selected) return null;
        return document.querySelector('.service-card[data-service="' + selected + '"]');
    }

    function updatePrice() {
        const qty = Math.max(1, Math.min(10, parseInt(qtyInput.value, 10) || 1));
        qtyInput.value = qty;

        const activeCard = getSelectedServiceCard();
        const pricePerPair = activeCard ? (parseInt(activeCard.dataset.price, 10) || 0) : 0;
        const serviceName = activeCard ? (activeCard.dataset.name || 'Belum dipilih') : 'Belum dipilih';

        const isPickup = pickupYes && pickupYes.checked;
        const servicePrice = pricePerPair * qty;
        const pickupFee = isPickup ? 15000 : 0;
        const total = servicePrice + pickupFee;

        if (summaryService) summaryService.textContent = serviceName;
        if (summaryQty) summaryQty.textContent = qty + ' pasang';
        if (summaryServicePrice) summaryServicePrice.textContent = formatRupiah(servicePrice);
        if (summaryTotal) summaryTotal.textContent = formatRupiah(total);

        if (pickupFeeRow) {
            if (isPickup) {
                pickupFeeRow.classList.remove('hidden');
            } else {
                pickupFeeRow.classList.add('hidden');
            }
        }
    }

    function selectService(card) {
        serviceCards.forEach(function (c) {
            c.classList.remove('border-blue-500', 'bg-blue-50');
            c.classList.add('border-gray-200');
        });
        card.classList.add('border-blue-500', 'bg-blue-50');
        card.classList.remove('border-gray-200');
        if (serviceInput) {
            serviceInput.value = card.dataset.service;
        }
        updatePrice();
    }

    function selectPayment(card) {
        paymentCards.forEach(function (p) {
            p.classList.remove('border-blue-500', 'bg-blue-50');
            p.classList.add('border-gray-200');
        });
        card.classList.add('border-blue-500', 'bg-blue-50');
        card.classList.remove('border-gray-200');
        if (paymentInput) {
            paymentInput.value = card.dataset.payment;
        }
    }

    serviceCards.forEach(function (card) {
        card.addEventListener('click', function () {
            selectService(card);
        });
    });

    paymentCards.forEach(function (card) {
        card.addEventListener('click', function () {
            selectPayment(card);
        });
    });

    if (btnMinus) {
        btnMinus.addEventListener('click', function () {
            const current = parseInt(qtyInput.value, 10) || 1;
            if (current > 1) {
                qtyInput.value = current - 1;
                updatePrice();
            }
        });
    }

    if (btnPlus) {
        btnPlus.addEventListener('click', function () {
            const current = parseInt(qtyInput.value, 10) || 1;
            if (current < 10) {
                qtyInput.value = current + 1;
                updatePrice();
            }
        });
    }

    function updatePickupState() {
        if (!pickupYes || !pickupNo) return;
        if (pickupYes.checked) {
            if (labelYes) {
                labelYes.classList.add('border-blue-500', 'bg-blue-50');
                labelYes.classList.remove('border-gray-200');
            }
            if (labelNo) {
                labelNo.classList.remove('border-blue-500', 'bg-blue-50');
                labelNo.classList.add('border-gray-200');
            }
            if (addressSection) addressSection.classList.remove('hidden');
        } else {
            if (labelNo) {
                labelNo.classList.add('border-blue-500', 'bg-blue-50');
                labelNo.classList.remove('border-gray-200');
            }
            if (labelYes) {
                labelYes.classList.remove('border-blue-500', 'bg-blue-50');
                labelYes.classList.add('border-gray-200');
            }
            if (addressSection) addressSection.classList.add('hidden');
        }
        updatePrice();
    }

    if (pickupYes) pickupYes.addEventListener('change', updatePickupState);
    if (pickupNo) pickupNo.addEventListener('change', updatePickupState);

    // Initial state setup
    if (serviceInput && serviceInput.value) {
        const current = getSelectedServiceCard();
        if (current) selectService(current);
    }
    if (paymentInput && paymentInput.value) {
        const currentPay = document.querySelector('.payment-card[data-payment="' + paymentInput.value + '"]');
        if (currentPay) selectPayment(currentPay);
    }
    updatePickupState();
    updatePrice();
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ray/Documents/Project/dr-sepatu/resources/views/customer/orders/create.blade.php ENDPATH**/ ?>