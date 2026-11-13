<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Pelanggan') - Dr. Sepatu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('styles')
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased selection:bg-blue-600 selection:text-white">
    <!-- Overlay for mobile sidebar -->
    <div id="sidebarOverlay" class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-40 lg:hidden transition-opacity"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 border-r border-slate-800 shadow-2xl transform -translate-x-full lg:translate-x-0 transition-transform duration-300 flex flex-col justify-between">
        <div>
            <!-- Logo & Close for Mobile -->
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-800/80">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-md shadow-blue-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-extrabold text-white text-base leading-tight tracking-tight">Dr.<span class="text-blue-400">Sepatu</span></div>
                        <div class="text-[10px] text-slate-400 font-medium">Customer Portal</div>
                    </div>
                </a>
                <button type="button" id="sidebarCloseBtn" class="lg:hidden p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800" aria-label="Close Sidebar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Customer Profile Header -->
            <div class="px-5 py-4 border-b border-slate-800/80 bg-slate-900/50">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xs shadow-xs">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-white text-xs font-bold truncate">{{ auth()->user()->name }}</p>
                        <p class="text-slate-400 text-[11px] truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Nav Links -->
            <nav class="px-3 py-4 space-y-1.5">
                <a href="{{ route('customer.dashboard') }}" class="sidebar-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('customer.orders.index') }}" class="sidebar-link {{ request()->routeIs('customer.orders.index') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    <span>Pesanan Saya</span>
                </a>

                <a href="{{ route('customer.orders.create') }}" class="sidebar-link {{ request()->routeIs('customer.orders.create') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>Pesan Cuci Baru</span>
                </a>

                <a href="{{ route('customer.chat.index') }}" class="sidebar-link {{ request()->routeIs('customer.chat.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    <span>Live Chat & Konsultasi</span>
                    @php 
                        $custUnread = \App\Models\ChatMessage::where('user_id', auth()->id())
                            ->where('sender_id', '!=', auth()->id())
                            ->where('is_read', false)
                            ->count(); 
                    @endphp
                    <span id="customerChatBadge" class="ml-auto bg-blue-500 text-white text-[11px] font-bold rounded-full px-2 py-0.5 {{ $custUnread > 0 ? '' : 'hidden' }}">{{ $custUnread }}</span>
                </a>
            </nav>
        </div>

        <!-- Bottom Actions -->
        <div class="p-3 border-t border-slate-800/80 space-y-1">
            <a href="{{ route('home') }}" class="sidebar-link text-xs">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span>Ke Beranda Utama</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-full text-left text-xs text-rose-300 hover:bg-rose-500/10 hover:text-rose-200">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Keluar Akun</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="lg:ml-64 min-h-screen flex flex-col">
        <!-- Top Bar -->
        <header class="bg-white/85 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-30 shadow-xs">
            <div class="flex items-center justify-between px-6 py-3.5">
                <div class="flex items-center gap-4">
                    <button id="sidebarToggle" class="lg:hidden p-2 rounded-xl text-slate-600 hover:bg-slate-100 transition-colors" aria-label="Toggle Navigation">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div>
                        <h1 class="text-lg sm:text-xl font-extrabold text-slate-900 tracking-tight">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-xs text-slate-500">@yield('page-subtitle', '')</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('customer.orders.create') }}" class="btn-primary py-2 px-3.5 text-xs font-semibold hidden sm:flex items-center gap-1.5 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v16m8-8H4"/></svg>
                        Buat Pesanan
                    </a>
                    <div class="w-8 h-8 rounded-xl bg-blue-50 border border-blue-200 text-blue-700 font-bold text-xs flex items-center justify-center">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Body -->
        <main class="p-4 sm:p-6 lg:p-8 flex-1">
            @if(session('success'))
                <div class="auto-dismiss mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center gap-3 text-sm shadow-xs">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="auto-dismiss mb-6 bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-xl flex items-center gap-3 text-sm shadow-xs">
                    <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
    <script>
        // Global customer unread badge poller
        (function() {
            function checkCustomerUnread() {
                fetch('{{ route("customer.chat.unread-count") }}')
                    .then(r => r.json())
                    .then(data => {
                        const badge = document.getElementById('customerChatBadge');
                        if (!badge) return;
                        if (data.unread_count > 0) {
                            badge.textContent = data.unread_count;
                            badge.classList.remove('hidden');
                        } else {
                            badge.classList.add('hidden');
                        }
                    }).catch(() => {});
            }
            setInterval(checkCustomerUnread, 6000);
        })();
    </script>
</body>
</html>
