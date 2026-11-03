@extends('layouts.app')

@section('title', 'Dr. Sepatu - Laundry Sepatu Profesional')

@section('content')
<!-- Hero Section -->
<section class="bg-hero relative overflow-hidden min-h-screen flex items-center">
    <!-- Decorative blobs -->
    <div class="absolute top-20 right-10 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 left-10 w-72 h-72 bg-blue-400/10 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-white/3 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 w-full relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="animate-fade-in">
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur rounded-full px-4 py-2 text-blue-200 text-sm font-medium mb-6 border border-white/20">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    Melayani 500+ Pelanggan Puas
                </div>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white leading-tight mb-6">
                    Sepatu Kotor?<br>
                    <span class="text-blue-300">Kami Ahlinya!</span>
                </h1>
                <p class="text-blue-100 text-xl leading-relaxed mb-8 max-w-lg">
                    Cuci sepatu profesional dengan 3 layanan unggulan. Fast Clean, Deep Clean, hingga Suede Treatment. Jemput antar tersedia!
                </p>
                <div class="flex flex-wrap gap-4">
                    @auth
                        <a href="{{ route('customer.orders.create') }}" class="bg-white text-blue-700 hover:bg-blue-50 font-bold py-4 px-8 rounded-2xl transition-all duration-200 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Pesan Sekarang
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="bg-white text-blue-700 hover:bg-blue-50 font-bold py-4 px-8 rounded-2xl transition-all duration-200 shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                            Mulai Sekarang - Gratis!
                        </a>
                        <a href="{{ route('login') }}" class="bg-white/10 border-2 border-white/40 text-white hover:bg-white/20 font-semibold py-4 px-8 rounded-2xl transition-all duration-200 backdrop-blur">
                            Sudah Punya Akun?
                        </a>
                    @endauth
                </div>

                <!-- Stats -->
                <div class="flex flex-wrap gap-8 mt-12">
                    <div class="text-center">
                        <div class="text-3xl font-black text-white">500+</div>
                        <div class="text-blue-200 text-sm">Pelanggan</div>
                    </div>
                    <div class="w-px bg-blue-600"></div>
                    <div class="text-center">
                        <div class="text-3xl font-black text-white">2000+</div>
                        <div class="text-blue-200 text-sm">Sepatu Dicuci</div>
                    </div>
                    <div class="w-px bg-blue-600"></div>
                    <div class="text-center">
                        <div class="text-3xl font-black text-white">4.9★</div>
                        <div class="text-blue-200 text-sm">Rating Kepuasan</div>
                    </div>
                </div>
            </div>

            <!-- Hero Visual -->
            <div class="hidden lg:flex justify-center animate-slide-up">
                <div class="relative">
                    <!-- Main card -->
                    <div class="bg-white/10 backdrop-blur-md rounded-3xl p-8 border border-white/20 shadow-2xl">
                        <div class="text-center mb-6">
                            <div class="text-6xl mb-4">👟</div>
                            <h3 class="text-white font-bold text-xl">Fast Clean</h3>
                            <p class="text-blue-200 text-sm mt-1">Selesai 1 hari kerja</p>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 text-blue-100 text-sm">
                                <div class="w-6 h-6 bg-green-400/20 rounded-full flex items-center justify-center">
                                    <svg class="w-3 h-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                Cuci bersih menyeluruh
                            </div>
                            <div class="flex items-center gap-3 text-blue-100 text-sm">
                                <div class="w-6 h-6 bg-green-400/20 rounded-full flex items-center justify-center">
                                    <svg class="w-3 h-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                Produk ramah sepatu
                            </div>
                            <div class="flex items-center gap-3 text-blue-100 text-sm">
                                <div class="w-6 h-6 bg-green-400/20 rounded-full flex items-center justify-center">
                                    <svg class="w-3 h-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                Garansi kepuasan
                            </div>
                        </div>
                        <div class="mt-6 text-center">
                            <span class="text-3xl font-black text-white">Rp 35.000</span>
                            <span class="text-blue-200 text-sm">/pasang</span>
                        </div>
                    </div>

                    <!-- Floating badge -->
                    <div class="absolute -top-4 -right-4 bg-yellow-400 text-yellow-900 rounded-2xl px-4 py-2 text-sm font-bold shadow-lg animate-bounce-soft">
                        🔥 Terlaris!
                    </div>

                    <!-- Floating notification -->
                    <div class="absolute -bottom-6 -left-6 bg-white rounded-xl p-3 shadow-xl flex items-center gap-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-900">Pesanan Selesai!</p>
                            <p class="text-xs text-gray-500">2 menit yang lalu</p>
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
        <div class="text-center mb-16">
            <span class="text-blue-600 font-semibold text-sm uppercase tracking-widest">Layanan Kami</span>
            <h2 class="text-4xl font-black text-gray-900 mt-2 mb-4">Pilih Layanan <span class="text-gradient">Terbaik</span> Untuk Sepatu Anda</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Tiga pilihan layanan cuci sepatu profesional yang disesuaikan dengan kebutuhan dan material sepatu Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="card p-8 text-center group hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border-2 border-transparent hover:border-blue-200">
                <div class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300
                    @if($service->service_type === 'fast_clean') bg-blue-100
                    @elseif($service->service_type === 'deep_clean') bg-indigo-100
                    @else bg-purple-100 @endif">
                    @if($service->service_type === 'fast_clean')
                        <span class="text-4xl">⚡</span>
                    @elseif($service->service_type === 'deep_clean')
                        <span class="text-4xl">🧼</span>
                    @else
                        <span class="text-4xl">✨</span>
                    @endif
                </div>
                <div class="inline-block px-3 py-1 rounded-full text-xs font-semibold mb-3
                    @if($service->service_type === 'fast_clean') bg-blue-100 text-blue-700
                    @elseif($service->service_type === 'deep_clean') bg-indigo-100 text-indigo-700
                    @else bg-purple-100 text-purple-700 @endif">
                    {{ $service->estimated_days }} hari pengerjaan
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-3">{{ $service->service_name }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-6">{{ $service->description }}</p>
                <div class="text-3xl font-black text-blue-600 mb-6">
                    Rp {{ number_format($service->price_per_pair, 0, ',', '.') }}
                    <span class="text-base font-normal text-gray-400">/pasang</span>
                </div>
                <a href="{{ auth()->check() ? route('customer.orders.create') : route('register') }}"
                   class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 group-hover:shadow-lg">
                    Pesan Layanan Ini
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- How it Works -->
<section id="how-it-works" class="py-24 bg-blue-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-blue-600 font-semibold text-sm uppercase tracking-widest">Cara Kerja</span>
            <h2 class="text-4xl font-black text-gray-900 mt-2 mb-4">Mudah & <span class="text-gradient">Cepat</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
            <!-- Connector line -->
            <div class="hidden md:block absolute top-10 left-[12.5%] right-[12.5%] h-0.5 bg-blue-200 -z-0"></div>

            @foreach([
                ['step' => '01', 'icon' => '📋', 'title' => 'Pilih Layanan', 'desc' => 'Pilih Fast Clean, Deep Clean, atau Suede Treatment sesuai kondisi sepatu Anda.'],
                ['step' => '02', 'icon' => '🚗', 'title' => 'Antar / Pickup', 'desc' => 'Antar langsung ke toko kami atau manfaatkan layanan pickup gratis area tertentu.'],
                ['step' => '03', 'icon' => '🧽', 'title' => 'Proses Cuci', 'desc' => 'Tim ahli kami memproses sepatu dengan produk premium dan teknik terpercaya.'],
                ['step' => '04', 'icon' => '✅', 'title' => 'Bersih & Wangi', 'desc' => 'Sepatu siap diambil atau kami antar langsung ke rumah Anda!'],
            ] as $item)
            <div class="text-center relative z-10">
                <div class="w-20 h-20 bg-white rounded-2xl shadow-lg flex items-center justify-center mx-auto mb-4 text-3xl border-2 border-blue-100">
                    {{ $item['icon'] }}
                </div>
                <div class="text-xs font-bold text-blue-400 mb-1">LANGKAH {{ $item['step'] }}</div>
                <h3 class="font-bold text-gray-900 mb-2">{{ $item['title'] }}</h3>
                <p class="text-gray-500 text-sm">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section id="pricing" class="py-24 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-blue-600 font-semibold text-sm uppercase tracking-widest">Harga Transparan</span>
            <h2 class="text-4xl font-black text-gray-900 mt-2 mb-4">Harga <span class="text-gradient">Terjangkau</span>, Kualitas Premium</h2>
        </div>

        <div class="card overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-6">
                <h3 class="text-white font-bold text-lg">Daftar Harga Layanan</h3>
                <p class="text-blue-200 text-sm">Harga per pasang sepatu</p>
            </div>
            <div class="divide-y divide-gray-100">
                <div class="flex items-center justify-between p-6 hover:bg-blue-50 transition-colors">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl">⚡</span>
                        <div>
                            <div class="font-bold text-gray-900">Fast Clean</div>
                            <div class="text-sm text-gray-500">Pengerjaan 1 hari</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-black text-xl text-blue-600">Rp 35.000</div>
                        <div class="text-xs text-gray-400">/pasang</div>
                    </div>
                </div>
                <div class="flex items-center justify-between p-6 hover:bg-blue-50 transition-colors bg-blue-50/50">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl">🧼</span>
                        <div>
                            <div class="font-bold text-gray-900">Deep Clean</div>
                            <div class="text-sm text-gray-500">Pengerjaan 2-3 hari</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-black text-xl text-blue-600">Rp 65.000</div>
                        <div class="text-xs text-gray-400">/pasang</div>
                    </div>
                </div>
                <div class="flex items-center justify-between p-6 hover:bg-blue-50 transition-colors">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl">✨</span>
                        <div>
                            <div class="font-bold text-gray-900">Suede Treatment</div>
                            <div class="text-sm text-gray-500">Pengerjaan 3-4 hari</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-black text-xl text-blue-600">Rp 95.000</div>
                        <div class="text-xs text-gray-400">/pasang</div>
                    </div>
                </div>
                <div class="flex items-center justify-between p-6 bg-gray-50">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl">🚗</span>
                        <div>
                            <div class="font-bold text-gray-900">Biaya Pickup</div>
                            <div class="text-sm text-gray-500">Jemput ke lokasi Anda</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-black text-xl text-gray-600">+ Rp 15.000</div>
                        <div class="text-xs text-gray-400">per pengambilan</div>
                    </div>
                </div>
            </div>
            <div class="p-6 bg-blue-600 text-center">
                <a href="{{ auth()->check() ? route('customer.orders.create') : route('register') }}"
                   class="inline-block bg-white text-blue-700 hover:bg-blue-50 font-bold py-3 px-8 rounded-xl transition-all duration-200 shadow-md hover:shadow-lg">
                    Pesan Sekarang →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-24 bg-blue-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-blue-400 font-semibold text-sm uppercase tracking-widest">Testimoni</span>
            <h2 class="text-4xl font-black text-white mt-2">Yang Mereka Katakan</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['name' => 'Budi Santoso', 'role' => 'Sneaker Enthusiast', 'text' => 'Sepatu Nike Air Jordan saya dibersihkan dengan sangat baik. Hasilnya seperti baru lagi! Recommended banget!', 'rating' => 5],
                ['name' => 'Sari Dewi', 'role' => 'Professional', 'text' => 'Layanan Suede Treatment-nya luar biasa. Suede shoes saya yang sudah kusam jadi kembali cerah. Worth it!', 'rating' => 5],
                ['name' => 'Ahmad Rizky', 'role' => 'Pelanggan Setia', 'text' => 'Sudah 3x order di Dr. Sepatu. Selalu puas dengan hasilnya, cepat, dan harganya terjangkau!', 'rating' => 5],
            ] as $testimonial)
            <div class="bg-white/5 backdrop-blur rounded-2xl p-8 border border-white/10">
                <div class="flex items-center gap-1 mb-4">
                    @for($i = 0; $i < $testimonial['rating']; $i++)
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <p class="text-blue-100 italic mb-6 leading-relaxed">"{{ $testimonial['text'] }}"</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr($testimonial['name'], 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-white">{{ $testimonial['name'] }}</p>
                        <p class="text-blue-400 text-sm">{{ $testimonial['role'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-gradient-to-r from-blue-600 to-blue-800">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-4xl font-black text-white mb-4">Siap Bersihkan Sepatu Anda?</h2>
        <p class="text-blue-100 text-lg mb-8">Daftar sekarang dan dapatkan layanan terbaik untuk sepatu kesayangan Anda.</p>
        <div class="flex flex-wrap gap-4 justify-center">
            @guest
                <a href="{{ route('register') }}" class="bg-white text-blue-700 hover:bg-blue-50 font-bold py-4 px-8 rounded-2xl transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1 transform duration-200">
                    Daftar Gratis Sekarang
                </a>
                <a href="{{ route('login') }}" class="bg-white/10 border-2 border-white/40 text-white hover:bg-white/20 font-semibold py-4 px-8 rounded-2xl transition-all duration-200">
                    Masuk ke Akun
                </a>
            @else
                <a href="{{ route('customer.orders.create') }}" class="bg-white text-blue-700 hover:bg-blue-50 font-bold py-4 px-8 rounded-2xl transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1 transform duration-200">
                    Pesan Sekarang!
                </a>
            @endguest
        </div>
    </div>
</section>
@endsection
