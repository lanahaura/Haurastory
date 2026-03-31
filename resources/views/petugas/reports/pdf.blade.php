<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1 { font-size: 18px; margin: 0; }
        .meta { margin: 6px 0 12px; color: #333; }
        .box { border:1px solid #ddd; padding:10px; border-radius:8px; margin-bottom: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; vertical-align: top; }
        th { background: #f6f6f6; text-align: left; }
        .badge { display:inline-block; padding:2px 8px; border-radius:999px; font-weight:700; }
        .borrowed { background:#ffe08a; }
        .returned { background:#c9f7d4; }
        .small { font-size: 11px; color:#444; }
    </style>
</head>
<body>

    <h1>📊 Laporan Peminjaman</h1>

    <div class="meta">
        <div><b>Tanggal Cetak:</b> {{ now()->format('Y-m-d H:i:s') }}</div>
        <div>
            <b>Filter:</b>
            Dari: {{ $from ?? '-' }} | Sampai: {{ $to ?? '-' }}
        </div>
    </div>

    <div class="box">
        <div><b>Total Transaksi:</b> {{ $summary['total'] }}</div>
        <div><b>Masih Dipinjam:</b> {{ $summary['borrowed'] }}</div>
        <div><b>Sudah Dikembalikan:</b> {{ $summary['returned'] }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:18%;">User</th>
                <th style="width:25%;">Buku</th>
                <th style="width:14%;">Kategori</th>
                <th style="width:12%;">Dipinjam</th>
                <th style="width:12%;">Dikembalikan</th>
                <th style="width:10%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $r)
                <tr>
                    <td>{{ $r->user->name ?? '-' }}</td>
                    <td>
                        <b>{{ $r->book->title ?? '-' }}</b><br>
                        <span class="small">
                            Penulis: {{ $r->book->author ?? '-' }}<br>
                            Penerbit: {{ $r->book->publisher ?? '-' }}
                        </span>
                    </td>
                    <td>{{ $r->book->category->name ?? '-' }}</td>
                    <td>{{ $r->borrowed_at }}</td>
                    <td>{{ $r->returned_at ?? '-' }}</td>
                    <td>
                        @if($r->status === 'returned')
                            <span class="badge returned">returned</span>
                        @else
                            <span class="badge borrowed">borrowed</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Data kosong.</td></tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
