<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir & Pencatatan Transaksi - TB Harapan Bumi Mas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    <!-- CDN Tom Select (Agar Select Box Barang Bisa Diketik/Dicari) -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

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

        /* Penyesuaian Tampilan Tom Select Agar Sesuai Tema Tailwind/Emerald */
        .ts-control {
            background-color: #f8fafc !important; /* bg-slate-50 */
            border-color: #e2e8f0 !important; /* border-slate-200 */
            border-radius: 0.5rem !important; /* rounded-lg */
            padding: 0.375rem 0.75rem !important;
            font-size: 0.75rem !important; /* text-xs */
        }
        .ts-wrapper.focus .ts-control {
            border-color: #059669 !important; /* focus:border-emerald-600 */
            box-shadow: 0 0 0 1px #059669 !important;
        }
        .ts-dropdown {
            font-size: 0.75rem !important;
            border-radius: 0.5rem !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
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
                        <a href="{{ route('barang.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-l-full text-xs font-medium hover:text-white hover:bg-white/10 transition">
                            <i class="fa-solid fa-boxes-stacked w-4 text-sm"></i>
                            <span>Stok Material</span>
                        </a>
                        <a href="{{ route('transaksi.index') }}" class="active-menu flex items-center gap-3 px-4 py-2.5 text-xs transition">
                            <i class="fa-solid fa-cash-register w-4 text-sm"></i>
                            <span>Kasir & Transaksi</span>
                        </a>
                        <a href="{{ route('employee.index') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-l-full text-xs font-medium hover:text-white hover:bg-white/10 transition">
                            <i class="fa-solid fa-user-check w-4 text-sm"></i>
                            <span>Karyawan</span>
                        </a>
                        <a href="{{ route('distributor.index') }}"
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
                        <p class="text-[10px] text-slate-400">Sistem Kasir & Pencatatan Penjualan</p>
                    </div>
                </div>

                <div class="relative w-full md:w-80">
                    <input type="text" id="globalSearchInput" placeholder="Cari Kode atau Nama Konsumen..." 
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
                        @foreach ($errors-> all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section class="bg-white rounded-2xl p-4 lg:p-5 shadow-sm border border-emerald-100 flex flex-col flex-1 min-h-0 overflow-hidden">
                
                <div class="flex items-center justify-between mb-3 flex-shrink-0">
                    <div class="flex items-center gap-2">
                        <h2 class="text-base font-bold text-slate-800">Riwayat Penjualan</h2>
                        <span id="totalBadge" class="text-[10px] bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded-full">{{ count($transaksis) }} Transaksi</span>
                    </div>
                    <span class="text-[10px] text-slate-400 font-medium">Updated Real-time</span>
                </div>

                <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-2.5 mb-3 flex-shrink-0">
                    <div class="flex flex-1 items-center gap-2">
                        <div class="relative flex-1 max-w-sm">
                            <input type="text" id="searchInput" placeholder="Cari Kode Transaksi, Barang, Konsumen..." 
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
                            <span>Input Transaksi</span>
                        </button>
                    </div>
                </div>

                <div class="overflow-auto flex-1 rounded-xl border border-slate-100 relative">
                    <table class="w-full text-left border-collapse min-w-[1000px]" id="transaksiTable">
                        <thead class="sticky top-0 bg-emerald-50/70 z-10 shadow-sm backdrop-blur-md">
                            <tr class="text-emerald-900 text-[11px] font-bold uppercase tracking-wider border-b border-emerald-100">
                                <th class="py-2.5 px-3 w-10 text-center">#</th>
                                <th class="py-2.5 px-3 text-right">Kode Transaksi</th>
                                <th class="py-2.5 px-3">Nama Barang</th>
                                <th class="py-2.5 px-3">Nama Konsumen</th>
                                <th class="py-2.5 px-3 text-center">Jumlah</th>
                                <th class="py-2.5 px-3 text-center">Satuan</th>
                                <th class="py-2.5 px-3 text-right">Harga Satuan</th>
                                <th class="py-2.5 px-3 text-right">Total Harga</th>
                                <th class="py-2.5 px-3 text-center">Status</th>
                                <th class="py-2.5 px-3 text-center">Metode</th>
                                <th class="py-2.5 px-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="transaksiTableBody" class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                            @if (count($transaksis) == 0)
                                <tr>
                                    <td colspan="11" class="py-6 text-center text-slate-400 font-medium text-xs">Belum ada data transaksi penjualan</td>
                                </tr>
                            @else
                                @foreach ($transaksis as $index => $item)
                                    <tr class="hover:bg-emerald-50/40 transition border-b border-slate-100 transaksi-row">
                                        <td class="py-2 px-3 text-center font-bold text-slate-400 text-[11px]">{{ $index + 1 }}</td>
                                        <td class="py-2 px-3 font-semibold text-slate-800 text-right item-search">{{ $item->kode_transaksi }}</td>
                                        <td class="py-2 px-3 font-semibold text-slate-800 item-search">{{ $item->nama_barang }}</td>
                                        <td class="py-2 px-3 text-slate-700 item-search">{{ $item->nama_konsumen }}</td>
                                        <td class="py-2 px-3 text-center font-bold text-slate-800">{{ $item->jumlah }}</td>
                                        <td class="py-2 px-3 text-center text-slate-500">{{ $item->satuan }}</td>
                                        <td class="py-2 px-3 text-right text-slate-600">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                        <td class="py-2 px-3 text-right font-bold text-emerald-700">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                        <td class="py-2 px-3 text-center">
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $item->status_pembayaran == 'Lunas' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                                {{ $item->status_pembayaran }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-3 text-center text-slate-600">{{ $item->metode_pembayaran }}</td>
                                        <td class="py-2 px-3 text-center space-x-1">
                                            <button onclick='openEditModal(@json($item))' class="bg-amber-50 text-amber-600 hover:bg-amber-100 px-2 py-1 rounded text-[11px] font-semibold transition">
                                                <i class="fa-solid fa-pen-to-square"></i> Edit
                                            </button>
                                            <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
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
                    <p id="tableInfo">Menampilkan {{ count($transaksis) }} data transaksi</p>
                </div>

            </section>
        </main>
    </div>

    <!-- Modal Form Tambah / Edit Transaksi -->
    <div id="transaksiModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl max-w-lg w-full p-5 shadow-2xl relative border border-emerald-100 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-3 pb-2 border-b border-slate-100">
                <h3 id="modalTitle" class="text-sm font-bold text-slate-800">Input Transaksi Baru</h3>
                <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

            <form id="transaksiForm" action="{{ route('transaksi.store') }}" method="POST" class="space-y-3 text-xs">
                @csrf
                <input type="hidden" id="methodField" name="_method" value="POST">

                <div>
                    <label class="block font-semibold text-slate-600 mb-1">Pilih / Ketik Nama Barang</label>
                    <select name="barang_id" id="inputBarangId" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                        <option value="">-- Cari Kode atau Nama Barang --</option>
                        @foreach ($barangs as $b)
                            <option value="{{ $b->id }}">{{ $b->kode_barang }} - {{ $b->nama_barang }} (Rp {{ number_format($b->harga_jual, 0, ',', '.') }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-600 mb-1">Nama Konsumen</label>
                    <input type="text" name="nama_konsumen" id="inputNamaKonsumen" required placeholder="Misal: Bp. Ahmad / Proyek X" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                </div>

                <div class="grid grid-cols-2 gap-2.5">
                    <div>
                        <label class="block font-semibold text-slate-600 mb-1">Jumlah</label>
                        <input type="number" min="1" value="1" name="jumlah" id="inputJumlah" required oninput="calculateTotal()" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-600 mb-1">Satuan</label>
                        <input type="text" id="inputSatuan" readonly placeholder="Otomatis" class="w-full bg-slate-100 border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-slate-500 cursor-not-allowed">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2.5">
                    <div>
                        <label class="block font-semibold text-slate-600 mb-1">Harga Satuan (Rp)</label>
                        <input type="text" id="inputHargaSatuanDisplay" readonly placeholder="0" class="w-full bg-slate-100 border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-slate-600 font-bold cursor-not-allowed">
                        <input type="hidden" id="inputHargaSatuan" name="harga_satuan">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-600 mb-1">Total Harga (Rp)</label>
                        <input type="text" id="inputTotalHargaDisplay" readonly placeholder="0" class="w-full bg-emerald-50 border border-emerald-300 rounded-lg px-3 py-1.5 text-xs font-bold text-emerald-700 cursor-not-allowed">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2.5">
                    <div>
                        <label class="block font-semibold text-slate-600 mb-1">Status Pembayaran</label>
                        <select name="status_pembayaran" id="inputStatusPembayaran" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                            <option value="Lunas">Lunas</option>
                            <option value="Belum Lunas">Belum Lunas</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-600 mb-1">Metode Pembayaran</label>
                        <select name="metode_pembayaran" id="inputMetodePembayaran" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                            <option value="Tunai">Tunai</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="QRIS">QRIS</option>
                            <option value="Tempo / Utang">Tempo / Utang</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-2 pt-3">
                    <button type="button" onclick="closeModal()" class="px-3.5 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-100 rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-emerald-700 text-white font-semibold rounded-lg text-xs hover:bg-emerald-800 transition shadow-sm">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let rawHargaSatuan = 0;
        let tomSelectBarang = null;

        // Inisialisasi Tom Select saat halaman selesai di-load
        document.addEventListener('DOMContentLoaded', function() {
            tomSelectBarang = new TomSelect('#inputBarangId', {
                create: false,
                placeholder: "-- Ketik Kode / Nama Barang --",
                allowEmptyOption: true,
                sortField: { field: "text", direction: "asc" },
                onChange: function(value) {
                    onBarangSelectChange(value);
                }
            });
        });

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        async function onBarangSelectChange(barangId) {
            if (!barangId) {
                rawHargaSatuan = 0;
                document.getElementById('inputSatuan').value = '';
                document.getElementById('inputHargaSatuan').value = '';
                document.getElementById('inputHargaSatuanDisplay').value = '';
                calculateTotal();
                return;
            }

            try {
                const response = await fetch(`/admin/transaksi/api/barang/${barangId}`);
                if (!response.ok) throw new Error('Gagal mengambil data barang');
                
                const data = await response.json();
                
                rawHargaSatuan = parseFloat(data.harga_jual);
                document.getElementById('inputSatuan').value = data.satuan;
                document.getElementById('inputHargaSatuan').value = rawHargaSatuan;
                document.getElementById('inputHargaSatuanDisplay').value = 'Rp ' + formatRupiah(rawHargaSatuan);

                calculateTotal();
            } catch (error) {
                console.error(error);
            }
        }

        function calculateTotal() {
            const jumlah = parseInt(document.getElementById('inputJumlah').value) || 0;
            const total = rawHargaSatuan * jumlah;
            document.getElementById('inputTotalHargaDisplay').value = 'Rp ' + formatRupiah(total);
        }

        function openModal() {
            document.getElementById('modalTitle').innerText = 'Input Transaksi Baru';
            document.getElementById('transaksiForm').action = "{{ route('transaksi.store') }}";
            document.getElementById('methodField').value = 'POST';
            document.getElementById('transaksiForm').reset();

            // Reset komponen Tom Select
            if (tomSelectBarang) {
                tomSelectBarang.clear();
            }
            
            rawHargaSatuan = 0;
            document.getElementById('inputHargaSatuanDisplay').value = '';
            document.getElementById('inputTotalHargaDisplay').value = '';

            document.getElementById('transaksiModal').classList.remove('hidden');
        }

        function openEditModal(data) {
            document.getElementById('modalTitle').innerText = 'Edit Transaksi Penjualan';
            document.getElementById('transaksiForm').action = `/admin/transaksi/${data.id}`;
            document.getElementById('methodField').value = 'PUT';

            // Set nilai barang ke Tom Select
            if (tomSelectBarang) {
                tomSelectBarang.setValue(data.barang_id);
            }

            document.getElementById('inputNamaKonsumen').value = data.nama_konsumen;
            document.getElementById('inputJumlah').value = data.jumlah;
            document.getElementById('inputSatuan').value = data.satuan;
            document.getElementById('inputStatusPembayaran').value = data.status_pembayaran;
            document.getElementById('inputMetodePembayaran').value = data.metode_pembayaran;

            rawHargaSatuan = parseFloat(data.harga_satuan);
            document.getElementById('inputHargaSatuan').value = rawHargaSatuan;
            document.getElementById('inputHargaSatuanDisplay').value = 'Rp ' + formatRupiah(rawHargaSatuan);

            calculateTotal();

            document.getElementById('transaksiModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('transaksiModal').classList.add('hidden');
        }

        function filterTable() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('.transaksi-row');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        document.getElementById('searchInput').addEventListener('input', filterTable);
        document.getElementById('globalSearchInput').addEventListener('input', function(e) {
            document.getElementById('searchInput').value = e.target.value;
            filterTable();
        });

        function exportToExcel() {
            const table = document.getElementById("transaksiTable");
            const workbook = XLSX.utils.table_to_book(table, { sheet: "Data Transaksi" });
            XLSX.writeFile(workbook, `Data_Transaksi_${new Date().toISOString().slice(0,10)}.xlsx`);
        }
    </script>
</body>
</html>