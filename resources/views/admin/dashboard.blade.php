@extends('base.base')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-teal-400 mb-6">Admin Dashboard</h1>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Admin Dashboard</p>
            <h2 class="text-2xl font-bold text-white mt-2">Overview</h2>
        </div>
        <a href="{{ route('admin.komik.create') }}" class="inline-flex items-center justify-center rounded bg-teal-500 px-5 py-3 text-sm font-semibold text-black hover:bg-teal-400">Create Comic Preview</a>
    </div>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4 mb-8">
        <div class="bg-slate-800 p-6 rounded-lg shadow-sm border border-slate-700">
            <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Total Users</p>
            <p class="mt-4 text-4xl font-bold">{{ $userCount }}</p>
        </div>
        <div class="bg-slate-800 p-6 rounded-lg shadow-sm border border-slate-700">
            <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Total Komik</p>
            <p class="mt-4 text-4xl font-bold">{{ $komikCount }}</p>
        </div>
        <div class="bg-slate-800 p-6 rounded-lg shadow-sm border border-slate-700">
            <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Bookmarks</p>
            <p class="mt-4 text-4xl font-bold">{{ $bookmarkCount }}</p>
        </div>
        <div class="bg-slate-800 p-6 rounded-lg shadow-sm border border-slate-700">
            <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Reading History</p>
            <p class="mt-4 text-4xl font-bold">{{ $historyCount }}</p>
        </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-2">
        <div class="bg-slate-800 p-6 rounded-lg border border-slate-700">
            <h2 class="text-xl font-semibold text-white mb-4">Recent Users</h2>
            <ul class="space-y-3">
                @forelse ($recentUsers as $user)
                    <li class="p-4 rounded bg-slate-900 border border-slate-700">
                        <p class="font-semibold">{{ $user->nama_user }}</p>
                        <p class="text-sm text-slate-400">{{ $user->email_user }}</p>
                    </li>
                @empty
                    <li class="text-slate-400">No users found.</li>
                @endforelse
            </ul>
        </div>

        <div class="bg-slate-800 p-6 rounded-lg border border-slate-700">
            <h2 class="text-xl font-semibold text-white mb-4">Recent Komik</h2>
            <ul class="space-y-3">
                @forelse ($recentKomik as $komik)
                    <li class="p-4 rounded bg-slate-900 border border-slate-700">
                        <p class="font-semibold">{{ $komik->nama_komik }}</p>
                        <p class="text-sm text-slate-400">{{ $komik->status_pengerjaan ?? 'Unknown status' }}</p>
                    </li>
                @empty
                    <li class="text-slate-400">No komik found.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
