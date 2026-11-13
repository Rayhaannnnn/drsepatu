@extends('layouts.admin')
@section('title', 'Live Chat & Konsultasi')
@section('page-title', 'Live Chat & Konsultasi Pelanggan')
@section('page-subtitle', 'Jawab pertanyaan seputar kondisi sepatu, bahan, keluhan, atau konsultasi sebelum pelanggan mencuci')

@section('content')
<div class="card border border-slate-200/90 shadow-sm overflow-hidden flex flex-col lg:flex-row h-[78vh] min-h-[600px] relative">
    
    <!-- Left Pane: Conversations List -->
    <div class="w-full lg:w-80 lg:min-w-[320px] bg-white border-r border-slate-200/80 flex flex-col h-full">
        <!-- Search bar -->
        <div class="p-4 border-b border-slate-100 bg-slate-50/50">
            <div class="relative">
                <input type="text" id="searchCustomer" placeholder="Cari pelanggan..."
                       class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-100 bg-white">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
        </div>

        <!-- Customer Threads List -->
        <div id="customerList" class="flex-1 overflow-y-auto divide-y divide-slate-100">
            @forelse($customers as $c)
            @php $last = $c->chatMessages->first(); @endphp
            <a href="{{ route('admin.chats.index', ['customer_id' => $c->id]) }}"
               class="customer-card block p-4 hover:bg-slate-50 transition-colors {{ optional($selectedCustomer)->id === $c->id ? 'bg-blue-50/70 border-l-4 border-blue-600' : '' }}"
               data-id="{{ $c->id }}"
               data-name="{{ strtolower($c->name) }}">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white font-bold text-xs flex items-center justify-center flex-shrink-0 shadow-xs">
                        {{ strtoupper(substr($c->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-1 mb-0.5">
                            <h4 class="font-bold text-xs text-slate-900 truncate">{{ $c->name }}</h4>
                            <span class="text-[10px] text-slate-400 flex-shrink-0">
                                {{ $last ? $last->created_at->diffForHumans(null, true) : '' }}
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-500 truncate">
                            {{ $last ? $last->message : 'Belum ada pesan' }}
                        </p>
                    </div>
                    @if($c->unread_count > 0)
                        <span class="unread-pill bg-rose-500 text-white text-[10px] font-black rounded-full px-2 py-0.5 flex-shrink-0">
                            {{ $c->unread_count }}
                        </span>
                    @endif
                </div>
            </a>
            @empty
            <div class="p-8 text-center text-slate-400">
                <div class="text-3xl mb-1">💬</div>
                <p class="text-xs font-semibold text-slate-600">Belum ada pelanggan terdaftar</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Right Pane: Active Conversation -->
    <div class="flex-1 flex flex-col h-full bg-slate-50/40 relative">
        @if($selectedCustomer)
            <!-- Active Chat Header & Customer Details -->
            <div class="px-6 py-4 bg-white border-b border-slate-200/80 flex flex-wrap items-center justify-between gap-4 z-10">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 text-white font-black text-sm flex items-center justify-center shadow-xs">
                        {{ strtoupper(substr($selectedCustomer->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="font-black text-slate-900 text-sm sm:text-base">{{ $selectedCustomer->name }}</h3>
                            <span class="text-[10px] bg-blue-50 text-blue-700 font-bold px-2 py-0.5 rounded-full border border-blue-200">Customer</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-3 text-xs text-slate-400 mt-0.5">
                            <span>📞 {{ $selectedCustomer->phone ?? 'Tidak ada nomor' }}</span>
                            <span>•</span>
                            <span>✉️ {{ $selectedCustomer->email }}</span>
                            <span>•</span>
                            <span class="text-slate-600 font-semibold">{{ $selectedCustomer->orders()->count() }} Pesanan</span>
                        </div>
                    </div>
                </div>

                <!-- Action Shortcut (WhatsApp & View Profile) -->
                <div class="flex items-center gap-2">
                    @if($selectedCustomer->phone)
                        @php
                            $waPhone = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $selectedCustomer->phone));
                        @endphp
                        <a href="https://wa.me/{{ $waPhone }}" target="_blank"
                           class="inline-flex items-center gap-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 px-3 py-1.5 rounded-xl border border-emerald-200 text-xs font-bold transition-all shadow-xs">
                            <span>📱 WhatsApp</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Quick Template Responses for Admin -->
            <div class="px-6 py-2 bg-slate-100/90 border-b border-slate-200/60 flex items-center gap-2 overflow-x-auto text-xs no-scrollbar">
                <span class="text-slate-400 font-semibold flex items-center gap-1 flex-shrink-0">
                    <span>⚡</span> Template:
                </span>
                <button type="button" class="admin-template-chip bg-white hover:bg-blue-50 hover:text-blue-700 text-slate-600 px-3 py-1 rounded-xl border border-slate-200 text-[11px] font-medium flex-shrink-0 transition-all shadow-xs">
                    Halo kak! Ada yang bisa kami bantu seputar sepatu Anda?
                </button>
                <button type="button" class="admin-template-chip bg-white hover:bg-blue-50 hover:text-blue-700 text-slate-600 px-3 py-1 rounded-xl border border-slate-200 text-[11px] font-medium flex-shrink-0 transition-all shadow-xs">
                    Bisa difotokan bagian sepatu yang kotor/bermasalah kak?
                </button>
                <button type="button" class="admin-template-chip bg-white hover:bg-blue-50 hover:text-blue-700 text-slate-600 px-3 py-1 rounded-xl border border-slate-200 text-[11px] font-medium flex-shrink-0 transition-all shadow-xs">
                    Untuk bahan suede/kulit, kami sarankan paket Suede Treatment ya kak.
                </button>
                <button type="button" class="admin-template-chip bg-white hover:bg-blue-50 hover:text-blue-700 text-slate-600 px-3 py-1 rounded-xl border border-slate-200 text-[11px] font-medium flex-shrink-0 transition-all shadow-xs">
                    Untuk noda lumpur membandel, paket Deep Clean sangat kami rekomendasikan kak.
                </button>
                <button type="button" class="admin-template-chip bg-white hover:bg-blue-50 hover:text-blue-700 text-slate-600 px-3 py-1 rounded-xl border border-slate-200 text-[11px] font-medium flex-shrink-0 transition-all shadow-xs">
                    Kami ada layanan pickup/jemput langsung ke alamat rumah kak!
                </button>
            </div>

            <!-- Message Stream -->
            <div id="adminMessagesContainer" class="flex-1 p-6 overflow-y-auto space-y-4">
                @forelse($messages as $msg)
                    @if($msg->sender_id === auth()->id())
                        <!-- Admin (Me) -->
                        <div class="flex items-start justify-end gap-3 admin-msg-item" data-id="{{ $msg->id }}">
                            <div class="max-w-md bg-blue-600 text-white rounded-2xl rounded-tr-xs p-4 shadow-md text-xs sm:text-sm space-y-1.5">
                                @if($msg->order)
                                    <div class="inline-flex items-center gap-1.5 bg-blue-700/80 text-blue-100 px-2 py-0.5 rounded-md text-[11px] font-mono">
                                        <span>📦 Pesanan: #{{ $msg->order->order_number }}</span>
                                    </div>
                                @endif
                                <p class="leading-relaxed whitespace-pre-wrap">{{ $msg->message }}</p>
                                <div class="text-[10px] text-blue-200 text-right pt-1 flex items-center justify-end gap-1">
                                    <span>{{ $msg->created_at->format('H:i') }}</span>
                                    <span>•</span>
                                    <span>Terkirim</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Customer -->
                        <div class="flex items-start gap-3 max-w-md admin-msg-item" data-id="{{ $msg->id }}">
                            <div class="w-8 h-8 rounded-xl bg-slate-800 text-white flex items-center justify-center font-bold text-xs flex-shrink-0 shadow-xs">
                                {{ strtoupper(substr($selectedCustomer->name, 0, 1)) }}
                            </div>
                            <div class="bg-white rounded-2xl rounded-tl-xs p-4 shadow-xs border border-slate-200/80 text-xs sm:text-sm text-slate-800 space-y-2">
                                <div class="font-bold text-xs text-slate-900">{{ $selectedCustomer->name }}</div>
                                @if($msg->order)
                                    <div class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 px-2 py-0.5 rounded-md text-[11px] font-mono">
                                        <span>📦 Menanyakan Pesanan: #{{ $msg->order->order_number }}</span>
                                    </div>
                                @endif
                                @if($msg->image_path)
                                    <div class="rounded-xl overflow-hidden mb-2 border border-slate-100">
                                        <img src="{{ asset('storage/' . $msg->image_path) }}" alt="Foto Sepatu" class="max-h-64 w-auto rounded-xl object-cover cursor-pointer hover:opacity-95" onclick="window.open(this.src)">
                                    </div>
                                @endif
                                <p class="leading-relaxed whitespace-pre-wrap">{{ $msg->message }}</p>
                                <div class="text-[10px] text-slate-400 text-right pt-1">{{ $msg->created_at->format('H:i') }}</div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="py-20 text-center text-slate-400">
                        <div class="text-4xl mb-2">💬</div>
                        <p class="font-semibold text-slate-600">Belum ada percakapan dengan {{ $selectedCustomer->name }}</p>
                        <p class="text-xs text-slate-400 mt-1">Gunakan kotak di bawah untuk mengirim pesan sapaan atau follow-up.</p>
                    </div>
                @endforelse
            </div>

            <!-- Admin Input Bar -->
            <div class="p-4 bg-white border-t border-slate-200/80">
                <form id="adminChatForm" class="flex items-center gap-2">
                    @csrf
                    <div class="flex-1 relative">
                        <input type="text" id="adminMessageInput"
                               placeholder="Balas pesan {{ $selectedCustomer->name }}..."
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all">
                    </div>
                    <button type="submit" id="adminSendBtn"
                            class="btn-primary py-3 px-6 text-sm font-bold flex items-center gap-1.5 shadow-md shadow-blue-500/20 disabled:opacity-50">
                        <span>Balas</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </form>
            </div>

        @else
            <!-- No Customer Selected Screen -->
            <div class="flex-1 flex flex-col items-center justify-center p-8 text-center text-slate-400">
                <div class="w-20 h-20 rounded-3xl bg-blue-50 text-blue-600 flex items-center justify-center text-3xl mb-4 shadow-sm border border-blue-100">
                    💬
                </div>
                <h3 class="font-black text-slate-800 text-lg mb-1">Pilih Percakapan Pelanggan</h3>
                <p class="text-xs text-slate-500 max-w-sm">Pilih salah satu pelanggan di kolom sebelah kiri untuk membuka live chat dan memberikan konsultasi sepatu.</p>
            </div>
        @endif
    </div>

</div>
@endsection

@push('scripts')
@if($selectedCustomer)
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('adminMessagesContainer');
    const form = document.getElementById('adminChatForm');
    const input = document.getElementById('adminMessageInput');
    const sendBtn = document.getElementById('adminSendBtn');
    const customerId = {{ $selectedCustomer->id }};

    function scrollToBottom() {
        if (container) container.scrollTop = container.scrollHeight;
    }
    scrollToBottom();

    // Subtle audio chime
    function playBeep() {
        try {
            const ctx = new (window.AudioContext || window.webkitAudioContext)();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.type = 'sine';
            osc.frequency.setValueAtTime(587.33, ctx.currentTime);
            osc.frequency.exponentialRampToValueAtTime(880, ctx.currentTime + 0.15);
            gain.gain.setValueAtTime(0.08, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.25);
            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.start();
            osc.stop(ctx.currentTime + 0.25);
        } catch(e) {}
    }

    // Template chips
    document.querySelectorAll('.admin-template-chip').forEach(chip => {
        chip.addEventListener('click', () => {
            input.value = chip.innerText.trim();
            input.focus();
        });
    });

    // Send Form
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const text = input.value.trim();
        if (!text) return;

        const tokenMeta = document.querySelector('meta[name="csrf-token"]');
        const token = tokenMeta ? tokenMeta.getAttribute('content') : '{{ csrf_token() }}';

        sendBtn.disabled = true;

        fetch(`{{ url('admin/chats') }}/${customerId}/messages`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ message: text, _token: token })
        })
        .then(async r => {
            sendBtn.disabled = false;
            const data = await r.json().catch(() => ({}));
            if (r.ok && data.status === 'success') {
                input.value = '';
                appendAdminMessage(data.message);
                scrollToBottom();
            } else {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Mengirim',
                        text: data.message || 'Gagal mengirim balasan.',
                        confirmButtonColor: '#1a56db',
                        customClass: { popup: 'swal2-custom-popup', confirmButton: 'swal2-custom-confirm' }
                    });
                } else {
                    alert(data.message || 'Gagal mengirim balasan.');
                }
            }
        })
        .catch(() => {
            sendBtn.disabled = false;
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Koneksi Terputus',
                    text: 'Gagal menghubungi server.',
                    confirmButtonColor: '#1a56db',
                    customClass: { popup: 'swal2-custom-popup', confirmButton: 'swal2-custom-confirm' }
                });
            } else {
                alert('Koneksi terputus.');
            }
        });
    });

    function appendAdminMessage(msg) {
        if (document.querySelector(`.admin-msg-item[data-id="${msg.id}"]`)) return;

        const div = document.createElement('div');
        div.className = msg.is_me ? 'flex items-start justify-end gap-3 admin-msg-item' : 'flex items-start gap-3 max-w-md admin-msg-item';
        div.dataset.id = msg.id;

        let imgHtml = '';
        if (msg.image_url) {
            imgHtml = `
                <div class="rounded-xl overflow-hidden mb-2 border border-slate-100">
                    <img src="${msg.image_url}" alt="Foto" class="max-h-64 w-auto rounded-xl object-cover cursor-pointer" onclick="window.open(this.src)">
                </div>`;
        }

        if (msg.is_me) {
            div.innerHTML = `
                <div class="max-w-md bg-blue-600 text-white rounded-2xl rounded-tr-xs p-4 shadow-md text-xs sm:text-sm space-y-1.5">
                    <p class="leading-relaxed whitespace-pre-wrap">${escapeHtml(msg.message)}</p>
                    <div class="text-[10px] text-blue-200 text-right pt-1 flex items-center justify-end gap-1">
                        <span>${msg.time}</span>
                        <span>•</span>
                        <span>Terkirim</span>
                    </div>
                </div>`;
        } else {
            div.innerHTML = `
                <div class="w-8 h-8 rounded-xl bg-slate-800 text-white flex items-center justify-center font-bold text-xs flex-shrink-0 shadow-xs">
                    ${escapeHtml(msg.sender_name.substring(0, 1).toUpperCase())}
                </div>
                <div class="bg-white rounded-2xl rounded-tl-xs p-4 shadow-xs border border-slate-200/80 text-xs sm:text-sm text-slate-800 space-y-2">
                    <div class="font-bold text-xs text-slate-900">${escapeHtml(msg.sender_name)}</div>
                    ${imgHtml}
                    <p class="leading-relaxed whitespace-pre-wrap">${escapeHtml(msg.message)}</p>
                    <div class="text-[10px] text-slate-400 text-right pt-1">${msg.time}</div>
                </div>`;
        }

        container.appendChild(div);
    }

    function escapeHtml(text) {
        if (!text) return '';
        const p = document.createElement('p');
        p.textContent = text;
        return p.innerHTML;
    }

    // Realtime Polling for active conversation
    function pollActiveChat() {
        const lastItem = document.querySelector('.admin-msg-item:last-of-type');
        const afterId = lastItem ? lastItem.dataset.id : 0;

        fetch(`{{ url('admin/chats') }}/${customerId}/messages?after_id=${afterId}`)
            .then(r => r.json())
            .then(data => {
                if (data.status === 'success' && data.messages.length > 0) {
                    let hasCustomerMsg = false;
                    data.messages.forEach(msg => {
                        appendAdminMessage(msg);
                        if (!msg.is_me) hasCustomerMsg = true;
                    });
                    scrollToBottom();
                    if (hasCustomerMsg) {
                        playBeep();
                    }
                }
            })
            .catch(() => {});
    }

    setInterval(pollActiveChat, 2500);

    // Search Filter
    const searchInput = document.getElementById('searchCustomer');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            document.querySelectorAll('.customer-card').forEach(card => {
                const name = card.dataset.name || '';
                card.style.display = name.includes(query) ? '' : 'none';
            });
        });
    }
});
</script>
@endif
@endpush

