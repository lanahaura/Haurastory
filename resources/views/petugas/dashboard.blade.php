@extends('petugas.layout', ['title' => 'Admin Dashboard'])

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div>
        <h1 class="text-3xl font-extrabold text-gray-800">
            📊 Petugas Dashboard
        </h1>
        <p class="text-gray-500 mt-1">
            Ringkasan data sistem perpustakaan.
        </p>
    </div>

    {{-- STAT CARDS --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

        {{-- Buku --}}
        <div class="p-6 bg-white rounded-3xl border border-yellow-100 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Buku</p>
                    <h2 class="text-3xl font-extrabold text-gray-800 mt-1">
                        {{ $countBooks }}
                    </h2>
                </div>
                <div class="w-12 h-12 flex items-center justify-center rounded-2xl bg-yellow-200 text-xl">
                    📚
                </div>
            </div>
        </div>

        {{-- Kategori --}}
        <div class="p-6 bg-white rounded-3xl border border-yellow-100 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Kategori</p>
                    <h2 class="text-3xl font-extrabold text-gray-800 mt-1">
                        {{ $countCategories }}
                    </h2>
                </div>
                <div class="w-12 h-12 flex items-center justify-center rounded-2xl bg-blue-200 text-xl">
                    🏷️
                </div>
            </div>
        </div>

        {{-- Removed User and Petugas counts as Petugas shouldn't see these --}}

        {{-- Dipinjam --}}
        <div class="p-6 bg-white rounded-3xl border border-yellow-100 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Sedang Dipinjam</p>
                    <h2 class="text-3xl font-extrabold text-yellow-600 mt-1">
                        {{ $countBorrowed }}
                    </h2>
                </div>
                <div class="w-12 h-12 flex items-center justify-center rounded-2xl bg-yellow-300 text-xl">
                    📌
                </div>
            </div>
        </div>

        {{-- Dikembalikan --}}
        <div class="p-6 bg-white rounded-3xl border border-yellow-100 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Sudah Dikembalikan</p>
                    <h2 class="text-3xl font-extrabold text-green-600 mt-1">
                        {{ $countReturned }}
                    </h2>
                </div>
                <div class="w-12 h-12 flex items-center justify-center rounded-2xl bg-green-300 text-xl">
                    ✅
                </div>
            </div>
        </div>

        {{-- Ulasan --}}
        <div class="p-6 bg-white rounded-3xl border border-yellow-100 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Ulasan</p>
                    <h2 class="text-3xl font-extrabold text-pink-600 mt-1">
                        {{ $countReviews }}
                    </h2>
                </div>
                <div class="w-12 h-12 flex items-center justify-center rounded-2xl bg-pink-200 text-xl">
                    💬
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
