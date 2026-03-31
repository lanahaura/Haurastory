<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bukti Peminjaman</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-yellow-50">
    <div class="max-w-2xl mx-auto p-6">
        <div class="bg-white border border-yellow-100 rounded-3xl shadow-sm p-6">

            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-extrabold text-gray-800">🧾 Bukti Peminjaman</h1>
                    <p class="text-sm text-gray-500 mt-1">Simpan/print sebagai bukti peminjaman.</p>
                </div>

                <button onclick="window.print()"
                        class="px-4 py-2 rounded-xl bg-yellow-300 hover:bg-yellow-400 font-extrabold shadow-sm print:hidden">
                    🖨️ Print
                </button>
            </div>

            <hr class="my-5 border-yellow-100">

            <div class="space-y-3 text-sm text-gray-700">
                <div class="flex justify-between">
                    <span class="font-semibold">Nama Peminjam</span>
                    <span>{{ $loan->borrower_name ?? ($loan->user->name ?? '-') }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="font-semibold">No. Telepon</span>
                    <span>{{ $loan->borrower_phone ?? '-' }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="font-semibold">Judul Buku</span>
                    <span class="font-bold">{{ $loan->book->title }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="font-semibold">Kategori</span>
                    <span>{{ $loan->book->category->name ?? '-' }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="font-semibold">Tanggal Pinjam</span>
                    <span>{{ $loan->borrowed_at }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="font-semibold">Jatuh Tempo</span>
                    <span>{{ $loan->due_at ?? '-' }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="font-semibold">Status</span>
                    <span class="font-bold">{{ $loan->status }}</span>
                </div>
            </div>

            <div class="mt-6 p-4 rounded-2xl bg-yellow-50 border border-yellow-100 text-xs text-gray-600">
                * Bukti ini dibuat otomatis oleh sistem.
            </div>
        </div>
    </div>
</body>
</html>
