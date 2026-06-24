@extends('base.base')

@section('content')
    <div class="page-container">
        <h2 class="text-2xl md:text-3xl font-bold mb-6">Browse All Comics</h2>
        <div class="comic-grid">
            @foreach($semuaKomik as $komik)
                <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition duration-200">
                    <img src="{{ $komik->url_cover ?? 'https://via.placeholder.com/150x200' }}" alt="Cover" class="w-full h-44 sm:h-52 object-cover">
                    <div class="p-3">
                        <p class="text-sm font-semibold truncate">{{ $komik->nama_komik }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
