@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-yellow-50">

    {{-- HEADER FULL WIDTH --}}
    <div class="bg-white border-b border-yellow-100">
        <div class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">

            <div>
                <h2 class="font-extrabold text-2xl text-gray-900">
                    🗓️ Riwayat Peminjaman
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Daftar buku yang pernah kamu pinjam.
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
                                        <span class="font-semibold">Kategori:</span>
                                        {{ $loan->book->category->name ?? '-' }}
                                    </span>

                                    <span>•</span>

                                    <span>
                                        <span class="font-semibold">Dipinjam:</span>
                                        {{ $loan->borrowed_at }}
                                    </span>

                                    <span>•</span>

                                    <span>
                                        <span class="font-semibold">Jatuh Tempo:</span>
                                        {{ $loan->due_at ?? '-' }}
                                    </span>
                                </div>

                                {{-- BADGE STATUS --}}
                                <div class="mt-3">
                                    @if($loan->status === 'pending_borrow')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-200 text-blue-900 text-xs font-bold">
                                            ⏳ Menunggu Persetujuan
                                        </span>
                                    @elseif($loan->status === 'borrowed')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-200 text-yellow-900 text-xs font-bold">
                                            📌 Dipinjam
                                        </span>
                                    @elseif($loan->status === 'rejected_borrow')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-200 text-red-900 text-xs font-bold">
                                            ❌ Ditolak
                                        </span>
                                    @elseif($loan->status === 'returned')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-200 text-green-900 text-xs font-bold">
                                            ✅ Dikembalikan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-200 text-gray-900 text-xs font-bold">
                                            {{ $loan->status }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- ACTION --}}
                            <div class="flex flex-col gap-2">
                                @if(in_array($loan->status, ['pending_borrow', 'borrowed']))
                                    <div class="mt-1 flex flex-wrap gap-2">
                                        {{-- CETAK BUKTI --}}
                                        <a href="{{ route('loans.receipt', $loan) }}" target="_blank"
                                           class="px-4 py-2 rounded-xl bg-white hover:bg-yellow-100 font-bold border border-yellow-200 shadow-sm text-center">
                                            🧾 Cetak Bukti
                                        </a>

                                        @if($loan->status === 'borrowed')
                                            <div x-data="{ showModal: false }" class="w-full">
                                                <button type="button" @click="showModal = true"
                                                        class="px-4 py-2 rounded-xl bg-yellow-300 hover:bg-yellow-400 font-bold shadow-sm w-full block text-center">
                                                    ✅ Dikembalikan
                                                </button>

                                                {{-- Modal Pengembalian --}}
                                                <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                                    <div @click.away="showModal = false" class="bg-white rounded-2xl w-full max-w-sm p-6 shadow-xl border border-yellow-200">
                                                        <h3 class="text-lg font-bold text-gray-900 mb-2">Konfirmasi Pengembalian</h3>
                                                        <p class="text-sm text-gray-600 mb-6">
                                                            Apakah kamu yakin ingin mengembalikan buku <strong>{{ $loan->book->title }}</strong> sekarang?
                                                        </p>
                                                        <div class="flex flex-col gap-3">
                                                            <form method="POST" action="{{ route('loans.return', $loan) }}">
                                                                @csrf
                                                                <button class="w-full px-4 py-2 rounded-xl bg-yellow-400 hover:bg-yellow-500 font-bold text-yellow-900 shadow-sm transition">
                                                                    Ya, Kembalikan
                                                                </button>
                                                            </form>
                                                            <button type="button" @click="showModal = false"
                                                                    class="w-full px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 font-semibold text-gray-700 transition">
                                                                Batal
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @elseif($loan->status === 'rejected_borrow')
                                    <span class="px-4 py-2 rounded-2xl bg-white border border-red-100 text-red-500 font-semibold">
                                        Pengajuan peminjaman ditolak
                                    </span>
                                @else
                                    <span class="px-4 py-2 rounded-2xl bg-white border border-yellow-100 text-gray-500 font-semibold">
                                        Sudah selesai
                                    </span>
                                @endif
                            </div>

                        </div>

                    @empty
                        <div class="p-6 rounded-3xl bg-yellow-50 border border-yellow-100 text-gray-700">
                            <div class="font-extrabold text-lg">📭 Belum ada peminjaman</div>
                            <div class="text-sm mt-1">Kalau kamu pinjam buku nanti muncul di sini ya bestihhh 😭✨</div>
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
