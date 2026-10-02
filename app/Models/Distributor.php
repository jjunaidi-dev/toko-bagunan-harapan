<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Distributor extends Model
{
    // Menentukan nama tabel secara eksplisit agar sesuai dengan database (singular)
    protected $table = 'distributor';

    // Kolom mana saja yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'distributor_code',
        'distributor_name',
        'category_stock',
        'contact_person',
        'phone',
        'email',
        'address'
    ];

    // Auto generate kode distributor otomatis
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($distributor) {
            if (empty($distributor->distributor_code)) {
                // Ambil ID dari urutan terakhir
                $lastDistributor = static::latest('id')->first();
                $nextDistributor = $lastDistributor ? $lastDistributor->id + 1 : 1;

                // Format kode: DST-0001
                $distributor->distributor_code = 'DST-' . str_pad($nextDistributor, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}