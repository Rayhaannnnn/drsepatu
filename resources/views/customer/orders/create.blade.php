@extends('layouts.customer')
@section('title', 'Buat Pesanan Baru')
@section('page-title', 'Form Pemesanan Cuci Sepatu')
@section('page-subtitle', 'Pilih layanan, opsi pickup, dan metode pembayaran Anda')

@section('content')
<div class="max-w-4xl mx-auto">

@if (isset($errors) && $errors->any())
<div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 p-4 rounded-2xl shadow-xs">
    <div class="flex items-center gap-2 font-bold mb-2 text-sm">
        <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>Harap periksa isian formulir:</span>
    </div>
    <ul class="list-disc list-inside text-xs space-y-1 pl-1">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('customer.orders.store') }}" id="orderForm">
    @csrf

    <!-- STEP 1: Pilih Layanan -->
    <div class="card p-6 sm:p-8 mb-6">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
            <div class="w-8 h-8 bg-blue-600 text-white rounded-xl flex items-center justify-center font-black text-sm shadow-sm shadow-blue-500/20">1</div>
            <div>
                <h2 class="text-base sm:text-lg font-extrabold text-slate-900 tracking-tight">Pilih Jenis Layanan Cuci</h2>
                <p class="text-xs text-slate-400">Pilih treatment yang paling cocok untuk kondisi sepatu Anda</p>
            </div>
        </div>

        <input type="hidden" id="service_type" name="service_type" value="{{ old('service_type') }}">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Fast Clean -->
            <div data-service="fast_clean"
                 data-price="{{ $services['fast_clean']->price_per_pair ?? 35000 }}"
                 data-name="⚡ Fast Clean"
                 class="service-card group cursor-pointer border-2 rounded-2xl p-6 text-center transition-all duration-200 {{ old('service_type') === 'fast_clean' ? 'border-blue-600 bg-blue-50/70 ring-2 ring-blue-500/20' : 'border-slate-200 hover:border-blue-400' }}">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-blue-50 group-hover:bg-blue-100 text-blue-600 flex items-center justify-center text-3xl mb-4 transition-colors">
                    ⚡
                </div>
                <h3 class="font-extrabold text-slate-900 text-lg mb-1">Fast Clean</h3>
                <p class="text-xs text-slate-500 mb-3">Pembersihan bagian luar harian</p>
                <div class="text-2xl font-black text-blue-600">
                    Rp {{ number_format($services['fast_clean']->price_per_pair ?? 35000, 0, ',', '.') }}
                </div>
                <div class="text-[11px] text-slate-400 mb-4">/ pasang</div>
                <ul class="text-xs text-slate-600 space-y-1.5 text-left border-t border-slate-100 pt-3">
                    <li class="flex items-center gap-2"><span class="text-emerald-500 font-bold">✓</span> Cuci upper & midsole</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-500 font-bold">✓</span> Pengeringan angin cepat</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-500 font-bold">✓</span> Selesai 1 hari kerja</li>
                </ul>
            </div>

            <!-- Deep Clean -->
            <div data-service="deep_clean"
                 data-price="{{ $services['deep_clean']->price_per_pair ?? 65000 }}"
                 data-name="🧼 Deep Clean"
                 class="service-card group cursor-pointer border-2 rounded-2xl p-6 text-center transition-all duration-200 relative {{ old('service_type') === 'deep_clean' ? 'border-blue-600 bg-blue-50/70 ring-2 ring-blue-500/20' : 'border-slate-200 hover:border-blue-400' }}">
                <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-blue-600 text-white text-[10px] font-extrabold px-3 py-0.5 rounded-full shadow-sm">
                    🔥 Terfavorit
                </div>
                <div class="w-14 h-14 mx-auto rounded-2xl bg-indigo-50 group-hover:bg-indigo-100 text-indigo-600 flex items-center justify-center text-3xl mb-4 transition-colors">
                    🧼
                </div>
                <h3 class="font-extrabold text-slate-900 text-lg mb-1">Deep Clean</h3>
                <p class="text-xs text-slate-500 mb-3">Cuci menyeluruh luar & dalam</p>
                <div class="text-2xl font-black text-blue-600">
                    Rp {{ number_format($services['deep_clean']->price_per_pair ?? 65000, 0, ',', '.') }}
                </div>
                <div class="text-[11px] text-slate-400 mb-4">/ pasang</div>
                <ul class="text-xs text-slate-600 space-y-1.5 text-left border-t border-slate-100 pt-3">
                    <li class="flex items-center gap-2"><span class="text-emerald-500 font-bold">✓</span> Cuci total luar, dalam, insole</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-500 font-bold">✓</span> Whitening unyellowing sol</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-500 font-bold">✓</span> Selesai 2-3 hari kerja</li>
                </ul>
            </div>

            <!-- Suede Treatment -->
            <div data-service="suede_treatment"
                 data-price="{{ $services['suede_treatment']->price_per_pair ?? 95000 }}"
                 data-name="✨ Suede Treatment"
                 class="service-card group cursor-pointer border-2 rounded-2xl p-6 text-center transition-all duration-200 {{ old('service_type') === 'suede_treatment' ? 'border-blue-600 bg-blue-50/70 ring-2 ring-blue-500/20' : 'border-slate-200 hover:border-blue-400' }}">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-purple-50 group-hover:bg-purple-100 text-purple-600 flex items-center justify-center text-3xl mb-4 transition-colors">
                    ✨
                </div>
                <h3 class="font-extrabold text-slate-900 text-lg mb-1">Suede Treatment</h3>
                <p class="text-xs text-slate-500 mb-3">Perawatan bahan kulit / suede</p>
                <div class="text-2xl font-black text-blue-600">
                    Rp {{ number_format($services['suede_treatment']->price_per_pair ?? 95000, 0, ',', '.') }}
                </div>
                <div class="text-[11px] text-slate-400 mb-4">/ pasang</div>
                <ul class="text-xs text-slate-600 space-y-1.5 text-left border-t border-slate-100 pt-3">
                    <li class="flex items-center gap-2"><span class="text-emerald-500 font-bold">✓</span> Sikat khusus suede premium</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-500 font-bold">✓</span> Restorasi warna & tekstur</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-500 font-bold">✓</span> Selesai 3-4 hari kerja</li>
                </ul>
            </div>
        </div>
        @error('service_type')
            <p class="mt-3 text-rose-500 text-xs font-semibold">{{ $message }}</p>
        @enderror
    </div>

    <!-- STEP 2: Detail Sepatu -->
    <div class="card p-6 sm:p-8 mb-6">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
            <div class="w-8 h-8 bg-blue-600 text-white rounded-xl flex items-center justify-center font-black text-sm shadow-sm shadow-blue-500/20">2</div>
            <div>
                <h2 class="text-base sm:text-lg font-extrabold text-slate-900 tracking-tight">Detail & Jumlah Sepatu</h2>
                <p class="text-xs text-slate-400">Tentukan jumlah pasang sepatu yang ingin Anda cuci</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="label">Jumlah Pasang <span class="text-rose-500">*</span></label>
                <div class="flex items-center gap-3">
                    <button type="button" id="btn_qty_minus" class="w-10 h-10 bg-slate-100 hover:bg-slate-200 active:bg-slate-300 rounded-xl font-bold text-lg text-slate-700 transition-colors flex items-center justify-center">−</button>
                    <input type="number" id="shoe_quantity" name="shoe_quantity" min="1" max="10"
                        value="{{ old('shoe_quantity', 1) }}"
                        class="input-field text-center font-black text-lg w-20 py-2" readonly>
                    <button type="button" id="btn_qty_plus" class="w-10 h-10 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white rounded-xl font-bold text-lg transition-colors flex items-center justify-center">+</button>
                    <span class="text-xs text-slate-500">Maks. 10 pasang per transaksi</span>
                </div>
            </div>

            <div>
                <label class="label">Merek Sepatu (Opsional)</label>
                <input type="text" name="shoe_brand" value="{{ old('shoe_brand') }}"
                    class="input-field" placeholder="Contoh: Nike Dunk Low, Converse 70s">
            </div>

            <div>
                <label class="label">Warna Sepatu (Opsional)</label>
                <input type="text" name="shoe_color" value="{{ old('shoe_color') }}"
                    class="input-field" placeholder="Contoh: Putih / Hitam">
            </div>

            <div>
                <label class="label">Catatan Khusus (Opsional)</label>
                <textarea name="notes" rows="2" class="input-field"
                    placeholder="Tuliskan jika ada noda minyak, sol lepas, dll...">{{ old('notes') }}</textarea>
            </div>
        </div>
    </div>

    <!-- STEP 3: Metode Pengambilan -->
    <div class="card p-6 sm:p-8 mb-6">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
            <div class="w-8 h-8 bg-blue-600 text-white rounded-xl flex items-center justify-center font-black text-sm shadow-sm shadow-blue-500/20">3</div>
            <div>
                <h2 class="text-base sm:text-lg font-extrabold text-slate-900 tracking-tight">Metode Pengambilan Sepatu</h2>
                <p class="text-xs text-slate-400">Pilih kemudahan jemput di rumah atau drop-off ke toko</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <label id="label_pickup_yes" class="payment-option cursor-pointer flex items-start gap-3.5 p-4 rounded-xl border-2 transition-all {{ old('is_pickup') == '1' ? 'border-blue-600 bg-blue-50/70 ring-2 ring-blue-500/20' : 'border-slate-200 hover:border-blue-400' }}" for="pickup_yes">
                <input type="radio" id="pickup_yes" name="is_pickup" value="1"
                    {{ old('is_pickup') == '1' ? 'checked' : '' }}
                    class="w-4 h-4 mt-1 text-blue-600 border-slate-300 focus:ring-blue-500">
                <div>
                    <div class="font-bold text-slate-900 text-sm">🚗 Pickup / Jemput ke Rumah</div>
                    <div class="text-xs text-slate-500 mt-0.5">Kurir kami yang akan datang mengambil</div>
                    <div class="text-xs font-bold text-amber-600 mt-1">+ Rp 15.000 flat</div>
                </div>
            </label>

            <label id="label_pickup_no" class="payment-option cursor-pointer flex items-start gap-3.5 p-4 rounded-xl border-2 transition-all {{ old('is_pickup', '0') == '0' ? 'border-blue-600 bg-blue-50/70 ring-2 ring-blue-500/20' : 'border-slate-200 hover:border-blue-400' }}" for="pickup_no">
                <input type="radio" id="pickup_no" name="is_pickup" value="0"
                    {{ old('is_pickup', '0') == '0' ? 'checked' : '' }}
                    class="w-4 h-4 mt-1 text-blue-600 border-slate-300 focus:ring-blue-500">
                <div>
                    <div class="font-bold text-slate-900 text-sm">🚶 Antar Sendiri ke Outlet</div>
                    <div class="text-xs text-slate-500 mt-0.5">Drop langsung ke alamat toko kami</div>
                    <div class="text-xs font-bold text-emerald-600 mt-1">Gratis Biaya</div>
                </div>
            </label>
        </div>

        <div id="address_section" class="{{ old('is_pickup') == '1' ? '' : 'hidden' }} pt-2">
            <label class="label">Alamat Lengkap Penjemputan <span class="text-rose-500">*</span></label>
            <textarea name="pickup_address" rows="3" class="input-field"
                placeholder="Tuliskan nama jalan, nomor rumah, RT/RW, kelurahan, dan patokan...">{{ old('pickup_address', auth()->user()->address) }}</textarea>
            <p class="text-[11px] text-slate-400 mt-1">Pastikan nomor WhatsApp Anda aktif agar kurir dapat menghubungi sebelum tiba.</p>
        </div>
    </div>

    <!-- STEP 4: Metode Pembayaran -->
    <div class="card p-6 sm:p-8 mb-6">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
            <div class="w-8 h-8 bg-blue-600 text-white rounded-xl flex items-center justify-center font-black text-sm shadow-sm shadow-blue-500/20">4</div>
            <div>
                <h2 class="text-base sm:text-lg font-extrabold text-slate-900 tracking-tight">Metode Pembayaran</h2>
                <p class="text-xs text-slate-400">Pilih cara pembayaran yang paling nyaman untuk Anda</p>
            </div>
        </div>

        <input type="hidden" id="payment_method" name="payment_method" value="{{ old('payment_method') }}">

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            @foreach([
                ['method' => 'cash', 'label' => 'Cash / Tunai', 'icon' => '💵'],
                ['method' => 'transfer_bca', 'label' => 'BCA Virtual/TF', 'icon' => '🏦'],
                ['method' => 'transfer_mandiri', 'label' => 'Bank Mandiri', 'icon' => '🏦'],
                ['method' => 'transfer_bni', 'label' => 'Bank BNI', 'icon' => '🏦'],
                ['method' => 'gopay', 'label' => 'GoPay', 'icon' => '🟢'],
                ['method' => 'ovo', 'label' => 'OVO Cash', 'icon' => '🟣'],
                ['method' => 'dana', 'label' => 'DANA Wallet', 'icon' => '🔵'],
                ['method' => 'qris', 'label' => 'QRIS (Semua E-Wallet)', 'icon' => '📲'],
            ] as $pm)
            <div data-payment="{{ $pm['method'] }}"
                 class="payment-card flex flex-col items-center text-center cursor-pointer p-4 rounded-xl border-2 transition-all {{ old('payment_method') === $pm['method'] ? 'border-blue-600 bg-blue-50/70 ring-2 ring-blue-500/20' : 'border-slate-200 hover:border-blue-400 bg-white' }}">
                <div class="text-2xl mb-1.5">{{ $pm['icon'] }}</div>
                <div class="text-xs font-bold text-slate-800">{{ $pm['label'] }}</div>
            </div>
            @endforeach
        </div>
        @error('payment_method')
            <p class="mt-3 text-rose-500 text-xs font-semibold">{{ $message }}</p>
        @enderror
    </div>

    <!-- Summary & Submit -->
    <div class="card p-6 sm:p-8 bg-gradient-to-br from-slate-900 to-slate-950 text-white shadow-xl">
        <h2 class="text-base sm:text-lg font-black text-white mb-5 pb-3 border-b border-slate-800 flex items-center justify-between">
            <span>Ringkasan Biaya Pesanan</span>
            <span class="text-xs font-semibold text-slate-400">Dr. Sepatu Care</span>
        </h2>

        <div class="space-y-3 text-xs sm:text-sm mb-6">
            <div class="flex justify-between items-center text-slate-300">
                <span>Paket Layanan:</span>
                <span id="summary_service" class="font-bold text-white">Belum dipilih</span>
            </div>
            <div class="flex justify-between items-center text-slate-300">
                <span>Jumlah Pasang:</span>
                <span id="summary_qty" class="font-bold text-white">1 pasang</span>
            </div>
            <div class="flex justify-between items-center text-slate-300">
                <span>Subtotal Layanan:</span>
                <span id="summary_service_price" class="font-bold text-white">Rp 0</span>
            </div>
            <div class="flex justify-between items-center text-slate-300 {{ old('is_pickup') == '1' ? '' : 'hidden' }}" id="pickup_fee_row">
                <span>Biaya Penjemputan (Pickup):</span>
                <span class="font-bold text-amber-400">+ Rp 15.000</span>
            </div>
            <div class="flex justify-between items-baseline pt-4 border-t border-slate-800">
                <div>
                    <span class="font-bold text-white text-base">Total Tagihan:</span>
                    <p class="text-[11px] text-slate-400">Sudah termasuk pajak & disinfektan</p>
                </div>
                <span id="summary_total" class="font-black text-blue-400 text-2xl sm:text-3xl">Rp 0</span>
            </div>
        </div>

        <button type="submit" class="w-full btn-primary py-3.5 text-sm sm:text-base font-bold shadow-lg shadow-blue-500/30">
            🛒 Konfirmasi & Kirim Pesanan
        </button>
        <p class="text-center text-[11px] text-slate-400 mt-3">Dengan mengirim pesanan, Anda menyetujui syarat & ketentuan laundry Dr. Sepatu.</p>
    </div>
