@extends('layouts.app')

@section('content')
<div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

{{-- HEADER FULL WIDTH --}}
<div class="bg-white rounded-2xl shadow-sm border border-yellow-100 px-6 py-4 mb-6 flex items-center justify-between">
        <div>
            <h2 class="font-extrabold text-2xl text-gray-900">✍️ Ulas Buku</h2>
            <p class="text-sm text-gray-500 mt-1">Kasih rating & komentar</p>
        </div>

        <a href="{{ route('dashboard') }}"
           class="px-5 py-2 rounded-xl bg-yellow-300 hover:bg-yellow-400 font-semibold transition shadow-sm">
            ← Kembali
        </a>
    </div>
</div>

<div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        {{-- FLASH --}}
        @if(session('success'))
            <div class="mb-5 p-4 rounded-2xl bg-green-100 text-green-800 font-semibold border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-5 p-4 rounded-2xl bg-red-100 text-red-800 font-semibold border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-yellow-50 border border-yellow-200 rounded-3xl p-6 sm:p-8">

            {{-- INFO BUKU --}}
            <div class="bg-white border border-yellow-100 rounded-2xl p-6 shadow-sm mb-6 hover:shadow-md transition">
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
                                <h3 class="text-2xl font-extrabold text-gray-800 leading-tight">
                                    {{ $book->title }}
                                </h3>
                                <div class="mt-2 text-sm text-gray-600 space-y-1">
                                    <div><span class="font-semibold">Penulis:</span> {{ $book->author }}</div>
                                    <div><span class="font-semibold">Penerbit:</span> {{ $book->publisher }}</div>
                                    <div><span class="font-semibold">Tahun:</span> {{ $book->published_year }}</div>
                                </div>
                            </div>

                            {{-- AVG RATING --}}
                            <div class="shrink-0 text-right">
                                <div class="text-sm text-gray-500">Rata-rata</div>
                                <div class="text-2xl font-extrabold text-gray-900">
                                    {{ number_format($avgRating ?? 0, 1) }}
                                    <span class="text-sm font-semibold text-gray-500">/ 5</span>
                                </div>
                                <div class="text-xs text-gray-500">
                                    ({{ $reviewsCount ?? 0 }} ulasan)
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ERROR VALIDASI --}}
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-800">
                    <div class="font-bold mb-2">⚠️ Ada yang belum benar:</div>
                    <ul class="list-disc pl-5 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM ULASAN --}}
            <div class="bg-white border border-yellow-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-bold text-lg text-gray-800">⭐ Tulis Ulasan Kamu</h4>
                    <span class="text-xs text-gray-500">Klik bintang untuk rating</span>
                </div>

                <form method="POST" action="{{ route('books.review.store', $book) }}" class="space-y-6">
                    @csrf

                    {{-- STAR RATING --}}
                    @php
                        $currentRating = old('rating', $existing->rating ?? 5);
                    @endphp

                    <div>
    <label class="font-semibold">Rating</label>

    <div class="mt-2 flex flex-row-reverse justify-end gap-1">
        @for($i = 5; $i >= 1; $i--)
            <input
                id="star{{ $i }}"
                type="radio"
                name="rating"
                value="{{ $i }}"
                class="peer hidden"
                {{ (int)old('rating', $existing->rating ?? 5) === $i ? 'checked' : '' }}
                required
            />
            <label
                for="star{{ $i }}"
                class="cursor-pointer text-3xl select-none
                       text-gray-300
                       peer-checked:text-yellow-400
                       hover:text-yellow-400
                       hover:peer-checked:text-yellow-400"
                title="{{ $i }}"
            >
                ★
            </label>
        @endfor
    </div>

    @error('rating')
        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>

                    {{-- KOMENTAR --}}
                    <div>
                        <label class="block font-semibold mb-2 text-gray-700">Komentar (Opsional)</label>
                        <textarea name="comment" rows="4"
                                  class="w-full rounded-2xl border-gray-300 focus:border-yellow-400 focus:ring-yellow-400"
                                  placeholder="Tulis pendapatmu tentang buku ini...">{{ old('comment', $existing->comment ?? '') }}</textarea>

                        @error('comment')
                            <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit"
                            class="w-full px-4 py-3 rounded-2xl bg-yellow-300 hover:bg-yellow-400 font-extrabold
                                   transition active:scale-[0.99] shadow-sm">
                        💾 Simpan Ulasan
                    </button>
                </form>
            </div>

            {{-- ULASAN ORANG LAIN --}}
            <div class="mt-8">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-bold text-lg text-gray-800">💬 Ulasan Lainnya</h4>
                    <span class="text-xs text-gray-500">Menampilkan ulasan user lain</span>
                </div>

                @if($otherReviews->count() === 0)
                    <div class="p-5 rounded-2xl bg-white border border-yellow-100 text-gray-700">
                        Belum ada ulasan lain untuk buku ini.
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($otherReviews as $r)
                            <div class="p-5 rounded-2xl bg-white border border-yellow-100 shadow-sm hover:shadow-md transition">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <div class="font-bold text-gray-800">
                                            {{ $r->user->name ?? 'User' }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $r->created_at?->format('d M Y, H:i') }}
                                        </div>
                                    </div>

                                    <div class="text-yellow-400 font-extrabold">
                                        @for($i=1;$i<=5;$i++)
                                            <span class="{{ $i <= (int)$r->rating ? '' : 'text-gray-300' }}">★</span>
                                        @endfor
                                    </div>
                                </div>

                                @if($r->comment)
                                    <div class="mt-3 text-sm text-gray-700 leading-relaxed">
                                        {{ $r->comment }}
                                    </div>
                                @else
                                    <div class="mt-3 text-sm text-gray-400 italic">
                                        (Tidak ada komentar)
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-5">
                        {{ $otherReviews->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

@endsection
