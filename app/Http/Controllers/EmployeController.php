<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeController extends Controller
{
    // Menampilkan daftar karyawan
    public function index()
    {
        $employees = Employee::all();
        return view('admin.karyawan.index', compact('employees'));
    }

    // Menyimpan data karyawan baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:employees,email',
            'phone'    => 'required|string|max:20',
            'position' => 'required|string|max:100',
            'status'   => 'required|string|in:Aktif,Non-Aktif',
        ]);

        Employee::create($request->all());

        return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil ditambahkan!');
    }

    // Memperbarui data karyawan
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:employees,email,' . $id,
            'phone'    => 'required|string|max:20',
            'position' => 'required|string|max:100',
            'status'   => 'required|string|in:Aktif,Non-Aktif',
        ]);

        $employee->update($request->all());

        return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil diperbarui!');
    }

    // Menghapus data karyawan
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil dihapus!');
    }
}