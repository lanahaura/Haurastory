@extends('admin.layout', ['title' => 'Data Petugas'])

@section('content')
<div class="bg-white rounded-2xl border border-yellow-100 shadow-sm p-4">
    <div class="flex items-center justify-between mb-3">
        <h2 class="font-bold text-lg">Data Petugas</h2>
        <a href="{{ route('admin.petugas.create') }}" class="px-4 py-2 rounded-xl bg-yellow-300 hover:bg-yellow-400 font-bold">
            + Tambah Petugas
        </a>
    </div>

    <div class="overflow-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="text-left">
                    <th class="p-2">Nama</th>
                    <th class="p-2">Username</th>
                    <th class="p-2">Dibuat</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($petugas as $p)
                    <tr class="border-t">
                        <td class="p-2 font-semibold">{{ $p->name }}</td>
                        <td class="p-2">{{ $p->username }}</td>
                        <td class="p-2">{{ $p->created_at?->format('Y-m-d') }}</td>
                        <td class="p-2 flex gap-2">
                            <a class="px-3 py-1 rounded-lg bg-yellow-200 font-semibold" href="{{ route('admin.petugas.edit', $p) }}">Edit</a>

                            <form method="POST" action="{{ route('admin.petugas.destroy', $p) }}"
                                  onsubmit="return confirm('Hapus petugas ini?')">
                                @csrf @method('DELETE')
                                <button class="px-3 py-1 rounded-lg bg-red-100 text-red-700 font-semibold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="p-3" colspan="4">Belum ada petugas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $petugas->links() }}</div>
</div>
@endsection