</form>
</div>

@push('scripts')
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
            c.classList.remove('border-blue-600', 'bg-blue-50/70', 'ring-2', 'ring-blue-500/20');
            c.classList.add('border-slate-200');
        });
        card.classList.add('border-blue-600', 'bg-blue-50/70', 'ring-2', 'ring-blue-500/20');
        card.classList.remove('border-slate-200');
        if (serviceInput) {
            serviceInput.value = card.dataset.service;
        }
        updatePrice();
    }

    function selectPayment(card) {
        paymentCards.forEach(function (p) {
            p.classList.remove('border-blue-600', 'bg-blue-50/70', 'ring-2', 'ring-blue-500/20');
            p.classList.add('border-slate-200');
        });
        card.classList.add('border-blue-600', 'bg-blue-50/70', 'ring-2', 'ring-blue-500/20');
        card.classList.remove('border-slate-200');
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
                labelYes.classList.add('border-blue-600', 'bg-blue-50/70', 'ring-2', 'ring-blue-500/20');
                labelYes.classList.remove('border-slate-200');
            }
            if (labelNo) {
                labelNo.classList.remove('border-blue-600', 'bg-blue-50/70', 'ring-2', 'ring-blue-500/20');
                labelNo.classList.add('border-slate-200');
            }
            if (addressSection) addressSection.classList.remove('hidden');
        } else {
            if (labelNo) {
                labelNo.classList.add('border-blue-600', 'bg-blue-50/70', 'ring-2', 'ring-blue-500/20');
                labelNo.classList.remove('border-slate-200');
            }
            if (labelYes) {
                labelYes.classList.remove('border-blue-600', 'bg-blue-50/70', 'ring-2', 'ring-blue-500/20');
                labelYes.classList.add('border-slate-200');
            }
            if (addressSection) addressSection.classList.add('hidden');
        }
        updatePrice();
    }

    if (pickupYes) pickupYes.addEventListener('change', updatePickupState);
    if (pickupNo) pickupNo.addEventListener('change', updatePickupState);

    // Initial load state
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
@endpush
@endsection
