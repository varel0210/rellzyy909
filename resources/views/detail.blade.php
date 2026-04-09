<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $akun->nama_akun }} | RELLZYY STORE</title>
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700" rel="stylesheet" />
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-['Poppins']">

<nav class="bg-white border-b border-slate-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
        <a href="/" class="flex items-center gap-2 text-slate-600 hover:text-blue-600 transition-all font-bold">
            <i data-lucide="arrow-left" class="w-5 h-5"></i> Kembali
        </a>
        <h1 class="text-xl font-black text-slate-900 tracking-tighter">RELLZYY<span class="text-blue-600">STR</span></h1>
        <div class="w-10"></div> {{-- Spacer --}}
    </div>
</nav>

<main class="max-w-6xl mx-auto px-6 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        
        {{-- BAGIAN KIRI: GAMBAR --}}
        <div class="space-y-4">
            <div class="bg-white p-2 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                <img src="{{ asset('storage/'.$akun->foto) }}" class="w-full rounded-2xl object-cover shadow-inner" alt="Preview Akun">
            </div>
        </div>

        {{-- BAGIAN KANAN: INFO --}}
        <div class="flex flex-col">
            <div class="mb-6">
                <span class="inline-block px-3 py-1 bg-blue-100 text-blue-600 rounded-lg text-[10px] font-black uppercase mb-4">
                    {{ $akun->kategori_game }}
                </span>
                <h1 class="text-3xl font-black text-slate-900 mb-2">{{ $akun->nama_akun }}</h1>
                <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($akun->harga) }}</p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm mb-8 flex-1">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest mb-4 flex items-center gap-2">
                    <i data-lucide="align-left" class="w-4 h-4 text-blue-500"></i> Deskripsi Produk
                </h3>
                <div class="text-slate-500 leading-relaxed whitespace-pre-line text-sm">
                    {{ $akun->deskripsi ?? 'Tidak ada deskripsi tambahan untuk akun ini.' }}
                </div>
            </div>

            <div class="flex flex-col gap-4">
                <div class="flex items-center justify-between p-4 bg-slate-900 rounded-2xl text-white">
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase">Status Stok</p>
                        <p class="font-bold text-sm uppercase tracking-wider">{{ $akun->status }}</p>
                    </div>
                    @if($akun->status == 'ready')
                        <span class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse shadow-[0_0_10px_#10b981]"></span>
                    @endif
                </div>

                @if($akun->status == 'ready')
                    <a href="https://wa.me/62895331114471?text=Halo%20Admin,%20saya%20tertarik%20membeli%20akun%20{{ urlencode($akun->nama_akun) }}" 
                       target="_blank"
                       class="w-full bg-blue-600 text-white py-4 rounded-2xl font-black text-center shadow-xl shadow-blue-500/30 hover:bg-blue-700 hover:-translate-y-1 transition-all flex items-center justify-center gap-3">
                        <i data-lucide="message-circle" class="w-5 h-5"></i>
                        HUBUNGI ADMIN VIA WHATSAPP
                    </a>
                @else
                    <button disabled class="w-full bg-slate-200 text-slate-400 py-4 rounded-2xl font-black cursor-not-allowed">
                        AKUN SUDAH TERJUAL
                    </button>
                @endif
            </div>
        </div>
    </div>
</main>

<script>lucide.createIcons();</script>
</body>
</html>