<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'satuan',
        'harga_modal',
        'harga_jual',
        'harga_grosir',
    ];

    /**
     * Auto Generate Kode Barang Saat Tambah Data Baru
     */
    protected static function booted()
    {
        static::creating(function ($barang) {
            if (empty($barang->kode_barang)) {
                // Ambil ID / urutan terakhir
                $lastBarang = static::latest('id')->first();
                $nextNumber = $lastBarang ? $lastBarang->id + 1 : 1;

                // Format kode: BRG-0001, BRG-0002, dst.
                $barang->kode_barang = 'BRG-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}