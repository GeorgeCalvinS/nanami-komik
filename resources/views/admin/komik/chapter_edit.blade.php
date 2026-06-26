@extends('base.base')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="mb-6 flex items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-teal-400 mb-2">Edit Chapter {{ $chapter->nomor_chapter }}</h1>
            <p class="text-slate-400">{{ $chapter->komik->nama_komik }}</p>
        </div>
        <a href="{{ route('admin.komik.chapter.show', $chapter->id_chapter) }}" class="text-teal-300 hover:text-teal-100">Back to chapter</a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded bg-teal-500/10 border border-teal-500 text-teal-100 p-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.komik.chapter.update', $chapter->id_chapter) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm text-gray-300 mb-2">Chapter Title</label>
            <input type="text" name="judul_chapter" value="{{ old('judul_chapter', $chapter->judul_chapter) }}" class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white" placeholder="Leave blank to use Chapter {{ old('nomor_chapter', $chapter->nomor_chapter) }}">
            @error('judul_chapter')<p class="text-red-400 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-300 mb-2">Chapter Number</label>
            <input type="number" name="nomor_chapter" value="{{ old('nomor_chapter', $chapter->nomor_chapter) }}" class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white" min="1" required>
            @error('nomor_chapter')<p class="text-red-400 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-300 mb-2">Image URLs (one per line)</label>
            <textarea name="page_urls" rows="8" class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white">{{ old('page_urls', $chapter->pages->pluck('file_path')->implode('\n')) }}</textarea>
            <p class="text-sm text-slate-500 mt-2">Enter one direct image URL per line. Blank lines are ignored.</p>
            @error('page_urls')<p class="text-red-400 mt-1">{{ $message }}</p>@enderror
            @error('page_urls.*')<p class="text-red-400 mt-1">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="bg-teal-500 hover:bg-teal-400 text-black px-6 py-3 rounded font-semibold">Save Chapter</button>
    </form>
</div>
@endsection
