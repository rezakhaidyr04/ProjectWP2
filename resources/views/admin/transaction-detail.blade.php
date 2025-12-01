@extends('layouts.app')

@section('title', 'Detail Transaksi - Admin Kelompo 2')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('admin.transactions') }}" class="btn btn-outline-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h1 class="h3">
                <i class="fas fa-receipt"></i> Detail Transaksi
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Transaksi</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Kode Transaksi:</strong>
                            <p><code>{{ $transaction->transaction_code }}</code></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Status:</strong>
                            <p>
                                @if ($transaction->status === 'completed')
                                    <span class="badge badge-bg-completed">Berhasil</span>
                                @elseif ($transaction->status === 'pending')
                                    <span class="badge badge-bg-pending">Pending</span>
                                @else
                                    <span class="badge badge-bg-failed">Gagal</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Nama User:</strong>
                            <p>{{ $transaction->user->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Email User:</strong>
                            <p>{{ $transaction->user->email }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Game:</strong>
                            <p>{{ $transaction->gamePackage->game_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Paket:</strong>
                            <p>{{ $transaction->gamePackage->package_name }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>ID Game:</strong>
                            <p>{{ $transaction->game_account }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Metode Pembayaran:</strong>
                            <p>{{ ucfirst(str_replace('_', ' ', $transaction->payment_method)) }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Total Pembayaran:</strong>
                            <p class="h5">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Tanggal Transaksi:</strong>
                            <p>{{ $transaction->created_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <strong>Catatan:</strong>
                            <p>{{ $transaction->notes }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Ubah Status</h5>
                </div>
                <div class="card-body">
                    <form id="updateStatusForm">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Status Transaksi</label>
                            <select name="status" class="form-select" required>
                                <option value="pending" {{ $transaction->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $transaction->status === 'completed' ? 'selected' : '' }}>Berhasil</option>
                                <option value="failed" {{ $transaction->status === 'failed' ? 'selected' : '' }}>Gagal</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catatan</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Masukkan catatan...">{{ $transaction->notes }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Ringkasan</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted">Kode Transaksi</small>
                        <p class="mb-0"><code>{{ $transaction->transaction_code }}</code></p>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <small class="text-muted">Nama Penerima</small>
                        <p class="mb-0">{{ $transaction->user->name }}</p>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <small class="text-muted">Game & Paket</small>
                        <p class="mb-0">{{ $transaction->gamePackage->game_name }}<br>{{ $transaction->gamePackage->package_name }}</p>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <small class="text-muted">Total Bayar</small>
                        <p class="h5 mb-0">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('updateStatusForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch('{{ route("admin.update-transaction-status", $transaction->id) }}', {
        method: 'PUT',
        headers: {
            'X-CSRF-Token': document.querySelector('input[name="_token"]').value,
        },
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            alert('Status berhasil diperbarui');
            location.reload();
        }
    })
    .catch(err => alert('Error: ' + err));
});
</script>
@endsection
