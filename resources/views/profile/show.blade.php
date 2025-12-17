@extends('layouts.app')

@section('title', 'Pengaturan Profil - Kelompok 2')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="mb-4">
        <h1 class="display-6 mb-2 profile-gradient-title">
            <i class="fas fa-user-circle me-2"></i>Pengaturan Profil
        </h1>
        <p class="lead text-muted">Kelola informasi akun dan preferensi Anda</p>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show profile-alert" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 mb-4">
            <!-- Profile Card -->
            <div class="card mb-4 profile-card glass-card">
                <div class="profile-card-header">
                    <div class="mb-3">
                        <i class="fas fa-user-circle profile-avatar"></i>
                    </div>
                    <h4 class="profile-name">{{ Auth::user()->name }}</h4>
                    <p class="profile-email">{{ Auth::user()->email }}</p>
                    <div class="member-badge">
                        <small>Member sejak</small>
                        <p class="member-date">{{ Auth::user()->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('profile.edit') }}" class="btn btn-profile-primary">
                            <i class="fas fa-edit me-1"></i> Edit Profil
                        </a>
                        <a href="{{ route('profile.edit-password') }}" class="btn btn-profile-secondary">
                            <i class="fas fa-key me-1"></i> Ubah Password
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Card -->
            <div class="card profile-card glass-card">
                <div class="card-body">
                    <h6 class="card-title-highlight">
                        <i class="fas fa-chart-bar me-2"></i>Statistik
                    </h6>
                    
                    <div class="stat-item">
                        <small class="stat-label">Total Transaksi</small>
                        <h3 class="stat-value stat-cyan">{{ Auth::user()->transactions()->count() }}</h3>
                    </div>
                    
                    <div class="stat-item">
                        <small class="stat-label">Transaksi Berhasil</small>
                        <h3 class="stat-value stat-lime">{{ Auth::user()->transactions()->where('status', 'completed')->count() }}</h3>
                    </div>
                    
                    <div class="stat-item">
                        <small class="stat-label">Total Pembelian</small>
                        <h3 class="stat-value stat-pink">Rp {{ number_format(Auth::user()->transactions()->where('status', 'completed')->sum('total_price'), 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <!-- Profile Information -->
            <div class="card mb-4 glass-card">
                <div class="card-header-custom">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Akun
                    </h5>
                </div>
                <div class="card-body profile-info-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="info-label">Nama Lengkap</label>
                            <p class="info-value">{{ Auth::user()->name }}</p>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="info-label">Email</label>
                            <p class="info-value">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="info-label">Nomor Telepon</label>
                            <p class="info-value">{{ Auth::user()->phone ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="info-label">Role / Status</label>
                            <p class="info-value info-highlight">
                                <i class="fas fa-badge me-1"></i>{{ Auth::user()->role ?? 'Member' }}
                            </p>
                        </div>
                        <div class="col-md-12 mb-0">
                            <label class="info-label">Alamat</label>
                            <p class="info-value">{{ Auth::user()->address ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="card glass-card">
                <div class="card-header-custom">
                    <h5 class="mb-0">
                        <i class="fas fa-history me-2"></i>Transaksi Terbaru
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0 profile-table">
                        <thead>
                            <tr class="table-header-row">
                                <th>Kode Transaksi</th>
                                <th>Game</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr class="table-body-row">
                                    <td><code class="transaction-code">{{ $transaction->transaction_code }}</code></td>
                                    <td class="table-text-secondary">{{ $transaction->gamePackage->game_name }}</td>
                                    <td class="table-amount">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $statusConfig = [
                                                'completed' => ['icon' => 'fas fa-check-circle', 'label' => 'Berhasil', 'class' => 'status-success'],
                                                'pending' => ['icon' => 'fas fa-hourglass-half', 'label' => 'Pending', 'class' => 'status-warning'],
                                                'failed' => ['icon' => 'fas fa-times-circle', 'label' => 'Gagal', 'class' => 'status-danger'],
                                            ];
                                            $config = $statusConfig[$transaction->status] ?? $statusConfig['failed'];
                                        @endphp
                                        <span class="status-badge {{ $config['class'] }}">
                                            <i class="{{ $config['icon'] }} me-1"></i>{{ $config['label'] }}
                                        </span>
                                    </td>
                                    <td class="table-date">{{ $transaction->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('topup.receipt', $transaction->id) }}" class="btn btn-sm btn-view">
                                            <i class="fas fa-eye me-1"></i>Lihat
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <p>Belum ada transaksi</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pagination-wrapper">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* ===== UTILITY CLASSES ===== */
    .glass-card {
        background: rgba(26, 31, 46, 0.3);
        border: 2px solid rgba(0, 245, 255, 0.2);
        border-radius: 15px;
        overflow: hidden;
    }

    /* ===== HEADER ===== */
    .profile-gradient-title {
        background: linear-gradient(135deg, #00f5ff, #39ff14);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .profile-alert {
        border-left: 4px solid #10b981;
    }

    /* ===== PROFILE CARD ===== */
    .profile-card {
        overflow: hidden;
    }

    .profile-card-header {
        background: linear-gradient(135deg, rgba(0, 245, 255, 0.1), rgba(57, 255, 20, 0.1));
        padding: 30px;
        text-align: center;
    }

    .profile-avatar {
        font-size: 5rem;
        color: var(--neon-cyan);
    }

    .profile-name {
        color: var(--neon-cyan);
        font-weight: 700;
    }

    .profile-email {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .member-badge {
        background: rgba(0, 245, 255, 0.1);
        padding: 10px;
        border-radius: 8px;
        margin: 15px 0;
    }

    .member-date {
        color: var(--neon-cyan);
        font-weight: 600;
        margin: 0;
    }

    /* ===== BUTTONS ===== */
    .btn-profile-primary {
        background: rgba(0, 212, 255, 0.2);
        color: #00d4ff;
        border: 1px solid #00d4ff;
        font-weight: 600;
    }

    .btn-profile-primary:hover {
        background: rgba(0, 212, 255, 0.3);
    }

    .btn-profile-secondary {
        background: rgba(168, 85, 247, 0.2);
        color: #a855f7;
        border: 1px solid #a855f7;
        font-weight: 600;
    }

    .btn-profile-secondary:hover {
        background: rgba(168, 85, 247, 0.3);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0, 212, 255, 0.2);
    }

    .btn-view {
        background: rgba(0, 212, 255, 0.2);
        color: #00d4ff;
        border: 1px solid #00d4ff;
        font-weight: 600;
    }

    /* ===== STATS ===== */
    .card-title-highlight {
        color: var(--neon-cyan);
        font-weight: 700;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .stat-item {
        margin-bottom: 20px;
    }

    .stat-item:not(:last-child) {
        border-bottom: 1px solid rgba(0, 245, 255, 0.2);
        padding-bottom: 15px;
    }

    .stat-label {
        color: var(--text-muted);
    }

    .stat-value {
        font-weight: 700;
        margin: 5px 0;
    }

    .stat-cyan { color: var(--neon-cyan); }
    .stat-lime { color: var(--neon-lime); }
    .stat-pink { color: var(--neon-pink); }

    /* ===== CARD HEADER ===== */
    .card-header-custom {
        background: linear-gradient(135deg, rgba(0, 245, 255, 0.1), rgba(57, 255, 20, 0.1));
        padding: 20px;
        border-bottom: 2px solid rgba(0, 245, 255, 0.2);
    }

    .card-header-custom h5 {
        color: var(--neon-cyan);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* ===== PROFILE INFO ===== */
    .profile-info-body {
        padding: 30px;
    }

    .info-label {
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
    }

    .info-value {
        color: var(--text-secondary);
        font-size: 1.1rem;
        margin: 8px 0;
    }

    .info-highlight {
        color: var(--neon-cyan) !important;
        font-weight: 600;
    }

    /* ===== TABLE ===== */
    .profile-table {
        background: transparent;
    }

    .table-header-row {
        background: rgba(0, 245, 255, 0.1);
        border-bottom: 2px solid rgba(0, 245, 255, 0.2);
    }

    .table-header-row th {
        color: var(--neon-cyan);
        font-weight: 700;
    }

    .table-body-row {
        border-bottom: 1px solid rgba(0, 245, 255, 0.1);
    }

    .table-body-row:hover {
        background: rgba(0, 245, 255, 0.05) !important;
    }

    .transaction-code {
        background: rgba(0, 245, 255, 0.1);
        color: var(--neon-cyan);
        padding: 4px 8px;
        border-radius: 4px;
    }

    .table-text-secondary {
        color: var(--text-secondary);
    }

    .table-amount {
        color: var(--neon-pink);
        font-weight: 600;
    }

    .table-date {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    /* ===== STATUS BADGES ===== */
    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .status-success {
        background: rgba(16, 185, 129, 0.2);
        color: #10b981;
    }

    .status-warning {
        background: rgba(245, 158, 11, 0.2);
        color: #f59e0b;
    }

    .status-danger {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        padding: 40px !important;
        text-align: center;
        color: var(--text-muted);
    }

    .empty-state i {
        font-size: 2rem;
        margin-bottom: 10px;
        display: block;
        opacity: 0.5;
    }

    .empty-state p {
        margin: 0;
    }

    /* ===== PAGINATION ===== */
    .pagination-wrapper {
        padding: 20px;
        border-top: 1px solid rgba(0, 245, 255, 0.2);
    }
</style>
@endsection