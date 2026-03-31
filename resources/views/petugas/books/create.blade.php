@extends('petugas.layout', ['title' => 'Tambah Buku'])

@section('content')
<div class="bg-white rounded-2xl border border-yellow-100 shadow-sm p-4 max-w-2xl">
    <h2 class="font-bold text-lg mb-3">Tambah Buku</h2>

        <form method="POST" action="{{ route('petugas.books.store') }}" enctype="multipart/form-data" class="grid gap-3">
         @csrf

        <div>
            <label class="font-semibold text-sm">Kategori</label>
            <select name="category_id" class="mt-1 w-full rounded-xl border-gray-300">
                @foreach($categories as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
            @error('category_id') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="font-semibold text-sm">Judul</label>
            <input name="title" value="{{ old('title') }}" class="mt-1 w-full rounded-xl border-gray-300" />
            @error('title') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="font-semibold text-sm">Penulis</label>
                <input name="author" value="{{ old('author') }}" class="mt-1 w-full rounded-xl border-gray-300" />
                @error('author') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="font-semibold text-sm">Penerbit</label>
                <input name="publisher" value="{{ old('publisher') }}" class="mt-1 w-full rounded-xl border-gray-300" />
                @error('publisher') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="font-semibold text-sm">Tahun Terbit</label>
                <input type="number" name="published_year" value="{{ old('published_year', date('Y')) }}" class="mt-1 w-full rounded-xl border-gray-300" />
                @error('published_year') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="font-semibold text-sm">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', 1) }}" class="mt-1 w-full rounded-xl border-gray-300" />
                @error('stock') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
               <label class="font-semibold text-sm">Cover Buku (jpg/png/webp)</label>
               <input type="file" name="cover" accept="image/*" class="mt-1 w-full rounded-xl border-gray-300 bg-white p-2" />
               @error('cover') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
        </div>
        
        <div class="flex gap-2">
            <button class="px-4 py-2 rounded-xl bg-yellow-300 hover:bg-yellow-400 font-bold">Simpan</button>
            <a href="{{ route('petugas.books.index') }}" class="px-4 py-2 rounded-xl bg-yellow-200 hover:bg-yellow-300 font-bold">Batal</a>
        </div>
    </form>
</div>
@endsection
