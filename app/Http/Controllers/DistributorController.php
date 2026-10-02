<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    /**
     * Menampilkan daftar distributor.
     */
    public function index()
    {
        $distributors = Distributor::latest()->get();
        return view('admin.distributor.index', compact('distributors'));
    }

    /**
     * Menyimpan data distributor baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'distributor_name' => 'required|string|max:255',
            'category_stock'   => 'required|string|max:255',
            'contact_person'   => 'required|string|max:255',
            'phone'            => 'required|string|max:50',
            'email'            => 'nullable|email|max:255',
            'address'          => 'required|string',
        ]);

        Distributor::create($request->all());

        return redirect()->route('distributor.index')->with('success', 'Data distributor berhasil ditambahkan.');
    }

    /**
     * Mengupdate data distributor.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'distributor_name' => 'required|string|max:255',
            'category_stock'   => 'required|string|max:255',
            'contact_person'   => 'required|string|max:255',
            'phone'            => 'required|string|max:50',
            'email'            => 'nullable|email|max:255',
            'address'          => 'required|string',
        ]);

        $distributor = Distributor::findOrFail($id);
        $distributor->update($request->all());

        return redirect()->route('distributor.index')->with('success', 'Data distributor berhasil diperbarui.');
    }

    /**
     * Menghapus data distributor.
     */
    public function destroy($id)
    {
        $distributor = Distributor::findOrFail($id);
        $distributor->delete();

        return redirect()->route('distributor.index')->with('success', 'Data distributor berhasil dihapus.');
    }
}