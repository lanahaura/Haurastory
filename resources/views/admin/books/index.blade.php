@extends('admin.layout', ['title' => 'Data Buku'])

@section('content')
<div class="bg-white rounded-2xl border border-yellow-100 shadow-sm p-5">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h2 class="font-extrabold text-xl">📚 Data Buku</h2>
            <p class="text-sm text-gray-600">Kelola buku yang tampil di dashboard user.</p>
        </div>

        <a href="{{ route('admin.books.create') }}"
           class="px-4 py-2 rounded-xl bg-yellow-300 hover:bg-yellow-400 font-bold shadow-sm">
            + Tambah Buku
        </a>
    </div>

    <div class="overflow-auto rounded-2xl border border-yellow-100">
        <table class="min-w-full text-sm bg-white">
            <thead class="bg-yellow-100">
                <tr class="text-left">
                    <th class="p-3 font-bold">Cover</th>
                    <th class="p-3 font-bold">Judul</th>
                    <th class="p-3 font-bold">Penulis</th>
                    <th class="p-3 font-bold">Penerbit</th>
                    <th class="p-3 font-bold">Kategori</th>
                    <th class="p-3 font-bold">Tahun</th>
                    <th class="p-3 font-bold text-center">Stok</th>
                    <th class="p-3 font-bold text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($books as $b)
                <tr class="border-t hover:bg-yellow-50">
                    <td class="p-3">
                        @if(!empty($b->cover))
                            <img src="{{ asset($b->cover) }}"
                                 class="w-12 h-16 object-cover rounded-xl border border-yellow-100 shadow-sm"
                                 alt="cover">
                        @else
                            <div class="w-12 h-16 rounded-xl border border-yellow-100 bg-yellow-50 flex items-center justify-center text-[10px] text-gray-500">
                                No Cover
                            </div>
                        @endif
                    </td>

                    <td class="p-3">
                        <div class="font-bold">{{ $b->title }}</div>
                    </td>

                    <td class="p-3">{{ $b->author }}</td>
                    <td class="p-3">{{ $b->publisher }}</td>

                    <td class="p-3">
                        <span class="px-2 py-1 rounded-full bg-yellow-200 font-semibold">
                            {{ $b->category->name ?? '-' }}
                        </span>
                    </td>

                    <td class="p-3">{{ $b->published_year }}</td>

                    <td class="p-3 text-center">
                        <span class="px-2 py-1 rounded-full bg-yellow-200 font-bold">
                            {{ $b->stock }}
                        </span>
                    </td>

                    <td class="p-3">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.books.edit', $b) }}"
                               class="px-3 py-2 rounded-xl bg-yellow-300 hover:bg-yellow-400 font-bold text-sm">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('admin.books.destroy', $b) }}"
                                  onsubmit="return confirm('Hapus buku ini?')">
                                @csrf @method('DELETE')
                                <button class="px-3 py-2 rounded-xl bg-red-100 hover:bg-red-200 text-red-700 font-bold text-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="p-4 text-gray-600" colspan="8">Belum ada buku.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $books->links() }}
    </div>
</div>
@endsection
