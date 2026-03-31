@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-yellow-50">

    {{-- HEADER FULL WIDTH --}}
    <div class="bg-white border-b border-yellow-100">
        <div class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">

            <div>
                <h2 class="font-extrabold text-2xl text-gray-900">
                    ✅ Riwayat Pengembalian
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Daftar buku yang sudah kamu kembalikan.
                </p>
            </div>

            <a href="{{ route('dashboard') }}"
               class="px-4 py-2 rounded-xl bg-yellow-300 hover:bg-yellow-400 font-semibold shadow-sm transition">
                ← Kembali
            </a>

        </div>
    </div>

    {{-- CONTENT --}}
    <div class="py-10">
        <div class="max-w-5xl mx-auto px-6">

            {{-- ALERT --}}
            @if(session('success'))
                <div class="mb-5 p-4 rounded-2xl bg-green-100 text-green-800 font-semibold border border-green-200">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 p-4 rounded-2xl bg-red-100 text-red-800 font-semibold border border-red-200">
                    ❌ {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-3xl border border-yellow-100 shadow-sm p-6">

                <div class="space-y-4">

                    @forelse($loans as $loan)

                        <div class="p-5 rounded-3xl bg-yellow-50 border border-yellow-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                            {{-- INFO --}}
                            <div class="flex-1">
                                <div class="text-lg font-extrabold text-gray-900">
                                    {{ $loan->book->title }}
                                </div>

                                <div class="text-sm text-gray-700 mt-1 flex flex-wrap gap-x-3 gap-y-1">
                                    <span>
                                        <span class="font-semibold">Dipinjam:</span>
                                        {{ \Carbon\Carbon::parse($loan->borrowed_at)->format('d M Y') }}
                                    </span>

                                    <span>•</span>

                                    <span>
                                        <span class="font-semibold">Dikembalikan:</span>
                                        {{ \Carbon\Carbon::parse($loan->returned_at)->format('d M Y') }}
                                    </span>
                                </div>

                                {{-- BADGE --}}
                                <div class="mt-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-200 text-green-900 text-xs font-bold">
                                        ✔️ Selesai
                                    </span>
                                </div>
                            </div>

                        </div>

                    @empty

                        <div class="p-6 rounded-3xl bg-yellow-50 border border-yellow-100 text-gray-700 text-center">
                            <div class="font-extrabold text-lg">📭 Belum ada pengembalian</div>
                            <div class="text-sm mt-1">
                                Kalau kamu sudah mengembalikan buku, akan muncul di sini ya bestihhh ✨
                            </div>
                        </div>

                    @endforelse

                </div>

                {{-- PAGINATION --}}
                <div class="mt-8">
                    {{ $loans->links() }}
                </div>

            </div>

        </div>
    </div>

</div>

@endsection
