@extends('layouts.app')

@section('title', 'Kelola Game Packages - Admin PayToWin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="fas fa-gamepad"></i> Kelola Game Packages
                </h1>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPackageModal">
                    <i class="fas fa-plus"></i> Tambah Paket
                </button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Daftar Game Packages</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Game</th>
                        <th>Paket</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Transaksi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($packages as $package)
                        <tr>
                            <td>{{ $package->game_name }}</td>
                            <td>{{ $package->package_name }}</td>
                            <td>Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                            <td>{{ $package->amount }}</td>
                            <td><span class="badge bg-secondary">{{ $package->transactions_count }}</span></td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" 
                                           {{ $package->is_active ? 'checked' : '' }}
                                           onchange="updatePackageStatus({{ $package->id }}, this.checked)">
                                </div>
                            </td>
                            <td>
                                <button class="btn btn-xs btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editPackageModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-xs btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Belum ada package
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $packages->links() }}
        </div>
    </div>
</div>

<!-- Add Package Modal -->
<div class="modal fade" id="addPackageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Game Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nama Game</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Paket</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
function updatePackageStatus(packageId, isActive) {
    fetch(`/admin/game-packages/${packageId}/status`, {
        method: 'PUT',
        headers: {
            'X-CSRF-Token': document.querySelector('input[name="_token"]').value,
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            is_active: isActive ? 1 : 0
        })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            console.log('Status updated');
        }
    })
    .catch(err => alert('Error: ' + err));
}
</script>
@endsection
