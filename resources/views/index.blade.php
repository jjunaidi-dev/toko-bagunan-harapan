<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta CSRF Token Wajib untuk AJAX Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TB Harapan Bumi Mas - Toko Bangunan Terlengkap & Terpercaya</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Tailwind Theme (Hijau Emerald & White) -->
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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        /* Custom Keyframe Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes pulseGlow {
            0%, 100% { opacity: 0.4; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.05); }
        }

        .animate-float { animation: float 4s ease-in-out infinite; }
        .animate-glow { animation: pulseGlow 3s ease-in-out infinite; }

        /* Ripple Effect Styles */
        .ripple { position: relative; overflow: hidden; }
        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to { transform: scale(4); opacity: 0; }
        }

        /* Scroll Reveal Animation Classes */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal-on-scroll.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* Glassmorphism */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(209, 250, 229, 0.5);
        }
    </style>
</head>

<body class="font-sans bg-slate-50 text-slate-800 antialiased flex flex-col min-h-screen overflow-x-hidden">

    <!-- TOAST NOTIFICATION -->
    <div id="toast"
        class="fixed bottom-6 right-6 z-50 bg-emerald-900 text-white px-5 py-3.5 rounded-2xl shadow-2xl flex items-center gap-3 transform translate-y-20 opacity-0 transition-all duration-300 pointer-events-none">
        <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center shrink-0">
            <i data-lucide="check" class="w-5 h-5 text-white"></i>
        </div>
        <span id="toastMsg" class="text-sm font-medium">Notifikasi</span>
    </div>

    <!-- TOP BAR -->
    <div class="bg-emerald-950 text-emerald-200 text-xs py-2 px-4 sm:px-8 border-b border-emerald-900">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center gap-6">
                <span class="flex items-center gap-1.5 hover:text-white transition-colors cursor-pointer">
                    <i data-lucide="phone" class="w-3.5 h-3.5 text-emerald-400"></i> +62 812-3456-7890
                </span>
                <span class="flex items-center gap-1.5 hover:text-white transition-colors cursor-pointer">
                    <i data-lucide="clock" class="w-3.5 h-3.5 text-emerald-400"></i> Senin - Sabtu: 08:00 - 17:00
                </span>
            </div>
            <div class="hidden md:flex items-center gap-2">
                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-emerald-400 animate-pulse"></i>
                <span class="font-medium">Penyedia Material Bangunan Ramah Lingkungan & Terlengkap</span>
            </div>
        </div>
    </div>

    <!-- HEADER / NAVBAR -->
    <header id="mainHeader"
        class="sticky top-0 z-40 bg-white/90 backdrop-blur-md transition-all duration-300 border-b border-emerald-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 h-20 flex items-center justify-between transition-all duration-300"
            id="headerContainer">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-3 group">
                <div
                    class="w-11 h-11 bg-gradient-to-tr from-emerald-700 to-emerald-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-500/20 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                    <i data-lucide="leaf" class="w-6 h-6"></i>
                </div>
                <div>
                    <span
                        class="text-xl font-extrabold tracking-tight text-emerald-950 block leading-none group-hover:text-emerald-600 transition-colors">HARAPAN
                        BUMI MAS</span>
                    <span class="text-[10px] font-bold tracking-widest text-emerald-600 uppercase">Toko Bangunan</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center gap-8 font-semibold text-slate-600 text-sm">
                <a href="#beranda"
                    class="hover:text-emerald-600 transition-all hover:-translate-y-0.5 inline-block">Beranda</a>
                <a href="#tentang"
                    class="hover:text-emerald-600 transition-all hover:-translate-y-0.5 inline-block">Tentang Kami</a>
                <a href="#produk"
                    class="hover:text-emerald-600 transition-all hover:-translate-y-0.5 inline-block">Katalog Produk</a>
                <a href="#keunggulan"
                    class="hover:text-emerald-600 transition-all hover:-translate-y-0.5 inline-block">Keunggulan</a>
                <a href="#kontak"
                    class="hover:text-emerald-600 transition-all hover:-translate-y-0.5 inline-block">Kontak</a>
            </nav>

            <!-- Header Action Buttons -->
            <div class="flex items-center gap-3">
                @auth
                    <!-- Jika Admin Sudah Login -->
                    <div class="flex items-center gap-3">
                        <a href="{{ route('dashboard') }}" class="text-xs font-bold bg-emerald-100 hover:bg-emerald-200 text-emerald-800 px-3.5 py-2 rounded-xl border border-emerald-200 transition-all">
                            Dashboard ({{ Auth::user()->email }})
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold text-xs px-3.5 py-2 rounded-xl transition-all shadow-sm">
                                Keluar
                            </button>
                        </form>
                    </div>
                @else
                    <!-- Jika Belum Login (Tombol Modal) -->
                    <button onclick="toggleModal('loginModal')"
                        class="ripple flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm px-5 py-2.5 rounded-2xl shadow-lg shadow-emerald-600/30 transition-all transform hover:scale-105 active:scale-95">
                        <i data-lucide="user" class="w-4 h-4"></i>
                        <span>Masuk</span>
                    </button>
                @endauth

                <!-- Mobile Menu Button -->
                <button id="menuBtn"
                    class="lg:hidden p-2.5 text-slate-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobileMenu"
            class="hidden lg:hidden bg-white/95 border-b border-emerald-100 px-6 py-4 space-y-3 transition-all">
            <a href="#beranda" class="block text-slate-700 font-semibold hover:text-emerald-600 py-1">Beranda</a>
            <a href="#tentang" class="block text-slate-700 font-semibold hover:text-emerald-600 py-1">Tentang Kami</a>
            <a href="#produk" class="block text-slate-700 font-semibold hover:text-emerald-600 py-1">Katalog Produk</a>
            <a href="#keunggulan" class="block text-slate-700 font-semibold hover:text-emerald-600 py-1">Keunggulan</a>
            <a href="#kontak" class="block text-slate-700 font-semibold hover:text-emerald-600 py-1">Kontak</a>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section id="beranda"
        class="relative bg-gradient-to-br from-emerald-950 via-emerald-900 to-slate-900 text-white py-24 lg:py-32 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl animate-glow"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl animate-glow"
            style="animation-delay: 1.5s;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-8 relative z-10 grid lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6 text-center lg:text-left reveal-on-scroll">
                <span
                    class="inline-flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold uppercase tracking-wider px-4 py-2 rounded-full backdrop-blur-md">
                    <i data-lucide="shield-check" class="w-4 h-4 text-emerald-400"></i> Solusi Bangunan Terbaik &
                    Terpercaya
                </span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight">
                    Bangun Kokoh Bersama <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-emerald-200">Harapan
                        Bumi Mas</span>
                </h1>
                <p
                    class="text-emerald-100/80 text-base sm:text-lg max-w-xl mx-auto lg:mx-0 font-normal leading-relaxed">
                    Menyediakan berbagai material konstruksi mulai dari semen, besi beton, cat tembok, hingga atap baja
                    ringan dengan kualitas SNI terjamin.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-4">
                    <a href="#produk"
                        class="ripple bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-8 py-4 rounded-2xl shadow-xl shadow-emerald-500/30 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2 group">
                        <span>Jelajahi Produk</span>
                        <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="https://wa.me/6281234567890" target="_blank"
                        class="ripple bg-white/10 hover:bg-white/20 backdrop-blur-md text-white border border-white/20 font-semibold px-8 py-4 rounded-2xl transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                        <i data-lucide="message-circle" class="w-5 h-5 text-emerald-400"></i>
                        <span>Hubungi WhatsApp</span>
                    </a>
                </div>
            </div>

            <div class="relative flex justify-center reveal-on-scroll" style="transition-delay: 200ms;">
                <div
                    class="relative w-full max-w-md bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-6 shadow-2xl animate-float">
                    <div
                        class="aspect-video bg-emerald-900 rounded-2xl overflow-hidden mb-6 relative group cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=800&q=80"
                            alt="Material Bangunan"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-emerald-950/80 via-transparent to-transparent">
                        </div>
                        <span
                            class="absolute bottom-3 left-3 bg-emerald-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">Stok
                            Terlengkap</span>
                    </div>
                    <div class="grid grid-cols-3 gap-3 text-center">
                        <div
                            class="p-3 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 transition-colors">
                            <h4 class="text-2xl font-black text-emerald-400">100%</h4>
                            <p class="text-[11px] text-emerald-200">Standar SNI</p>
                        </div>
                        <div
                            class="p-3 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 transition-colors">
                            <h4 class="text-2xl font-black text-emerald-400">15+</h4>
                            <p class="text-[11px] text-emerald-200">Th Pengalaman</p>
                        </div>
                        <div
                            class="p-3 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 transition-colors">
                            <h4 class="text-2xl font-black text-emerald-400">Cepat</h4>
                            <p class="text-[11px] text-emerald-200">Kirim Langsung</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TENTANG KAMI -->
    <section id="tentang" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6 reveal-on-scroll">
                    <span
                        class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest bg-emerald-50 px-3.5 py-1.5 rounded-full border border-emerald-100">Tentang
                        Kami</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-emerald-950 leading-tight">Mitra Bangunan
                        Terpercaya untuk Rumah & Proyek Impian Anda</h2>
                    <p class="text-slate-600 leading-relaxed font-normal">
                        TB Harapan Bumi Mas hadir sebagai penyedia bahan bangunan terlengkap yang mengutamakan mutu,
                        kejujuran takaran, dan pelayanan terbaik. Kami melayani kebutuhan eceran untuk renovasi rumah
                        hingga pengadaan material besar untuk proyek konstruksi.
                    </p>
                    <div class="space-y-3 pt-2">
                        <div class="flex items-center gap-3 group">
                            <div
                                class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </div>
                            <span class="text-slate-700 font-semibold text-sm">Pengiriman tepat waktu dengan armada
                                operasional sendiri.</span>
                        </div>
                        <div class="flex items-center gap-3 group">
                            <div
                                class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </div>
                            <span class="text-slate-700 font-semibold text-sm">Harga transparan dan kompetitif untuk
                                grosir maupun retail.</span>
                        </div>
                        <div class="flex items-center gap-3 group">
                            <div
                                class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </div>
                            <span class="text-slate-700 font-semibold text-sm">Layanan konsultasi material bangunan
                                gratis dari para ahli.</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 reveal-on-scroll" style="transition-delay: 200ms;">
                    <div class="space-y-4">
                        <div class="overflow-hidden rounded-3xl shadow-lg border border-emerald-100 group">
                            <img src="img/gambar1.jpg"
                                alt="Bangunan"
                                class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                    </div>
                    <div class="space-y-4 pt-8">
                        <div class="overflow-hidden rounded-3xl shadow-lg border border-emerald-100 group">
                            <img src="https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?auto=format&fit=crop&w=500&q=80"
                                alt="Material"
                                class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- KATALOG PRODUK -->
    <section id="produk" class="py-24 bg-emerald-50/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12 space-y-3 reveal-on-scroll">
                <span
                    class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest bg-emerald-100/60 px-3.5 py-1.5 rounded-full">Katalog
                    Produk</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-emerald-950">Bahan Bangunan Pilihan</h2>
                <p class="text-slate-600">Pilih dari bermacam produk berkualitas tinggi yang sesuai dengan anggaran dan
                    kebutuhan Anda.</p>
            </div>

            <!-- Filter Tabs -->
            <div class="flex flex-wrap justify-center gap-2 mb-12 reveal-on-scroll">
                <button onclick="filterProducts('all', this)"
                    class="filter-btn active bg-emerald-600 text-white font-semibold px-6 py-2.5 rounded-2xl text-sm transition-all shadow-md shadow-emerald-600/20">Semua
                    Produk</button>
                <button onclick="filterProducts('semen', this)"
                    class="filter-btn bg-white hover:bg-emerald-100/50 text-slate-700 font-semibold px-6 py-2.5 rounded-2xl text-sm border border-emerald-100 transition-all">Semen
                    & Bata</button>
                <button onclick="filterProducts('besi', this)"
                    class="filter-btn bg-white hover:bg-emerald-100/50 text-slate-700 font-semibold px-6 py-2.5 rounded-2xl text-sm border border-emerald-100 transition-all">Besi
                    & Baja</button>
                <button onclick="filterProducts('cat', this)"
                    class="filter-btn bg-white hover:bg-emerald-100/50 text-slate-700 font-semibold px-6 py-2.5 rounded-2xl text-sm border border-emerald-100 transition-all">Cat
                    & Finishing</button>
                <button onclick="filterProducts('atap', this)"
                    class="filter-btn bg-white hover:bg-emerald-100/50 text-slate-700 font-semibold px-6 py-2.5 rounded-2xl text-sm border border-emerald-100 transition-all">Atap
                    & Pipanisasi</button>
            </div>

            <!-- Product Cards Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6" id="productGrid">
                <!-- Product Card 1 -->
                <div
                    class="product-card semen bg-white rounded-3xl p-5 border border-emerald-100/80 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between group reveal-on-scroll">
                    <div>
                        <div class="bg-emerald-50 rounded-2xl overflow-hidden aspect-square mb-4 relative">
                            <img src="img/semen_tonasa.jpg"
                                alt="Semen PCC"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <span
                                class="absolute top-3 left-3 bg-emerald-950/80 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-full">Semen</span>
                        </div>
                        <h3 class="font-bold text-emerald-950 group-hover:text-emerald-600 transition-colors">Semen Tonasa 50kg</h3>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">Daya rekat cepat kering, sempurna untuk
                            plesteran & struktur.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-400 block font-semibold">Harga Satuan</span>
                            <span class="font-extrabold text-emerald-700 text-lg">Rp 64.000</span>
                        </div>
                        <button onclick="addCart('Semen PCC 50kg')"
                            class="ripple p-3 bg-emerald-50 hover:bg-emerald-600 text-emerald-600 hover:text-white rounded-2xl transition-all shadow-sm">
                            <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="product-card besi bg-white rounded-3xl p-5 border border-emerald-100/80 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between group reveal-on-scroll"
                    style="transition-delay: 100ms;">
                    <div>
                        <div class="bg-emerald-50 rounded-2xl overflow-hidden aspect-square mb-4 relative">
                            <img src="img/besi_beton.jpg"
                                alt="Besi Beton"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <span
                                class="absolute top-3 left-3 bg-emerald-950/80 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-full">Besi</span>
                        </div>
                        <h3 class="font-bold text-emerald-950 group-hover:text-emerald-600 transition-colors">Besi Beton 10 SNI</h3>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">Besi baja kualitas SNI full presisi
                            tinggi untuk fondasi rumah.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-400 block font-semibold">Harga Satuan</span>
                            <span class="font-extrabold text-emerald-700 text-lg">Rp 80.000</span>
                        </div>
                        <button onclick="addCart('Besi Beton 12mm')"
                            class="ripple p-3 bg-emerald-50 hover:bg-emerald-600 text-emerald-600 hover:text-white rounded-2xl transition-all shadow-sm">
                            <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="product-card cat bg-white rounded-3xl p-5 border border-emerald-100/80 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between group reveal-on-scroll"
                    style="transition-delay: 200ms;">
                    <div>
                        <div class="bg-emerald-50 rounded-2xl overflow-hidden aspect-square mb-4 relative">
                            <img src="https://images.unsplash.com/photo-1562259949-e8e7689d7828?auto=format&fit=crop&w=400&q=80"
                                alt="Cat Tembok"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <span
                                class="absolute top-3 left-3 bg-emerald-950/80 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-full">Cat</span>
                        </div>
                        <h3 class="font-bold text-emerald-950 group-hover:text-emerald-600 transition-colors">Cat Tembok
                            Interior 5kg</h3>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">Formula ramah lingkungan, warna indah
                            tahan lama.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-400 block font-semibold">Harga Satuan</span>
                            <span class="font-extrabold text-emerald-700 text-lg">Rp 145.000</span>
                        </div>
                        <button onclick="addCart('Cat Tembok Interior')"
                            class="ripple p-3 bg-emerald-50 hover:bg-emerald-600 text-emerald-600 hover:text-white rounded-2xl transition-all shadow-sm">
                            <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <!-- Product Card 4 -->
                <div class="product-card atap bg-white rounded-3xl p-5 border border-emerald-100/80 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between group reveal-on-scroll"
                    style="transition-delay: 300ms;">
                    <div>
                        <div class="bg-emerald-50 rounded-2xl overflow-hidden aspect-square mb-4 relative">
                            <img src="https://images.unsplash.com/photo-1620641788421-7a1c342ea42e?auto=format&fit=crop&w=400&q=80"
                                alt="Baja Ringan"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <span
                                class="absolute top-3 left-3 bg-emerald-950/80 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-full">Atap</span>
                        </div>
                        <h3 class="font-bold text-emerald-950 group-hover:text-emerald-600 transition-colors">Baja
                            Ringan Galvalum C75</h3>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">Sangat kuat, ringan, dan tidak mudah
                            berkarat.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-400 block font-semibold">Harga Satuan</span>
                            <span class="font-extrabold text-emerald-700 text-lg">Rp 82.000</span>
                        </div>
                        <button onclick="addCart('Baja Ringan C75')"
                            class="ripple p-3 bg-emerald-50 hover:bg-emerald-600 text-emerald-600 hover:text-white rounded-2xl transition-all shadow-sm">
                            <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- KEUNGGULAN -->
    <section id="keunggulan" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3 reveal-on-scroll">
                <span
                    class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest bg-emerald-50 px-3.5 py-1.5 rounded-full">Keunggulan</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-emerald-950">Alasan Memilih Kami</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div
                    class="p-8 rounded-3xl bg-slate-50/80 border border-slate-100 hover:border-emerald-300 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 space-y-4 group reveal-on-scroll">
                    <div
                        class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300 shadow-inner">
                        <i data-lucide="truck" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-extrabold text-emerald-950">Armada Sendiri</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Pengiriman dijamin tepat waktu langsung ke area
                        proyek konstruksi Anda.</p>
                </div>

                <!-- Card 2 -->
                <div class="p-8 rounded-3xl bg-slate-50/80 border border-slate-100 hover:border-emerald-300 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 space-y-4 group reveal-on-scroll"
                    style="transition-delay: 150ms;">
                    <div
                        class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300 shadow-inner">
                        <i data-lucide="award" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-extrabold text-emerald-950">Jaminan Mutu SNI</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Hanya menjual produk berkualitas resmi
                        bersertifikasi SNI demi keamanan bangunan.</p>
                </div>

                <!-- Card 3 -->
                <div class="p-8 rounded-3xl bg-slate-50/80 border border-slate-100 hover:border-emerald-300 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 space-y-4 group reveal-on-scroll"
                    style="transition-delay: 300ms;">
                    <div
                        class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300 shadow-inner">
                        <i data-lucide="tag" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-extrabold text-emerald-950">Harga Paling Juara</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Dapatkan penawaran harga spesial untuk order
                        partai besar & pengadaan kontraktor.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER & KONTAK -->
    <footer id="kontak" class="bg-emerald-950 text-emerald-100/80 pt-20 pb-12 border-t border-emerald-900 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 grid md:grid-cols-4 gap-10 mb-16 reveal-on-scroll">
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center text-white">
                        <i data-lucide="leaf" class="w-6 h-6"></i>
                    </div>
                    <span class="text-lg font-extrabold text-white">HARAPAN BUMI MAS</span>
                </div>
                <p class="text-xs text-emerald-200/70 leading-relaxed">Toko bahan bangunan terlengkap, melayani dengan
                    sepenuh hati sejak 2010.</p>
            </div>

            <div>
                <h4 class="text-white font-bold text-sm mb-4">Pintasan Navigasi</h4>
                <ul class="space-y-2.5 text-xs">
                    <li><a href="#beranda" class="hover:text-emerald-400 transition-colors">Beranda</a></li>
                    <li><a href="#tentang" class="hover:text-emerald-400 transition-colors">Tentang Kami</a></li>
                    <li><a href="#produk" class="hover:text-emerald-400 transition-colors">Katalog Produk</a></li>
                    <li><a href="#keunggulan" class="hover:text-emerald-400 transition-colors">Keunggulan</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold text-sm mb-4">Informasi Kontak</h4>
                <ul class="space-y-3 text-xs">
                    <li class="flex items-start gap-2.5">
                        <i data-lucide="map-pin" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                        <span>Jl. Raya Utama Bumi Mas No. 88, Banjarmasin</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="phone" class="w-4 h-4 text-emerald-400 shrink-0"></i>
                        <span>+62 812-3456-7890</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="mail" class="w-4 h-4 text-emerald-400 shrink-0"></i>
                        <span>info@harapanbumimas.com</span>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold text-sm mb-4">Jam Operasional</h4>
                <div class="text-xs space-y-2">
                    <p class="flex justify-between border-b border-emerald-900/60 pb-1.5">
                        <span>Senin - Sabtu</span> <span class="text-white font-semibold">08:00 - 17:00</span>
                    </p>
                    <p class="flex justify-between text-emerald-400">
                        <span>Minggu & Libur</span> <span class="font-semibold">Tutup</span>
                    </p>
                </div>
            </div>
        </div>

        <div
            class="max-w-7xl mx-auto px-4 sm:px-8 pt-8 border-t border-emerald-900/60 text-center text-xs text-emerald-300/50">
            <p>&copy; 2026 TB Harapan Bumi Mas. Hak Cipta Dilindungi Undang-Undang.</p>
        </div>
    </footer>

    <!-- MODAL LOGIN (Zoom-in & Smooth Animation) -->
    <div id="loginModal"
        class="fixed inset-0 bg-emerald-950/70 backdrop-blur-md z-50 flex items-center justify-center hidden p-4 opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl max-w-md w-full p-8 shadow-2xl relative transform scale-90 transition-all duration-300"
            id="modalCard">
            <!-- Close Button -->
            <button onclick="toggleModal('loginModal')"
                class="absolute top-6 right-6 p-2 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-full transition-all">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>

            <div class="text-center space-y-2 mb-6">
                <div
                    class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-2">
                    <i data-lucide="lock" class="w-6 h-6"></i>
                </div>
                <h3 class="text-2xl font-extrabold text-emerald-950">Masuk Akun</h3>
                <p class="text-xs text-slate-500">Akses layanan khusus pengelola TB Harapan Bumi Mas</p>
            </div>

            <!-- Login Form -->
            <form id="loginForm" class="space-y-4">
                @csrf

                <!-- Input Email -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Email Admin</label>
                    <div class="relative">
                        <i data-lucide="mail" class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5"></i>
                        <input type="email" id="loginEmail" name="email" required placeholder="admin@harapanbumimas.com"
                            class="w-full pl-10 pr-4 py-3 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all">
                    </div>
                </div>

                <!-- Input Password -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Kata Sandi</label>
                    <div class="relative">
                        <i data-lucide="key-round" class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5"></i>
                        <input type="password" id="loginPassword" name="password" required placeholder="••••••••"
                            class="w-full pl-10 pr-4 py-3 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all">
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 cursor-pointer text-slate-600">
                        <input type="checkbox" id="loginRemember" name="remember"
                            class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span>Ingat Saya</span>
                    </label>
                    <a href="#" class="text-emerald-600 font-bold hover:underline">Lupa Password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="loginSubmitBtn"
                    class="ripple w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-emerald-600/30 transition-all text-sm flex items-center justify-center gap-2">
                    <span>Masuk Sekarang</span>
                </button>
            </form>

            <div class="mt-6 text-center text-xs text-slate-500">
                Belum memiliki akun? <a href="{{ route('admin.register') }}" class="text-emerald-600 font-bold hover:underline">Daftar Akun Baru</a>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT ANIMATIONS & LOGIC -->
    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // 1. HEADER DYNAMICS ON SCROLL
        const mainHeader = document.getElementById('mainHeader');
        const headerContainer = document.getElementById('headerContainer');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                mainHeader.classList.add('shadow-md', 'bg-white/95');
                headerContainer.classList.remove('h-20');
                headerContainer.classList.add('h-16');
            } else {
                mainHeader.classList.remove('shadow-md');
                headerContainer.classList.remove('h-16');
                headerContainer.classList.add('h-20');
            }
        });

        // 2. SCROLL REVEAL ANIMATION (Intersection Observer)
        const observerOptions = { threshold: 0.15 };

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal-on-scroll').forEach(element => {
            revealObserver.observe(element);
        });

        // 3. RIPPLE EFFECT ON BUTTON CLICK
        document.querySelectorAll('.ripple').forEach(button => {
            button.addEventListener('click', function (e) {
                const rect = button.getBoundingClientRect();
                const circle = document.createElement('span');
                const diameter = Math.max(rect.width, rect.height);
                const radius = diameter / 2;

                circle.style.width = circle.style.height = `${diameter}px`;
                circle.style.left = `${e.clientX - rect.left - radius}px`;
                circle.style.top = `${e.clientY - rect.top - radius}px`;
                circle.classList.add('ripple-effect');

                const ripple = button.getElementsByClassName('ripple-effect')[0];
                if (ripple) {
                    ripple.remove();
                }

                button.appendChild(circle);
            });
        });

        // 4. MOBILE MENU TOGGLE
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // 5. MODAL TOGGLE & ANIMATION
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            const modalCard = document.getElementById('modalCard');

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modalCard.classList.remove('scale-90');
                    modalCard.classList.add('scale-100');
                }, 10);
            } else {
                modal.classList.add('opacity-0');
                modalCard.classList.remove('scale-100');
                modalCard.classList.add('scale-90');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
        }

        // 6. TOAST NOTIFICATION SYSTEM
        function showToast(message) {
            const toast = document.getElementById('toast');
            const toastMsg = document.getElementById('toastMsg');

            toastMsg.innerText = message;
            toast.classList.remove('translate-y-20', 'opacity-0');

            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 3000);
        }

        function addCart(productName) {
            showToast(`"${productName}" ditambahkan ke keranjang!`);
        }

        // 7. PRODUCT FILTER FUNCTIONALITY
        function filterProducts(category, btnElement) {
            const cards = document.querySelectorAll('.product-card');
            const buttons = document.querySelectorAll('.filter-btn');

            buttons.forEach(btn => {
                btn.classList.remove('bg-emerald-600', 'text-white', 'shadow-md');
                btn.classList.add('bg-white', 'text-slate-700');
            });

            btnElement.classList.remove('bg-white', 'text-slate-700');
            btnElement.classList.add('bg-emerald-600', 'text-white', 'shadow-md');

            cards.forEach(card => {
                if (category === 'all' || card.classList.contains(category)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>

    <!-- 8. AJAX LOGIN SUBMISSION -->
    <script>
        document.getElementById('loginForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const btn = document.getElementById('loginSubmitBtn');
            btn.disabled = true;
            btn.innerHTML = '<span>Memproses...</span>';

            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            const remember = document.getElementById('loginRemember').checked;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch("{{ route('login') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ email, password, remember })
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    if (typeof toggleModal === 'function') {
                        toggleModal('loginModal');
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Login Berhasil!',
                        text: result.message,
                        confirmButtonColor: '#059669',
                        confirmButtonText: 'Masuk Dashboard'
                    }).then(() => {
                        window.location.href = result.redirect;
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Gagal',
                        text: result.message || 'Email atau kata sandi yang Anda masukkan salah.',
                        confirmButtonColor: '#ef4444'
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Gagal menghubungkan ke server.',
                    confirmButtonColor: '#ef4444'
                });
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<span>Masuk Sekarang</span>';
            }
        });
    </script>

    <!-- 9. FLASH SESSION POPUPS (AFTER REGISTER & LOGOUT) -->
    @if (session('success_register'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Registrasi Berhasil!',
                    text: "{{ session('success_register') }}",
                    confirmButtonColor: '#059669',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    @if (session('success_logout'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'info',
                    title: 'Logout Berhasil',
                    text: "{{ session('success_logout') }}",
                    confirmButtonColor: '#059669',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif
</body>

</html>