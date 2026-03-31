@extends('admin.layout', ['title' => 'Data User'])

@section('content')

<div class="min-h-screen bg-yellow-50 py-10">
    <div class="max-w-6xl mx-auto px-6 space-y-6">

        {{-- HEADER --}}
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800">
                👤 Data User
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Kelola akun pengguna sistem.
            </p>
        </div>

        {{-- FLASH MESSAGE --}}
        @if(session('success'))
            <div class="p-4 rounded-2xl bg-green-100 text-green-800 border border-green-200 font-semibold">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-2xl bg-red-100 text-red-800 border border-red-200 font-semibold">
                ❌ {{ session('error') }}
            </div>
        @endif

        {{-- TABLE CARD --}}
        <div class="bg-white rounded-3xl border border-yellow-100 shadow-sm p-6">

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-600 border-b border-yellow-100">
                            <th class="py-3 px-3 font-extrabold">Nama</th>
                            <th class="py-3 px-3 font-extrabold">Email</th>
                            <th class="py-3 px-3 font-extrabold">Dibuat</th>
                            <th class="py-3 px-3 font-extrabold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $u)
                            <tr class="border-b border-yellow-50 hover:bg-yellow-50/60 transition">

                                <td class="py-4 px-3 font-extrabold text-gray-800">
                                    {{ $u->name }}
                                </td>

                                <td class="py-4 px-3 text-gray-700">
                                    {{ $u->email }}
                                </td>

                                <td class="py-4 px-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-gray-700 font-bold text-xs">
                                        📅 {{ $u->created_at?->format('d M Y') }}
                                    </span>
                                </td>

                                <td class="py-4 px-3">
                                    <form method="POST" action="{{ route('admin.users.destroy', $u) }}"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini? Peminjaman dan pengembalian yang terkait juga mungkin akan terhapus.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-4 py-2 bg-red-100 hover:bg-red-200 text-red-700 font-bold rounded-xl text-xs shadow-sm transition">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td class="py-8 px-3 text-center text-gray-600" colspan="4">
                                    📭 Belum ada user.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="mt-6">
                {{ $users->links() }}
            </div>

        </div>

    </div>
</div>

@endsection
