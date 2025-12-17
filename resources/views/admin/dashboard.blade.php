@extends('layouts.app')

@section('title', 'Admin Dashboard - Kelompok 2')

@push('styles')
<style>
    :root {
        --admin-bg: #f4f7fc;
        --admin-card-bg: #ffffff;
        --admin-text-primary: #344767;
        --admin-text-secondary: #6c757d;
        --admin-border-color: #e9ecef;
        --admin-primary: #4a69bb;
        --admin-success: #28a745;
        --admin-warning: #ffc107;
        --admin-danger: #dc3545;
        --admin-info: #17a2b8;
    }

    body.light-mode {
        --admin-bg: #f4f7fc;
        --admin-card-bg: #ffffff;
        --admin-text-primary: #344767;
        --admin-text-secondary: #6c757d;
        --admin-border-color: #e9ecef;
    }

    body.dark-mode {
        --admin-bg: #1a2035;
        --admin-card-bg: #202940;
        --admin-text-primary: #e9ecef;
        --admin-text-secondary: #a0aec0;
        --admin-border-color: #2d3748;
    }

    .admin-dashboard {
        background-color: var(--admin-bg);
        color: var(--admin-text-primary);
    }

    .stat-card {
        background-color: var(--admin-card-bg);
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .stat-card .card-body {
        padding: 1.5rem;
    }

    .stat-card-icon {
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        color: #fff;
    }

    .icon-users { background: linear-gradient(135deg, #5e72e4, #825ee4); }
    .icon-transactions { background: linear-gradient(135deg, #2dce89, #2dceb3); }
    .icon-revenue { background: linear-gradient(135deg, #fb6340, #fbb140); }
    .icon-games { background: linear-gradient(135deg, #11cdef, #1171ef); }

    .stat-card-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--admin-text-secondary);
        text-transform: uppercase;
    }

    .stat-card-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--admin-text-primary);
    }

    .main-card {
        background-color: var(--admin-card-bg);
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .main-card .card-header {
        background-color: transparent;
        border-bottom: 1px solid var(--admin-border-color);
        padding: 1.25rem 1.5rem;
    }

    .main-card .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--admin-text-primary);
    }

    .admin-table thead th {
        background-color: var(--admin-bg);
        border-bottom: 2px solid var(--admin-border-color);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        color: var(--admin-text-secondary);
    }

    .admin-table tbody tr:hover {
        background-color: var(--admin-bg);
    }

    .status-badge {
        padding: 0.35em 0.75em;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .status-completed { background-color: rgba(40, 167, 69, 0.1); color: #28a745; }
    .status-pending { background-color: rgba(255, 193, 7, 0.1); color: #ffc107; }
    .status-failed { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; }
</style>
@endpush

@section('content')
<div class="admin-dashboard p-4">
    <!-- Header -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h1 class="h3 mb-0 font-weight-bold">Dashboard</h1>
            <p class="text-muted mb-0">Selamat datang kembali, Admin!</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('admin.transactions') }}" class="btn btn-primary">
                <i class="fas fa-list me-1"></i> Lihat Semua Transaksi
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="stat-card-title mb-1">Total Pengguna</p>
                            <h3 class="stat-card-value mb-0">{{ $totalUsers }}</h3>
                        </div>
                        <div class="col-auto">
                            <div class="stat-card-icon icon-users">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="stat-card-title mb-1">Total Transaksi</p>
                            <h3 class="stat-card-value mb-0">{{ $totalTransactions }}</h3>
                        </div>
                        <div class="col-auto">
                            <div class="stat-card-icon icon-transactions">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="stat-card-title mb-1">Total Pendapatan</p>
                            <h3 class="stat-card-value mb-0">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                        </div>
                        <div class="col-auto">
                            <div class="stat-card-icon icon-revenue">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="stat-card-title mb-1">Total Game</p>
                            {{-- Pastikan variabel $totalGames tersedia dari controller --}}
                            <h3 class="stat-card-value mb-0">{{ $totalGames ?? 0 }}</h3>
                        </div>
                        <div class="col-auto">
                            <div class="stat-card-icon icon-games">
                                <i class="fas fa-gamepad"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Transaction Chart -->
        <div class="col-lg-7 mb-4 mb-lg-0">
            <div class="main-card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-chart-line me-2"></i>Gambaran Transaksi (7 Hari Terakhir)</h5>
                </div>
                <div class="card-body">
                    <canvas id="transactionChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Recent Activity -->
        <div class="col-lg-5">
            <div class="main-card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-concierge-bell me-2"></i>Ringkasan Status</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center p-3 mb-2 bg-light rounded">
                        <div>
                            <h6 class="mb-0">Transaksi Berhasil</h6>
                            <small class="text-muted">Total transaksi yang telah selesai</small>
                        </div>
                        <h4 class="mb-0 text-success font-weight-bold">{{ $completedTransactions }}</h4>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-3 mb-2 bg-light rounded">
                        <div>
                            <h6 class="mb-0">Transaksi Pending</h6>
                            <small class="text-muted">Menunggu konfirmasi pembayaran</small>
                        </div>
                        <h4 class="mb-0 text-warning font-weight-bold">{{ $pendingTransactions }}</h4>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                        <div>
                            <h6 class="mb-0">Transaksi Gagal</h6>
                            <small class="text-muted">Dibatalkan atau gagal bayar</small>
                        </div>
                        {{-- Pastikan variabel $failedTransactions tersedia dari controller --}}
                        <h4 class="mb-0 text-danger font-weight-bold">{{ $failedTransactions ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions Table -->
    <div class="row">
        <div class="col-12">
            <div class="main-card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-history me-2"></i>Transaksi Terbaru</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0 admin-table">
                        <thead>
                            <tr>
                                <th>Kode Transaksi</th>
                                <th>Pengguna</th>
                                <th>Game</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentTransactions as $transaction)
                                <tr>
                                    <td><code>{{ $transaction->transaction_code }}</code></td>
                                    <td>{{ $transaction->user->name ?? 'N/A' }}</td>
                                    <td>{{ $transaction->gamePackage->game_name ?? 'N/A' }}</td>
                                    <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $statusClass = 'status-pending';
                                            if ($transaction->status === 'completed') $statusClass = 'status-completed';
                                            if ($transaction->status === 'failed') $statusClass = 'status-failed';
                                        @endphp
                                        <span class="status-badge {{ $statusClass }}">{{ ucfirst($transaction->status) }}</span>
                                    </td>
                                    <td>{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                                    <td>
                                        <a href="{{ route('topup.receipt', $transaction->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada transaksi.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('transactionChart').getContext('2d');
        
        {{-- Pastikan variabel $transactionChartData tersedia dari controller --}}
        const transactionData = @json($transactionChartData ?? []);

        const labels = transactionData.map(d => d.date);
        const completedData = transactionData.map(d => d.completed);
        const pendingData = transactionData.map(d => d.pending);
        const failedData = transactionData.map(d => d.failed);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Berhasil',
                        data: completedData,
                        borderColor: 'rgba(40, 167, 69, 1)',
                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Pending',
                        data: pendingData,
                        borderColor: 'rgba(255, 193, 7, 1)',
                        backgroundColor: 'rgba(255, 193, 7, 0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Gagal',
                        data: failedData,
                        borderColor: 'rgba(220, 53, 69, 1)',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                }
            }
        });
    });
</script>
@endpush
