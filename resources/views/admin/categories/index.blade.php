@extends('admin.layout', ['title' => 'Data Kategori'])

@section('content')

<div class="min-h-screen bg-yellow-50 py-10">
    <div class="max-w-6xl mx-auto px-6 space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-800">🏷️ Data Kategori</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola kategori untuk mengelompokkan buku.</p>
            </div>

            <a href="{{ route('admin.categories.create') }}"
               class="px-5 py-3 rounded-2xl bg-yellow-300 hover:bg-yellow-400 font-extrabold shadow-sm transition">
                + Tambah Kategori
            </a>
        </div>

        {{-- FLASH MESSAGE --}}
        @if(session('success'))
            <div class="p-4 rounded-2xl bg-green-100 text-green-800 font-semibold border border-green-200">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-2xl bg-red-100 text-red-800 font-semibold border border-red-200">
                ❌ {{ session('error') }}
            </div>
        @endif

        {{-- CARD TABLE --}}
        <div class="bg-white rounded-3xl border border-yellow-100 shadow-sm p-6">

            {{-- TOP BAR (optional search UI) --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-5">
                <div class="font-bold text-gray-800">📋 List Kategori</div>

                {{-- Kalau mau search beneran nanti, tinggal buat logic controller --}}
                <form method="GET" action="{{ route('admin.categories.index') }}" class="w-full md:w-96">
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">🔎</span>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari kategori..."
                            class="w-full rounded-2xl border-gray-200 focus:border-yellow-400 focus:ring-yellow-400 pl-12 pr-4 py-3"
                        />
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-600 border-b border-yellow-100">
                            <th class="py-3 px-3 font-extrabold">Nama Kategori</th>
                            <th class="py-3 px-3 font-extrabold">Dibuat</th>
                            <th class="py-3 px-3 font-extrabold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($categories as $c)
                            <tr class="border-b border-yellow-50 hover:bg-yellow-50/60 transition">
                                <td class="py-4 px-3">
                                    <div class="font-extrabold text-gray-800">{{ $c->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $c->id }}</div>
                                </td>

                                <td class="py-4 px-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-gray-700 font-bold text-xs">
                                        📅 {{ $c->created_at?->format('d M Y') }}
                                    </span>
                                </td>

                                <td class="py-4 px-3">
                                    <div class="flex flex-wrap gap-2">

                                        <a href="{{ route('admin.categories.edit', $c) }}"
                                           class="px-4 py-2 rounded-xl bg-yellow-200 hover:bg-yellow-300 font-extrabold transition">
                                            ✏️ Edit
                                        </a>

                                        <form method="POST" action="{{ route('admin.categories.destroy', $c) }}"
                                              onsubmit="return confirm('Hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="px-4 py-2 rounded-xl bg-red-100 hover:bg-red-200 text-red-700 font-extrabold transition">
                                                🗑️ Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-8 px-3 text-center text-gray-600" colspan="3">
                                    📭 Belum ada kategori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="mt-6">
                {{ $categories->links() }}
            </div>
        </div>

    </div>
</div>

@endsection
