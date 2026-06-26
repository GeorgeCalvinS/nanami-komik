@extends('base.base')

@section('content')
<div class="page-container">

    {{-- TOP COMICS --}}
    <div class="mb-10">
        <h2 class="text-xl font-bold text-teal-400 mb-4">⭐ Top Comics</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
            @foreach($topKomik as $top)
                <a href="{{ route('komik.show', $top->id_komik) }}"
                   class="bg-gray-800 rounded-xl overflow-hidden hover:ring-2 hover:ring-teal-400 transition duration-200">
                    <img src="{{ $top->url_cover ?? 'https://via.placeholder.com/150x200' }}"
                         alt="Cover" class="w-full h-44 object-cover">
                    <div class="p-3 space-y-1">
                        <p class="text-sm font-semibold text-white truncate">{{ $top->nama_komik }}</p>
                        <p class="text-yellow-400 text-xs">★ {{ number_format($top->rating_rata, 1) }}</p>
                        <p class="text-slate-400 text-xs">❤ {{ $top->likes_count }} likes</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    {{-- SEMUA KOMIK --}}
    <h2 class="text-2xl md:text-3xl font-bold mb-6">Browse All Comics</h2>
    <div class="comic-grid">
        @foreach($semuaKomik as $komik)
            <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition duration-200">
                <img src="{{ $komik->url_cover ?? 'https://via.placeholder.com/150x200' }}"
                     alt="Cover" class="w-full h-44 sm:h-52 object-cover">
                <div class="p-3">
                    <a href="{{ route('komik.show', $komik->id_komik) }}"
                       class="text-sm font-semibold truncate text-white hover:text-teal-300">
                        {{ $komik->nama_komik }}
                    </a>
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-yellow-400 text-xs">★ {{ number_format($komik->rating_rata, 1) }}</span>
                        <span class="text-slate-400 text-xs">❤ {{ $komik->likes_count }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection