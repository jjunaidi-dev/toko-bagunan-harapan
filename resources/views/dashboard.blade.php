<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Portal - TB Harapan Bumi Mas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f0fdf4;
        }

        .sidebar-dark {
            background-color: #143823;
        }

        .active-menu {
            background-color: #f0fdf4;
            color: #143823 !important;
            border-top-left-radius: 9999px;
            border-bottom-left-radius: 9999px;
            font-weight: 700;
        }

        .active-menu i {
            color: #143823;
        }

        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #a7f3d0;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #059669;
        }
    </style>
</head>

<body class="h-full overflow-hidden text-slate-700">

    <div class="flex h-screen w-screen overflow-hidden bg-[#f0fdf4]">

        <!-- Sidebar Navigation -->
        <aside
            class="sidebar-dark text-emerald-100 w-64 flex-shrink-0 flex flex-col justify-between pt-5 pb-5 pl-3 pr-0 z-20">
            <div class="flex flex-col h-full justify-between">
                <div>
                    @php
                        $currentUser = auth('admin')->user() ?? auth()->user();
                        $userName = $currentUser->name ?? 'Administrator';
                    @endphp
                    <div
                        class="bg-white text-slate-800 p-2.5 rounded-xl flex items-center justify-between mr-3 mb-6 shadow-md">
                        <div class="flex items-center gap-2.5">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($userName) }}&background=143823&color=fff"
                                alt="Profile" class="w-8 h-8 rounded-full object-cover">
                            <div>
                                <h4 class="font-bold text-xs leading-tight text-slate-800">{{ $userName }}</h4>
                                <p class="text-[10px] text-emerald-700 font-medium">Kasir / Admin</p>
                            </div>
                        </div>
                    </div>

                    <nav class="space-y-1">
                        <a href="{{ route('dashboard') }}"
                            class="active-menu flex items-center gap-3 px-4 py-2.5 text-xs transition">
                            <i class="fa-solid fa-chart-pie w-4 text-sm"></i>
                            <span>Dashboard Portal</span>
                        </a>
                        <a href="{{ route('barang.index') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-l-full text-xs font-medium hover:text-white hover:bg-white/10 transition">
                            <i class="fa-solid fa-boxes-stacked w-4 text-sm"></i>
                            <span>Stok Material</span>
                        </a>
                        <a href="{{ route('transaksi.index') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-l-full text-xs font-medium hover:text-white hover:bg-white/10 transition">
                            <i class="fa-solid fa-cash-register w-4 text-sm"></i>
                            <span>Kasir & Transaksi</span>
                        </a>
                        <a href="{{ route('employee.index') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-l-full text-xs font-medium hover:text-white hover:bg-white/10 transition">
                            <i class="fa-solid fa-user-check w-4 text-sm"></i>
                            <span>Karyawan</span>
                        </a>
                        <a href="#"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-l-full text-xs font-medium hover:text-white hover:bg-white/10 transition">
                            <i class="fa-solid fa-truck-field w-4 text-sm"></i>
                            <span>Data Distributor</span>
                        </a>
                    </nav>
                </div>

                <div class="pr-3 border-t border-emerald-800/60 pt-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-2.5 px-3 py-2 text-xs font-medium text-emerald-300 hover:text-rose-300 transition">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span>Keluar Sistem</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto bg-[#f0fdf4] p-4 lg:p-6 space-y-5">

            <!-- Header Banner -->
            <header
                class="bg-gradient-to-r from-emerald-800 via-emerald-700 to-teal-800 text-white rounded-2xl p-5 lg:p-6 shadow-lg relative overflow-hidden flex-shrink-0">
                <div
                    class="absolute -right-6 -bottom-10 opacity-10 text-9xl font-black select-none pointer-events-none">
                    <i class="fa-solid fa-tree-city"></i>
                </div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div
                            class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md px-3 py-1 rounded-full text-xs text-emerald-100 mb-2 border border-white/10">
                            <i class="fa-solid fa-building-circle-check text-amber-300"></i>
                            <span>TB. Harapan Bumi Mas System</span>
                        </div>
                        <h1 class="text-xl lg:text-2xl font-extrabold tracking-tight">Selamat Datang, {{ $userName }}!
                            👋</h1>
                        <p class="text-xs text-emerald-100/90 mt-1 max-w-xl">
                            Portal navigasi utama Toko Bangunan Harapan Bumi Mas. Pilih menu untuk mengelola stok
                            material, kasir penjualan, dan laporan operasional.
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="bg-white/10 backdrop-blur-md rounded-xl p-3 border border-white/10 text-right">
                            <p class="text-[10px] text-emerald-200 font-medium">Hari Ini</p>
                            <p class="text-xs font-bold text-white">
                                {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}
                            </p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Quick Metrics Cards -->
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div
                    class="bg-white rounded-2xl p-4 border border-emerald-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400">Total Stok Material</p>
                        <h3 class="text-lg font-extrabold text-slate-800 mt-0.5">128 <span
                                class="text-xs font-normal text-slate-500">Item</span></h3>
                        <p class="text-[10px] text-emerald-600 font-semibold mt-1"><i
                                class="fa-solid fa-arrow-up text-[9px]"></i> Aktif di database</p>
                    </div>
                    <div
                        class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg font-bold">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl p-4 border border-emerald-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400">Penjualan Hari Ini</p>
                        <h3 class="text-lg font-extrabold text-slate-800 mt-0.5">24 <span
                                class="text-xs font-normal text-slate-500">Transaksi</span></h3>
                        <p class="text-[10px] text-emerald-600 font-semibold mt-1"><i
                                class="fa-solid fa-circle-check text-[9px]"></i> Kasir Aktif</p>
                    </div>
                    <div
                        class="w-11 h-11 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-lg font-bold">
                        <i class="fa-solid fa-cash-register"></i>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl p-4 border border-emerald-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400">Omset Hari Ini</p>
                        <h3 class="text-lg font-extrabold text-emerald-700 mt-0.5">Rp 4.850.000</h3>
                        <p class="text-[10px] text-slate-400 font-medium mt-1">Estimasi kotor</p>
                    </div>
                    <div
                        class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg font-bold">
                        <i class="fa-solid fa-coins"></i>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl p-4 border border-emerald-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-semibold text-slate-400">Stok Menipis</p>
                        <h3 class="text-lg font-extrabold text-rose-600 mt-0.5">3 <span
                                class="text-xs font-normal text-slate-500">Item</span></h3>
                        <p class="text-[10px] text-rose-500 font-semibold mt-1"><i
                                class="fa-solid fa-triangle-exclamation text-[9px]"></i> Perlu re-stock</p>
                    </div>
                    <div
                        class="w-11 h-11 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-lg font-bold">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                </div>
            </section>

            <!-- Navigation Portal / Quick Access Cards -->
            <section>
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                        <i class="fa-solid fa-compass text-emerald-600"></i>
                        <span>Portal Navigasi Modul</span>
                    </h2>
                    <span class="text-[11px] text-slate-400">Pilih menu untuk bekerja</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                    <!-- Card 1: Stok Material -->
                    <a href="{{ route('barang.index') }}"
                        class="group bg-white rounded-2xl p-5 border border-emerald-100 hover:border-emerald-500/50 hover:shadow-xl hover:-translate-y-1 transition duration-200 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition duration-200 flex items-center justify-center text-xl font-bold shadow-sm">
                                    <i class="fa-solid fa-boxes-stacked"></i>
                                </div>
                                <span
                                    class="text-[10px] bg-emerald-100 text-emerald-700 font-bold px-2.5 py-1 rounded-full">Modul
                                    Utama</span>
                            </div>
                            <h3 class="text-base font-bold text-slate-800 group-hover:text-emerald-600 transition">Stok
                                & Material</h3>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                Kelola katalog bahan bangunan, harga modal/jual, harga grosir, serta penyesuaian stok.
                            </p>
                        </div>
                        <div
                            class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-emerald-600">
                            <span>Kelola Barang</span>
                            <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition"></i>
                        </div>
                    </a>

                    <!-- Card 2: Kasir / Penjualan -->
                    <a href="#"
                        class="group bg-white rounded-2xl p-5 border border-emerald-100 hover:border-teal-500/50 hover:shadow-xl hover:-translate-y-1 transition duration-200 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-600 group-hover:bg-teal-600 group-hover:text-white transition duration-200 flex items-center justify-center text-xl font-bold shadow-sm">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </div>
                                <span
                                    class="text-[10px] bg-teal-100 text-teal-800 font-bold px-2.5 py-1 rounded-full">POS
                                    / Kasir</span>
                            </div>
                            <h3 class="text-base font-bold text-slate-800 group-hover:text-teal-600 transition">
                                Transaksi Penjualan</h3>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                Mesin kasir penjualan eceran/grosir cepat, perhitungan otomatis, dan cetak nota belanja
                                toko.
                            </p>
                        </div>
                        <div
                            class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-teal-600">
                            <span>Buka Mesin Kasir</span>
                            <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition"></i>
                        </div>
                    </a>

                    <!-- Card 3: Pembelian & Pasokan -->
                    <a href="#"
                        class="group bg-white rounded-2xl p-5 border border-emerald-100 hover:border-amber-500/50 hover:shadow-xl hover:-translate-y-1 transition duration-200 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition duration-200 flex items-center justify-center text-xl font-bold shadow-sm">
                                    <i class="fa-solid fa-truck-field"></i>
                                </div>
                                <span
                                    class="text-[10px] bg-slate-100 text-slate-600 font-bold px-2.5 py-1 rounded-full">Supplier</span>
                            </div>
                            <h3 class="text-base font-bold text-slate-800 group-hover:text-amber-600 transition">
                                Pembelian & Supplier</h3>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                Catat pasokan material masuk dari distributor, faktur nota supplier, dan riwayat retur.
                            </p>
                        </div>
                        <div
                            class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-amber-600">
                            <span>Input Barang Masuk</span>
                            <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition"></i>
                        </div>
                    </a>

                    <!-- Card 4: Laporan Keuangan -->
                    <a href="#"
                        class="group bg-white rounded-2xl p-5 border border-emerald-100 hover:border-sky-500/50 hover:shadow-xl hover:-translate-y-1 transition duration-200 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 group-hover:bg-sky-600 group-hover:text-white transition duration-200 flex items-center justify-center text-xl font-bold shadow-sm">
                                    <i class="fa-solid fa-chart-line"></i>
                                </div>
                                <span
                                    class="text-[10px] bg-slate-100 text-slate-600 font-bold px-2.5 py-1 rounded-full">Laporan</span>
                            </div>
                            <h3 class="text-base font-bold text-slate-800 group-hover:text-sky-600 transition">Laporan &
                                Rekapitulasi</h3>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                Grafik laba bersih, rekap omset harian/bulanan, dan statistik barang yang paling cepat
                                laku.
                            </p>
                        </div>
                        <div
                            class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-sky-600">
                            <span>Lihat Laporan</span>
                            <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition"></i>
                        </div>
                    </a>

                    <!-- Card 5: Pelanggan & Piutang Bon -->
                    <a href="#"
                        class="group bg-white rounded-2xl p-5 border border-emerald-100 hover:border-indigo-500/50 hover:shadow-xl hover:-translate-y-1 transition duration-200 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition duration-200 flex items-center justify-center text-xl font-bold shadow-sm">
                                    <i class="fa-solid fa-id-card"></i>
                                </div>
                                <span
                                    class="text-[10px] bg-slate-100 text-slate-600 font-bold px-2.5 py-1 rounded-full">Pelanggan</span>
                            </div>
                            <h3 class="text-base font-bold text-slate-800 group-hover:text-indigo-600 transition">
                                Pelanggan & Piutang Bon</h3>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                Catatan data tukang/kontraktor langganan, manajemen transaksi bon proyek, dan jatuh
                                tempo.
                            </p>
                        </div>
                        <div
                            class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-indigo-600">
                            <span>Kelola Piutang</span>
                            <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition"></i>
                        </div>
                    </a>

                    <!-- Card 6: Pengaturan Toko -->
                    <a href="#"
                        class="group bg-white rounded-2xl p-5 border border-emerald-100 hover:border-slate-500/50 hover:shadow-xl hover:-translate-y-1 transition duration-200 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-700 group-hover:bg-slate-800 group-hover:text-white transition duration-200 flex items-center justify-center text-xl font-bold shadow-sm">
                                    <i class="fa-solid fa-sliders"></i>
                                </div>
                                <span
                                    class="text-[10px] bg-slate-100 text-slate-600 font-bold px-2.5 py-1 rounded-full">Sistem</span>
                            </div>
                            <h3 class="text-base font-bold text-slate-800 group-hover:text-slate-900 transition">
                                Pengaturan Sistem Toko</h3>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                Setting identitas TB Harapan Bumi Mas, cetak header nota, manajemen akun admin & kasir.
                            </p>
                        </div>
                        <div
                            class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-slate-700">
                            <span>Pengaturan</span>
                            <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition"></i>
                        </div>
                    </a>

                </div>
            </section>

            <!-- Status Operasional -->
            <section class="bg-white rounded-2xl p-5 border border-emerald-100 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h3 class="text-sm font-bold text-slate-800">Status Operasional TB Harapan Bumi Mas</h3>
                        <p class="text-[11px] text-slate-400">Pembaruan realtime sistem database & akun</p>
                    </div>
                    <span
                        class="text-[10px] bg-emerald-100 text-emerald-700 font-bold px-2.5 py-0.5 rounded-full">Sistem
                        Normal</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">
                    <div class="p-3 bg-emerald-50/60 rounded-xl border border-emerald-100 flex items-center gap-3">
                        <div
                            class="w-8 h-8 rounded-lg bg-emerald-600 text-white flex items-center justify-center font-bold">
                            <i class="fa-solid fa-circle-check text-xs"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800">Modul Barang Siap Digunakan</p>
                            <p class="text-[10px] text-slate-500">Tabel data barang telah aktif dan siap diakses.</p>
                        </div>
                    </div>

                    <div class="p-3 bg-teal-50/60 rounded-xl border border-teal-100 flex items-center gap-3">
                        <div
                            class="w-8 h-8 rounded-lg bg-teal-600 text-white flex items-center justify-center font-bold">
                            <i class="fa-solid fa-user-shield text-xs"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800">Otentikasi Guard Admin</p>
                            <p class="text-[10px] text-slate-500">Akses aman terhubung langsung dengan sesi akun admin.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

        </main>
    </div>

</body>

</html>