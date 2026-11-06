@extends('layouts.app')

@section('title', 'Dr. Sepatu - Laundry Sepatu Profesional & Terpercaya')

@section('content')
<!-- Hero Section -->
<section class="bg-hero relative overflow-hidden min-h-[90vh] flex items-center bg-grid-pattern">
    <!-- Ambient light glow -->
    <div class="absolute top-10 right-10 w-[500px] h-[500px] bg-blue-500/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 left-10 w-[400px] h-[400px] bg-indigo-500/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            
            <!-- Left Headline -->
            <div class="lg:col-span-7 animate-fade-in">
                <div class="inline-flex items-center gap-2.5 bg-blue-500/10 border border-blue-400/30 backdrop-blur-md rounded-full px-4 py-1.5 text-blue-200 text-xs font-semibold mb-6 shadow-xs">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    <span>Layanan Laundry Sepatu #1 Terpercaya</span>
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-[1.15] mb-6">
                    Kembalikan Bersih & Warna Sepatu Anda Seperti <span class="bg-gradient-to-r from-blue-300 via-indigo-200 to-sky-300 bg-clip-text text-transparent">Baru Lagi.</span>
                </h1>

                <p class="text-slate-300 text-base sm:text-lg leading-relaxed mb-8 max-w-xl">
                    Perawatan sepatu profesional dengan chemical khusus ramah material. Tersedia pilihan <strong class="text-white font-semibold">Fast Clean</strong>, <strong class="text-white font-semibold">Deep Clean</strong>, hingga <strong class="text-white font-semibold">Suede Treatment</strong> dengan layanan pickup praktis.
                </p>

                <div class="flex flex-wrap items-center gap-3.5">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="btn-primary py-3.5 px-7 text-sm font-bold shadow-lg shadow-blue-500/30">
                                📊 Buka Panel Admin
                            </a>
                        @else
                            <a href="{{ route('customer.orders.create') }}" class="btn-primary py-3.5 px-7 text-sm font-bold shadow-lg shadow-blue-500/30 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                Pesan Cuci Sekarang
                            </a>
                        @endif
                    @else
                        <a href="{{ route('register') }}" class="btn-primary py-3.5 px-7 text-sm font-bold shadow-lg shadow-blue-500/30">
                            Mulai Pesan Sekarang →
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center font-semibold text-white bg-white/10 hover:bg-white/15 active:bg-white/20 py-3.5 px-6 rounded-xl border border-white/20 backdrop-blur-md transition-all text-sm">
                            Masuk Akun
                        </a>
                    @endauth
                </div>

                <!-- Verified Metrics -->
                <div class="grid grid-cols-3 gap-6 pt-10 mt-10 border-t border-white/10 max-w-lg">
                    <div>
                        <div class="text-2xl sm:text-3xl font-black text-white">500+</div>
                        <div class="text-xs text-slate-400 mt-0.5">Pelanggan Aktif</div>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-black text-white">2.500+</div>
                        <div class="text-xs text-slate-400 mt-0.5">Sepatu Dicuci</div>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-black text-amber-400 flex items-center gap-1">
                            <span>4.9</span>
                            <span class="text-base">★</span>
                        </div>
                        <div class="text-xs text-slate-400 mt-0.5">Rating Kepuasan</div>
                    </div>
                </div>
            </div>

            <!-- Right Visual Interactive Showcase -->
            <div class="lg:col-span-5 flex justify-center lg:justify-end animate-slide-up">
                <div class="relative w-full max-w-md">
                    <!-- Ambient Glow underneath -->
                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl blur-xl opacity-30"></div>

                    <!-- Main Glass Card -->
                    <div class="relative card-dark-glass p-7 border border-white/15 shadow-2xl">
                        <!-- Top status bar -->
                        <div class="flex items-center justify-between pb-5 border-b border-white/10 mb-5">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                                <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                                <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-blue-300 bg-blue-500/20 px-2.5 py-1 rounded-md border border-blue-400/30">
                                Layanan Populer
                            </span>
                        </div>

                        <!-- Service Showcase Feature -->
                        <div class="text-center py-2">
                            <div class="w-20 h-20 mx-auto bg-gradient-to-br from-blue-500/20 to-indigo-500/30 rounded-2xl flex items-center justify-center text-4xl mb-4 border border-white/20 shadow-inner">
                                🧼
                            </div>
                            <h3 class="text-xl font-black text-white">Deep Clean Treatment</h3>
                            <p class="text-xs text-slate-300 mt-1 max-w-xs mx-auto">Pembersihan mendalam dari luar, sol, insole, hingga antibakteri.</p>
                            <div class="mt-4 inline-flex items-baseline gap-1.5">
                                <span class="text-3xl font-black text-white">Rp 65.000</span>
                                <span class="text-xs text-slate-400">/ pasang</span>
                            </div>
                        </div>

                        <!-- Feature checks -->
                        <div class="space-y-2.5 mt-6 pt-5 border-t border-white/10">
                            <div class="flex items-center gap-3 text-xs text-slate-200">
                                <div class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <span>Pembersihan mendalam luar, dalam & tali</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs text-slate-200">
                                <div class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <span>Whitening midsole & penghilang noda</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs text-slate-200">
                                <div class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <span>Disinfektan anti bau & parfum fresh shoes</span>
                            </div>
                        </div>

                        <!-- CTA inside card -->
                        <div class="mt-6">
                            <a href="{{ auth()->check() ? route('customer.orders.create') : route('register') }}"
                               class="w-full btn-primary py-2.5 text-xs font-bold text-center block">
                                Pesan Layanan Ini
                            </a>
                        </div>
                    </div>

                    <!-- Floating Badge Real-time Order -->
                    <div class="absolute -bottom-5 -left-5 bg-white rounded-2xl p-3.5 shadow-xl border border-slate-100 flex items-center gap-3 animate-bounce-soft hidden sm:flex">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-900">Pesanan Selesai!</p>
                            <p class="text-[11px] text-slate-500">Nike Air Jordan · Baru saja</p>
                        </div>
                    </div>

                    <!-- Floating Badge Rating -->
                    <div class="absolute -top-4 -right-4 bg-amber-400 text-slate-950 px-3 py-1.5 rounded-xl font-bold text-xs shadow-lg flex items-center gap-1.5">
                        <span>🔥</span>
                        <span>Pilihan Terfavorit</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-600 bg-blue-50 px-3.5 py-1.5 rounded-full border border-blue-100">
                Layanan Profesional
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mt-4 mb-3">
                Pilih Perawatan <span class="text-gradient">Terbaik</span> Untuk Sepatu Anda
            </h2>
            <p class="text-slate-500 text-sm sm:text-base leading-relaxed">
                Setiap material sepatu diperlakukan dengan metode spesifik dan formula pembersih premium agar bersih tanpa merusak tekstur.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="card p-7 text-center group hover:shadow-xl hover:border-blue-200 transition-all duration-300 flex flex-col justify-between">
                <div>
                    <div class="w-18 h-18 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-105 transition-transform duration-300
                        @if($service->service_type === 'fast_clean') bg-blue-50 text-blue-600
                        @elseif($service->service_type === 'deep_clean') bg-indigo-50 text-indigo-600
                        @else bg-purple-50 text-purple-600 @endif">
                        @if($service->service_type === 'fast_clean')
                            <span class="text-4xl">⚡</span>
                        @elseif($service->service_type === 'deep_clean')
                            <span class="text-4xl">🧼</span>
                        @else
                            <span class="text-4xl">✨</span>
                        @endif
                    </div>

                    <div class="inline-block px-3 py-1 rounded-full text-xs font-bold mb-3
                        @if($service->service_type === 'fast_clean') bg-blue-100/70 text-blue-700
                        @elseif($service->service_type === 'deep_clean') bg-indigo-100/70 text-indigo-700
                        @else bg-purple-100/70 text-purple-700 @endif">
                        ⏱️ Estimasi {{ $service->estimated_days }} Hari
                    </div>

                    <h3 class="text-2xl font-black text-slate-900 mb-2">{{ $service->service_name }}</h3>
                    <p class="text-slate-500 text-xs sm:text-sm leading-relaxed mb-6">{{ $service->description }}</p>
                </div>

                <div class="pt-6 border-t border-slate-100">
                    <div class="mb-4">
                        <span class="text-2xl sm:text-3xl font-black text-blue-600">
                            Rp {{ number_format($service->price_per_pair, 0, ',', '.') }}
                        </span>
                        <span class="text-xs text-slate-400">/pasang</span>
                    </div>

                    <a href="{{ auth()->check() ? route('customer.orders.create') : route('register') }}"
                       class="btn-primary w-full text-xs py-3 font-bold group-hover:shadow-md">
                        Pesan Layanan Ini →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- How it Works -->
