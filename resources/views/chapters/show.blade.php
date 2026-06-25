@extends('base.base')

@section('content')
<div id="chapter-reader" class="max-w-full sm:max-w-5xl mx-auto px-4 py-10" style="--reader-page-margin: 24px;">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <a href="{{ route('komik.show', $chapter->komik->id_komik) }}" class="text-teal-300 hover:text-teal-100">&larr; Back to {{ $chapter->komik->nama_komik }}</a>
            <h1 class="text-3xl font-bold text-white mt-4">{{ $chapter->judul_chapter }}</h1>
            <p class="text-slate-400">Chapter {{ $chapter->nomor_chapter }}</p>
        </div>
        <div class="w-full sm:w-auto">
            <div class="rounded-xl border border-slate-700 bg-slate-900 p-4">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-300 font-semibold">Reader margin</p>
                        <p class="text-xs text-slate-500">Adjust page spacing for comfortable reading.</p>
                    </div>
                    <span id="margin-value" class="text-teal-300 font-semibold">24</span>px
                </div>
                <input id="margin-range" type="range" min="0" max="80" value="24" class="mt-4 w-full">
            </div>
        </div>
    </div>

    <div>
        @foreach($chapter->pages as $page)
            <div class="bg-slate-900" style="margin-bottom: var(--reader-page-margin);">
                <img src="{{ $page->file_path }}" alt="Page {{ $page->page_number }}" class="w-full h-auto object-contain block rounded-none">
            </div>
        @endforeach
    </div>
</div>

<script>
    (function () {
        const reader = document.getElementById('chapter-reader');
        const range = document.getElementById('margin-range');
        const value = document.getElementById('margin-value');
        const storageKey = 'reader_page_margin';
        const defaultMargin = 24;
        const savedMargin = localStorage.getItem(storageKey);
        const initialMargin = savedMargin !== null && !isNaN(savedMargin) ? Number(savedMargin) : defaultMargin;

        range.value = initialMargin;
        value.textContent = initialMargin;
        reader.style.setProperty('--reader-page-margin', initialMargin + 'px');

        range.addEventListener('input', () => {
            const margin = Number(range.value);
            value.textContent = margin;
            reader.style.setProperty('--reader-page-margin', margin + 'px');
            localStorage.setItem(storageKey, margin);
        });
    })();
</script>
@endsection