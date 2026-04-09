<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Akun | Admin RELLZYY STORE</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link:hover { background-color: rgba(59, 130, 246, 0.1); }
        .sidebar-link.active { 
            background-color: #2563eb !important; 
            color: white !important; 
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3); 
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800">

<div class="flex min-h-screen">
    <aside class="w-72 bg-slate-900 text-slate-300 flex flex-col border-r border-slate-800 shadow-xl sticky top-0 h-screen">
        <div class="p-8">
            <div class="flex items-center gap-3 mb-10">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-600/30">
                    <i data-lucide="shield-check" class="text-white w-6 h-6"></i>
                </div>
                <h2 class="text-xl font-bold tracking-tight text-white uppercase">Admin<span class="text-blue-500">Panel</span></h2>
            </div>

            <nav class="space-y-2">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4">Menu Utama</p>
                
                <a href="/admin" class="sidebar-link flex items-center gap-3 p-3 rounded-xl transition-all {{ request()->is('admin') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="/admin/akun/create" class="sidebar-link flex items-center gap-3 p-3 rounded-xl transition-all {{ request()->is('admin/akun/create') ? 'active' : '' }}">
                    <i data-lucide="plus-circle" class="w-5 h-5"></i>
                    <span class="font-medium">Tambah Akun</span>
                </a>

                <a href="/admin/akun/index" class="sidebar-link flex items-center gap-3 p-3 rounded-xl transition-all {{ (request()->is('admin/akun/index') || request()->is('admin/akun/*/edit')) ? 'active' : '' }}">
                    <i data-lucide="database" class="w-5 h-5"></i>
                    <span class="font-medium">Data Akun</span>
                </a>

                <a href="{{ route('admin.akun.kelola_user') }}" class="sidebar-link flex items-center gap-3 p-3 rounded-xl transition-all border-t border-slate-800 mt-4 pt-6 {{ request()->is('admin/akun/kelola_user') ? 'active' : '' }}">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    <span class="font-medium">Manajemen User</span>
                </a>
            </nav>
        </div>

        <div class="mt-auto p-8 border-t border-slate-800 bg-slate-900/50">
            <div class="flex items-center gap-3 w-full">
                <div class="shrink-0 w-9 h-9 rounded-full bg-blue-500/20 border border-blue-500/30 flex items-center justify-center text-blue-400 font-bold text-xs uppercase">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0"> 
                    <p class="text-sm font-bold text-white truncate w-full">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-500 truncate uppercase tracking-wider">Administrator</p>
                </div>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex flex-col">
        <nav class="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center sticky top-0 z-30">
            <h1 class="text-xl font-bold text-slate-900">Manajemen Stok</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="flex items-center gap-2 bg-rose-50 text-rose-600 px-4 py-2 rounded-xl text-sm font-bold hover:bg-rose-600 hover:text-white transition-all">
                    <i data-lucide="log-out" class="w-4 h-4"></i> Keluar
                </button>
            </form>
        </nav>

        <div class="p-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Daftar Akun Game</h2>
                        <p class="text-sm text-slate-500">Total: {{ count($akun) }} akun aktif</p>
                    </div>
                    <a href="/admin/akun/create" class="bg-blue-600 text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-blue-500/20 flex items-center gap-2 hover:bg-blue-700 transition-all">
                        <i data-lucide="plus" class="w-4 h-4"></i> Tambah Stok Akun
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50/80 text-slate-500 text-[11px] uppercase tracking-widest font-bold">
                            <tr>
                                <th class="px-6 py-4">Preview</th>
                                <th class="px-6 py-4">Nama Produk</th>
                                <th class="px-6 py-4">Deskripsi</th>
                                <th class="px-6 py-4">Game</th>
                                <th class="px-6 py-4">Harga Jual</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($akun as $a)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="w-16 h-12 bg-slate-100 rounded-lg overflow-hidden border border-slate-200 shadow-sm">
                                        <img src="{{ asset('storage/'.$a->foto) }}" class="w-full h-full object-cover">
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-slate-900">{{ $a->nama_akun }}</td>
                                
                                <td class="px-6 py-4">
                                    <p class="text-xs text-slate-500 max-w-[200px] leading-relaxed line-clamp-2" title="{{ $a->deskripsi }}">
                                        {{ \Illuminate\Support\Str::limit($a->deskripsi, 50) }}
                                    </p>
                                </td>

                                <td class="px-6 py-4 text-sm text-slate-600">
                                    <span class="text-xs text-slate-500 max-w-[200px] leading-relaxed line-clamp-2" title="{{ $a->kategori_game }}">
                                        {{ $a->kategori_game }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-black text-blue-600">Rp {{ number_format($a->harga) }}</td>
                                
                                <td class="px-6 py-4">
                                    @if($a->status == 'ready')
                                        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> READY
                                        </span>
                                    @elseif($a->status == 'booking')
                                        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-amber-100 text-amber-700 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> BOOKING
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-rose-100 text-rose-700 border border-rose-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> SOLD OUT
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.akun.edit', $a->id) }}" title="Edit Data" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors border border-amber-100">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>

                                        <form action="{{ route('admin.akun.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus Data" class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors border border-rose-100">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if(count($akun) == 0)
                <div class="p-20 text-center">
                    <i data-lucide="inbox" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
                    <p class="text-slate-400 font-medium">Belum ada stok akun yang tersedia.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>lucide.createIcons();</script>
</body>
</html>