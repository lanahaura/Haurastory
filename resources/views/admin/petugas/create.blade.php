@extends('admin.layout', ['title' => 'Tambah Petugas'])

@section('content')
<div class="bg-white rounded-2xl border border-yellow-100 shadow-sm p-4 max-w-xl">
    <h2 class="font-bold text-lg mb-3">Tambah Petugas</h2>

    <form method="POST" action="{{ route('admin.petugas.store') }}" class="grid gap-3">
        @csrf

        <div>
            <label class="font-semibold text-sm">Nama</label>
            <input name="name" value="{{ old('name') }}" class="mt-1 w-full rounded-xl border-gray-300" />
            @error('name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="font-semibold text-sm">Username</label>
            <input name="username" value="{{ old('username') }}" class="mt-1 w-full rounded-xl border-gray-300" />
            @error('username') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="font-semibold text-sm">Password</label>
            <input type="password" name="password" class="mt-1 w-full rounded-xl border-gray-300" />
            @error('password') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="flex gap-2">
            <button class="px-4 py-2 rounded-xl bg-yellow-300 hover:bg-yellow-400 font-bold">Simpan</button>
            <a href="{{ route('admin.petugas.index') }}" class="px-4 py-2 rounded-xl bg-yellow-200 hover:bg-yellow-300 font-bold">Batal</a>
        </div>
    </form>
</div>
@endsection
