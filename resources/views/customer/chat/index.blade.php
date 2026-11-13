@extends('layouts.customer')
@section('title', 'Live Chat & Konsultasi')
@section('page-title', 'Live Chat & Konsultasi Sepatu')
@section('page-subtitle', 'Tanyakan kondisi sepatu, rekomendasi layanan, atau keluhan langsung ke Customer Service Dr. Sepatu')

@section('content')
<div class="card border border-slate-200/90 shadow-sm overflow-hidden flex flex-col h-[75vh] min-h-[550px] relative">
    
    <!-- Chat Header -->
    <div class="px-6 py-4 bg-white border-b border-slate-100 flex items-center justify-between z-10">
        <div class="flex items-center gap-3.5">
            <div class="relative">
                <div class="w-11 h-11 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
                <span class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full"></span>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h3 class="font-bold text-slate-900 text-sm sm:text-base">Customer Service Dr. Sepatu</h3>
                    <span class="text-[10px] bg-emerald-50 text-emerald-700 font-bold px-2 py-0.5 rounded-full border border-emerald-200">Online</span>
                </div>
                <p class="text-xs text-slate-400">Siap bantu analisa jenis noda & bahan sepatu Anda</p>
            </div>
        </div>

        <!-- Optional Order Reference Selector -->
        @if($activeOrders->isNotEmpty())
        <div class="hidden sm:flex items-center gap-2">
            <span class="text-xs text-slate-400 font-medium">Bahas Pesanan:</span>
            <select id="chatOrderSelect" class="input-field py-1.5 px-3 text-xs w-44">
                <option value="">-- Umum / Tanpa Pesanan --</option>
                @foreach($activeOrders as $ord)
                    <option value="{{ $ord->id }}">#{{ $ord->order_number }} ({{ $ord->service_label }})</option>
                @endforeach
            </select>
        </div>
        @endif
    </div>

    <!-- Quick Consultation Chips Bar -->
    <div class="px-6 py-2.5 bg-slate-50/90 border-b border-slate-100 flex items-center gap-2 overflow-x-auto text-xs no-scrollbar">
        <span class="text-slate-400 font-semibold flex items-center gap-1 flex-shrink-0">
            <span>💡</span> Tanya Cepat:
        </span>
        <button type="button" class="quick-chip bg-white hover:bg-blue-50 hover:text-blue-600 text-slate-600 px-3 py-1.5 rounded-xl border border-slate-200/80 transition-all flex-shrink-0 whitespace-nowrap shadow-xs">
            Bisa cuci sepatu bahan Suede?
        </button>
        <button type="button" class="quick-chip bg-white hover:bg-blue-50 hover:text-blue-600 text-slate-600 px-3 py-1.5 rounded-xl border border-slate-200/80 transition-all flex-shrink-0 whitespace-nowrap shadow-xs">
            Berapa lama estimasi pengerjaan?
        </button>
        <button type="button" class="quick-chip bg-white hover:bg-blue-50 hover:text-blue-600 text-slate-600 px-3 py-1.5 rounded-xl border border-slate-200/80 transition-all flex-shrink-0 whitespace-nowrap shadow-xs">
            Sepatu saya ada noda jamur/lumpur
        </button>
        <button type="button" class="quick-chip bg-white hover:bg-blue-50 hover:text-blue-600 text-slate-600 px-3 py-1.5 rounded-xl border border-slate-200/80 transition-all flex-shrink-0 whitespace-nowrap shadow-xs">
            Apakah bisa dijemput ke rumah?
        </button>
    </div>

    <!-- Messages Container -->
    <div id="messagesContainer" class="flex-1 p-4 sm:p-6 overflow-y-auto space-y-4 bg-slate-50/50">
        <!-- Welcome Bot Message -->
        <div class="flex items-start gap-3 max-w-xl">
            <div class="w-8 h-8 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-xs flex-shrink-0 shadow-xs">
                DS
            </div>
            <div class="bg-white rounded-2xl rounded-tl-xs p-4 shadow-xs border border-slate-200/80 text-xs sm:text-sm text-slate-700 space-y-2">
                <p class="font-semibold text-blue-700">Halo kak {{ auth()->user()->name }}! 👋 Selamat datang di Live Chat Dr. Sepatu.</p>
                <p>Mau konsultasi kondisi sepatu sebelum memesan? Silakan tanyakan bahan sepatu, jenis noda, atau kirimkan foto sepatu Anda di bawah ya. Tim kami siap membantu!</p>
                <div class="text-[10px] text-slate-400 pt-1 text-right">CS Dr. Sepatu</div>
            </div>
        </div>

        @foreach($messages as $msg)
            @if($msg->sender_id === auth()->id())
                <!-- Customer (Me) Bubble -->
                <div class="flex items-start justify-end gap-3 message-item" data-id="{{ $msg->id }}">
                    <div class="max-w-md bg-blue-600 text-white rounded-2xl rounded-tr-xs p-4 shadow-md text-xs sm:text-sm space-y-2">
                        @if($msg->order)
                            <div class="inline-flex items-center gap-1.5 bg-blue-700/80 text-blue-100 px-2 py-0.5 rounded-md text-[11px] font-mono">
                                <span>📦 Terkait: #{{ $msg->order->order_number }}</span>
                            </div>
                        @endif
                        @if($msg->image_path)
                            <div class="rounded-xl overflow-hidden mb-2 bg-blue-700/50">
                                <img src="{{ asset('storage/' . $msg->image_path) }}" alt="Foto Sepatu" class="max-h-60 w-auto rounded-xl object-cover cursor-pointer hover:opacity-95 transition-opacity" onclick="window.open(this.src)">
                            </div>
                        @endif
                        <p class="leading-relaxed whitespace-pre-wrap">{{ $msg->message }}</p>
                        <div class="text-[10px] text-blue-200 text-right pt-1 flex items-center justify-end gap-1">
                            <span>{{ $msg->created_at->format('H:i') }}</span>
                            <span>•</span>
                            <span>{{ $msg->is_read ? 'Dibaca' : 'Terkirim' }}</span>
                        </div>
                    </div>
                </div>
            @else
                <!-- Admin Bubble -->
                <div class="flex items-start gap-3 max-w-md message-item" data-id="{{ $msg->id }}">
                    <div class="w-8 h-8 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-xs flex-shrink-0 shadow-xs">
                        DS
                    </div>
                    <div class="bg-white rounded-2xl rounded-tl-xs p-4 shadow-xs border border-slate-200/80 text-xs sm:text-sm text-slate-700 space-y-2">
                        <div class="font-bold text-xs text-blue-700 flex items-center gap-1">
                            <span>Admin Dr. Sepatu</span>
                            <span class="text-[10px] bg-blue-50 text-blue-600 font-semibold px-1.5 py-0.5 rounded">Resmi</span>
                        </div>
                        @if($msg->image_path)
                            <div class="rounded-xl overflow-hidden mb-2">
                                <img src="{{ asset('storage/' . $msg->image_path) }}" alt="Foto Lampiran" class="max-h-60 w-auto rounded-xl object-cover cursor-pointer" onclick="window.open(this.src)">
                            </div>
                        @endif
                        <p class="leading-relaxed whitespace-pre-wrap">{{ $msg->message }}</p>
                        <div class="text-[10px] text-slate-400 text-right pt-1">{{ $msg->created_at->format('H:i') }}</div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Image Preview Container (Hidden by default) -->
    <div id="imagePreviewBar" class="hidden px-6 py-2 bg-slate-100 border-t border-slate-200 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <img id="imagePreviewImg" class="w-12 h-12 object-cover rounded-xl border border-slate-300 shadow-xs" src="" alt="Preview">
            <div>
                <p class="text-xs font-bold text-slate-800" id="imagePreviewName">foto-sepatu.jpg</p>
                <p class="text-[11px] text-slate-400">Siap dikirim untuk dianalisa admin</p>
            </div>
        </div>
        <button type="button" id="removeImageBtn" class="text-slate-400 hover:text-rose-600 p-1.5 rounded-lg hover:bg-white text-xs font-bold transition-all">
            ✕ Batal
        </button>
    </div>

    <!-- Chat Input Form -->
    <div class="p-4 bg-white border-t border-slate-200/80">
        <form id="chatForm" class="flex items-center gap-2">
            @csrf
            
            <!-- Upload Photo Button -->
            <label class="cursor-pointer p-2.5 rounded-xl text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition-colors flex-shrink-0" title="Kirim Foto Sepatu">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <input type="file" id="chatImageInput" accept="image/*" class="hidden">
            </label>

            <!-- Text Message Input -->
            <div class="flex-1 relative">
                <input type="text" id="chatMessageInput"
                       placeholder="Ketik pertanyaan atau konsultasi sepatu Anda di sini..."
                       class="w-full pl-4 pr-10 py-3 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all">
            </div>

            <!-- Send Button -->
            <button type="submit" id="sendBtn"
                    class="btn-primary py-3 px-5 text-sm font-bold flex items-center gap-1.5 shadow-md shadow-blue-500/20 disabled:opacity-50">
                <span>Kirim</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </form>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const messagesContainer = document.getElementById('messagesContainer');
    const chatForm = document.getElementById('chatForm');
    const chatMessageInput = document.getElementById('chatMessageInput');
    const chatImageInput = document.getElementById('chatImageInput');
    const chatOrderSelect = document.getElementById('chatOrderSelect');
    const imagePreviewBar = document.getElementById('imagePreviewBar');
    const imagePreviewImg = document.getElementById('imagePreviewImg');
    const imagePreviewName = document.getElementById('imagePreviewName');
    const removeImageBtn = document.getElementById('removeImageBtn');
    const sendBtn = document.getElementById('sendBtn');
    let selectedImageFile = null;

    // Scroll to bottom
    function scrollToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
    scrollToBottom();

    // Subtle audio chime on new message
    function playBeep() {
        try {
            const ctx = new (window.AudioContext || window.webkitAudioContext)();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.type = 'sine';
            osc.frequency.setValueAtTime(587.33, ctx.currentTime); // D5
            osc.frequency.exponentialRampToValueAtTime(880, ctx.currentTime + 0.15); // A5
            gain.gain.setValueAtTime(0.08, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.25);
            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.start();
            osc.stop(ctx.currentTime + 0.25);
        } catch(e) {}
    }

    // Quick Consultation Chips
    document.querySelectorAll('.quick-chip').forEach(btn => {
        btn.addEventListener('click', () => {
            chatMessageInput.value = btn.innerText.trim();
            chatMessageInput.focus();
        });
    });

    // Image Preview Handling
    chatImageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            selectedImageFile = file;
            imagePreviewName.textContent = file.name;
            const reader = new FileReader();
            reader.onload = function(evt) {
                imagePreviewImg.src = evt.target.result;
                imagePreviewBar.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    removeImageBtn.addEventListener('click', function() {
        selectedImageFile = null;
        chatImageInput.value = '';
        imagePreviewBar.classList.add('hidden');
    });

    // Send Message Handler
    chatForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const text = chatMessageInput.value.trim();
        if (!text && !selectedImageFile) return;

        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        if (text) formData.append('message', text);
        if (selectedImageFile) formData.append('image', selectedImageFile);
        if (chatOrderSelect && chatOrderSelect.value) {
            formData.append('order_id', chatOrderSelect.value);
        }

        // Disable input during send
        sendBtn.disabled = true;

        fetch('{{ route("customer.chat.send") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            sendBtn.disabled = false;
            if (data.status === 'success') {
                chatMessageInput.value = '';
                removeImageBtn.click();
                appendMessage(data.message);
                scrollToBottom();
            } else {
                alert(data.message || 'Gagal mengirim pesan.');
            }
        })
        .catch(() => {
            sendBtn.disabled = false;
            alert('Koneksi terputus. Silakan coba lagi.');
        });
    });

    // Append Message to UI
    function appendMessage(msg) {
        if (document.querySelector(`.message-item[data-id="${msg.id}"]`)) return;

        const div = document.createElement('div');
        div.className = msg.is_me ? 'flex items-start justify-end gap-3 message-item' : 'flex items-start gap-3 max-w-md message-item';
        div.dataset.id = msg.id;

        let imgHtml = '';
        if (msg.image_url) {
            imgHtml = `
                <div class="rounded-xl overflow-hidden mb-2 bg-blue-700/50">
                    <img src="${msg.image_url}" alt="Foto" class="max-h-60 w-auto rounded-xl object-cover cursor-pointer" onclick="window.open(this.src)">
                </div>`;
        }

        let orderHtml = '';
        if (msg.order_number) {
            orderHtml = `
                <div class="inline-flex items-center gap-1.5 ${msg.is_me ? 'bg-blue-700/80 text-blue-100' : 'bg-slate-100 text-slate-700'} px-2 py-0.5 rounded-md text-[11px] font-mono mb-1">
                    <span>📦 Terkait: #${msg.order_number}</span>
                </div>`;
        }

        if (msg.is_me) {
            div.innerHTML = `
                <div class="max-w-md bg-blue-600 text-white rounded-2xl rounded-tr-xs p-4 shadow-md text-xs sm:text-sm space-y-2">
                    ${orderHtml}
                    ${imgHtml}
                    <p class="leading-relaxed whitespace-pre-wrap">${escapeHtml(msg.message)}</p>
                    <div class="text-[10px] text-blue-200 text-right pt-1 flex items-center justify-end gap-1">
                        <span>${msg.time}</span>
                        <span>•</span>
                        <span>Terkirim</span>
                    </div>
                </div>`;
        } else {
            div.innerHTML = `
                <div class="w-8 h-8 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-xs flex-shrink-0 shadow-xs">
                    DS
                </div>
                <div class="bg-white rounded-2xl rounded-tl-xs p-4 shadow-xs border border-slate-200/80 text-xs sm:text-sm text-slate-700 space-y-2">
                    <div class="font-bold text-xs text-blue-700 flex items-center gap-1">
                        <span>Admin Dr. Sepatu</span>
                        <span class="text-[10px] bg-blue-50 text-blue-600 font-semibold px-1.5 py-0.5 rounded">Resmi</span>
                    </div>
                    ${imgHtml}
                    <p class="leading-relaxed whitespace-pre-wrap">${escapeHtml(msg.message)}</p>
                    <div class="text-[10px] text-slate-400 text-right pt-1">${msg.time}</div>
                </div>`;
        }

        messagesContainer.appendChild(div);
    }

    function escapeHtml(text) {
        if (!text) return '';
        const p = document.createElement('p');
        p.textContent = text;
        return p.innerHTML;
    }

    // Polling for Realtime updates
    function pollMessages() {
        const lastItem = document.querySelector('.message-item:last-of-type');
        const afterId = lastItem ? lastItem.dataset.id : 0;

        fetch(`{{ route("customer.chat.fetch") }}?after_id=${afterId}`)
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success' && data.messages.length > 0) {
                    let hasNewAdminMsg = false;
                    data.messages.forEach(msg => {
                        appendMessage(msg);
                        if (!msg.is_me) hasNewAdminMsg = true;
                    });
                    scrollToBottom();
                    if (hasNewAdminMsg) {
                        playBeep();
                    }
                }
            })
            .catch(() => {});
    }

    // Poll every 2.5 seconds
    setInterval(pollMessages, 2500);
});
</script>
@endpush
