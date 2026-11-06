@extends('layouts.app')
@section('title', 'Masuk ke Akun - Dr. Sepatu')

@section('content')
<div class="min-h-[85vh] bg-gradient-to-b from-slate-100/60 via-white to-slate-50 flex items-center justify-center py-12 px-4 sm:px-6">
    <div class="max-w-md w-full">
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 group">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/20 group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <div class="text-left">
                    <div class="text-2xl font-black text-slate-900 leading-none">Dr.<span class="text-blue-600">Sepatu</span></div>
                    <div class="text-[11px] text-slate-500 font-medium tracking-wide mt-1">Professional Shoes Cleaning</div>
                </div>
            </a>
            <h2 class="mt-6 text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Selamat Datang Kembali</h2>
            <p class="text-slate-500 text-sm mt-1.5">Masuk untuk memantau cucian sepatu Anda</p>
        </div>

        <div class="card p-7 sm:p-8 bg-white border border-slate-200/80 shadow-xl shadow-slate-100">
            @if (isset($errors) && $errors->any())
                <div class="mb-5 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl text-sm flex items-center gap-2.5">
                    <svg class="w-5 h-5 flex-shrink-0 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm flex items-center gap-2.5">
                    <svg class="w-5 h-5 flex-shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="label">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="input-field pl-10 @error('email') border-rose-400 @enderror"
                            placeholder="nama@email.com" required autofocus>
                    </div>
                </div>

                <div>
                    <label for="password" class="label">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input type="password" id="password" name="password"
                            class="input-field pl-10 pr-11" placeholder="••••••••" required>
                        <button type="button" onclick="togglePassword('password', this)" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none" aria-label="Toggle password view">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 rounded border-slate-300 focus:ring-blue-500">
                        <span class="text-xs font-medium text-slate-600">Ingat saya</span>
                    </label>
                </div>

                <button type="submit" class="btn-primary w-full text-sm py-3 mt-2 font-bold shadow-md shadow-blue-500/25">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-slate-100 text-center">
                <p class="text-slate-500 text-xs">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:text-blue-700 transition-colors ml-1">Daftar sekarang gratis →</a>
                </p>
            </div>

            <!-- Demo Credentials (Quick Fill) -->
            <div class="mt-6 p-4 bg-slate-50 rounded-xl border border-slate-200/80">
                <div class="flex items-center justify-between mb-2.5">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-700 flex items-center gap-1.5">
                        <span>⚡</span> Akun Demo
                    </span>
                    <span class="text-[11px] text-slate-500">Klik untuk isi otomatis</span>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" onclick="fillCredentials('admin@drsepatu.com', '12345')"
                            class="px-3 py-2 bg-white hover:bg-blue-50 border border-slate-200 hover:border-blue-300 text-slate-800 rounded-lg text-xs font-semibold transition-all text-left flex flex-col group">
                        <span class="text-blue-700 font-bold group-hover:text-blue-800">👤 Admin</span>
                        <span class="text-[10px] text-slate-500 truncate">admin@drsepatu.com</span>
                    </button>
                    <button type="button" onclick="fillCredentials('customer@drsepatu.com', 'password')"
                            class="px-3 py-2 bg-white hover:bg-blue-50 border border-slate-200 hover:border-blue-300 text-slate-800 rounded-lg text-xs font-semibold transition-all text-left flex flex-col group">
                        <span class="text-emerald-700 font-bold group-hover:text-emerald-800">👟 Customer</span>
                        <span class="text-[10px] text-slate-500 truncate">customer@drsepatu.com</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(id, btn) {
    const input = document.getElementById(id);
    if (!input) return;
    input.type = input.type === 'password' ? 'text' : 'password';
}

function fillCredentials(email, password) {
    document.getElementById('email').value = email;
    document.getElementById('password').value = password;
}
</script>
@endsection
