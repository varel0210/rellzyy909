<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RELLZYY STORE | Jual Beli Akun Terpercaya</title>

    <link href="https://fonts.bunny.net/css?family=montserrat:700,800|poppins:400,500,600" rel="stylesheet" />
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900 font-['Poppins']">

<nav class="sticky top-0 bg-white/80 backdrop-blur-md shadow-sm z-50">
    <div class="max-w-7xl mx-auto px-6 flex justify-between items-center h-20">
        
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-600/20">
                <i data-lucide="shopping-cart" class="text-white w-6 h-6"></i>
            </div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tighter">RELLZYY<span class="text-blue-600">STR</span></h1>
        </div>

        <div class="flex items-center gap-8">
            <div class="hidden md:flex items-center gap-6 font-semibold text-sm">
                <a href="/" class="{{ !request('kategori') ? 'text-blue-600' : 'text-slate-500' }}">Beranda</a>
                <a href="#katalog" class="text-slate-500 hover:text-blue-600 transition-colors">Katalog</a>
            </div>

            <div class="h-6 w-[1px] bg-slate-200 hidden md:block"></div>

            <div class="flex items-center gap-4">
                @auth
                    <div class="relative">
                        <button onclick="toggleDropdown()" 
                            class="flex items-center gap-3 bg-slate-100 hover:bg-slate-200 p-1.5 pr-4 rounded-full transition-all">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=2563eb&color=fff" 
                                 class="w-8 h-8 rounded-full shadow-sm">
                            <span class="text-sm font-bold text-slate-700">{{ Auth::user()->name }}</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
                        </button>

                        <div id="dropdownMenu" class="hidden absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 overflow-hidden">
                            @if(Auth::user()->role == 'admin')
                                <a href="/admin" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-600 hover:bg-blue-50 hover:text-blue-600">
                                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard Admin
                                </a>
                            @endif
                            <a href="/profile" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-600 hover:bg-blue-50 hover:text-blue-600">
                                <i data-lucide="user" class="w-4 h-4"></i> Detail Profil
                            </a>
                            <div class="border-t border-slate-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full flex items-center gap-3 px-4 py-3 text-sm font-bold text-rose-500 hover:bg-rose-50">
                                    <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-blue-500/20 hover:bg-blue-700 transition-all">
                        Daftar Sekarang
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<header class="relative py-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <span class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 rounded-full text-xs font-bold tracking-widest uppercase mb-6">
            Marketplace Akun Game No. 1
        </span>
        <h1 class="text-5xl md:text-6xl font-black text-slate-900 mb-6 leading-tight">
            Cari Akun <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500">Impianmu</span><br>Dengan Aman.
        </h1>
        <p class="text-slate-500 text-lg mb-10 max-w-2xl mx-auto">
            Platform jual beli akun game sultan terpercaya dengan ribuan testimoni sukses. Proses cepat, legal, dan bergaransi.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="#katalog" class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-bold shadow-xl shadow-blue-600/30 hover:scale-105 transition-all">
                Mulai Belanja
            </a>
        </div>
    </div>
</header>

<section id="katalog" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-8">
            <div>
                <h2 class="text-3xl font-black text-slate-900 mb-2">Katalog Terbaru</h2>
                <div class="w-20 h-1.5 bg-blue-600 rounded-full"></div>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ url('/') }}#katalog" 
                   class="px-5 py-2.5 rounded-xl text-xs font-bold transition-all {{ !request('kategori') ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/20' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}">
                    Semua Akun
                </a>
                @foreach($categories as $cat)
                    <a href="?kategori={{ $cat }}#katalog" 
                       class="px-5 py-2.5 rounded-xl text-xs font-bold transition-all {{ request('kategori') == $cat ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($akun as $a)
                <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                    
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('storage/'.$a->foto) }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                             alt="{{ $a->nama_akun }}">
                        
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 backdrop-blur px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider shadow-sm text-slate-800">
                                {{ $a->kategori_game }}
                            </span>
                        </div>

                        {{-- LABEL DISKON --}}
                        @auth
                            @if(Auth::user()->discount > 0)
                            <div class="absolute top-4 right-4">
                                <span class="bg-amber-500 text-white px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-tighter shadow-lg flex items-center gap-1 animate-bounce">
                                    <i data-lucide="zap" class="w-3 h-3 fill-current"></i>
                                    {{ Auth::user()->discount }}% OFF
                                </span>
                            </div>
                            @endif
                        @endauth

                        <div class="absolute bottom-4 right-4">
                            @if($a->status == 'ready')
                                <span class="bg-emerald-500 text-white px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-tighter shadow-lg flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> Ready
                                </span>
                            @else
                                <span class="bg-rose-500 text-white px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-tighter shadow-lg">
                                    Sold Out
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="font-bold text-slate-900 text-lg mb-2 truncate">{{ $a->nama_akun }}</h3>
                        <p class="text-slate-400 text-xs mb-4 line-clamp-2 min-h-[32px]">
                            {{ $a->deskripsi ?? 'Tidak ada deskripsi produk.' }}
                        </p>

                        <div class="flex justify-between items-center pt-4 border-t border-slate-50">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase">Harga</p>
                                
                                @auth
                                    @if(Auth::user()->discount > 0)
                                        <div class="flex flex-col">
                                            <span class="text-[10px] text-rose-400 line-through">
                                                Rp {{ number_format($a->harga) }}
                                            </span>
                                            <p class="text-blue-600 font-black text-lg">
                                                Rp {{ number_format($a->harga * (1 - Auth::user()->discount / 100)) }}
                                            </p>
                                        </div>
                                    @else
                                        <p class="text-blue-600 font-black text-lg">Rp {{ number_format($a->harga) }}</p>
                                    @endif
                                @else
                                    <p class="text-blue-600 font-black text-lg">Rp {{ number_format($a->harga) }}</p>
                                @endauth
                            </div>
                            
                            <a href="{{ route('akun.detail', $a->id) }}" class="bg-blue-600 text-white px-4 py-2.5 rounded-xl text-xs font-bold hover:bg-slate-900 transition-all shadow-lg shadow-blue-500/20 flex items-center gap-2">
                                <i data-lucide="eye" class="w-4 h-4"></i> Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="package-search" class="w-10 h-10 text-slate-200"></i>
                    </div>
                    <p class="text-slate-400 font-bold">Maaf, akun untuk kategori ini sedang kosong.</p>
                    <a href="/" class="text-blue-600 text-sm font-bold mt-2 inline-block">Lihat Semua Akun</a>
                </div>
            @endforelse
        </div>
    </div>
</section>

<footer class="bg-slate-900 text-slate-400 py-12 mt-20">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-white font-bold text-xl mb-4 uppercase tracking-tighter text-blue-500">RELLZYY STORE</h2>
        <div class="flex justify-center gap-6 mb-8">
            <a href="#" class="hover:text-white transition-colors"><i data-lucide="instagram" class="w-5 h-5"></i></a>
            <a href="#" class="hover:text-white transition-colors"><i data-lucide="facebook" class="w-5 h-5"></i></a>
        </div>
        <p class="text-xs border-t border-slate-800 pt-8">© 2026 RELLZYY STORE. All Rights Reserved.</p>
    </div>
</footer>

<script>
    lucide.createIcons();

    function toggleDropdown() {
        const menu = document.getElementById("dropdownMenu");
        menu.classList.toggle("hidden");
    }

    window.onclick = function(e) {
        if (!e.target.closest('.relative')) {
            document.getElementById("dropdownMenu")?.classList.add("hidden");
        }
    }
</script>
</body>
</html>