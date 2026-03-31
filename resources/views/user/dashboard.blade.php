@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-yellow-50">

    {{-- HEADER FULL (ujung ke ujung) --}}
    <div class="bg-white border-b border-yellow-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h2 class="font-extrabold text-2xl text-gray-800">
                        📚 HAURA STORY HOUSE
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Pilih buku untuk dipinjam atau beri ulasan.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-2">
                    <a href="{{ route('history.borrows') }}"
                       class="px-4 py-2 rounded-xl bg-yellow-200 hover:bg-yellow-300 text-sm font-bold text-gray-800 shadow-sm">
                        Riwayat Peminjaman
                    </a>
                    <a href="{{ route('history.returns') }}"
                       class="px-4 py-2 rounded-xl bg-yellow-200 hover:bg-yellow-300 text-sm font-bold text-gray-800 shadow-sm">
                        Riwayat Pengembalian
                    </a>
                </div>

            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ALERT --}}
            @if(session('success'))
                <div class="mb-4 p-4 rounded-2xl bg-green-100 text-green-800 font-semibold border border-green-200">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 rounded-2xl bg-red-100 text-red-800 font-semibold border border-red-200">
                    ❌ {{ session('error') }}
                </div>
            @endif

            {{-- WRAPPER --}}
            <div class="bg-white p-6 rounded-3xl border border-yellow-100 shadow-sm">

                {{-- OPTIONAL: SEARCH UI (kalau belum ada logic search, ini cuma tampilan) --}}
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
                    <div class="font-bold text-gray-800">📖 Daftar Buku</div>

                    <div class="w-full md:w-96">
                        <form method="GET" action="{{ route('dashboard') }}" class="w-full md:w-96">
                            <div class="relative">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari judul / penulis..."
                                class="w-full rounded-2xl border-gray-200 focus:border-yellow-400 focus:ring-yellow-400 pl-10 pr-4"/>
                             <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
                         </div>
                    </form>
                </div>
                </div>

                @if($books->count() === 0)
                    <div class="p-6 rounded-2xl bg-yellow-50 border border-yellow-100 text-gray-700">
                        <div class="font-bold text-lg">📭 Belum ada data buku</div>
                        <div class="text-sm mt-1">Silakan minta admin menambahkan buku.</div>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($books as $book)
                            <div class="p-5 rounded-3xl border border-yellow-100 bg-yellow-50/40 hover:bg-yellow-50 transition">

                                <div class="flex flex-col md:flex-row gap-4 md:items-center">

                                    {{-- COVER --}}
                                    <div class="shrink-0">
                                        @if(!empty($book->cover))
                                            <img src="{{ asset('storage/'.$book->cover) }}"
                                                 class="w-24 h-32 object-cover rounded-2xl border border-yellow-100 shadow-sm"
                                                 alt="cover">
                                        @else
                                            <div class="w-24 h-32 rounded-2xl border border-yellow-100 bg-yellow-50 flex items-center justify-center text-xs text-gray-500">
                                                No Cover
                                            </div>
                                        @endif
                                    </div>

                                    {{-- INFO --}}
                                    <div class="flex-1">
                                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">

                                            <div>
                                                <div class="text-lg font-extrabold text-gray-800">
                                                    {{ $book->title }}
                                                </div>

                                                <div class="text-sm text-gray-700 mt-1 leading-relaxed">
                                                    <span class="font-semibold">Penulis:</span> {{ $book->author }} •
                                                    <span class="font-semibold">Penerbit:</span> {{ $book->publisher }} •
                                                    <span class="font-semibold">Kategori:</span> {{ $book->category->name ?? '-' }} •
                                                    <span class="font-semibold">Tahun:</span> {{ $book->published_year }}
                                                </div>

                                                {{-- STOK badge --}}
                                                <div class="mt-3">
                                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full
                                                        {{ $book->stock < 1 ? 'bg-red-100 text-red-700 border border-red-200' : 'bg-yellow-200 text-gray-900 border border-yellow-300' }}
                                                        font-bold text-sm">
                                                        📦 Stok: {{ $book->stock }}
                                                    </span>
                                                </div>
                                            </div>

                                            {{-- ACTIONS (tengah kanan, rapih) --}}
                                            <div class="flex gap-2 items-center">
                                                <a href="{{ route('books.borrow.create', $book) }}"
                                                   class="px-5 py-2 rounded-2xl bg-yellow-300 hover:bg-yellow-400 font-extrabold shadow-sm
                                                   {{ $book->stock < 1 ? 'opacity-50 pointer-events-none' : '' }}">
                                                    Pinjam
                                                </a>

                                                @if(in_array($book->id, $returnedBookIds))
                                                    <a href="{{ route('books.review.create', $book) }}"
                                                       class="px-5 py-2 rounded-2xl bg-white hover:bg-yellow-100 font-extrabold border border-yellow-200 shadow-sm">
                                                        Ulas
                                                    </a>
                                                @endif
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- PAGINATION --}}
                    <div class="mt-6">
                        {{ $books->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>

</div>
@endsection
