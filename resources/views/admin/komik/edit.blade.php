@extends('base.base')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-teal-400 mb-6">Add Chapter for {{ $komik->nama_komik }}</h1>

    @if(session('success'))
        <div class="mb-4 rounded bg-teal-500/10 border border-teal-500 text-teal-100 p-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 rounded-xl border border-slate-700 bg-slate-900 p-5">
        <h2 class="text-xl font-semibold text-white mb-3">Comic Details</h2>
        <form action="{{ route('admin.komik.update', $komik->id_komik) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm text-gray-300 mb-2">Title</label>
                <input type="text" name="nama_komik" value="{{ old('nama_komik', $komik->nama_komik) }}" class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white" required>
                @error('nama_komik')<p class="text-red-400 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-2">Synopsis</label>
                <textarea name="sinopsis_komik" rows="3" class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white">{{ old('sinopsis_komik', $komik->sinopsis_komik) }}</textarea>
                @error('sinopsis_komik')<p class="text-red-400 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-2">Cover URL</label>
                <input type="url" name="url_cover" value="{{ old('url_cover', $komik->url_cover) }}" class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white" placeholder="Paste a direct image URL here">
                @error('url_cover')<p class="text-red-400 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-300 mb-2">Release Date</label>
                    <input type="date" name="tanggal_rilis" value="{{ old('tanggal_rilis', $komik->tanggal_rilis) }}" class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white">
                    @error('tanggal_rilis')<p class="text-red-400 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm text-gray-300 mb-2">Status</label>
                    <input type="text" name="status_pengerjaan" value="{{ old('status_pengerjaan', $komik->status_pengerjaan) }}" class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white" placeholder="Ongoing / Completed">
                    @error('status_pengerjaan')<p class="text-red-400 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <button type="submit" class="bg-teal-500 hover:bg-teal-400 text-black px-6 py-3 rounded font-semibold">Save Comic</button>
        </form>
    </div>

    @if($komik->chapters->isNotEmpty())
        <div class="mb-6 rounded-xl border border-slate-700 bg-slate-900 p-5">
            <h2 class="text-xl font-semibold text-white mb-3">Existing Chapters</h2>
            <ul class="space-y-2 text-sm text-slate-300">
                @foreach($komik->chapters as $chapter)
                    <li class="flex items-center justify-between gap-4 py-2 px-3 rounded-lg bg-slate-800">
                        <div>
                            <div class="font-semibold text-white">{{ $chapter->nomor_chapter }}. {{ $chapter->judul_chapter }}</div>
                            <div class="text-slate-400 text-xs">ID: {{ $chapter->id_chapter }}</div>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.komik.chapter.show', $chapter->id_chapter) }}" class="text-teal-300 hover:text-teal-100">View</a>
                            <a href="{{ route('admin.komik.chapter.edit', $chapter->id_chapter) }}" class="text-slate-100 bg-slate-700 hover:bg-slate-600 px-3 py-2 rounded">Edit URLs</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.komik.chapter.store', $komik->id_komik) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm text-gray-300 mb-2">Chapter Title (optional)</label>
            <input type="text" name="judul_chapter" value="{{ old('judul_chapter') }}" class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white" placeholder="Leave blank to use Chapter {{ old('nomor_chapter', $nextChapterNumber) }}">
            @error('judul_chapter')<p class="text-red-400 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-300 mb-2">Chapter Number</label>
            <input type="number" name="nomor_chapter" value="{{ old('nomor_chapter', $nextChapterNumber) }}" class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white" min="1" required>
            @error('nomor_chapter')<p class="text-red-400 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-300 mb-2">Chapter Pages (one image URL per line or comma separated)</label>
            <textarea name="page_urls" rows="6" class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white" placeholder="https://example.com/page1.jpg\nhttps://example.com/page2.jpg">{{ old('page_urls') }}</textarea>
            <p class="text-sm text-slate-500 mt-2">Enter one direct image URL per line or separate multiple URLs with commas. Blank lines are ignored.</p>
            @error('page_urls')<p class="text-red-400 mt-1">{{ $message }}</p>@enderror
            @error('page_urls.*')<p class="text-red-400 mt-1">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="bg-teal-500 hover:bg-teal-400 text-black px-6 py-3 rounded font-semibold">Upload Chapter</button>
    </form>
</div>
@endsection