@extends('layouts.app')

@section('title', 'Riwayat Pembelian - Kelompok 2')

@section('content')
<style>
    .wallet-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 40px 0;
        margin-bottom: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
    }
    
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 20px;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 15px;
    }
    
    .stat-icon.icon-blue {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
    }
    
    .stat-icon.icon-green {
        background: rgba(34, 197, 94, 0.1);
        color: #22c55e;
    }
    
    .stat-icon.icon-orange {
        background: rgba(251, 146, 60, 0.1);
        color: #fb923c;
    }
    
    .stat-label {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 8px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }
    
    .transactions-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    
    .transactions-card .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 20px;
    }
    
    .transactions-card .card-header h5 {
        margin: 0;
        font-weight: 600;
        font-size: 18px;
    }
</style>

<div class="container py-5">
    <!-- Header Section -->
    <div class="wallet-header">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="h2 mb-2" style="margin: 0;">
                        <i class="fas fa-wallet"></i> Riwayat Pembelian
                    </h1>
                    <p class="mb-0" style="opacity: 0.9;">Kelola dan pantau semua transaksi Anda</p>
                </div>
                <a href="{{ route('profile.show') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon icon-blue">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <p class="stat-label">Total Transaksi</p>
                <h3 class="stat-value">{{ Auth::user()->transactions()->count() }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon icon-green">
                    <i class="fas fa-check-circle"></i>
                </div>
                <p class="stat-label">Transaksi Berhasil</p>
                <h3 class="stat-value">{{ Auth::user()->transactions()->where('status', 'completed')->count() }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon icon-orange">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <p class="stat-label">Total Pengeluaran</p>
                <h3 class="stat-value">Rp {{ number_format($totalSpent, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>


    <!-- Transaction List -->
    <div class="card transactions-card">
        <div class="card-header">
            <h5>Riwayat Pembelian Detail</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr style="background: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                        <th style="color: #6b7280; font-weight: 600; padding: 15px;">Kode Transaksi</th>
                        <th style="color: #6b7280; font-weight: 600; padding: 15px;">Game</th>
                        <th style="color: #6b7280; font-weight: 600; padding: 15px;">Paket</th>
                        <th style="color: #6b7280; font-weight: 600; padding: 15px;">Harga</th>
                        <th style="color: #6b7280; font-weight: 600; padding: 15px;">Status</th>
                        <th style="color: #6b7280; font-weight: 600; padding: 15px;">Metode</th>
                        <th style="color: #6b7280; font-weight: 600; padding: 15px;">Tanggal</th>
                        <th style="color: #6b7280; font-weight: 600; padding: 15px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr style="border-bottom: 1px solid #e5e7eb; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='white'">
                            <td style="padding: 15px; vertical-align: middle;">
                                <code style="background: #f3f4f6; padding: 5px 10px; border-radius: 6px; font-size: 12px; color: #667eea;">{{ $transaction->transaction_code }}</code>
                            </td>
                            <td style="padding: 15px; vertical-align: middle;">
                                <strong>{{ $transaction->gamePackage->game_name }}</strong>
                            </td>
                            <td style="padding: 15px; vertical-align: middle;">
                                {{ $transaction->gamePackage->package_name }}
                            </td>
                            <td style="padding: 15px; vertical-align: middle; font-weight: 600; color: #22c55e;">
                                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                            </td>
                            <td style="padding: 15px; vertical-align: middle;">
                                @if ($transaction->status === 'completed')
                                    <span class="badge" style="background: #d1fae5; color: #065f46; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 500;">
                                        <i class="fas fa-check-circle"></i> Berhasil
                                    </span>
                                @elseif ($transaction->status === 'pending')
                                    <span class="badge" style="background: #fef3c7; color: #92400e; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 500;">
                                        <i class="fas fa-clock"></i> Pending
                                    </span>
                                @else
                                    <span class="badge" style="background: #fee2e2; color: #991b1b; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 500;">
                                        <i class="fas fa-times-circle"></i> Gagal
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 15px; vertical-align: middle;">
                                <i class="fas fa-credit-card"></i> {{ ucfirst(str_replace('_', ' ', $transaction->payment_method)) }}
                            </td>
                            <td style="padding: 15px; vertical-align: middle; color: #6b7280;">
                                {{ $transaction->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td style="padding: 15px; vertical-align: middle; text-align: center;">
                                <a href="{{ route('topup.receipt', $transaction->id) }}" class="btn btn-sm" style="background: #dbeafe; color: #0c4a6e; border: none; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 500; transition: all 0.3s ease;" onmouseover="this.style.background='#bfdbfe'; this.style.color='#082f49'" onmouseout="this.style.background='#dbeafe'; this.style.color='#0c4a6e'">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center" style="padding: 40px 15px; color: #6b7280;">
                                <div style="font-size: 48px; margin-bottom: 15px; opacity: 0.5;">
                                    <i class="fas fa-inbox"></i>
                                </div>
                                <p style="font-size: 16px; margin: 0;">Belum ada transaksi yang berhasil</p>
                                <p style="font-size: 13px; color: #9ca3af; margin-top: 5px;">Mulai topup sekarang untuk melihat riwayat Anda</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer" style="background: white; border-top: 1px solid #e5e7eb; padding: 20px;">
            <div style="display: flex; justify-content: center;">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
