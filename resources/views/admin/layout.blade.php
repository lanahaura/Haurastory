<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin' }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen bg-yellow-50">
<div class="max-w-7xl mx-auto p-4 md:p-6">
    {{-- Header --}}
    <div class="bg-white border border-yellow-100 rounded-2xl px-5 py-4 shadow-sm flex items-center justify-between">
        <div class="font-extrabold text-lg">🧑‍💼 Admin Perpustakaan</div>
        <div class="text-sm text-gray-600">Akses: <span class="font-semibold">/admin</span></div>
    </div>

    {{-- Body --}}
    <div class="mt-4 grid grid-cols-1 md:grid-cols-12 gap-4">
        {{-- Sidebar --}}
        <aside class="md:col-span-3">
            <div class="bg-white border border-yellow-100 rounded-2xl p-3 shadow-sm">
                <div class="text-xs font-bold text-gray-500 px-2 mb-2">MENU</div>

                @php
                    $linkClass = fn($active) =>
                        'block px-4 py-3 rounded-xl font-semibold text-sm transition ' .
                        ($active
                            ? 'bg-yellow-300 text-gray-900 shadow-sm'
                            : 'bg-yellow-100 hover:bg-yellow-200 text-gray-800');
                @endphp

                <div class="space-y-2">
                    <a class="{{ $linkClass(request()->routeIs('admin.dashboard')) }}"
                       href="{{ route('admin.dashboard') }}">Dashboard</a>

                    <a class="{{ $linkClass(request()->routeIs('admin.books.*')) }}"
                       href="{{ route('admin.books.index') }}">Data Buku</a>

                    <a class="{{ $linkClass(request()->routeIs('admin.categories.*')) }}"
                       href="{{ route('admin.categories.index') }}">Data Kategori</a>

                    <a class="{{ $linkClass(request()->routeIs('admin.users.*')) }}"
                       href="{{ route('admin.users.index') }}">Data User</a>

                    <a class="{{ $linkClass(request()->routeIs('admin.petugas.*')) }}"
                       href="{{ route('admin.petugas.index') }}">Data Petugas</a>

                    <a class="{{ $linkClass(request()->routeIs('admin.loans.*')) }}"
                       href="{{ route('admin.loans.index') }}">Data Peminjaman</a>

                    <a class="{{ $linkClass(request()->routeIs('admin.returns.*')) }}"
                       href="{{ route('admin.returns.index') }}">Data Pengembalian</a>

                    <a class="{{ $linkClass(request()->routeIs('admin.reviews.*')) }}"
                       href="{{ route('admin.reviews.index') }}">Data Ulasan</a>

                    <a class="{{ $linkClass(request()->routeIs('admin.reports.*')) }}"
                       href="{{ route('admin.reports.index') }}">Laporan</a>
                </div>
            </div>
        </aside>

        {{-- Content --}}
        <main class="md:col-span-9">
            @if(session('success'))
                <div class="mb-4 p-3 rounded-xl bg-green-100 text-green-800 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
