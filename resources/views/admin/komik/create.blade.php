@extends('base.base')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-teal-400 mb-6">Create Comic Preview</h1>

    @if(session('success'))
        <div class="mb-4 rounded bg-teal-500/10 border border-teal-500 text-teal-100 p-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.komik.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm text-gray-300 mb-2">Comic Title</label>
            <input type="text" name="nama_komik" value="{{ old('nama_komik') }}" class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white" required>
            @error('nama_komik')<p class="text-red-400 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-300 mb-2">Synopsis</label>
            <textarea name="sinopsis_komik" class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white" rows="4">{{ old('sinopsis_komik') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-300 mb-2">Cover URL</label>
            <input type="url" name="url_cover" value="{{ old('url_cover') }}" class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white" placeholder="Paste a direct image URL here">
            <p class="text-sm text-slate-500 mt-2">Use a direct public image URL. Google Drive links must resolve to an actual image file.</p>
            @error('url_cover')<p class="text-red-400 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="grid md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm text-gray-300 mb-2">Release Date</label>
                <input type="date" name="tanggal_rilis" value="{{ old('tanggal_rilis') }}" class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white">
            </div>
            <div>
                <label class="block text-sm text-gray-300 mb-2">Status</label>
                <input type="text" name="status_pengerjaan" value="{{ old('status_pengerjaan') }}" class="w-full p-3 rounded bg-gray-800 border border-gray-700 text-white" placeholder="Ongoing / Completed">
            </div>
        </div>

        <button type="submit" class="bg-teal-500 hover:bg-teal-400 text-black px-6 py-3 rounded font-semibold">Create Preview</button>
    </form>

</div>
@endsection