<section id="how-it-works" class="py-24 bg-slate-50 border-y border-slate-200/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-600 bg-blue-100/60 px-3.5 py-1.5 rounded-full border border-blue-200/60">
                Alur Pemesanan
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mt-4 mb-2">
                Praktis, Cepat & <span class="text-gradient">Transparan</span>
            </h2>
            <p class="text-slate-500 text-sm">Hanya butuh 4 langkah mudah sampai sepatu Anda bersih kembali.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
            @foreach([
                ['step' => '01', 'icon' => '📝', 'title' => 'Buat Pesanan', 'desc' => 'Pilih paket cuci sepatu dan tentukan apakah ingin di-pickup atau diantar sendiri.'],
                ['step' => '02', 'icon' => '🚗', 'title' => 'Penjemputan', 'desc' => 'Kurir kami mengambil sepatu di lokasi Anda, atau silakan drop ke outlet.'],
                ['step' => '03', 'icon' => '✨', 'title' => 'Treatment Ahli', 'desc' => 'Dikerjakan dengan sikat bertingkat dan formula khusus sesuai jenis material.'],
                ['step' => '04', 'icon' => '📦', 'title' => 'Pengantaran', 'desc' => 'Sepatu diantar kembali dalam kondisi bersih, steril, dan wangi siap pakai!'],
            ] as $item)
            <div class="card p-6 text-center hover:shadow-lg transition-all duration-200 relative">
                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl border border-blue-100">
                    {{ $item['icon'] }}
                </div>
                <div class="text-[11px] font-black text-blue-600 tracking-widest mb-1">LANGKAH {{ $item['step'] }}</div>
                <h3 class="font-bold text-slate-900 text-base mb-2">{{ $item['title'] }}</h3>
                <p class="text-slate-500 text-xs leading-relaxed">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section id="pricing" class="py-24 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-600 bg-blue-50 px-3.5 py-1.5 rounded-full border border-blue-100">
                Transparansi Biaya
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mt-4 mb-2">
                Daftar Harga <span class="text-gradient">Terjangkau</span>
            </h2>
            <p class="text-slate-500 text-sm">Tidak ada biaya tersembunyi. Kualitas terbaik untuk setiap pasang.</p>
        </div>

        <div class="card overflow-hidden border border-slate-200/90 shadow-lg">
            <div class="bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700 p-6 text-white flex items-center justify-between">
                <div>
                    <h3 class="font-black text-lg">Paket & Biaya Laundry</h3>
                    <p class="text-blue-100 text-xs mt-0.5">Dihitung per pasang sepatu</p>
                </div>
                <span class="text-xs font-bold bg-white/20 backdrop-blur-md px-3 py-1 rounded-full border border-white/20">
                    Jaminan Kualitas 100%
                </span>
            </div>

            <div class="divide-y divide-slate-100">
                <div class="flex items-center justify-between p-5 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">⚡</div>
                        <div>
                            <div class="font-bold text-slate-900 text-sm sm:text-base">Fast Clean</div>
                            <div class="text-xs text-slate-500">Pengerjaan kilat 1 hari kerja</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-black text-lg sm:text-xl text-blue-600">Rp 35.000</div>
                        <div class="text-[11px] text-slate-400">/ pasang</div>
                    </div>
                </div>

                <div class="flex items-center justify-between p-5 bg-blue-50/40 hover:bg-blue-50/70 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">🧼</div>
                        <div>
                            <div class="font-bold text-slate-900 text-sm sm:text-base flex items-center gap-2">
                                <span>Deep Clean</span>
                                <span class="text-[10px] bg-blue-600 text-white font-bold px-2 py-0.5 rounded-full">Favorit</span>
                            </div>
                            <div class="text-xs text-slate-500">Pengerjaan detail menyeluruh 2-3 hari</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-black text-lg sm:text-xl text-blue-600">Rp 65.000</div>
                        <div class="text-[11px] text-slate-400">/ pasang</div>
                    </div>
                </div>

                <div class="flex items-center justify-between p-5 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl">✨</div>
                        <div>
                            <div class="font-bold text-slate-900 text-sm sm:text-base">Suede Treatment</div>
                            <div class="text-xs text-slate-500">Chemical restorasi khusus bahan suede 3-4 hari</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-black text-lg sm:text-xl text-blue-600">Rp 95.000</div>
                        <div class="text-[11px] text-slate-400">/ pasang</div>
                    </div>
                </div>

                <div class="flex items-center justify-between p-5 bg-slate-50">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">🚗</div>
                        <div>
                            <div class="font-bold text-slate-900 text-sm sm:text-base">Biaya Antar Jemput (Pickup)</div>
                            <div class="text-xs text-slate-500">Jemput langsung ke alamat rumah Anda</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-black text-base sm:text-lg text-slate-700">+ Rp 15.000</div>
                        <div class="text-[11px] text-slate-400">flat rate per order</div>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-slate-100/60 border-t border-slate-200/80 text-center">
                <a href="{{ auth()->check() ? route('customer.orders.create') : route('register') }}"
                   class="btn-primary py-3 px-8 text-sm font-bold shadow-md">
                    Mulai Pesan Sekarang →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section id="testimonials" class="py-24 bg-slate-950 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-400 bg-blue-900/40 px-3.5 py-1.5 rounded-full border border-blue-500/30">
                Ulasan Pelanggan
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mt-4 mb-2">
                Apa Kata Mereka?
            </h2>
            <p class="text-slate-400 text-sm">Cerita pengalaman langsung dari pelanggan setia Dr. Sepatu.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['name' => 'Budi Santoso', 'role' => 'Sneaker Enthusiast', 'text' => 'Sepatu Nike Air Jordan saya dibersihkan dengan sangat rapi dan teliti. Midsole-nya kembali putih tanpa merusak cat!', 'rating' => 5],
                ['name' => 'Sari Dewi', 'role' => 'Office Professional', 'text' => 'Layanan Suede Treatment-nya juara banget! Sepatu suede kerja saya yang kusam kembali halus dan warnanya cerah seperti baru.', 'rating' => 5],
                ['name' => 'Ahmad Rizky', 'role' => 'Pelanggan Setia', 'text' => 'Layanan pickup-nya sangat membantu buat yang sibuk kerja. Tinggal buat order, sepatu dijemput, dan kembali dalam kondisi wangi bersih.', 'rating' => 5],
            ] as $testimonial)
            <div class="card-dark-glass p-7 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-1 mb-4 text-amber-400">
                        @for($i = 0; $i < $testimonial['rating']; $i++)
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-slate-300 text-xs sm:text-sm leading-relaxed mb-6">"{{ $testimonial['text'] }}"</p>
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-white/10">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white font-bold text-xs flex items-center justify-center">
                        {{ strtoupper(substr($testimonial['name'], 0, 1)) }}
                    </div>
                    <div>
                        <div class="text-xs font-bold text-white">{{ $testimonial['name'] }}</div>
                        <div class="text-[11px] text-slate-400">{{ $testimonial['role'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Final CTA -->
<section class="py-20 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <h2 class="text-3xl sm:text-4xl font-black mb-3 tracking-tight">Siap Bikin Sepatu Anda Bersih & Wangi?</h2>
        <p class="text-blue-100 text-sm sm:text-base mb-8 max-w-lg mx-auto">
            Daftar sekarang dan rasakan kemudahan mencuci sepatu tanpa repot keluar rumah.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-3">
            @guest
                <a href="{{ route('register') }}" class="bg-white text-blue-700 hover:bg-blue-50 font-bold py-3.5 px-8 rounded-xl shadow-xl transition-all duration-200 text-sm transform hover:-translate-y-0.5">
                    Daftar Gratis Sekarang →
                </a>
                <a href="{{ route('login') }}" class="bg-white/10 border border-white/30 text-white hover:bg-white/20 font-semibold py-3.5 px-7 rounded-xl transition-all duration-200 text-sm backdrop-blur-md">
                    Sudah Punya Akun
                </a>
            @else
                <a href="{{ route('customer.orders.create') }}" class="bg-white text-blue-700 hover:bg-blue-50 font-bold py-3.5 px-8 rounded-xl shadow-xl transition-all duration-200 text-sm transform hover:-translate-y-0.5">
                    Buat Pesanan Sekarang →
                </a>
            @endguest
        </div>
    </div>
</section>
@endsection
