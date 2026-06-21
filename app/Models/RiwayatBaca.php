<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatBaca extends Model
{
    protected $table = 'riwayat_baca';
    protected $primaryKey = 'ID_Riwayat';

    protected $fillable = [
        'ID_Pengguna', 
        'ID_Komik', 
        'ID_Chapter', 
        'halaman_terakhir'
    ];
}