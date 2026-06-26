<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ChapterPage;

class Chapter extends Model
{
    protected $table = 'chapters';
    protected $primaryKey = 'id_chapter';
    protected $fillable = [
        'id_komik',
        'judul_chapter',
        'nomor_chapter',
    ];

    public function komik()
    {
        return $this->belongsTo(Komik::class, 'id_komik', 'id_komik');
    }

    public function pages()
    {
        return $this->hasMany(ChapterPage::class, 'id_chapter', 'id_chapter')->orderBy('page_number');
    }
}
