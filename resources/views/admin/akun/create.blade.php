<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun | Admin RELLZYY STORE</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link:hover { background-color: rgba(59, 130, 246, 0.1); }
        /* Style untuk menu aktif */
        .sidebar-link.active { background-color: #2563eb; color: white; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2); }
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

                <a href="/admin/akun/index" class="sidebar-link flex items-center gap-3 p-3 rounded-xl transition-all {{ request()->is('admin/akun/index') ? 'active' : '' }}">
                    <i data-lucide="database" class="w-5 h-5"></i>
                    <span class="font-medium">Data Akun</span>
                </a>

                <a href="{{ route('admin.akun.kelola_user') }}" 
                   class="sidebar-link flex items-center gap-3 p-3 rounded-xl transition-all border-t border-slate-800 mt-4 pt-6 {{ request()->is('admin/akun/kelola_user') ? 'active' : '' }}">
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
            <h1 class="text-xl font-bold text-slate-900">Input Produk Baru</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="flex items-center gap-2 bg-rose-50 text-rose-600 px-4 py-2 rounded-xl text-sm font-bold hover:bg-rose-600 hover:text-white transition-all">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    Keluar
                </button>
            </form>
        </nav>

        <div class="p-8 flex justify-center">
            <div class="w-full max-w-2xl bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                
                @if(session('success'))
                <div class="m-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-3">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                    <span class="text-sm font-bold">{{ session('success') }}</span>
                </div>
                @endif

                <div class="p-6 border-b border-slate-50 bg-slate-50/50">
                    <p class="text-slate-500 text-sm">Silahkan isi formulir di bawah untuk menambah stok akun baru.</p>
                </div>

                <form action="/admin/akun/store" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Akun / Judul</label>
                        <input type="text" name="nama_akun" required placeholder="Contoh: Akun ML Mythical Glory" 
                               class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Kategori Game</label>
                            <select name="kategori_game" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Mobile Legends">Mobile Legends</option>
                                <option value="Free Fire">Free Fire</option>
                                <option value="PUBG">PUBG Mobile</option>
                                <option value="Genshin Impact">Genshin Impact</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Harga (Rp)</label>
                            <input type="number" name="harga" required placeholder="1500000" 
                                   class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Status Produk</label>
                            <select name="status" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl outline-none font-semibold">
                                <option value="ready">🟢 Ready Stock</option>
                                <option value="booking">🟡 Booking</option>
                                <option value="sold">🔴 Sold Out</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Detail</label>
                        <textarea name="deskripsi" rows="4" placeholder="Sebutkan hero, skin, dll..." 
                                  class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Upload Foto Akun</label>
                        <div class="mt-1 flex flex-col items-center justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-xl hover:border-blue-400 transition-colors bg-slate-50 relative">
                            <div class="space-y-1 text-center" id="upload-placeholder">
                                <i data-lucide="image" class="mx-auto h-12 w-12 text-slate-300"></i>
                                <div class="flex text-sm text-slate-600 justify-center">
                                    <label class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                        <span>Pilih File Gambar</span>
                                        <input type="file" name="foto" id="foto-input" class="sr-only" accept="image/*" onchange="previewImage(event)">
                                    </label>
                                </div>
                                <p class="text-xs text-slate-500">PNG, JPG up to 2MB</p>
                            </div>
                            <img id="image-preview" class="hidden max-h-48 rounded-lg mb-2 shadow-md">
                            <button type="button" id="remove-btn" onclick="removeImage()" class="hidden text-xs text-rose-600 font-bold underline mt-2">Hapus Gambar</button>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="flex-1 bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition-all">
                            Simpan Data Akun
                        </button>
                        <a href="/admin/akun/index" class="px-6 py-3 bg-slate-100 text-slate-600 font-bold rounded-xl hover:bg-slate-200 transition-all text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('upload-placeholder');
        const removeBtn = document.getElementById('remove-btn');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                removeBtn.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeImage() {
        const input = document.getElementById('foto-input');
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('upload-placeholder');
        const removeBtn = document.getElementById('remove-btn');

        input.value = '';
        preview.classList.add('hidden');
        placeholder.classList.remove('hidden');
        removeBtn.classList.add('hidden');
    }
    
    lucide.createIcons();
</script>
</body>
</html>