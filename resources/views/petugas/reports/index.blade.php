@extends('petugas.layout', ['title' => 'Laporan'])

@section('content')
<div class="bg-white rounded-2xl border border-yellow-100 shadow-sm p-4">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <h2 class="font-bold text-lg">📊 Laporan Peminjaman</h2>

        <form method="GET" action="{{ route('petugas.reports.index') }}" class="flex flex-col md:flex-row gap-2">
            <div>
                <label class="text-xs font-semibold">Dari</label>
                <input type="date" name="from" value="{{ $from }}"
                       class="block rounded-xl border-gray-300 text-sm" />
            </div>

            <div>
                <label class="text-xs font-semibold">Sampai</label>
                <input type="date" name="to" value="{{ $to }}"
                       class="block rounded-xl border-gray-300 text-sm" />
            </div>

            <div class="flex items-end gap-2">
                <button class="px-4 py-2 rounded-xl bg-yellow-300 hover:bg-yellow-400 font-bold text-sm">
                    Filter
                </button>
                <a href="{{ route('petugas.reports.index') }}"
                   class="px-4 py-2 rounded-xl bg-yellow-200 hover:bg-yellow-300 font-bold text-sm">
                    Reset
                </a>
                <a href="{{ route('petugas.reports.pdf', ['from' => $from, 'to' => $to]) }}"
                   class="px-4 py-2 rounded-xl bg-yellow-200 hover:bg-yellow-300 font-bold text-sm">
                   Export PDF
                </a>

            </div>
        </form>
    </div>

    <div class="grid md:grid-cols-3 gap-3 mt-4">
        <div class="p-4 rounded-2xl bg-yellow-50 border border-yellow-100">
            <div class="text-sm text-gray-600">Total Transaksi</div>
            <div class="text-2xl font-extrabold">{{ $summary['total'] }}</div>
        </div>
        <div class="p-4 rounded-2xl bg-yellow-50 border border-yellow-100">
            <div class="text-sm text-gray-600">Masih Dipinjam</div>
            <div class="text-2xl font-extrabold">{{ $summary['borrowed'] }}</div>
        </div>
        <div class="p-4 rounded-2xl bg-yellow-50 border border-yellow-100">
            <div class="text-sm text-gray-600">Sudah Dikembalikan</div>
            <div class="text-2xl font-extrabold">{{ $summary['returned'] }}</div>
        </div>
    </div>

    <div class="mt-5 overflow-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="text-left">
                    <th class="p-2">User</th>
                    <th class="p-2">Buku</th>
                    <th class="p-2">Kategori</th>
                    <th class="p-2">Dipinjam</th>
                    <th class="p-2">Dikembalikan</th>
                    <th class="p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rows as $r)
                    <tr class="border-t align-top">
                        <td class="p-2 font-semibold">{{ $r->user->name ?? '-' }}</td>
                        <td class="p-2">{{ $r->book->title ?? '-' }}</td>
                        <td class="p-2">{{ $r->book->category->name ?? '-' }}</td>
                        <td class="p-2">{{ $r->borrowed_at }}</td>
                        <td class="p-2">{{ $r->returned_at ?? '-' }}</td>
                        <td class="p-2">
                            @if($r->status === 'returned')
                                <span class="px-2 py-1 rounded-full bg-green-100 text-green-800 font-semibold">returned</span>
                            @else
                                <span class="px-2 py-1 rounded-full bg-yellow-200 font-semibold">borrowed</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td class="p-3" colspan="6">Data laporan kosong.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $rows->withQueryString()->links() }}</div>
</div>
@endsection
