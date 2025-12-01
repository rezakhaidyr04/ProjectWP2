@extends('layouts.app')

@section('title', 'Kelola Transaksi - Admin Kelompo 2')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h3 mb-0">
                <i class="fas fa-list"></i> Kelola Transaksi
            </h1>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Daftar Semua Transaksi</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>User</th>
                        <th>Game</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                        <th>Status</th>
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
                            <td>{{ $transaction->user->name }}</td>
                            <td>{{ $transaction->gamePackage->game_name }}</td>
                            <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $transaction->payment_method)) }}</span>
                            </td>
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
                                {{ $transaction->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td>
                                <a href="{{ route('admin.transaction-detail', $transaction->id) }}" class="btn btn-xs btn-outline-primary">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                Belum ada transaksi
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
