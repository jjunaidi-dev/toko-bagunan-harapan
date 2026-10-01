<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Barang - TB Harapan Bumi Mas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- CDN SheetJS -->
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

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
        <aside class="sidebar-dark text-emerald-100 w-64 flex-shrink-0 flex flex-col justify-between pt-5 pb-5 pl-3 pr-0 z-20">
            <div class="flex flex-col h-full justify-between">
                <div>
                    @php
                        $currentUser = auth('admin')->user() ?? auth()->user();
                        $userName =$currentUser->name ?? 'Administrator';
                    @endphp
                    <div class="bg-white text-slate-800 p-2.5 rounded-xl flex items-center justify-between mr-3 mb-6 shadow-md">
                        <div class="flex items-center gap-2.5">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($userName) }}&background=143823&color=fff" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                            <div>
                                <h4 class="font-bold text-xs leading-tight text-slate-800">{{ $userName }}</h4>
                                <p class="text-[10px] text-emerald-700 font-medium">Kasir / Admin</p>
                            </div>
                        </div>
                    </div>

                    <nav class="space-y-1">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-l-full text-xs font-medium hover:text-white hover:bg-white/10 transition">
                            <i class="fa-solid fa-chart-pie w-4 text-sm"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('barang.index') }}" class="active-menu flex items-center gap-3 px-4 py-2.5 text-xs transition">
                            <i class="fa-solid fa-boxes-stacked w-4 text-sm"></i>
                            <span>Stok Material</span>
                        </a>
                        <a href="{{ route('transaksi.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-l-full text-xs font-medium hover:text-white hover:bg-white/10 transition">
                            <i class="fa-solid fa-cash-register w-4 text-sm"></i>
                            <span>Kasir & Transaksi</span>
                        </a>
                        <a href="#"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-l-full text-xs font-medium hover:text-white hover:bg-white/10 transition">
                            <i class="fa-solid fa-user-check w-4 text-sm"></i>
                            <span>Absensi</span>
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
                        <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 text-xs font-medium text-emerald-300 hover:text-rose-300 transition">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span>Keluar Sistem</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col min-w-0 overflow-hidden bg-[#f0fdf4] p-4 lg:p-6">
            
            <!-- Header Top Bar -->
            <header class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-4 flex-shrink-0">
                <div class="bg-white px-4 py-2.5 rounded-xl shadow-sm border border-emerald-100 flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xs">
                        <i class="fa-solid fa-building-wheat"></i>
                    </div>
                    <div>
                        <h1 class="text-sm font-bold text-slate-800 leading-tight">TB. Harapan Bumi Mas</h1>
                        <p class="text-[10px] text-slate-400">Sistem Manajemen Toko Bangunan</p>
                    </div>
                </div>

                <div class="relative w-full md:w-80">
                    <input type="text" id="globalSearchInput" placeholder="Cari Kode atau Nama Barang..." 
                        class="w-full bg-white text-xs pl-9 pr-3 py-2 rounded-xl border border-emerald-200/80 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 shadow-sm transition">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-xs"></i>
                </div>
            </header>

            @if (session('success'))
                <div class="mb-3 p-3 bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs rounded-xl flex items-center justify-between">
                    <span><i class="fa-solid fa-circle-check mr-1.5 text-emerald-600"></i> {{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900">&times;</button>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-3 p-3 bg-rose-100 border border-rose-300 text-rose-700 text-xs rounded-xl">
                    <p class="font-bold mb-1"><i class="fa-solid fa-triangle-exclamation mr-1"></i> Terjadi Kesalahan:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section class="bg-white rounded-2xl p-4 lg:p-5 shadow-sm border border-emerald-100 flex flex-col flex-1 min-h-0 overflow-hidden">
                
                <div class="flex items-center justify-between mb-3 flex-shrink-0">
                    <div class="flex items-center gap-2">
                        <h2 class="text-base font-bold text-slate-800">Daftar Barang & Material</h2>
                        <span id="totalBadge" class="text-[10px] bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded-full">{{ count($barangs) }} Data</span>
                    </div>
                    <span class="text-[10px] text-slate-400 font-medium">Updated Real-time</span>
                </div>

                <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-2.5 mb-3 flex-shrink-0">
                    <div class="flex flex-1 items-center gap-2">
                        <div class="relative flex-1 max-w-sm">
                            <input type="text" id="searchInput" placeholder="Cari Nama atau Satuan..." 
                                class="w-full bg-slate-50 text-xs pl-8 pr-3 py-1.5 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600">
                            <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2 text-slate-400 text-xs"></i>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        <button onclick="exportToExcel()" class="bg-teal-50 text-teal-700 hover:bg-teal-100 border border-teal-200 px-3 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1.5 transition">
                            <i class="fa-solid fa-file-excel text-xs"></i>
                            <span>Export Excel</span>
                        </button>

                        <button onclick="openModal()" class="bg-emerald-700 hover:bg-emerald-800 text-white px-3 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1.5 transition shadow-sm">
                            <i class="fa-solid fa-plus text-xs"></i>
                            <span>Tambah Barang</span>
                        </button>
                    </div>
                </div>

                <div class="overflow-auto flex-1 rounded-xl border border-slate-100 relative">
                    <table class="w-full text-left border-collapse min-w-[850px]" id="barangTable">
                        <thead class="sticky top-0 bg-emerald-50/70 z-10 shadow-sm backdrop-blur-md">
                            <tr class="text-emerald-900 text-[11px] font-bold uppercase tracking-wider border-b border-emerald-100">
                                <th class="py-2.5 px-3 w-10 text-center">#</th>
                                <th class="py-2.5 px-3 text-right">Kode Barang</th>
                                <th class="py-2.5 px-3">Nama Barang</th>
                                <th class="py-2.5 px-3 text-center">Satuan</th>
                                <th class="py-2.5 px-3 text-right">Harga Modal</th>
                                <th class="py-2.5 px-3 text-right">Harga Jual</th>
                                <th class="py-2.5 px-3 text-right">Harga Grosir</th>
                                <th class="py-2.5 px-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="barangTableBody" class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                            @if (count($barangs) == 0)
                                <tr>
                                    <td colspan="8" class="py-6 text-center text-slate-400 font-medium text-xs">Belum ada data barang tersedia</td>
                                </tr>
                            @else
                                @foreach ($barangs as $index =>$item)
                                    <tr class="hover:bg-emerald-50/40 transition border-b border-slate-100 barang-row">
                                        <td class="py-2 px-3 text-center font-bold text-slate-400 text-[11px]">{{ $index + 1 }}</td>
                                        <td class="py-2 px-3 font-semibold text-slate-800 item-nama text-right">{{ $item->kode_barang }}</td>
                                        <td class="py-2 px-3 font-semibold text-slate-800 item-nama">{{ $item->nama_barang }}</td>
                                        <td class="py-2 px-3 text-center text-slate-500 item-satuan">{{ $item->satuan }}</td>
                                        <td class="py-2 px-3 text-right font-medium text-slate-600">Rp {{ number_format($item->harga_modal, 0, ',', '.') }}</td>
                                        <td class="py-2 px-3 text-right font-bold text-emerald-700">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                                        <td class="py-2 px-3 text-right font-medium text-teal-700">
                                            {{ $item->harga_grosir ? 'Rp ' . number_format($item->harga_grosir, 0, ',', '.') : '-' }}
                                        </td>
                                        <td class="py-2 px-3 text-center space-x-1">
                                            <button onclick='openEditModal(@json($item))' class="bg-amber-50 text-amber-600 hover:bg-amber-100 px-2 py-1 rounded text-[11px] font-semibold transition">
                                                <i class="fa-solid fa-pen-to-square"></i> Edit
                                            </button>
                                            <form action="{{ route('barang.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-rose-50 text-rose-600 hover:bg-rose-100 px-2 py-1 rounded text-[11px] font-semibold transition">
                                                    <i class="fa-solid fa-trash-can"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-col sm:flex-row justify-between items-center gap-3 mt-3 pt-2 text-[11px] text-slate-500 flex-shrink-0">
                    <p id="tableInfo">Menampilkan {{ count($barangs) }} data barang</p>
                </div>

            </section>
        </main>
    </div>

    <!-- Modal Form Tambah / Edit -->
    <div id="barangModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl max-w-md w-full p-5 shadow-2xl relative border border-emerald-100">
            <div class="flex justify-between items-center mb-3 pb-2 border-b border-slate-100">
                <h3 id="modalTitle" class="text-sm font-bold text-slate-800">Tambah Barang Baru</h3>
                <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

            <form id="barangForm" action="{{ route('barang.store') }}" method="POST" class="space-y-3 text-xs">
                @csrf
                <input type="hidden" id="methodField" name="_method" value="POST">

                <div>
                    <label class="block font-semibold text-slate-600 mb-1">Nama Barang Material</label>
                    <input type="text" name="nama_barang" id="inputNama" required placeholder="Misal: Semen Tiga Roda 50kg" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                </div>
                <div>
                    <label class="block font-semibold text-slate-600 mb-1">Satuan Material</label>
                    <select name="satuan" id="inputSatuan" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                        <option value="Sak">Sak</option>
                        <option value="Pcs">PCS</option>
                        <option value="Batang">Batang</option>
                        <option value="Lembar">Lembar</option>
                        <option value="Dus">Dus</option>
                        <option value="Meter">Meter</option>
                        <option value="M³ (Kubik)">M³ (Kubik)</option>
                        <option value="Rit/Colt">Rit/Colt</option>
                        <option value="Pail">Pail</option>
                        <option value="Buah">Buah</option>
                        <option value="Roll">Roll</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-2.5">
                    <div>
                        <label class="block font-semibold text-slate-600 mb-1">Harga Modal (Rp)</label>
                        <input type="number" min="0" name="harga_modal" id="inputHargaModal" required placeholder="60000" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-600 mb-1">Harga Jual (Rp)</label>
                        <input type="number" min="0" name="harga_jual" id="inputHargaJual" required placeholder="68000" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                    </div>
                </div>
                <div>
                    <label class="block font-semibold text-slate-600 mb-1">Harga Grosir (Rp) <span class="text-slate-400 font-normal">(Opsional)</span></label>
                    <input type="number" min="0" name="harga_grosir" id="inputHargaGrosir" placeholder="65000" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                </div>

                <div class="flex justify-end gap-2 pt-3">
                    <button type="button" onclick="closeModal()" class="px-3.5 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-100 rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-emerald-700 text-white font-semibold rounded-lg text-xs hover:bg-emerald-800 transition shadow-sm">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('modalTitle').innerText = 'Tambah Barang Baru';
            document.getElementById('barangForm').action = "{{ route('barang.store') }}";
            document.getElementById('methodField').value = 'POST';
            document.getElementById('barangForm').reset();
            document.getElementById('barangModal').classList.remove('hidden');
        }

        function openEditModal(data) {
            document.getElementById('modalTitle').innerText = 'Edit Data Barang';
            document.getElementById('barangForm').action = `/admin/barang/${data.id}`;
            document.getElementById('methodField').value = 'PUT';
            
            document.getElementById('inputNama').value = data.nama_barang;
            document.getElementById('inputSatuan').value = data.satuan;
            document.getElementById('inputHargaModal').value = data.harga_modal;
            document.getElementById('inputHargaJual').value = data.harga_jual;
            document.getElementById('inputHargaGrosir').value = data.harga_grosir ?? '';

            document.getElementById('barangModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('barangModal').classList.add('hidden');
        }

        /**
         * Penjelasan Teknis Perbaikan Search Bar:
         * 1. querySelectorAll('.barang-row td') digunakan untuk memilih spesifik kolom berdasarkan urutan index-nya (nth-child):
         *    - Index [1] = Kode Barang
         *    - Index [2] = Nama Barang
         *    - Index [3] = Satuan
         * 2. Dengan mengambil innerText/textContent dari index [2], kita memastikan data yang dicocokkan 
         *    secara akurat adalah 'nama_barang' (bukan kode_barang lagi).
         * 3. Digunakan fungsi .toLowerCase() dan .trim() agar pencarian bersifat case-insensitive (tidak membedakan huruf besar/kecil)
         *    serta mengabaikan spasi berlebih.
         */
        function filterTable() {
            // Mengambil input teks dari search bar dan mengubahnya ke huruf kecil
            const query = document.getElementById('searchInput').value.toLowerCase().trim();
            const rows = document.querySelectorAll('.barang-row');

            let visibleCount = 0;

            rows.forEach(row => {
                // Mengambil elemen <td> berdasarkan urutan kolom di dalam baris (row)
                const cols = row.querySelectorAll('td');
                
                // Index 2 adalah kolom 'Nama Barang'
                const namaBarang = cols[2] ? cols[2].textContent.toLowerCase().trim() : '';
                
                // Index 3 adalah kolom 'Satuan'
                const satuanBarang = cols[3] ? cols[3].textContent.toLowerCase().trim() : '';

                // Memeriksa apakah teks pencarian cocok dengan Nama Barang atau Satuan
                if (namaBarang.includes(query) || satuanBarang.includes(query)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Opsional: memperbarui info jumlah baris yang tampil saat difilter
            const tableInfo = document.getElementById('tableInfo');
            if (tableInfo) {
                tableInfo.textContent = `Menampilkan ${visibleCount} data barang`;
            }
        }

        // Event listener untuk input pencarian lokal dan global
        document.getElementById('searchInput').addEventListener('input', filterTable);
        
        const globalSearch = document.getElementById('globalSearchInput');
        if (globalSearch) {
            globalSearch.addEventListener('input', function(e) {
                document.getElementById('searchInput').value = e.target.value;
                filterTable();
            });
        }

        function exportToExcel() {
            const table = document.getElementById("barangTable");
            const workbook = XLSX.utils.table_to_book(table, { sheet: "Data Barang" });
            XLSX.writeFile(workbook, `Data_Barang_${new Date().toISOString().slice(0,10)}.xlsx`);
        }
    </script>
</body>
</html>