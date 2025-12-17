<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background: #f5f5f5;
        }
        .header {
            background: linear-gradient(135deg, #0f1419 0%, #242d3d 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #00d4ff;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 12px;
            opacity: 0.8;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-bottom: 20px;
        }
        th {
            background: #a855f7;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        tr:hover {
            background: #f0f0f0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #666;
        }
        .empty {
            text-align: center;
            padding: 40px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1><i>❤️</i> Laporan Wishlist</h1>
        <p>Total Game: {{ $wishlists->count() }} | Dicetak pada: {{ now()->format('d M Y H:i:s') }}</p>
    </div>

    @if($wishlists->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No.</th>
                    <th style="width: 30%;">Game</th>
                    <th style="width: 20%;">Kategori</th>
                    <th style="width: 20%;">Developer</th>
                    <th style="width: 15%;">Harga</th>
                    <th style="width: 10%;">Ditambahkan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wishlists as $key => $wishlist)
                    @php $game = $wishlist->gamePackage; @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $game->name ?? 'N/A' }}</td>
                        <td>{{ $game->category ?? '-' }}</td>
                        <td>{{ $game->developer ?? '-' }}</td>
                        <td>Rp {{ number_format($game->base_price ?? 0, 0, ',', '.') }}</td>
                        <td>{{ $wishlist->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty">
            <p>Wishlist Anda masih kosong</p>
        </div>
    @endif

    <div class="footer">
        <p>Laporan ini dibuat dari platform Kelompok 2 Gaming Top-Up</p>
        <p>© {{ now()->year }} - Semua hak dilindungi</p>
    </div>
</body>
</html>
