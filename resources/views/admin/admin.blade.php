<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | RELLZYY STORE</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link:hover { background-color: rgba(59, 130, 246, 0.1); }
        .sidebar-link.active { background-color: #2563eb; color: white; }
    </style>
</head>

<body class="bg-slate-50 text-slate-800">

<div class="flex min-h-screen">

    <aside class="w-72 bg-slate-900 text-slate-300 flex flex-col border-r border-slate-800 shadow-xl">
        <div class="p-8">
            <div class="flex items-center gap-3 mb-10">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-600/30">
                    <i data-lucide="shield-check" class="text-white w-6 h-6"></i>
                </div>
                <h2 class="text-xl font-bold tracking-tight text-white uppercase">Admin<span class="text-blue-500">Panel</span></h2>
            </div>

            <nav class="space-y-2">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4">Menu Utama</p>
                
                <a href="/admin" class="sidebar-link active flex items-center gap-3 p-3 rounded-xl transition-all">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="/admin/akun/create" class="sidebar-link flex items-center gap-3 p-3 rounded-xl transition-all hover:text-white">
                    <i data-lucide="plus-circle" class="w-5 h-5"></i>
                    <span class="font-medium">Tambah Akun</span>
                </a>

                <a href="/admin/akun/index" class="sidebar-link flex items-center gap-3 p-3 rounded-xl transition-all hover:text-white">
                    <i data-lucide="database" class="w-5 h-5"></i>
                    <span class="font-medium">Data Akun</span>
                </a>

                <a href="{{ route('admin.akun.kelola_user') }}" 
   class="sidebar-link flex items-center gap-3 p-3 rounded-xl transition-all hover:text-white border-t border-slate-800 mt-4 pt-6 {{ request()->is('admin/akun/kelola_user') ? 'active' : '' }}">
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
                    <p class="text-sm font-bold text-white truncate w-full" title="{{ Auth::user()->name }}">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-xs text-slate-500 truncate uppercase tracking-wider">Administrator</p>
                </div>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex flex-col">

        <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-30 border-b border-slate-200 px-8 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-bold text-slate-900">Selamat Datang Kembali 👋</h1>
                <p class="text-sm text-slate-500">Pantau statistik penjualan akun hari ini.</p>
            </div>

            <div class="flex items-center gap-6">
                <div class="relative hidden lg:block">
                    <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" placeholder="Cari data..." class="bg-slate-100 border-none rounded-full py-2 pl-10 pr-4 text-sm focus:ring-2 focus:ring-blue-500 w-64">
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="flex items-center gap-2 bg-rose-50 text-rose-600 px-4 py-2 rounded-xl text-sm font-bold hover:bg-rose-600 hover:text-white transition-all">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        Keluar
                    </button>
                </form>
            </div>
        </nav>

        <main class="p-8">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <i data-lucide="shopping-bag" class="w-6 h-6"></i>
                </div>
                <span class="text-xs font-bold text-blue-500 bg-blue-50 px-2 py-1 rounded-full">Stok Aktif</span>
            </div>
            <h3 class="text-slate-500 text-sm font-medium">Total Akun Terpasang</h3>
            <p class="text-3xl font-black text-slate-900">{{ $totalAkun }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <i data-lucide="trending-up" class="w-6 h-6"></i>
                </div>
                <span class="text-xs font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-full">Terjual</span>
                
            </div>
            
            <h3 class="text-slate-500 text-sm font-medium">Total Akun Terjual</h3>  {{-- ← tambah ini --}}
    <p class="text-3xl font-black text-slate-900">{{ $totalTerjual }}</p>    {{-- ← tambah ini --}}
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                    <i data-lucide="users" class="w-6 h-6"></i>
                </div>
                <span class="text-xs font-bold text-indigo-500 bg-indigo-50 px-2 py-1 rounded-full">Member</span>
            </div>
            <h3 class="text-slate-500 text-sm font-medium">User Terdaftar</h3>
            <p class="text-3xl font-black text-slate-900">{{ $totalUser }}</p>
        </div>
    </div>
    
    </main>
    </div>

</div>

<script>
    lucide.createIcons();
</script>
</body>
</html>