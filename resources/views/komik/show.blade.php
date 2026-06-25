@extends('base.base')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <div class="grid gap-6 lg:grid-cols-[280px_1fr]">
        <div class="bg-slate-900 p-4 rounded-xl border border-slate-700">
            <img src="{{ $komik->url_cover ?? 'https://via.placeholder.com/280x420' }}" alt="Cover" class="w-full rounded-lg mb-4 object-cover">
            <div class="text-sm text-slate-400 mb-2">Release: {{ $komik->tanggal_rilis ?? 'Unknown' }}</div>
            <div class="text-sm text-slate-400">Status: {{ $komik->status_pengerjaan ?? 'Unknown' }}</div>
        </div>

        <div>
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-4xl font-bold text-white">{{ $komik->nama_komik }}</h1>
                <p class="text-slate-300 mt-3">{{ $komik->sinopsis_komik }}</p>
            </div>
            @auth
                @if(auth()->user()->role_user === 1)
                    <a href="{{ route('admin.komik.edit', $komik->id_komik) }}" class="inline-flex items-center justify-center rounded bg-teal-500 px-5 py-3 text-sm font-semibold text-black hover:bg-teal-400">Add Chapter</a>
                @endif
            @endauth
        </div>

            <div class="bg-slate-900 p-6 rounded-xl border border-slate-700">
                <h2 class="text-2xl font-semibold text-white mb-4">Chapters</h2>

                @if($komik->chapters->isEmpty())
                    <p class="text-slate-400">No chapters yet.</p>
                @else
                    <ul class="space-y-3">
                        @foreach($komik->chapters as $chapter)
                            <li class="p-4 rounded-lg bg-slate-800 border border-slate-700">
                                <a href="{{ route('komik.chapter.show', $chapter->id_chapter) }}" class="block text-white font-semibold hover:text-teal-300">{{ $chapter->judul_chapter }}</a>
                                <p class="text-slate-400 text-sm mt-1">Chapter {{ $chapter->nomor_chapter }}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection