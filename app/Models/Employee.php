<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // Column mana saja yang boleh diisi
    protected $fillable = [
        'employe_code', 'name', 'email', 'phone', 'position', 'status'
    ];

    protected static function boot()
    {
        parent::boot(); // Disarankan menambahkan parent::boot()

        static::creating(function ($employee) { // Di sini tadinya ada kelebihan ')'
            if (empty($employee->employe_code)) {
                // Ambil id dari urutan terakhir 
                $last_employee = static::latest('id')->first();
                $nextNumber = $last_employee ? $last_employee->id + 1 : 1;

                // Di sini tadinya kurang koma ',' sebelum STR_PAD_LEFT
                $employee->employe_code = 'KRY' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}