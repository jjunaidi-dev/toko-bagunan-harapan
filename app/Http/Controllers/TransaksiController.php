<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Tampilkan Halaman Kasir / Transaksi
    public function index()
    {
        $transaksis = Transaksi::latest()->get();
        $barangs = Barang::all();
        return view('admin.transaksi.index', compact('transaksis', 'barangs'));
    }

    // API JSON untuk ambil detail barang berdasarkan ID
    public function getBarangDetail($id)
    {
        $barang = Barang::find($id);
        if (!$barang) {
            return response()->json(['message' => 'Barang tidak ditemukan'], 404);
        }
        return response()->json($barang);
    }

    // Simpan Transaksi Baru
    public function store(Request $request)
    {
        $request->validate([
            'barang_id'         => 'required|exists:barangs,id',
            'nama_konsumen'     => 'required|string|max:255',
            'jumlah'            => 'required|integer|min:1',
            'status_pembayaran' => 'required|in:Lunas,Belum Lunas',
            'metode_pembayaran' => 'required|string|max:50',
        ], [
            'barang_id.required'         => 'Pilih barang terlebih dahulu.',
            'nama_konsumen.required'     => 'Nama konsumen wajib diisi.',
            'jumlah.required'            => 'Jumlah barang wajib diisi.',
            'status_pembayaran.required' => 'Pilih status pembayaran.',
            'metode_pembayaran.required' => 'Pilih metode pembayaran.',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        $hargaSatuan = $barang->harga_jual;
        $totalHarga = $hargaSatuan * $request->jumlah;

        Transaksi::create([
            'barang_id'         => $barang->id,
            'nama_barang'       => $barang->nama_barang,
            'nama_konsumen'     => $request->nama_konsumen,
            'jumlah'            => $request->jumlah,
            'satuan'            => $barang->satuan,
            'status_pembayaran' => $request->status_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
            'harga_satuan'      => $hargaSatuan,
            'total_harga'       => $totalHarga,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    // Update Transaksi
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $request->validate([
            'barang_id'         => 'required|exists:barangs,id',
            'nama_konsumen'     => 'required|string|max:255',
            'jumlah'            => 'required|integer|min:1',
            'status_pembayaran' => 'required|in:Lunas,Belum Lunas',
            'metode_pembayaran' => 'required|string|max:50',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        $hargaSatuan = $barang->harga_jual;
        $totalHarga = $hargaSatuan * $request->jumlah;

        $transaksi->update([
            'barang_id'         => $barang->id,
            'nama_barang'       => $barang->nama_barang,
            'nama_konsumen'     => $request->nama_konsumen,
            'jumlah'            => $request->jumlah,
            'satuan'            => $barang->satuan,
            'status_pembayaran' => $request->status_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
            'harga_satuan'      => $hargaSatuan,
            'total_harga'       => $totalHarga,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    // Hapus Transaksi
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}