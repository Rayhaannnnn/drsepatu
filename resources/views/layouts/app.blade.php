<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dr. Sepatu - Layanan cuci sepatu profesional dengan Fast Clean, Deep Clean, dan Suede Treatment. Jemput antar tersedia!">
    <title>@yield('title', 'Dr. Sepatu - Laundry Sepatu Profesional')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('styles')
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-800">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/85 backdrop-blur-md border-b border-slate-200/70 shadow-xs transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-18">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl flex items-center justify-center shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform duration-200">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-xl font-extrabold tracking-tight text-slate-900">Dr.<span class="text-blue-600">Sepatu</span></span>
                        <span class="hidden sm:inline-block ml-1.5 text-[10px] font-bold uppercase tracking-wider px-1.5 py-0.5 rounded bg-blue-50 text-blue-700 border border-blue-200/60">Laundry</span>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <div class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
                    <a href="{{ route('home') }}#services" class="hover:text-blue-600 transition-colors">Layanan</a>
                    <a href="{{ route('home') }}#how-it-works" class="hover:text-blue-600 transition-colors">Cara Kerja</a>
                    <a href="{{ route('home') }}#pricing" class="hover:text-blue-600 transition-colors">Daftar Harga</a>
                    <a href="{{ route('home') }}#testimonials" class="hover:text-blue-600 transition-colors">Testimoni</a>
                </div>

                <!-- Auth Buttons (Desktop) -->
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="btn-primary py-2 px-4 text-xs font-semibold">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                Panel Admin
                            </a>
                        @else
                            <a href="{{ route('customer.dashboard') }}" class="text-slate-700 hover:text-blue-600 font-semibold text-xs py-2 px-3 transition-colors">
                                Dashboard
                            </a>
                            <a href="{{ route('customer.orders.create') }}" class="btn-primary py-2 px-4 text-xs font-semibold">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Pesan Cuci
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-slate-700 hover:text-blue-600 font-semibold text-xs py-2 px-3.5 transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-primary py-2 px-4 text-xs font-semibold">Daftar Akun</a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex md:hidden items-center">
                    <button type="button" id="mobileMenuBtn" class="p-2 rounded-xl text-slate-600 hover:text-blue-600 hover:bg-slate-100 focus:outline-none" aria-label="Toggle Menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobileMenu" class="hidden md:hidden border-t border-slate-200/80 bg-white/95 backdrop-blur-md px-4 pt-3 pb-5 space-y-3 shadow-lg">
            <div class="flex flex-col space-y-2 text-sm font-semibold text-slate-700">
                <a href="{{ route('home') }}#services" class="px-3 py-2 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition-colors">Layanan</a>
                <a href="{{ route('home') }}#how-it-works" class="px-3 py-2 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition-colors">Cara Kerja</a>
                <a href="{{ route('home') }}#pricing" class="px-3 py-2 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition-colors">Daftar Harga</a>
                <a href="{{ route('home') }}#testimonials" class="px-3 py-2 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition-colors">Testimoni</a>
            </div>
            <div class="pt-3 border-t border-slate-100 flex flex-col gap-2">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn-primary w-full text-center py-2.5 text-xs">Panel Admin</a>
                    @else
                        <a href="{{ route('customer.dashboard') }}" class="btn-secondary w-full text-center py-2 text-xs">Dashboard Saya</a>
                        <a href="{{ route('customer.orders.create') }}" class="btn-primary w-full text-center py-2 text-xs">Pesan Sekarang</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-secondary w-full text-center py-2 text-xs">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-primary w-full text-center py-2 text-xs">Daftar Gratis</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="pt-18">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-950 text-white relative overflow-hidden">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2.5 mb-4">
                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-md shadow-blue-500/20">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-black text-white">Dr.<span class="text-blue-400">Sepatu</span></span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-sm mb-6">
                        Solusi profesional perawatan dan pencucian sepatu dengan standar higienis tertinggi, formula aman material, dan hasil maksimal seperti baru.
                    </p>
                    <div class="flex items-center gap-2.5 text-xs text-slate-300">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-900 border border-slate-800">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Buka Setiap Hari (08:00 - 20:00 WIB)
                        </span>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-white text-sm uppercase tracking-wider mb-4">Layanan Utama</h4>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="{{ route('home') }}#services" class="hover:text-blue-400 transition-colors flex items-center gap-1.5">⚡ Fast Clean (1 Hari)</a></li>
                        <li><a href="{{ route('home') }}#services" class="hover:text-blue-400 transition-colors flex items-center gap-1.5">🧼 Deep Clean Total</a></li>
                        <li><a href="{{ route('home') }}#services" class="hover:text-blue-400 transition-colors flex items-center gap-1.5">✨ Suede Treatment</a></li>
                        <li><a href="{{ route('home') }}#pricing" class="hover:text-blue-400 transition-colors flex items-center gap-1.5">🚗 Layanan Pickup & Antar</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-white text-sm uppercase tracking-wider mb-4">Hubungi Kami</h4>
                    <ul class="space-y-3 text-sm text-slate-400">
                        <li class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400 flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <span>+62 812-3456-7890</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400 flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <span>hello@drsepatu.com</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400 flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <span>Jl. Sepatu Bersih No. 1, Jakarta</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-800/80 mt-12 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                <p>© {{ date('Y') }} Dr. Sepatu. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <a href="#" class="hover:text-slate-300 transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-slate-300 transition-colors">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            if (mobileBtn && mobileMenu) {
                mobileBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
