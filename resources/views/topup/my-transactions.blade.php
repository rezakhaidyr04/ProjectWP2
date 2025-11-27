@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="mb-5">
        <h1 class="display-4 mb-2" style="background: linear-gradient(135deg, #00f5ff, #39ff14); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
            Riwayat Transaksi
        </h1>
        <p class="lead" style="color: #a0a0c0;">Kelola semua transaksi top-up Anda</p>
    </div>

    @if($transactions->count() > 0)
        <!-- Tabel Transaksi -->
        <div class="card" style="
            background: rgba(30, 30, 30, 0.8);
            border: 2px solid rgba(0, 245, 255, 0.3);
            border-radius: 15px;
            backdrop-filter: blur(20px);
            overflow: hidden;
        ">
            <div class="table-responsive">
                <table style="width: 100%; color: #ffffff; margin: 0;">
                    <thead>
                        <tr style="background: rgba(0, 245, 255, 0.1); border-bottom: 2px solid rgba(0, 245, 255, 0.3);">
                            <th style="padding: 15px; text-align: left; color: #00f5ff; font-weight: 600;">No</th>
                            <th style="padding: 15px; text-align: left; color: #00f5ff; font-weight: 600;">Kode Transaksi</th>
                            <th style="padding: 15px; text-align: left; color: #00f5ff; font-weight: 600;">Game</th>
                            <th style="padding: 15px; text-align: left; color: #00f5ff; font-weight: 600;">Paket</th>
                            <th style="padding: 15px; text-align: left; color: #00f5ff; font-weight: 600;">Harga</th>
                            <th style="padding: 15px; text-align: left; color: #00f5ff; font-weight: 600;">Status</th>
                            <th style="padding: 15px; text-align: left; color: #00f5ff; font-weight: 600;">Tanggal</th>
                            <th style="padding: 15px; text-align: center; color: #00f5ff; font-weight: 600;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $index => $transaction)
                        <tr style="border-bottom: 1px solid rgba(0, 245, 255, 0.2); transition: all 0.3s;">
                            <td style="padding: 15px; color: #a0a0c0;">
                                {{ $transactions->firstItem() + $index }}
                            </td>
                            <td style="padding: 15px;">
                                <code style="background: rgba(0, 0, 0, 0.3); padding: 5px 10px; border-radius: 4px; color: #39ff14; font-size: 0.85rem;">
                                    {{ $transaction->transaction_code }}
                                </code>
                            </td>
                            <td style="padding: 15px;">
                                {{ $transaction->gamePackage->game_name }}
                            </td>
                            <td style="padding: 15px;">
                                {{ $transaction->gamePackage->package_name }}
                            </td>
                            <td style="padding: 15px; color: #39ff14; font-weight: 600;">
                                Rp{{ number_format($transaction->total_price, 0, ',', '.') }}
                            </td>
                            <td style="padding: 15px;">
                                @if($transaction->status === 'pending')
                                    <span style="background: rgba(255, 170, 0, 0.2); color: #ffaa00; padding: 6px 12px; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">
                                        <i class="fas fa-hourglass-half"></i> Menunggu
                                    </span>
                                @elseif($transaction->status === 'completed')
                                    <span style="background: rgba(0, 255, 136, 0.2); color: #00ff88; padding: 6px 12px; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">
                                        <i class="fas fa-check-circle"></i> Selesai
                                    </span>
                                @else
                                    <span style="background: rgba(255, 59, 48, 0.2); color: #ff3b30; padding: 6px 12px; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">
                                        <i class="fas fa-times-circle"></i> Dibatalkan
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 15px; color: #a0a0c0; font-size: 0.9rem;">
                                {{ $transaction->created_at->format('d M Y H:i') }}
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="{{ route('topup.receipt', $transaction->id) }}" class="btn btn-sm" style="
                                    background: rgba(0, 245, 255, 0.2);
                                    border: 1px solid #00f5ff;
                                    color: #00f5ff;
                                    text-decoration: none;
                                    padding: 6px 12px;
                                    border-radius: 6px;
                                    font-size: 0.85rem;
                                    transition: all 0.3s;
                                ">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div style="margin-top: 30px; display: flex; justify-content: center;">
            {{ $transactions->links() }}
        </div>
    @else
        <!-- Pesan Kosong -->
        <div class="alert" style="
            background: rgba(0, 245, 255, 0.1);
            border: 2px solid rgba(0, 245, 255, 0.3);
            color: #00f5ff;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
        ">
            <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 15px; display: block;"></i>
            <h5 style="color: #00f5ff; font-weight: 600; margin-bottom: 10px;">
                Belum Ada Transaksi
            </h5>
            <p style="color: #a0a0c0; margin: 0 0 20px 0;">
                Mulai berbelanja top-up game favorit Anda sekarang!
            </p>
            <a href="{{ route('topup.index') }}" class="btn" style="
                background: linear-gradient(135deg, #00f5ff, #39ff14);
                color: #000;
                font-weight: 600;
                border: none;
                border-radius: 8px;
                padding: 12px 24px;
                text-decoration: none;
                display: inline-block;
            ">
                <i class="fas fa-shopping-cart"></i> Mulai Belanja
            </a>
        </div>
    @endif
</div>

<style>
    tr:hover {
        background: rgba(0, 245, 255, 0.05);
    }

    .btn-sm:hover {
        background: rgba(0, 245, 255, 0.3) !important;
        transform: translateY(-2px);
    }

    /* Custom Pagination Styling */
    .pagination {
        justify-content: center;
    }

    .pagination .page-link {
        background: rgba(30, 30, 30, 0.8);
        border: 1px solid rgba(0, 245, 255, 0.3);
        color: #00f5ff;
        border-radius: 6px;
        margin: 0 5px;
    }

    .pagination .page-link:hover {
        background: rgba(0, 245, 255, 0.2);
        border-color: #00f5ff;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #00f5ff, #39ff14);
        color: #000;
        border-color: #00f5ff;
    }

    .pagination .page-item.disabled .page-link {
        color: #708fa0;
        background: rgba(30, 30, 30, 0.5);
    }
</style>
@endsection
