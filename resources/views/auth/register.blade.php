@extends('layouts.app')
@section('title', 'Daftar - Dr. Sepatu')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-50 flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <div class="text-left">
                    <div class="text-2xl font-black text-blue-900">Dr.<span class="text-blue-600">Sepatu</span></div>
                    <div class="text-xs text-gray-500">Laundry Sepatu Profesional</div>
                </div>
            </a>
            <h2 class="mt-6 text-3xl font-black text-gray-900">Buat Akun Baru 🚀</h2>
            <p class="text-gray-500 mt-2">Gratis! Mulai cuci sepatu hari ini</p>
        </div>

        <div class="card p-8">
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="name" class="label">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="input-field @error('name') border-red-400 @enderror"
                        placeholder="Nama Anda" required autofocus>
                </div>

                <div>
                    <label for="email" class="label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="input-field @error('email') border-red-400 @enderror"
                        placeholder="email@anda.com" required>
                </div>

                <div>
                    <label for="phone" class="label">Nomor HP / WhatsApp</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                        class="input-field @error('phone') border-red-400 @enderror"
                        placeholder="08xxxxxxxxxx" required>
                </div>

                <div>
                    <label for="password" class="label">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="input-field pr-12" placeholder="Min. 8 karakter" required>
                        <button type="button" onclick="togglePassword('password', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="label">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="input-field" placeholder="Ulangi password" required>
                </div>

                <button type="submit" class="btn-primary w-full text-center">
                    Buat Akun Sekarang
                </button>
            </form>

            <p class="text-center text-gray-500 text-sm mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:text-blue-800 transition-colors">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>

<script>
function togglePassword(id) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
@endsection
