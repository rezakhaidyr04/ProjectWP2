@extends('layouts.app')

@section('title', 'Profil Saya - Kelompo 2')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Sidebar -->
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-user-circle" style="font-size: 4rem; color: var(--neon-cyan);"></i>
                    </div>
                    <h5>{{ Auth::user()->name }}</h5>
                    <p class="text-muted small mb-3">{{ Auth::user()->email }}</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit"></i> Edit Profil
                        </a>
                        <a href="{{ route('profile.edit-password') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-key"></i> Ubah Password
                        </a>
                        <a href="{{ route('profile.wallet') }}" class="btn btn-outline-info">
                            <i class="fas fa-wallet"></i> Riwayat Pembelian
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Statistik</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted">Total Transaksi</small>
                        <p class="h5 mb-0">{{ Auth::user()->transactions()->count() }}</p>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <small class="text-muted">Transaksi Berhasil</small>
                        <p class="h5 mb-0">{{ Auth::user()->transactions()->where('status', 'completed')->count() }}</p>
                    </div>
                    <hr>
                    <div>
                        <small class="text-muted">Total Pembelian</small>
                        <p class="h5 mb-0">Rp {{ number_format(Auth::user()->transactions()->where('status', 'completed')->sum('total_price'), 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Profile Info -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Profil</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Nama Lengkap</label>
                            <p>{{ Auth::user()->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Email</label>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Nomor Telepon</label>
                            <p>{{ Auth::user()->phone ?? 'Belum diisi' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Alamat</label>
                            <p>{{ Auth::user()->address ?? 'Belum diisi' }}</p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label text-muted">Tanggal Daftar</label>
                            <p>{{ Auth::user()->created_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-history"></i> Transaksi Terbaru
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Kode</th>
                                <th>Game</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td><code>{{ $transaction->transaction_code }}</code></td>
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
                                    <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('topup.receipt', $transaction->id) }}" class="btn btn-xs btn-outline-primary">
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
                <div class="card-footer">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
