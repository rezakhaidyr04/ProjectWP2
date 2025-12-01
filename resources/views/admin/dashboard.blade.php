@extends('layouts.app')

@section('title', 'Admin Dashboard - GameCredit')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h3 mb-0">
                <i class="fas fa-tachometer-alt"></i> Admin Dashboard
            </h1>
            <p class="text-muted">Kelola platform GameCredit Anda</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Total Users</p>
                            <h3 class="mb-0">{{ $totalUsers }}</h3>
                        </div>
                        <i class="fas fa-users" style="font-size: 2rem; color: var(--neon-cyan); opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Total Transaksi</p>
                            <h3 class="mb-0">{{ $totalTransactions }}</h3>
                        </div>
                        <i class="fas fa-exchange-alt" style="font-size: 2rem; color: var(--neon-lime); opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Transaksi Berhasil</p>
                            <h3 class="mb-0">{{ $completedTransactions }}</h3>
                        </div>
                        <i class="fas fa-check-circle" style="font-size: 2rem; color: var(--accent-success); opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Total Revenue</p>
                            <h3 class="mb-0">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                        </div>
                        <i class="fas fa-money-bill-wave" style="font-size: 2rem; color: var(--neon-pink); opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <p class="text-muted mb-2">Transaksi Pending</p>
                    <h2 class="text-warning">{{ $pendingTransactions }}</h2>
                    <a href="{{ route('admin.transactions') }}" class="btn btn-sm btn-outline-primary mt-2">Lihat Semua</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-list"></i> Transaksi Terbaru
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Kode Transaksi</th>
                                <th>User</th>
                                <th>Game</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentTransactions as $transaction)
                                <tr>
                                    <td>
                                        <code>{{ $transaction->transaction_code }}</code>
                                    </td>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td>{{ $transaction->gamePackage->game_name }}</td>
                                    <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($transaction->status === 'completed')
                                            <span class="badge badge-bg-completed">Berhasil</span>
                                        @elseif ($transaction->status === 'pending')
                                            <span class="badge badge-bg-pending">Pending</span>
                                        @else
                                            <span class="badge badge-bg-failed">Gagal</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.transaction-detail', $transaction->id) }}" class="btn btn-xs btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        Belum ada transaksi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Top Games -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-star"></i> Game Paling Populer
                    </h5>
                </div>
                <div class="card-body">
                    @forelse ($topGames as $game)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span>{{ $game->game_name }}</span>
                                <span class="badge badge-primary">{{ $game->transactions_count }}</span>
                            </div>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" 
                                     style="width: {{ ($game->transactions_count / $topGames->first()->transactions_count) * 100 }}%">
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center">Belum ada data</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-link"></i> Quick Links
                    </h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.transactions') }}" class="btn btn-outline-primary me-2 mb-2">
                        <i class="fas fa-list"></i> Kelola Transaksi
                    </a>
                    <a href="{{ route('admin.users') }}" class="btn btn-outline-primary me-2 mb-2">
                        <i class="fas fa-users"></i> Kelola User
                    </a>
                    <a href="{{ route('admin.game-packages') }}" class="btn btn-outline-primary me-2 mb-2">
                        <i class="fas fa-gamepad"></i> Kelola Game Packages
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
