@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-yellow-50">

    {{-- HEADER FULL WIDTH --}}
    <div class="bg-white border-b border-yellow-100">
        <div class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">

            <div>
                <h2 class="font-extrabold text-2xl text-gray-900">
                    👤 Profile User
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Informasi akun kamu.
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
        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-white rounded-3xl border border-yellow-100 shadow-sm p-8">

                <div class="flex items-center gap-6">

                    {{-- Avatar Circle --}}
                    <div class="w-20 h-20 rounded-full bg-yellow-200 flex items-center justify-center text-3xl font-bold text-gray-800 shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    {{-- Info --}}
                    <div>
                        <div class="text-xl font-extrabold text-gray-800">
                            {{ auth()->user()->name }}
                        </div>
                        <div class="text-gray-500 text-sm">
                            {{ auth()->user()->email }}
                        </div>
                        <div class="mt-2">
                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-bold">
                                User Aktif
                            </span>
                        </div>
                    </div>

                </div>

                {{-- Divider --}}
                <div class="my-6 border-t border-yellow-100"></div>

                {{-- Detail Section --}}
                <div class="grid sm:grid-cols-2 gap-6 text-sm">

                    <div>
                        <div class="text-gray-500">Nama Lengkap</div>
                        <div class="font-semibold text-gray-800">
                            {{ auth()->user()->name }}
                        </div>
                    </div>

                    <div>
                        <div class="text-gray-500">Email</div>
                        <div class="font-semibold text-gray-800">
                            {{ auth()->user()->email }}
                        </div>
                    </div>

                    <div>
                        <div class="text-gray-500">Bergabung Sejak</div>
                        <div class="font-semibold text-gray-800">
                            {{ auth()->user()->created_at->format('d M Y') }}
                        </div>
                    </div>

                    <div>
                        <div class="text-gray-500">Status</div>
                        <div class="font-semibold text-green-600">
                            Aktif
                        </div>
                    </div>

                </div>

                {{-- Button Section --}}
                <div class="mt-8 flex gap-3">
                    <a href="#"
                       class="px-4 py-2 rounded-xl bg-yellow-300 hover:bg-yellow-400 font-bold shadow-sm transition">
                        ✏️ Edit Profile
                    </a>

                    <a href="#"
                       class="px-4 py-2 rounded-xl border border-gray-300 hover:bg-gray-100 font-bold transition">
                        🔐 Ubah Password
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection
