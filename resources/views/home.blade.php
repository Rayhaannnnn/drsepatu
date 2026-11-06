@extends('layouts.app')

@section('title', 'Dr. Sepatu - Laundry Sepatu Profesional & Terpercaya')

@section('content')
<!-- Hero Section (Vibrant Dr. Sepatu Royal Blue) -->
<section class="relative overflow-hidden min-h-screen flex items-center bg-[#1a56db] text-white pt-16">
    <!-- Animated Ambient Lighting (Subtle Glow on Solid Blue) -->
    <div class="absolute top-16 right-16 w-96 h-96 bg-white/10 rounded-full blur-3xl pointer-events-none animate-pulse-glow"></div>
    <div class="absolute bottom-12 left-12 w-80 h-80 bg-blue-300/15 rounded-full blur-3xl pointer-events-none animate-float-slow"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            
            <!-- Left Headline -->
            <div class="lg:col-span-7 animate-fade-in">
                <!-- Live Pill Badge -->
                <div class="inline-flex items-center gap-2.5 bg-white/15 backdrop-blur-md rounded-full px-4 py-2 text-white text-xs font-bold mb-6 border border-white/25 shadow-sm">
                    <span class="w-2.5 h-2.5 bg-emerald-400 rounded-full animate-pulse shadow-xs"></span>
                    <span>Layanan Laundry Sepatu #1 Terpercaya</span>
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-tight tracking-tight mb-6">
                    Kembalikan Bersih & Warna Sepatu Anda Seperti <span class="text-blue-200 underline decoration-blue-300/40 decoration-wavy">Baru Lagi.</span>
                </h1>

                <p class="text-blue-100 text-base sm:text-lg leading-relaxed mb-8 max-w-xl font-normal">
                    Perawatan sepatu profesional dengan chemical khusus ramah material. Tersedia pilihan <strong class="text-white font-semibold">Fast Clean</strong>, <strong class="text-white font-semibold">Deep Clean</strong>, hingga <strong class="text-white font-semibold">Suede Treatment</strong> dengan layanan pickup praktis.
                </p>

                <!-- CTA Action Buttons -->
                <div class="flex flex-wrap items-center gap-4">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                               class="bg-white text-blue-700 hover:bg-blue-50 font-bold py-3.5 px-8 rounded-2xl transition-all duration-200 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 hover:scale-105 active:scale-95 text-sm sm:text-base flex items-center gap-2">
                                📊 Buka Panel Admin
                            </a>
                        @else
                            <a href="{{ route('customer.orders.create') }}"
                               class="bg-white text-blue-700 hover:bg-blue-50 font-bold py-3.5 px-8 rounded-2xl transition-all duration-200 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 hover:scale-105 active:scale-95 text-sm sm:text-base flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                Pesan Cuci Sekarang
                            </a>
                        @endif
                    @else
                        <a href="{{ route('register') }}"
                           class="bg-white text-blue-700 hover:bg-blue-50 font-black py-3.5 px-8 rounded-2xl transition-all duration-200 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 hover:scale-105 active:scale-95 text-sm sm:text-base">
                            Mulai Pesan Sekarang →
                        </a>
                        <a href="{{ route('login') }}"
                           class="bg-white/10 hover:bg-white/20 border-2 border-white/30 hover:border-white text-white font-bold py-3.5 px-7 rounded-2xl transition-all duration-200 backdrop-blur-md text-sm sm:text-base transform hover:-translate-y-0.5">
                            Masuk Akun
                        </a>
                    @endauth
                </div>

                <!-- Verified Stats -->
                <div class="flex flex-wrap items-center gap-8 pt-10 mt-10 border-t border-white/20 max-w-lg">
                    <div>
                        <div class="text-3xl font-black text-white">500+</div>
                        <div class="text-xs text-blue-200 font-semibold mt-0.5">Pelanggan Aktif</div>
                    </div>
                    <div class="w-px h-10 bg-white/20"></div>
                    <div>
                        <div class="text-3xl font-black text-white">2.500+</div>
                        <div class="text-xs text-blue-200 font-semibold mt-0.5">Sepatu Dicuci</div>
                    </div>
                    <div class="w-px h-10 bg-white/20"></div>
                    <div>
                        <div class="text-3xl font-black text-amber-300 flex items-center gap-1">
                            <span>4.9</span>
                            <span class="text-xl">★</span>
                        </div>
                        <div class="text-xs text-blue-200 font-semibold mt-0.5">Rating Kepuasan</div>
                    </div>
                </div>
            </div>

            <!-- Right Visual Interactive Floating Card -->
            <div class="lg:col-span-5 flex justify-center lg:justify-end animate-slide-up">
                <div class="relative w-full max-w-md">
                    
                    <!-- Main Showcase Card with smooth float animation -->
                    <div class="bg-white/15 backdrop-blur-xl rounded-3xl p-8 border border-white/30 shadow-2xl animate-float">
                        <div class="text-center mb-6">
                            <div class="text-6xl mb-3 transform hover:scale-110 transition-transform duration-300 cursor-pointer">👟</div>
                            <h3 class="text-white font-extrabold text-2xl tracking-tight">Fast Clean</h3>
                            <p class="text-blue-100 text-sm mt-1">Selesai cepat 1 hari kerja</p>
                        </div>

                        <div class="space-y-3 bg-white/10 rounded-2xl p-4 border border-white/15">
                            <div class="flex items-center gap-3 text-white text-sm font-medium">
                                <div class="w-6 h-6 bg-emerald-400 text-blue-900 rounded-full flex items-center justify-center flex-shrink-0 font-bold text-xs">✓</div>
                                <span>Cuci bersih menyeluruh luar & sol</span>
                            </div>
                            <div class="flex items-center gap-3 text-white text-sm font-medium">
                                <div class="w-6 h-6 bg-emerald-400 text-blue-900 rounded-full flex items-center justify-center flex-shrink-0 font-bold text-xs">✓</div>
                                <span>Formula aman ramah material sepatu</span>
                            </div>
                            <div class="flex items-center gap-3 text-white text-sm font-medium">
                                <div class="w-6 h-6 bg-emerald-400 text-blue-900 rounded-full flex items-center justify-center flex-shrink-0 font-bold text-xs">✓</div>
                                <span>Garansi wangi, bersih, dan higienis</span>
                            </div>
                        </div>

                        <div class="mt-6 text-center">
                            <span class="text-3xl sm:text-4xl font-black text-white">Rp 35.000</span>
                            <span class="text-blue-200 text-sm font-medium">/ pasang</span>
                        </div>

                        <div class="mt-5">
                            <a href="{{ auth()->check() ? route('customer.orders.create') : route('register') }}"
                               class="w-full text-center block bg-white text-blue-700 hover:bg-blue-50 font-bold py-3 px-6 rounded-xl transition-all shadow-md hover:shadow-lg text-sm">
                                Pesan Layanan Ini
                            </a>
                        </div>
                    </div>

                    <!-- Floating Badge: Terlaris -->
                    <div class="absolute -top-4 -right-4 bg-amber-400 text-slate-900 rounded-2xl px-4 py-2 text-xs font-black shadow-xl animate-bounce-soft flex items-center gap-1.5 border border-amber-300">
                        <span>🔥</span>
                        <span>Terlaris!</span>
                    </div>

                    <!-- Floating Badge: Real-time Order Finished -->
                    <div class="absolute -bottom-6 -left-6 bg-white text-slate-900 rounded-2xl p-3.5 shadow-2xl flex items-center gap-3.5 border border-slate-100 hidden sm:flex">
                        <div class="w-9 h-9 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-900 leading-tight">Pesanan Selesai!</p>
                            <p class="text-[11px] text-slate-500 font-medium mt-0.5">Sepatu siap dijemput/diantar</p>
                        </div>
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
                Layanan Kami
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mt-4 mb-3">
                Pilih Layanan <span class="text-blue-600">Terbaik</span> Untuk Sepatu Anda
            </h2>
            <p class="text-slate-500 text-sm sm:text-base leading-relaxed">
                Tiga pilihan layanan cuci sepatu profesional yang disesuaikan dengan kebutuhan dan material sepatu Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="card p-8 text-center group hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border-2 border-slate-100 hover:border-blue-400 flex flex-col justify-between">
                <div>
                    <div class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300
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
                        @if($service->service_type === 'fast_clean') bg-blue-100 text-blue-700
                        @elseif($service->service_type === 'deep_clean') bg-indigo-100 text-indigo-700
                        @else bg-purple-100 text-purple-700 @endif">
                        ⏱️ {{ $service->estimated_days }} hari pengerjaan
                    </div>

                    <h3 class="text-2xl font-black text-slate-900 mb-3">{{ $service->service_name }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">{{ $service->description }}</p>
                </div>

                <div class="pt-6 border-t border-slate-100">
                    <div class="text-3xl font-black text-blue-600 mb-5">
                        Rp {{ number_format($service->price_per_pair, 0, ',', '.') }}
                        <span class="text-sm font-normal text-slate-400">/pasang</span>
                    </div>

                    <a href="{{ auth()->check() ? route('customer.orders.create') : route('register') }}"
                       class="btn-primary w-full text-sm py-3 font-bold group-hover:shadow-lg">
                        Pesan Layanan Ini
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- How it Works -->
<section id="how-it-works" class="py-24 bg-blue-50/60 border-y border-blue-100/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-600 bg-white px-3.5 py-1.5 rounded-full border border-blue-200">
                Cara Kerja
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mt-4 mb-2">
                Mudah & <span class="text-blue-600">Cepat</span>
            </h2>
            <p class="text-slate-500 text-sm">Hanya butuh 4 langkah mudah sampai sepatu Anda bersih kembali.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
            @foreach([
                ['step' => '01', 'icon' => '📋', 'title' => 'Pilih Layanan', 'desc' => 'Pilih Fast Clean, Deep Clean, atau Suede Treatment sesuai kondisi sepatu Anda.'],
                ['step' => '02', 'icon' => '🚗', 'title' => 'Antar / Pickup', 'desc' => 'Antar langsung ke outlet kami atau gunakan opsi jemput kurir ke lokasi Anda.'],
                ['step' => '03', 'icon' => '🧽', 'title' => 'Proses Cuci', 'desc' => 'Tim ahli kami memproses sepatu dengan produk premium dan chemical aman material.'],
                ['step' => '04', 'icon' => '✅', 'title' => 'Bersih & Wangi', 'desc' => 'Sepatu siap diambil kembali atau kami antar ke rumah dalam kondisi prima!'],
            ] as $item)
            <div class="card p-6 text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative border border-blue-100">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl shadow-sm flex items-center justify-center mx-auto mb-4 text-3xl border border-blue-100">
                    {{ $item['icon'] }}
                </div>
                <div class="text-xs font-black text-blue-600 tracking-wider mb-1">LANGKAH {{ $item['step'] }}</div>
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
                Harga Transparan
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mt-4 mb-2">
                Harga <span class="text-blue-600">Terjangkau</span>, Kualitas Premium
            </h2>
            <p class="text-slate-500 text-sm">Daftar harga transparan per pasang sepatu tanpa biaya tersembunyi.</p>
        </div>

        <div class="card overflow-hidden border border-slate-200 shadow-xl">
            <div class="bg-[#1a56db] p-6 text-white flex items-center justify-between">
                <div>
                    <h3 class="text-white font-black text-lg">Daftar Harga Layanan</h3>
                    <p class="text-blue-100 text-xs mt-0.5">Harga per pasang sepatu</p>
                </div>
                <span class="text-xs font-bold bg-white/20 backdrop-blur-md px-3 py-1 rounded-full border border-white/25">
                    Garansi Bersih 100%
                </span>
            </div>

            <div class="divide-y divide-slate-100">
                <div class="flex items-center justify-between p-6 hover:bg-blue-50/50 transition-colors">
                    <div class="flex items-center gap-4">
                        <span class="text-3xl">⚡</span>
                        <div>
                            <div class="font-bold text-slate-900 text-base">Fast Clean</div>
                            <div class="text-xs text-slate-500">Pengerjaan cepat 1 hari</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-black text-xl text-blue-600">Rp 35.000</div>
                        <div class="text-xs text-slate-400">/pasang</div>
                    </div>
                </div>

                <div class="flex items-center justify-between p-6 bg-blue-50/40 hover:bg-blue-50/70 transition-colors">
                    <div class="flex items-center gap-4">
                        <span class="text-3xl">🧼</span>
                        <div>
                            <div class="font-bold text-slate-900 text-base flex items-center gap-2">
                                <span>Deep Clean</span>
                                <span class="text-[10px] bg-blue-600 text-white font-bold px-2 py-0.5 rounded-full">Favorit</span>
                            </div>
                            <div class="text-xs text-slate-500">Pembersihan mendalam 2-3 hari</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-black text-xl text-blue-600">Rp 65.000</div>
                        <div class="text-xs text-slate-400">/pasang</div>
                    </div>
                </div>

                <div class="flex items-center justify-between p-6 hover:bg-blue-50/50 transition-colors">
                    <div class="flex items-center gap-4">
                        <span class="text-3xl">✨</span>
                        <div>
                            <div class="font-bold text-slate-900 text-base">Suede Treatment</div>
                            <div class="text-xs text-slate-500">Bahan kulit / suede 3-4 hari</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-black text-xl text-blue-600">Rp 95.000</div>
                        <div class="text-xs text-slate-400">/pasang</div>
                    </div>
                </div>

                <div class="flex items-center justify-between p-6 bg-slate-50">
                    <div class="flex items-center gap-4">
                        <span class="text-3xl">🚗</span>
                        <div>
                            <div class="font-bold text-slate-900 text-base">Biaya Penjemputan (Pickup)</div>
                            <div class="text-xs text-slate-500">Jemput langsung ke alamat rumah Anda</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-black text-lg text-slate-700">+ Rp 15.000</div>
                        <div class="text-xs text-slate-400">per pesanan</div>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-blue-50/60 border-t border-slate-100 text-center">
                <a href="{{ auth()->check() ? route('customer.orders.create') : route('register') }}"
                   class="btn-primary py-3 px-8 text-sm font-bold shadow-md hover:shadow-lg inline-block">
                    Pesan Sekarang →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section id="testimonials" class="py-24 bg-[#1141a3] text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-200 bg-white/10 px-3.5 py-1.5 rounded-full border border-white/20">
                Testimoni
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight mt-4">Yang Mereka Katakan</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['name' => 'Budi Santoso', 'role' => 'Sneaker Enthusiast', 'text' => 'Sepatu Nike Air Jordan saya dibersihkan dengan sangat baik. Hasilnya seperti baru lagi! Recommended banget!', 'rating' => 5],
                ['name' => 'Sari Dewi', 'role' => 'Professional', 'text' => 'Layanan Suede Treatment-nya luar biasa. Suede shoes saya yang sudah kusam jadi kembali cerah. Worth it!', 'rating' => 5],
                ['name' => 'Ahmad Rizky', 'role' => 'Pelanggan Setia', 'text' => 'Sudah 3x order di Dr. Sepatu. Selalu puas dengan hasilnya, cepat, dan harganya terjangkau!', 'rating' => 5],
            ] as $testimonial)
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-7 border border-white/15 flex flex-col justify-between hover:bg-white/15 transition-all">
                <div>
                    <div class="flex items-center gap-1 mb-4 text-amber-300">
                        @for($i = 0; $i < $testimonial['rating']; $i++)
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-blue-100 italic mb-6 leading-relaxed text-sm">"{{ $testimonial['text'] }}"</p>
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-white/15">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-300 to-blue-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                        {{ strtoupper(substr($testimonial['name'], 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-bold text-white text-sm">{{ $testimonial['name'] }}</p>
                        <p class="text-blue-200 text-xs">{{ $testimonial['role'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Bottom CTA -->
<section class="py-20 bg-[#1a56db] text-white relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <h2 class="text-3xl sm:text-4xl font-black mb-4">Siap Bersihkan Sepatu Anda?</h2>
        <p class="text-blue-100 text-base sm:text-lg mb-8 max-w-lg mx-auto">Daftar sekarang dan dapatkan layanan terbaik untuk sepatu kesayangan Anda.</p>
        <div class="flex flex-wrap gap-4 justify-center">
            @guest
                <a href="{{ route('register') }}"
                   class="bg-white text-blue-700 hover:bg-blue-50 font-bold py-3.5 px-8 rounded-2xl transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1 transform duration-200 text-sm sm:text-base">
                    Daftar Gratis Sekarang
                </a>
                <a href="{{ route('login') }}"
                   class="bg-white/10 border-2 border-white/40 text-white hover:bg-white/20 font-semibold py-3.5 px-8 rounded-2xl transition-all duration-200 text-sm sm:text-base">
                    Masuk ke Akun
                </a>
            @else
                <a href="{{ route('customer.orders.create') }}"
                   class="bg-white text-blue-700 hover:bg-blue-50 font-bold py-3.5 px-8 rounded-2xl transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1 transform duration-200 text-sm sm:text-base">
                    Pesan Sekarang!
                </a>
            @endguest
        </div>
    </div>
</section>
@endsection
