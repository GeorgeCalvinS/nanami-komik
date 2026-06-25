<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\ChapterPage;
use App\Models\Komik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminKomikController extends Controller
{
    public function create()
    {
        return view('admin.komik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_komik' => 'required|string|max:255',
            'sinopsis_komik' => 'nullable|string',
            'url_cover' => 'nullable|url',
            'tanggal_rilis' => 'nullable|date',
            'status_pengerjaan' => 'nullable|string|max:100',
        ]);

        $coverUrl = $request->url_cover;

        $komik = Komik::create([
            'id_user' => auth()->id(),
            'nama_komik' => $request->nama_komik,
            'sinopsis_komik' => $request->sinopsis_komik,
            'url_cover' => $coverUrl,
            'tanggal_rilis' => $request->tanggal_rilis,
            'status_pengerjaan' => $request->status_pengerjaan,
        ]);

        return redirect()->route('admin.komik.edit', $komik->id_komik)
            ->with('success', 'Comic preview created. Now add chapters.');
    }

    public function edit(Komik $komik)
    {
        $komik->load(['chapters' => function ($query) {
            $query->orderBy('nomor_chapter');
        }]);

        $latestChapterNumber = $komik->chapters->max('nomor_chapter') ?: 0;
        $nextChapterNumber = $latestChapterNumber + 1;

        return view('admin.komik.edit', compact('komik', 'nextChapterNumber'));
    }

    public function update(Request $request, Komik $komik)
    {
        $request->validate([
            'nama_komik' => 'required|string|max:255',
            'sinopsis_komik' => 'nullable|string',
            'url_cover' => 'nullable|url',
            'tanggal_rilis' => 'nullable|date',
            'status_pengerjaan' => 'nullable|string|max:100',
        ]);

        $komik->update([
            'nama_komik' => $request->nama_komik,
            'sinopsis_komik' => $request->sinopsis_komik,
            'url_cover' => $request->url_cover,
            'tanggal_rilis' => $request->tanggal_rilis,
            'status_pengerjaan' => $request->status_pengerjaan,
        ]);

        return back()->with('success', 'Comic updated successfully.');
    }

    public function editChapter(Chapter $chapter)
    {
        $chapter->load('pages');

        return view('admin.komik.chapter_edit', compact('chapter'));
    }

    public function updateChapter(Request $request, Chapter $chapter)
    {
        $request->validate([
            'page_urls' => 'required|string',
        ]);

        $urls = preg_split('/[\r\n]+|,\s*/', $request->page_urls);
        $urls = array_values(array_filter(array_map('trim', $urls)));

        if (empty($urls)) {
            return back()->withErrors(['page_urls' => 'Please enter at least one image URL.'])->withInput();
        }

        $validator = Validator::make(['page_urls' => $urls], ['page_urls.*' => 'required|url']);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $chapter->pages()->delete();
        foreach ($urls as $index => $url) {
            ChapterPage::create([
                'id_chapter' => $chapter->id_chapter,
                'page_number' => $index + 1,
                'file_path' => $url,
            ]);
        }

        return redirect()->route('admin.komik.chapter.show', $chapter->id_chapter)
            ->with('success', 'Chapter URLs updated successfully.');
    }

    public function storeChapter(Request $request, Komik $komik)
    {
        $request->validate([
            'judul_chapter' => 'nullable|string|max:255',
            'nomor_chapter' => 'required|integer|min:1',
            'page_urls' => 'required|string',
        ]);

        $urls = preg_split('/[\r\n]+|,\s*/', $request->page_urls);
        $urls = array_values(array_filter(array_map('trim', $urls)));

        if (empty($urls)) {
            return back()->withErrors(['page_urls' => 'Please enter at least one image URL.'])->withInput();
        }

        $validator = Validator::make(['page_urls' => $urls], ['page_urls.*' => 'required|url']);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $chapterTitle = trim($request->judul_chapter ?: '');
        if ($chapterTitle === '') {
            $chapterTitle = sprintf('Chapter %s', $request->nomor_chapter);
        }

        $chapter = Chapter::create([
            'id_komik' => $komik->id_komik,
            'judul_chapter' => $chapterTitle,
            'nomor_chapter' => $request->nomor_chapter,
        ]);

        foreach ($urls as $index => $url) {
            ChapterPage::create([
                'id_chapter' => $chapter->id_chapter,
                'page_number' => $index + 1,
                'file_path' => $url,
            ]);
        }

        return back()->with('success', 'Chapter added successfully.');
    }

    public function showChapter(Chapter $chapter)
    {
        $chapter->load('pages');

        return view('admin.komik.chapter', compact('chapter'));
    }
}
