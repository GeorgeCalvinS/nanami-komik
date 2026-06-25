<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Chapter;

class ChapterPage extends Model
{
    protected $table = 'chapter_pages';
    protected $fillable = [
        'id_chapter',
        'page_number',
        'file_path',
    ];

    public function getFilePathAttribute($value)
    {
        if (!$value) {
            return $value;
        }

        $value = $this->normalizeRemoteImageUrl($value);

        if (Str::startsWith($value, ['http://', 'https://', '/storage/'])) {
            return $value;
        }

        if (Str::startsWith($value, 'storage/')) {
            return '/' . $value;
        }

        return Storage::disk('public')->url($value);
    }

    protected function normalizeRemoteImageUrl(string $value): string
    {
        if (preg_match('#https?://drive\.google\.com/file/d/([A-Za-z0-9_-]+)(?:/view(?:\?.*)?)?#i', $value, $matches)) {
            return 'https://drive.google.com/uc?export=view&id=' . $matches[1];
        }

        if (preg_match('#https?://drive\.google\.com/open\?id=([^&]+)#i', $value, $matches)) {
            return 'https://drive.google.com/uc?export=view&id=' . $matches[1];
        }

        if (preg_match('#https?://drive\.google\.com/uc\?id=([^&]+)#i', $value, $matches)) {
            return 'https://drive.google.com/uc?export=view&id=' . $matches[1];
        }

        return $value;
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'id_chapter', 'id_chapter');
    }
}
