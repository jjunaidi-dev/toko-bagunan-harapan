<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Tampilkan Halaman Input Data & Tabel Barang
    public function index()
    {
        $barangs = Barang::latest()->get();
        return view('admin.barang.index', compact('barangs'));
    }

    // Simpan Data Barang Baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang'  => 'required|string|max:255',
            'satuan'       => 'required|string|max:50',
            'harga_modal'  => 'required|numeric|min:0',
            'harga_jual'   => 'required|numeric|min:0',
            'harga_grosir' => 'nullable|numeric|min:0',
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'satuan.required'      => 'Satuan wajib diisi.',
            'harga_modal.required' => 'Harga modal wajib diisi.',
            'harga_jual.required'  => 'Harga jual wajib diisi.',
        ]);

        // Kode barang otomatis di-generate oleh Model Barang
        Barang::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    // Update Data Barang
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'nama_barang'  => 'required|string|max:255',
            'satuan'       => 'required|string|max:50',
            'harga_modal'  => 'required|numeric|min:0',
            'harga_jual'   => 'required|numeric|min:0',
            'harga_grosir' => 'nullable|numeric|min:0',
        ]);

        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui!');
    }

    // Hapus Data Barang
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}