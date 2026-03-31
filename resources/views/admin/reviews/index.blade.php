@extends('admin.layout', ['title' => 'Data Ulasan'])

@section('content')
<div class="bg-white rounded-2xl border border-yellow-100 shadow-sm p-4">
    <h2 class="font-bold text-lg mb-3">Data Ulasan</h2>

    <div class="overflow-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="text-left">
                    <th class="p-2">User</th>
                    <th class="p-2">Buku</th>
                    <th class="p-2">Rating</th>
                    <th class="p-2">Komentar</th>
                    <th class="p-2">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reviews as $r)
                    <tr class="border-t align-top">
                        <td class="p-2 font-semibold">{{ $r->user->name ?? '-' }}</td>
                        <td class="p-2">{{ $r->book->title ?? '-' }}</td>
                        <td class="p-2">
                            <span class="px-2 py-1 rounded-full bg-yellow-200 font-semibold">
                                {{ $r->rating }}/5
                            </span>
                        </td>
                        <td class="p-2">{{ $r->comment ?? '-' }}</td>
                        <td class="p-2">{{ $r->created_at?->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr><td class="p-3" colspan="5">Belum ada ulasan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $reviews->links() }}</div>
</div>
@endsection
