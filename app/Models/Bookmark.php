<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $table = 'bookmark';
    protected $primaryKey = 'ID_Bookmark';

    protected $fillable = [
        'ID_Pengguna', 
        'ID_Komik'
    ];
}