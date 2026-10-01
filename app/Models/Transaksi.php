<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'barang_id',
        'nama_barang',
        'nama_konsumen',
        'jumlah',
        'satuan',
        'status_pembayaran',
        'metode_pembayaran',
        'harga_satuan',
        'total_harga',
    ];

    /**
     * Auto generate kode transaksi (contoh: TRX-0001)
     */
    protected static function booted()
    {
        static::creating(function ($transaksi) {
            if (empty($transaksi->kode_transaksi)) {
                $lastTransaksi = static::latest('id')->first();
                $nextNumber = $lastTransaksi ? $lastTransaksi->id + 1 : 1;
                $transaksi->kode_transaksi = 'TRX-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    /**
     * Relasi ke Model Barang
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}