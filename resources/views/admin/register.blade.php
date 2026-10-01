<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin - TB Harapan Bumi Mas</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                            950: '#022c22'
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="h-full font-sans antialiased bg-slate-50 text-slate-800 flex items-center justify-center p-4">

    <!-- Background Decoration -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Main Card Container -->
    <div class="w-full max-w-md relative z-10">
        
        <!-- Brand Header -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-3 group mb-2">
                <div class="w-12 h-12 bg-gradient-to-tr from-emerald-700 to-emerald-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-600/20 group-hover:scale-105 transition-transform">
                    <i data-lucide="leaf" class="w-6 h-6"></i>
                </div>
                <div class="text-left">
                    <span class="text-xl font-extrabold text-emerald-950 block leading-tight">HARAPAN BUMI MAS</span>
                    <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">Portal Admin</span>
                </div>
            </a>
            <h2 class="text-2xl font-extrabold text-emerald-950 mt-4">Pendaftaran Admin Baru</h2>
            <p class="text-xs text-slate-500 mt-1">Buat akun pengelola untuk mengontrol sistem TB Harapan Bumi Mas</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-8 border border-emerald-100/80 shadow-xl shadow-emerald-950/5">
            
            {{-- Alert Flash Message Success --}}
            @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-2xl text-xs font-semibold flex items-center gap-2">
                <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <form action="{{ route('admin.register.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Input Email -->
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 mb-1.5">Alamat Email Admin</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                            placeholder="admin@harapanbumimas.com" 
                            class="w-full pl-10 pr-4 py-3 text-sm rounded-xl border @error('email') border-red-500 focus:ring-red-500/20 @else border-slate-200 focus:border-emerald-500 focus:ring-emerald-500/20 @enderror focus:outline-none focus:ring-2 transition-all">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-[11px] font-medium mt-1 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Input Password -->
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-700 mb-1.5">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                        </div>
                        <input type="password" name="password" id="password" required 
                            placeholder="Minimal 6 Karakter" 
                            class="w-full pl-10 pr-10 py-3 text-sm rounded-xl border @error('password') border-red-500 focus:ring-red-500/20 @else border-slate-200 focus:border-emerald-500 focus:ring-emerald-500/20 @enderror focus:outline-none focus:ring-2 transition-all">
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-emerald-600 transition-colors">
                            <i data-lucide="eye" id="eyeIcon" class="w-4 h-4"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-[11px] font-medium mt-1 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-emerald-600/30 transition-all text-sm flex items-center justify-center gap-2 group">
                    <span>Daftarkan Admin</span>
                    <i data-lucide="user-plus" class="w-4 h-4 group-hover:translate-x-0.5 transition-transform"></i>
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-100 text-center">
                <p class="text-xs text-slate-500">
                    Sudah memiliki akun admin? 
                    <a href="#" class="text-emerald-600 font-bold hover:underline">Masuk Login</a>
                </p>
            </div>
        </div>

        <p class="text-center text-[11px] text-slate-400 mt-6">
            &copy; 2026 TB Harapan Bumi Mas. Hak Cipta Dilindungi.
        </p>
    </div>

    <!-- JavaScript Logic -->
    <script>
        // Init Lucide Icons
        lucide.createIcons();

        // Toggle Password Visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.setAttribute('data-lucide', 'eye-off');
            } else {
                passwordInput.type = 'password';
                eyeIcon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }
    </script>
</body>
</html>