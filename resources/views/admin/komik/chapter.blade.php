@extends('base.base')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-teal-400 mb-4">{{ $chapter->judul_chapter }}</h1>

    <div class="space-y-6">
        @foreach($chapter->pages as $page)
            <div class="rounded overflow-hidden border border-slate-700 bg-slate-900">
                <img src="{{ $page->file_path }}" alt="Chapter page {{ $page->page_number }}" class="w-full object-contain">
                <div class="p-3 text-slate-400">Page {{ $page->page_number }}</div>
            </div>
        @endforeach
    </div>
</div>
@endsection