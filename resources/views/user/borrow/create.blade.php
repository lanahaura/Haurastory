@extends('layouts.app')

@section('content')
<div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="bg-white rounded-2xl shadow-sm border border-yellow-100 px-6 py-4 mb-6 flex items-center justify-between">

    <div>
        <h2 class="font-extrabold text-2xl text-gray-800">
            📌 Form Peminjaman Buku
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Lengkapi data peminjam sebelum menyimpan.
        </p>
    </div>

    <a href="{{ route('dashboard') }}"
       class="px-4 py-2 rounded-xl bg-yellow-200 hover:bg-yellow-300 text-sm font-semibold transition">
        ← Kembali
    </a>

</div>
        {{-- WRAPPER CARD --}}
        <div class="bg-yellow-50 border border-yellow-200 rounded-3xl p-6 sm:p-8">

            {{-- CARD: INFO BUKU --}}
            <div class="bg-white border border-yellow-100 rounded-2xl p-5 sm:p-6 shadow-sm">
                <div class="flex flex-col sm:flex-row gap-5 items-start">

                    {{-- Cover --}}
                    <div class="w-full sm:w-40 flex-shrink-0">
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}"
                                 class="w-full h-56 object-cover rounded-2xl border border-yellow-100 shadow-sm"
                                 alt="cover">
                        @else
                            <div class="w-full h-56 rounded-2xl border border-yellow-100 bg-yellow-50
                                        flex items-center justify-center text-sm text-gray-500">
                                No Cover
                            </div>
                        @endif
                    </div>

                    {{-- Detail --}}
                    <div class="flex-1 w-full">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h3 class="text-xl sm:text-2xl font-extrabold text-gray-800 leading-tight">
                                    {{ $book->title }}
                                </h3>
                                <div class="mt-2 text-sm text-gray-600 space-y-1">
                                    <div><span class="font-semibold text-gray-700">Penulis:</span> {{ $book->author }}</div>
                                    <div><span class="font-semibold text-gray-700">Penerbit:</span> {{ $book->publisher }}</div>
                                    <div><span class="font-semibold text-gray-700">Kategori:</span> {{ $book->category->name }}</div>
                                    <div><span class="font-semibold text-gray-700">Tahun:</span> {{ $book->published_year }}</div>
                                </div>
                            </div>

                            {{-- Badge stok --}}
                            <div class="shrink-0">
                                <span class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-200
                                             text-gray-800 font-bold text-sm">
                                    Stok: {{ $book->stock }}
                                </span>
                            </div>
                        </div>

                        {{-- Sub info --}}
                        <div class="mt-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs">
                                ID Buku: #{{ $book->id }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="mt-5 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-800">
                    <div class="font-bold mb-2">⚠️ Ada yang belum benar:</div>
                    <ul class="list-disc pl-5 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM --}}
            <div class="mt-6 bg-white border border-yellow-100 rounded-2xl p-5 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-bold text-lg text-gray-800">📝 Data Peminjam</h4>
                    <span class="text-xs text-gray-500">Semua field wajib diisi</span>
                </div>

                <form method="POST" action="{{ route('books.borrow.store', $book) }}" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold mb-1 text-gray-700">Nama</label>
                            <input type="text" name="borrower_name" value="{{ old('borrower_name') }}"
                                   class="w-full rounded-xl border-gray-300 focus:border-yellow-400 focus:ring-yellow-400"
                                   placeholder="Masukkan nama peminjam" required>
                        </div>

                        <div>
                            <label class="block font-semibold mb-1 text-gray-700">Nomor Telepon</label>
                            <input type="text" name="borrower_phone" value="{{ old('borrower_phone') }}"
                                   class="w-full rounded-xl border-gray-300 focus:border-yellow-400 focus:ring-yellow-400"
                                   placeholder="08xxxxxxxxxx" required>
                            <p class="text-xs text-gray-500 mt-1">Contoh: 081234567890</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold mb-1 text-gray-700">Tanggal Pinjam</label>
                            <input type="date" name="borrowed_at" value="{{ old('borrowed_at', date('Y-m-d')) }}"
                                   class="w-full rounded-xl border-gray-300 focus:border-yellow-400 focus:ring-yellow-400"
                                   required>
                        </div>

                        <div>
                            <label class="block font-semibold mb-1 text-gray-700">Tanggal Jatuh Tempo</label>
                            <input type="date" name="due_at" value="{{ old('due_at') }}"
                                   class="w-full rounded-xl border-gray-300 focus:border-yellow-400 focus:ring-yellow-400"
                                   required>
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full px-4 py-3 rounded-2xl bg-yellow-300 hover:bg-yellow-400 font-extrabold
                                   transition active:scale-[0.99] shadow-sm">
                        ✅ Simpan Peminjaman
                    </button>

                    <p class="text-xs text-gray-500 text-center">
                        Pastikan data benar sebelum disimpan.
                    </p>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
