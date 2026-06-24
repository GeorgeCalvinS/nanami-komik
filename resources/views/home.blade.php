@extends('base.base')

@section('content')
    <div class="page-container">
        <h2 class="text-2xl md:text-3xl font-bold mb-5">Recommended for You</h2>
        <div class="comic-grid">
            @foreach($rekomendasi as $komik)
                <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition duration-200">
                    <img src="{{ $komik->url_cover ?? 'https://via.placeholder.com/150x200' }}" alt="Cover" class="w-full h-44 sm:h-52 object-cover">
                    <div class="p-3">
                        <p class="text-sm font-semibold truncate">{{ $komik->nama_komik }}</p>
                        <p class="text-xs text-teal-400 mt-1">{{ $komik->status_pengerjaan }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
