@extends('admin.layout', ['title' => 'Edit Kategori'])

@section('content')

<div class="min-h-screen bg-yellow-50 py-10">
    <div class="max-w-3xl mx-auto px-6 space-y-6">

        {{-- HEADER --}}
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800">
                ✏️ Edit Kategori
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Ubah nama kategori sesuai kebutuhan.
            </p>
        </div>

        {{-- CARD --}}
        <div class="bg-white rounded-3xl border border-yellow-100 shadow-sm p-8">

            {{-- ERROR GLOBAL --}}
            @if ($errors->any())
                <div class="mb-5 p-4 rounded-2xl bg-red-100 text-red-800 border border-red-200 text-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                  action="{{ route('admin.categories.update', $category) }}"
                  class="space-y-6">
                @csrf
                @method('PUT')

                {{-- INPUT --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">
                        Nama Kategori
                    </label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $category->name) }}"
                        class="w-full rounded-2xl border-gray-200 focus:border-yellow-400 focus:ring-yellow-400 px-4 py-3 shadow-sm"
                    />
                </div>

                {{-- INFO KECIL --}}
                <div class="text-xs text-gray-500">
                    Dibuat pada: {{ $category->created_at?->format('d M Y H:i') }}
                </div>

                {{-- BUTTONS --}}
                <div class="flex items-center gap-3 pt-4">

                    <button
                        type="submit"
                        class="px-6 py-3 rounded-2xl bg-yellow-300 hover:bg-yellow-400 font-extrabold shadow-sm transition">
                        💾 Update
                    </button>

                    <a href="{{ route('admin.categories.index') }}"
                       class="px-6 py-3 rounded-2xl border border-gray-300 hover:bg-gray-100 font-bold transition">
                        ← Batal
                    </a>

                </div>

            </form>

        </div>

    </div>
</div>

@endsection
