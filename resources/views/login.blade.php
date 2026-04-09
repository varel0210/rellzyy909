<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | RELLZYY STORE</title>
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700" rel="stylesheet" />
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#0f172a] font-['Poppins'] flex items-center justify-center min-h-screen p-4">

    <div class="flex flex-col md:flex-row w-full max-w-4xl bg-gray-800 rounded-3xl overflow-hidden shadow-2xl border border-gray-700">
        
        <div class="w-full md:w-1/2 bg-blue-600 p-10 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-[-10%] left-[-10%] w-64 h-64 bg-blue-500 rounded-full blur-3xl opacity-50"></div>
            
            <div class="relative z-10">
                <a href="/" class="flex items-center gap-2 text-white group">
                    <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i>
                    <span class="font-semibold text-sm">Kembali ke Beranda</span>
                </a>
            </div>

            <div class="relative z-10 mt-12 md:mt-0">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-6">
                    <i data-lucide="shopping-cart" class="text-white w-10 h-10"></i>
                </div>
                <h1 class="text-4xl font-black text-white tracking-tighter mb-4">
                    RELLZYY<span class="text-blue-200">STR</span>
                </h1>
                <p class="text-blue-100 text-sm leading-relaxed max-w-xs">
                    Masuk untuk mengakses koleksi akun premium dan kelola transaksi Anda dengan aman.
                </p>
            </div>

            <div class="relative z-10 text-blue-200 text-xs mt-8 md:mt-0">
                &copy; 2026 RELLZYY STORE. Trusted Marketplace.
            </div>
        </div>

        <div class="w-full md:w-1/2 p-8 md:p-12 bg-gray-800">
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-white mb-2">Selamat Datang!</h2>
                <p class="text-gray-400 text-sm">Silakan masukkan akun Anda untuk melanjutkan.</p>
            </div>

            @if(session('error'))
                <div class="bg-rose-500/10 border border-rose-500/50 text-rose-500 p-3 rounded-xl mb-6 text-sm flex items-center gap-3">
                    <i data-lucide="alert-circle" class="w-5 h-5"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-5">
                @csrf

                <div>
                    <label class="text-gray-400 text-xs font-bold uppercase tracking-wider ml-1">Email</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <input type="email" name="email"
                            class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-gray-900/50 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-gray-600"
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
                            class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-gray-900/50 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-gray-600"
                            placeholder="••••••••" required>
                    </div>
                </div>

                <div class="flex justify-end">
                    <a href="#" class="text-xs text-blue-400 hover:text-blue-300 transition-colors">Lupa Password?</a>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-600/20 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                    Masuk Sekarang
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-gray-700/50 text-center">
                <p class="text-gray-400 text-sm">
                    Belum punya akun? 
                    <a href="/register" class="text-blue-400 font-bold hover:text-blue-300 transition-colors underline underline-offset-4">Daftar Gratis</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Inisialisasi Ikon Lucide
        lucide.createIcons();
    </script>
</body>
</html>