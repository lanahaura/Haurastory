@extends('petugas.layout', ['title' => 'Data Pengembalian'])

@section('content')
<div class="bg-white rounded-2xl border border-yellow-100 shadow-sm p-4">
    <h2 class="font-bold text-lg mb-3">Data Pengembalian</h2>

    <div class="overflow-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="text-left">
                    <th class="p-2">User</th>
                    <th class="p-2">Buku</th>
                    <th class="p-2">Kategori</th>
                    <th class="p-2">Dipinjam</th>
                    <th class="p-2">Jatuh Tempo</th>
                    <th class="p-2">Status / Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $l)
                    <tr class="border-t">
                        <td class="p-2 font-semibold">{{ $l->user->name ?? '-' }}</td>
                        <td class="p-2">{{ $l->book->title ?? '-' }}</td>
                        <td class="p-2">{{ $l->book->category->name ?? '-' }}</td>
                        <td class="p-2">{{ $l->borrowed_at }}</td>
                        <td class="p-2">{{ $l->due_at ?? '-' }}</td>
                        <td class="p-2">
                            @if($l->status === 'pending_return')
                                <div class="flex items-center gap-1">
                                    <form method="POST" action="{{ route('petugas.returns.approve-return', $l) }}">
                                        @csrf
                                        <button class="px-2 py-1 bg-green-500 hover:bg-green-600 text-white rounded text-xs font-bold">Setuju</button>
                                    </form>
                                    <form method="POST" action="{{ route('petugas.returns.reject-return', $l) }}">
                                        @csrf
                                        <button class="px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded text-xs font-bold">Tolak</button>
                                    </form>
                                </div>
                            @elseif($l->status === 'returned')
                                <span class="px-2 py-1 rounded-full bg-green-200 text-green-800 font-semibold text-xs">Selesai</span>
                            @else
                                <span class="px-2 py-1 rounded-full bg-gray-200 font-semibold text-xs">{{ $l->status }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td class="p-3" colspan="6">Belum ada pengembalian.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $loans->links() }}</div>
</div>
@endsection
