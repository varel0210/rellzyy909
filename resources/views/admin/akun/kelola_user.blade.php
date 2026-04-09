<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User | Admin RELLZYY STORE</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .sidebar-link:hover { background-color: rgba(59, 130, 246, 0.1); }
        .sidebar-link.active { background-color: #2563eb; color: white; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2); }
        
        #discountModal.hidden { display: none; }
        .modal-enter { animation: modalFadeIn 0.3s ease-out; }
        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-['Inter']">
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
                    <a href="/admin/akun/kelola_user" class="sidebar-link flex items-center gap-3 p-3 rounded-xl transition-all border-t border-slate-800 mt-4 pt-6 {{ request()->is('admin/akun/kelola_user') ? 'active' : '' }}">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        <span class="font-medium">Manajemen User</span>
                    </a>
                </nav>
            </div>

            <div class="mt-auto p-8 border-t border-slate-800 bg-slate-900/50">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-blue-500/20 border border-blue-500/30 flex items-center justify-center text-blue-400 font-bold text-xs uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">Administrator</p>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col">
            <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-30 border-b border-slate-200 px-8 py-4 flex justify-between items-center">
                <h1 class="text-xl font-bold text-slate-900">Manajemen User</h1>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="flex items-center gap-2 bg-rose-50 text-rose-600 px-4 py-2 rounded-xl text-sm font-bold hover:bg-rose-600 hover:text-white transition-all">
                        <i data-lucide="log-out" class="w-4 h-4"></i> Keluar
                    </button>
                </form>
            </nav>

            <main class="p-8">
                @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl flex items-center gap-3 text-sm font-bold shadow-sm">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                    {{ session('success') }}
                </div>
                @endif

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900">Daftar Member Terdaftar</h2>
                            <p class="text-sm text-slate-500">Kelola akses dan diskon khusus member</p>
                        </div>
                        <div class="bg-blue-50 text-blue-600 px-4 py-2 rounded-lg text-xs font-bold border border-blue-100">
                            {{ count($users) }} Member Aktif
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 text-slate-500 text-[11px] uppercase tracking-widest font-bold">
                                <tr>
                                    <th class="px-6 py-4">Nama</th>
                                    <th class="px-6 py-4">Email</th>
                                    <th class="px-6 py-4">Diskon Aktif</th>
                                    <th class="px-6 py-4">Bergabung</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($users as $user)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-slate-900">{{ $user->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600 text-sm">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        @if($user->discount > 0)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-black border border-amber-200">
                                                <i data-lucide="sparkles" class="w-3 h-3"></i>
                                                {{ $user->discount }}% OFF
                                            </span>
                                        @else
                                            <span class="text-slate-400 text-xs italic">Tidak ada diskon</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-xs text-slate-500">{{ $user->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <button onclick="openDiscountModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->discount }}')" 
                                                class="flex items-center gap-2 px-3 py-2 bg-amber-50 text-amber-600 border border-amber-100 rounded-lg hover:bg-amber-600 hover:text-white transition-all text-xs font-bold">
                                                <i data-lucide="percent" class="w-3.5 h-3.5"></i>
                                                {{ $user->discount > 0 ? 'Update' : 'Beri' }} Diskon
                                            </button>

                                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors border border-rose-100">
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
                </div>
            </main>
        </div>
    </div>

    <div id="discountModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden modal-enter border border-white/20">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-slate-900">Pengaturan Diskon</h3>
                    <button onclick="closeDiscountModal()" class="text-slate-400 hover:text-slate-600">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                
                <form action="{{ route('admin.user.give_discount') }}" method="POST" id="discountForm" class="p-6">
                    @csrf
                    <input type="hidden" name="user_id" id="modal_user_id">
                    
                    <div class="mb-6 text-center">
                        <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="gift" class="w-8 h-8"></i>
                        </div>
                        <p class="text-sm text-slate-500">Berikan potongan harga khusus untuk member:</p>
                        <h4 id="modal_user_name" class="text-xl font-black text-slate-900 mt-1"></h4>
                    </div>

                    <div class="mb-6">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Persentase Diskon Baru</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="tag" class="w-5 h-5"></i>
                            </div>
                            <input type="number" name="discount_percent" id="modal_discount_input" min="0" max="100" required
                                class="w-full pl-12 pr-12 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 focus:outline-none font-black text-xl text-slate-800"
                                placeholder="0">
                            <span class="absolute right-4 top-4 font-black text-slate-400 text-xl">%</span>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3">
                        <div class="flex gap-3">
                            <button type="button" onclick="closeDiscountModal()" 
                                class="flex-1 px-4 py-3 bg-slate-100 text-slate-600 rounded-xl font-bold hover:bg-slate-200 transition-all">Batal</button>
                            <button type="submit" 
                                class="flex-[2] px-4 py-3 bg-amber-500 text-white rounded-xl font-bold hover:bg-amber-600 shadow-lg shadow-amber-500/30 transition-all flex items-center justify-center gap-2">
                                <i data-lucide="save" class="w-4 h-4"></i> Simpan
                            </button>
                        </div>
                        
                        <button type="button" onclick="deleteDiscount()" id="btnDeleteDiscount"
                            class="w-full px-4 py-3 bg-rose-50 text-rose-600 border border-rose-100 rounded-xl font-bold hover:bg-rose-600 hover:text-white transition-all flex items-center justify-center gap-2">
                            <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus Semua Diskon
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function openDiscountModal(id, name, currentDiscount) {
            document.getElementById('modal_user_id').value = id;
            document.getElementById('modal_user_name').innerText = name;
            document.getElementById('modal_discount_input').value = currentDiscount;
            document.getElementById('discountModal').classList.remove('hidden');

            // Logika sembunyi/tampilkan tombol hapus
            const btnDelete = document.getElementById('btnDeleteDiscount');
            if(parseFloat(currentDiscount) <= 0) {
                btnDelete.classList.add('hidden');
            } else {
                btnDelete.classList.remove('hidden');
            }
        }

        function closeDiscountModal() {
            document.getElementById('discountModal').classList.add('hidden');
        }

        function deleteDiscount() {
            if(confirm('Hapus semua diskon untuk member ini?')) {
                document.getElementById('modal_discount_input').value = 0;
                document.getElementById('discountForm').submit();
            }
        }

        window.onclick = function(event) {
            let modal = document.getElementById('discountModal');
            if (event.target == modal.firstElementChild || event.target == modal) {
                closeDiscountModal();
            }
        }
    </script>
</body>
</html>