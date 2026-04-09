<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | RELLZYY STORE</title>
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700" rel="stylesheet" />
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#0f172a] font-['Poppins'] flex items-center justify-center min-h-screen p-4">

    <div class="flex flex-col md:flex-row w-full max-w-4xl bg-gray-800 rounded-3xl overflow-hidden shadow-2xl border border-gray-700">
        
        <div class="w-full md:w-1/2 bg-emerald-600 p-10 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-[-10%] left-[-10%] w-64 h-64 bg-emerald-500 rounded-full blur-3xl opacity-50"></div>
            
            <div class="relative z-10">
                <a href="/" class="flex items-center gap-2 text-white group">
                    <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i>
                    <span class="font-semibold text-sm">Kembali ke Beranda</span>
                </a>
            </div>

            <div class="relative z-10 mt-12 md:mt-0">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-6">
                    <i data-lucide="user-plus" class="text-white w-10 h-10"></i>
                </div>
                <h1 class="text-4xl font-black text-white tracking-tighter mb-4">
                    JOIN US<span class="text-emerald-200">.</span>
                </h1>
                <p class="text-emerald-100 text-sm leading-relaxed max-w-xs">
                    Buat akun sekarang dan mulai kumpulkan poin untuk setiap pembelian akun game favoritmu.
                </p>
            </div>

            <div class="relative z-10 text-emerald-200 text-xs mt-8 md:mt-0">
                &copy; 2026 RELLZYY STORE. No.1 Game Marketplace.
            </div>
        </div>

        <div class="w-full md:w-1/2 p-8 md:p-12 bg-gray-800">
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-white mb-2">Daftar Akun</h2>
                <p class="text-gray-400 text-sm">Lengkapi data di bawah untuk bergabung.</p>
            </div>

            <form method="POST" action="/register" class="space-y-5">
                @csrf

                <div>
                    <label class="text-gray-400 text-xs font-bold uppercase tracking-wider ml-1">Nama Lengkap</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                            <i data-lucide="user" class="w-5 h-5"></i>
                        </div>
                        <input type="text" name="name"
                            class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-gray-900/50 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all placeholder:text-gray-600"
                            placeholder="Masukkan nama lengkap" required>
                    </div>
                </div>

                <div>
                    <label class="text-gray-400 text-xs font-bold uppercase tracking-wider ml-1">Email</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <input type="email" name="email"
                            class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-gray-900/50 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all placeholder:text-gray-600"
                            placeholder="nama@email.com" required>
                    </div>
                </div>

                <div>
                    <label class="text-gray-400 text-xs font-bold uppercase tracking-wider ml-1">Password</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <input type="password" name="password"
                            class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-gray-900/50 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all placeholder:text-gray-600"
                            placeholder="Minimal 8 karakter" required>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-emerald-600/20 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                    Daftar Sekarang
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-gray-700/50 text-center">
                <p class="text-gray-400 text-sm">
                    Sudah punya akun? 
                    <a href="/login" class="text-emerald-400 font-bold hover:text-emerald-300 transition-colors underline underline-offset-4">Login Disini</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>