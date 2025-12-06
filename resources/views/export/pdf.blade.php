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
            margin-bottom: 20px;
            background: white;
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
        .total-row {
            background: #e9d5ff;
            font-weight: bold;
            color: #a855f7;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #666;
        }
        .status-completed {
            background: #d1fae5;
            color: #065f46;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }
        .status-pending {
            background: #fef3c7;
            color: #92400e;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }
        .status-failed {
            background: #fee2e2;
            color: #991b1b;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1><i>📊</i> Laporan Transaksi</h1>
        <p>Total: {{ $count }} transaksi | Jumlah: Rp {{ number_format($total, 0, ',', '.') }}</p>
        <p>Dicetak pada: {{ now()->format('d M Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No.</th>
                <th style="width: 40%;">Game</th>
                <th style="width: 20%;">Jumlah</th>
                <th style="width: 15%;">Status</th>
                <th style="width: 20%;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $key => $trans)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $trans->gamePackage->name ?? 'N/A' }}</td>
                    <td>Rp {{ number_format($trans->amount, 0, ',', '.') }}</td>
                    <td>
                        @if($trans->status === 'completed')
                            <span class="status-completed">✓ Berhasil</span>
                        @elseif($trans->status === 'pending')
                            <span class="status-pending">⏳ Menunggu</span>
                        @else
                            <span class="status-failed">✗ Gagal</span>
                        @endif
                    </td>
                    <td>{{ $trans->created_at->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #999;">Tidak ada data transaksi</td>
                </tr>
            @endforelse
            @if($transactions->count() > 0)
                <tr class="total-row">
                    <td colspan="2" style="text-align: right;">TOTAL</td>
                    <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                    <td colspan="2"></td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan ini dibuat dari platform Kelompok 2 Gaming Top-Up</p>
        <p>© {{ now()->year }} - Semua hak dilindungi</p>
    </div>
</body>
</html>
