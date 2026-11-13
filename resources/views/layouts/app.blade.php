<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
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
                    @auth
                        @if(auth()->user()->isCustomer())
                            <a href="{{ route('customer.chat.index') }}" class="hover:text-blue-600 transition-colors flex items-center gap-1.5 text-blue-600">
                                <span>Konsultasi Sepatu</span>
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            </a>
                        @endif
                    @endauth
                </div>

                <!-- Auth Buttons (Desktop) -->
                <div class="hidden md:flex items-center gap-3">
                    @auth
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="btn-primary py-2 px-4 text-xs font-semibold">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Panel Admin
                    </a>
                    @else
                    <a href="{{ route('customer.dashboard') }}" class="text-slate-700 hover:text-blue-600 font-semibold text-xs py-2 px-3 transition-colors">
                        Dashboard
                    </a>
                    <a href="{{ route('customer.orders.create') }}" class="btn-primary py-2 px-4 text-xs font-semibold">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
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
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <span>+62 813-3101-4572</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400 flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span>rayhan21.kusuma@gmail.com</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400 flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <span>Jl. Taman Pasadena C4-01 Gedangan Sidoarjo</span>
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

    <!-- Floating Live Chat Widget Launcher -->
    <div id="liveChatWidget" class="fixed bottom-6 right-6 z-50 flex flex-col items-end">
        
        <!-- Live Chat Box (Popup) -->
        <div id="chatBoxPopup" class="hidden mb-4 w-96 max-w-[calc(100vw-2rem)] h-[500px] bg-white rounded-3xl shadow-2xl border border-slate-200/90 flex flex-col overflow-hidden animate-slide-up transition-all">
            <!-- Header -->
            <div class="px-5 py-4 bg-[#1a56db] text-white flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center font-bold text-sm">
                            👟
                        </div>
                        <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-400 border-2 border-[#1a56db] rounded-full"></span>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-white leading-tight">Live Chat & Konsultasi</h4>
                        <p class="text-[11px] text-blue-100 flex items-center gap-1 mt-0.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>Admin Dr. Sepatu Aktif</span>
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-1">
                    @auth
                        @if(auth()->user()->isCustomer())
                            <a href="{{ route('customer.chat.index') }}" title="Buka Halaman Penuh" class="text-white/80 hover:text-white p-1.5 rounded-lg hover:bg-white/10 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        @endif
                    @endauth
                    <button type="button" id="closeChatBtn" class="text-white/80 hover:text-white p-1.5 rounded-lg hover:bg-white/10 transition-colors" aria-label="Close Chat">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            @auth
                @if(auth()->user()->isCustomer())
                    <!-- Customer Active Chat Stream -->
                    <div id="widgetMessages" class="flex-1 p-4 overflow-y-auto space-y-3 bg-slate-50 text-xs">
                        <!-- Welcome message -->
                        <div class="flex items-start gap-2.5 max-w-[85%]">
                            <div class="w-7 h-7 rounded-lg bg-[#1a56db] text-white flex items-center justify-center font-bold text-[10px] flex-shrink-0 shadow-xs">
                                DS
                            </div>
                            <div class="bg-white p-3 rounded-2xl rounded-tl-xs border border-slate-200/80 text-slate-700 shadow-xs space-y-1">
                                <p class="font-bold text-blue-700">Halo kak {{ auth()->user()->name }}! 👋</p>
                                <p>Silakan tanyakan seputar kondisi sepatu, bahan, noda, atau paket cuci yang cocok sebelum memesan ya.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick consultation chips in widget -->
                    <div class="px-3 py-2 bg-slate-100/90 border-t border-slate-200/60 flex items-center gap-1.5 overflow-x-auto no-scrollbar text-[11px]">
                        <button type="button" class="widget-chip bg-white hover:bg-blue-50 hover:text-blue-600 text-slate-600 px-2.5 py-1 rounded-lg border border-slate-200 whitespace-nowrap transition-all">
                            Bisa cuci bahan Suede?
                        </button>
                        <button type="button" class="widget-chip bg-white hover:bg-blue-50 hover:text-blue-600 text-slate-600 px-2.5 py-1 rounded-lg border border-slate-200 whitespace-nowrap transition-all">
                            Berapa lama pengerjaan?
                        </button>
                        <button type="button" class="widget-chip bg-white hover:bg-blue-50 hover:text-blue-600 text-slate-600 px-2.5 py-1 rounded-lg border border-slate-200 whitespace-nowrap transition-all">
                            Ada layanan pickup?
                        </button>
                    </div>

                    <!-- Chat Form in widget -->
                    <div class="p-3 bg-white border-t border-slate-200">
                        <form id="widgetChatForm" class="flex items-center gap-2">
                            @csrf
                            <input type="text" id="widgetMessageInput" placeholder="Ketik pesan konsultasi..."
                                   class="flex-1 px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-100">
                            <button type="submit" id="widgetSendBtn" class="bg-[#1a56db] hover:bg-blue-700 text-white p-2 rounded-xl transition-all shadow-xs disabled:opacity-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </form>
                    </div>
                @else
                    <!-- Admin view notice -->
                    <div class="flex-1 p-6 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl mb-3">
                            👑
                        </div>
                        <h4 class="font-bold text-slate-800 text-sm mb-1">Anda Sedang Login Sebagai Admin</h4>
                        <p class="text-xs text-slate-500 mb-4">Silakan kelola seluruh percakapan pelanggan melalui panel admin.</p>
                        <a href="{{ route('admin.chats.index') }}" class="btn-primary py-2 px-4 text-xs font-bold">
                            Buka Panel Chat Admin
                        </a>
                    </div>
                @endif
            @else
                <!-- Guest View: Prompt to Login / Register -->
                <div class="flex-1 p-6 flex flex-col justify-between text-center bg-slate-50/50">
                    <div>
                        <div class="w-16 h-16 rounded-3xl bg-blue-50 border border-blue-100 text-[#1a56db] flex items-center justify-center text-3xl mx-auto mb-4 shadow-sm">
                            💬
                        </div>
                        <h4 class="font-black text-slate-900 text-base mb-2">Konsultasi Sepatu dengan Ahli Kami</h4>
                        <p class="text-xs text-slate-500 leading-relaxed max-w-xs mx-auto mb-6">
                            Bingung memilih paket cuci atau punya sepatu bermasalah (luntur, jamur, noda oli)? Masuk ke akun Anda untuk chat langsung dengan CS kami.
                        </p>
                    </div>

                    <div class="space-y-2.5">
                        <a href="{{ route('login') }}" class="btn-primary w-full py-2.5 text-xs font-bold shadow-md">
                            Masuk untuk Mulai Chat
                        </a>
                        <a href="{{ route('register') }}" class="btn-secondary w-full py-2.5 text-xs font-bold">
                            Daftar Akun Baru (Gratis)
                        </a>
                        <p class="text-[10px] text-slate-400 mt-2">Respon cepat dalam hitungan menit ⚡</p>
                    </div>
                </div>
            @endauth
        </div>

        <!-- Sticky Floating Button -->
        <button type="button" id="toggleChatBtn"
                class="group flex items-center gap-2.5 bg-[#1a56db] hover:bg-blue-700 active:scale-95 text-white font-bold px-4 py-3.5 rounded-full shadow-2xl hover:shadow-blue-500/40 transition-all duration-200 border-2 border-white/30">
            <div class="relative">
                <svg class="w-6 h-6 text-white group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <span class="absolute -top-1 -right-1 w-3 h-3 bg-emerald-400 rounded-full border-2 border-[#1a56db] animate-pulse"></span>
            </div>
            <span class="text-xs sm:text-sm font-extrabold pr-1">Konsultasi Sepatu</span>
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            if (mobileBtn && mobileMenu) {
                mobileBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Floating Live Chat Popup Toggle
            const toggleChatBtn = document.getElementById('toggleChatBtn');
            const closeChatBtn = document.getElementById('closeChatBtn');
            const chatBoxPopup = document.getElementById('chatBoxPopup');
            
            if (toggleChatBtn && chatBoxPopup) {
                toggleChatBtn.addEventListener('click', () => {
                    chatBoxPopup.classList.toggle('hidden');
                    if (!chatBoxPopup.classList.contains('hidden')) {
                        const input = document.getElementById('widgetMessageInput');
                        if (input) input.focus();
                        scrollToBottomWidget();
                    }
                });
            }

            if (closeChatBtn && chatBoxPopup) {
                closeChatBtn.addEventListener('click', () => {
                    chatBoxPopup.classList.add('hidden');
                });
            }

            // Customer widget interactive chat handling
            const widgetForm = document.getElementById('widgetChatForm');
            const widgetInput = document.getElementById('widgetMessageInput');
            const widgetMessages = document.getElementById('widgetMessages');
            const widgetSendBtn = document.getElementById('widgetSendBtn');

            function scrollToBottomWidget() {
                if (widgetMessages) {
                    widgetMessages.scrollTop = widgetMessages.scrollHeight;
                }
            }

            // Quick chips
            document.querySelectorAll('.widget-chip').forEach(chip => {
                chip.addEventListener('click', () => {
                    if (widgetInput) {
                        widgetInput.value = chip.innerText.trim();
                        widgetInput.focus();
                    }
                });
            });

            @auth
            @if(auth()->user()->isCustomer())
            if (widgetForm && widgetInput) {
                widgetForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const text = widgetInput.value.trim();
                    if (!text) return;

                    widgetSendBtn.disabled = true;

                    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
                    const token = tokenMeta ? tokenMeta.getAttribute('content') : '{{ csrf_token() }}';

                    const formData = new FormData();
                    formData.append('_token', token);
                    formData.append('message', text);

                    fetch('{{ route("customer.chat.send") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(async r => {
                        widgetSendBtn.disabled = false;
                        const data = await r.json().catch(() => ({}));
                        if (r.ok && data.status === 'success') {
                            widgetInput.value = '';
                            appendWidgetMessage(data.message);
                            scrollToBottomWidget();
                        } else if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Mengirim',
                                text: data.message || 'Pesan gagal terkirim.',
                                confirmButtonColor: '#1a56db',
                                customClass: { popup: 'swal2-custom-popup', confirmButton: 'swal2-custom-confirm' }
                            });
                        }
                    })
                    .catch(() => {
                        widgetSendBtn.disabled = false;
                    });
                });

                function appendWidgetMessage(msg) {
                    if (document.querySelector(`.widget-msg[data-id="${msg.id}"]`)) return;
                    const div = document.createElement('div');
                    div.className = msg.is_me ? 'flex items-start justify-end gap-2 widget-msg' : 'flex items-start gap-2 max-w-[85%] widget-msg';
                    div.dataset.id = msg.id;

                    if (msg.is_me) {
                        div.innerHTML = `
                            <div class="bg-[#1a56db] text-white p-2.5 rounded-2xl rounded-tr-xs shadow-xs text-xs space-y-1">
                                <p class="leading-relaxed whitespace-pre-wrap">${escapeHtml(msg.message)}</p>
                                <div class="text-[9px] text-blue-200 text-right">${msg.time}</div>
                            </div>`;
                    } else {
                        div.innerHTML = `
                            <div class="w-6 h-6 rounded-lg bg-[#1a56db] text-white flex items-center justify-center font-bold text-[9px] flex-shrink-0">DS</div>
                            <div class="bg-white p-2.5 rounded-2xl rounded-tl-xs border border-slate-200/80 text-slate-700 shadow-xs text-xs space-y-1">
                                <div class="font-bold text-[10px] text-blue-700">Admin Dr. Sepatu</div>
                                <p class="leading-relaxed whitespace-pre-wrap">${escapeHtml(msg.message)}</p>
                                <div class="text-[9px] text-slate-400 text-right">${msg.time}</div>
                            </div>`;
                    }
                    widgetMessages.appendChild(div);
                }

                function escapeHtml(text) {
                    if (!text) return '';
                    const p = document.createElement('p');
                    p.textContent = text;
                    return p.innerHTML;
                }

                // Poll messages when popup is open
                setInterval(() => {
                    if (chatBoxPopup && !chatBoxPopup.classList.contains('hidden')) {
                        const last = document.querySelector('.widget-msg:last-of-type');
                        const afterId = last ? last.dataset.id : 0;
                        fetch(`{{ route("customer.chat.fetch") }}?after_id=${afterId}`)
                            .then(r => r.json())
                            .then(data => {
                                if (data.status === 'success' && data.messages.length > 0) {
                                    data.messages.forEach(msg => appendWidgetMessage(msg));
                                    scrollToBottomWidget();
                                }
                            }).catch(() => {});
                    }
                }, 3000);
            }
            @endif
            @endauth
        });
    </script>
    @stack('scripts')
</body>

</html>