@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="mb-5" data-aos="fade-up">
        <span class="badge mb-3" style="background: var(--gradient-primary); padding: 0.5rem 1rem; border-radius: 50px;">
            <i class="fas fa-history me-1"></i>Riwayat
        </span>
        <h1 class="display-5 fw-bold text-gradient mb-3">Riwayat Transaksi</h1>
        <p class="lead text-muted">Kelola dan pantau semua transaksi top-up Anda</p>
    </div>

    @if($transactions->count() > 0)
        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 text-center" style="border-radius: 20px;">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mx-auto mb-3" style="
                            width: 56px;
                            height: 56px;
                            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(168, 85, 247, 0.2));
                            border-radius: 16px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        ">
                            <i class="fas fa-shopping-bag" style="color: var(--accent-primary); font-size: 1.5rem;"></i>
                        </div>
                        <h3 class="fw-bold mb-1">{{ $transactions->total() }}</h3>
                        <p class="text-muted small mb-0">Total Transaksi</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="150">
                <div class="card h-100 text-center" style="border-radius: 20px;">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mx-auto mb-3" style="
                            width: 56px;
                            height: 56px;
                            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(6, 182, 212, 0.2));
                            border-radius: 16px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        ">
                            <i class="fas fa-check-circle" style="color: var(--accent-emerald); font-size: 1.5rem;"></i>
                        </div>
                        <h3 class="fw-bold mb-1">{{ $transactions->where('status', 'completed')->count() }}</h3>
                        <p class="text-muted small mb-0">Selesai</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 text-center" style="border-radius: 20px;">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mx-auto mb-3" style="
                            width: 56px;
                            height: 56px;
                            background: linear-gradient(135deg, rgba(251, 191, 36, 0.2), rgba(245, 158, 11, 0.2));
                            border-radius: 16px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        ">
                            <i class="fas fa-hourglass-half" style="color: var(--accent-amber); font-size: 1.5rem;"></i>
                        </div>
                        <h3 class="fw-bold mb-1">{{ $transactions->where('status', 'pending')->count() }}</h3>
                        <p class="text-muted small mb-0">Menunggu</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="250">
                <div class="card h-100 text-center" style="border-radius: 20px;">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mx-auto mb-3" style="
                            width: 56px;
                            height: 56px;
                            background: linear-gradient(135deg, rgba(244, 63, 94, 0.2), rgba(239, 68, 68, 0.2));
                            border-radius: 16px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        ">
                            <i class="fas fa-times-circle" style="color: var(--accent-rose); font-size: 1.5rem;"></i>
                        </div>
                        <h3 class="fw-bold mb-1">{{ $transactions->where('status', 'cancelled')->count() }}</h3>
                        <p class="text-muted small mb-0">Dibatalkan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction Table -->
        <div class="card" data-aos="fade-up" data-aos-delay="300" style="border-radius: 24px; overflow: hidden;">
            <div class="card-header p-4" style="background: transparent; border-bottom: 1px solid var(--glass-border);">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-list me-2" style="color: var(--accent-primary);"></i>Daftar Transaksi
                    </h5>
                    <span class="badge" style="background: var(--glass-bg); border: 1px solid var(--glass-border); color: var(--text-secondary); padding: 0.5rem 1rem; border-radius: 50px;">
                        {{ $transactions->total() }} transaksi
                    </span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr style="border-bottom: 1px solid var(--glass-border);">
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Kode Transaksi</th>
                            <th class="px-4 py-3">Game</th>
                            <th class="px-4 py-3">Paket</th>
                            <th class="px-4 py-3">Harga</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $index => $transaction)
                        <tr class="transaction-row" style="border-bottom: 1px solid var(--glass-border);">
                            <td class="px-4 py-3 text-muted">
                                {{ $transactions->firstItem() + $index }}
                            </td>
                            <td class="px-4 py-3">
                                <code class="transaction-code">
                                    {{ $transaction->transaction_code }}
                                </code>
                            </td>
                            <td class="px-4 py-3 fw-medium">
                                {{ $transaction->gamePackage->game_name }}
                            </td>
                            <td class="px-4 py-3">
                                <span style="color: var(--accent-emerald);">{{ $transaction->gamePackage->package_name }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="fw-bold text-gradient">
                                    Rp{{ number_format($transaction->total_price, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                @if($transaction->status === 'pending')
                                    <span class="status-badge status-pending">
                                        <i class="fas fa-hourglass-half me-1"></i>Menunggu
                                    </span>
                                @elseif($transaction->status === 'completed')
                                    <span class="status-badge status-completed">
                                        <i class="fas fa-check-circle me-1"></i>Selesai
                                    </span>
                                @else
                                    <span class="status-badge status-cancelled">
                                        <i class="fas fa-times-circle me-1"></i>Dibatalkan
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-muted" style="font-size: 0.9rem;">
                                {{ $transaction->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('topup.receipt', $transaction->id) }}" class="btn btn-action">
                                    <i class="fas fa-eye me-1"></i>Lihat
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4" data-aos="fade-up">
            {{ $transactions->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="card text-center" data-aos="fade-up" style="border-radius: 24px; padding: 4rem 2rem;">
            <div class="mb-4">
                <div class="icon-wrapper mx-auto" style="
                    width: 100px;
                    height: 100px;
                    background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(168, 85, 247, 0.2));
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                ">
                    <i class="fas fa-inbox fa-3x" style="color: var(--accent-primary); opacity: 0.7;"></i>
                </div>
            </div>
            <h4 class="fw-bold mb-2">Belum Ada Transaksi</h4>
            <p class="text-muted mb-4" style="max-width: 400px; margin: 0 auto;">
                Mulai berbelanja top-up game favorit Anda sekarang dan nikmati proses yang cepat!
            </p>
            <div>
                <a href="{{ route('topup.index') }}" class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-shopping-cart me-2"></i>Mulai Belanja
                </a>
            </div>
        </div>
    @endif
</div>

@section('styles')
<style>
    .text-gradient {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .table {
        color: var(--text-primary);
    }
    
    .table thead th {
        font-weight: 600;
        color: var(--text-muted);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: transparent;
    }
    
    .transaction-row {
        transition: var(--transition-normal);
    }
    
    .transaction-row:hover {
        background: var(--glass-bg);
    }
    
    .transaction-code {
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        padding: 0.35rem 0.75rem;
        border-radius: 8px;
        color: var(--accent-emerald);
        font-size: 0.85rem;
        font-family: 'JetBrains Mono', monospace;
    }
    
    .status-badge {
        padding: 0.4rem 0.85rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }
    
    .status-pending {
        background: rgba(251, 191, 36, 0.15);
        color: var(--accent-amber);
        border: 1px solid rgba(251, 191, 36, 0.3);
    }
    
    .status-completed {
        background: rgba(16, 185, 129, 0.15);
        color: var(--accent-emerald);
        border: 1px solid rgba(16, 185, 129, 0.3);
    }
    
    .status-cancelled {
        background: rgba(244, 63, 94, 0.15);
        color: var(--accent-rose);
        border: 1px solid rgba(244, 63, 94, 0.3);
    }
    
    .btn-action {
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        color: var(--accent-primary);
        padding: 0.4rem 1rem;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 500;
        transition: var(--transition-normal);
    }
    
    .btn-action:hover {
        background: var(--accent-primary);
        color: white;
        transform: translateY(-2px);
    }
    
    /* Pagination Styling */
    .pagination {
        gap: 0.5rem;
    }
    
    .pagination .page-link {
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        color: var(--text-secondary);
        border-radius: 10px;
        padding: 0.5rem 1rem;
        transition: var(--transition-normal);
    }
    
    .pagination .page-link:hover {
        background: var(--accent-primary);
        border-color: var(--accent-primary);
        color: white;
    }
    
    .pagination .page-item.active .page-link {
        background: var(--gradient-primary);
        border-color: transparent;
        color: white;
    }
    
    .pagination .page-item.disabled .page-link {
        color: var(--text-muted);
        opacity: 0.5;
    }
</style>
@endsection
@endsection
