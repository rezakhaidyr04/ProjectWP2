@extends('layouts.app')

@section('title', 'Riwayat Pembelian - Kelompok 2')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h1 class="h3">
                <i class="fas fa-wallet"></i> Riwayat Pembelian
            </h1>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted mb-1">Total Transaksi</p>
                    <h3 class="mb-0">{{ Auth::user()->transactions()->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted mb-1">Transaksi Berhasil</p>
                    <h3 class="mb-0">{{ Auth::user()->transactions()->where('status', 'completed')->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted mb-1">Total Pengeluaran</p>
                    <h3 class="mb-0">Rp {{ number_format($totalSpent, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction List -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Riwayat Pembelian Detail</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
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
                                <code>{{ $transaction->transaction_code }}</code>
                            </td>
                            <td>{{ $transaction->gamePackage->game_name }}</td>
                            <td>{{ $transaction->gamePackage->package_name }}</td>
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
                            <td>{{ ucfirst(str_replace('_', ' ', $transaction->payment_method)) }}</td>
                            <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('topup.receipt', $transaction->id) }}" class="btn btn-xs btn-outline-primary">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                Belum ada transaksi yang berhasil
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection
