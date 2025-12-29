@extends('layouts.app')

@section('title', 'Riwayat Pembelian - PayToWin')

@section('content')
<style>
    .header-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 40px 0;
        margin-bottom: 30px;
        border-radius: 0 0 20px 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .back-btn {
        background: rgba(255,255,255,0.2) !important;
        border: 2px solid white !important;
        color: white !important;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        background: white !important;
        color: #667eea !important;
    }

    .stat-card {
        background: white;
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }

    .stat-card .card-body {
        padding: 25px;
    }

    .stat-label {
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #9ca3af;
        margin-bottom: 10px;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .stat-icon {
        float: right;
        font-size: 32px;
        opacity: 0.2;
        color: #667eea;
    }

    .transaction-card {
        background: white;
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .transaction-card .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 20px;
    }

    .transaction-card .card-header h5 {
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .table-responsive {
        border-radius: 0 0 15px 15px;
    }

    .table thead th {
        background: #f3f4f6;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        border: none;
        color: #6b7280;
        padding: 18px;
    }

    .table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #e5e7eb;
    }

    .table tbody tr:hover {
        background-color: #f9fafb;
    }

    .table tbody td {
        padding: 18px;
        vertical-align: middle;
        color: #374151;
    }

    .transaction-code {
        background: #f3f4f6;
        padding: 8px 12px;
        border-radius: 8px;
        font-family: 'Courier New', monospace;
        font-weight: 600;
        color: #667eea;
        font-size: 13px;
    }

    .badge-bg-completed {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .badge-bg-pending {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .badge-bg-failed {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .btn-detail {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }

    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-state i {
        font-size: 48px;
        color: #d1d5db;
        margin-bottom: 20px;
    }

    .empty-state p {
        color: #9ca3af;
        font-size: 16px;
    }

    .card-footer {
        background: transparent;
        border-top: 1px solid #e5e7eb;
        padding: 20px;
    }

    .pagination {
        gap: 5px;
    }

    .page-link {
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        color: #667eea;
        margin: 0 2px;
        transition: all 0.3s ease;
    }

    .page-link:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: #667eea;
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: #667eea;
    }
</style>

<div class="header-section">
    <div class="container">
        <a href="{{ route('profile.show') }}" class="btn back-btn mb-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <h1 class="h2" style="margin-top: 15px; margin-bottom: 0; font-weight: 700;">
            <i class="fas fa-wallet"></i> Riwayat Pembelian
        </h1>
        <p style="margin-top: 8px; opacity: 0.9;">Kelola dan pantau semua transaksi Anda</p>
    </div>
</div>

<div class="container" style="margin-top: -20px; position: relative; z-index: 1;">

    <!-- Summary Stats -->
    <div class="row mb-5">
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-history"></i>
                </div>
                <div class="card-body">
                    <p class="stat-label">Total Transaksi</p>
                    <h3 class="stat-value">{{ Auth::user()->transactions()->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="card-body">
                    <p class="stat-label">Transaksi Berhasil</p>
                    <h3 class="stat-value">{{ Auth::user()->transactions()->where('status', 'completed')->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="card-body">
                    <p class="stat-label">Total Pengeluaran</p>
                    <h3 class="stat-value" style="color: #ef4444;">Rp {{ number_format($totalSpent, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction List -->
    <div class="transaction-card mb-5">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-list"></i> Riwayat Pembelian Detail</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Game</th>
                        <th>Paket</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Metode</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>
                                <span class="transaction-code">{{ $transaction->transaction_code }}</span>
                            </td>
                            <td>
                                <strong>{{ $transaction->gamePackage->game_name }}</strong>
                            </td>
                            <td>
                                <span style="color: #667eea;">{{ $transaction->gamePackage->package_name }}</span>
                            </td>
                            <td>
                                <strong style="color: #1f2937;">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</strong>
                            </td>
                            <td>
                                @if ($transaction->status === 'completed')
                                    <span class="badge-bg-completed">✓ Berhasil</span>
                                @elseif ($transaction->status === 'pending')
                                    <span class="badge-bg-pending">⏳ Pending</span>
                                @else
                                    <span class="badge-bg-failed">✗ Gagal</span>
                                @endif
                            </td>
                            <td>
                                <i class="fas fa-credit-card" style="color: #667eea;"></i> {{ ucfirst(str_replace('_', ' ', $transaction->payment_method)) }}
                            </td>
                            <td style="font-size: 14px;">
                                {{ $transaction->created_at->format('d/m/Y') }}<br>
                                <span style="color: #9ca3af;">{{ $transaction->created_at->format('H:i') }}</span>
                            </td>
                            <td>
                                <a href="{{ route('topup.receipt', $transaction->id) }}" class="btn-detail">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <p>Belum ada transaksi yang tercatat</p>
                                    <small style="color: #d1d5db;">Mulai berbelanja sekarang untuk melihat riwayat transaksi Anda</small>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-center">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
