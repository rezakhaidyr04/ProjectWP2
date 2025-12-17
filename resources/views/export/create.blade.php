@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h2 class="mb-5" style="color: #00d4ff;">
                <i class="fas fa-download me-2"></i> Export Data Transaksi
            </h2>

            <div class="row g-4">
                <!-- Export Transactions -->
                <div class="col-md-6">
                    <div class="card h-100" style="background: linear-gradient(135deg, #1a1f2e 0%, #242d3d 100%); border: 1px solid #00d4ff33;">
                        <div class="card-body">
                            <h5 class="mb-3" style="color: #00d4ff;">
                                <i class="fas fa-receipt me-2"></i> Transaksi
                            </h5>
                            <p class="text-muted mb-4">Export riwayat transaksi top-up Anda dalam format PDF atau CSV</p>

                            <form id="transactionForm">
                                <div class="mb-3">
                                    <label class="form-label" style="color: #a0aec0;">Tanggal Mulai</label>
                                    <input type="date" name="start_date" class="form-control" style="background: #0f1419; border: 1px solid #00d4ff33; color: #e9d5ff;">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" style="color: #a0aec0;">Tanggal Akhir</label>
                                    <input type="date" name="end_date" class="form-control" style="background: #0f1419; border: 1px solid #00d4ff33; color: #e9d5ff;">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" style="color: #a0aec0;">Status</label>
                                    <select name="status" class="form-select" style="background: #0f1419; border: 1px solid #00d4ff33; color: #e9d5ff;">
                                        <option value="">Semua Status</option>
                                        <option value="completed">Berhasil</option>
                                        <option value="pending">Menunggu</option>
                                        <option value="failed">Gagal</option>
                                    </select>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="button" onclick="exportTransaction('pdf')" class="btn" style="background: linear-gradient(135deg, #00d4ff 0%, #a855f7 100%); color: #0f1419; border: none; font-weight: 600;">
                                        <i class="fas fa-file-pdf me-2"></i> Download PDF
                                    </button>
                                    <button type="button" onclick="exportTransaction('csv')" class="btn" style="background: #242d3d; color: #00d4ff; border: 1px solid #00d4ff;">
                                        <i class="fas fa-file-csv me-2"></i> Download CSV
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Export Reviews -->
                <div class="col-md-6">
                    <div class="card h-100" style="background: linear-gradient(135deg, #1a1f2e 0%, #242d3d 100%); border: 1px solid #00d4ff33;">
                        <div class="card-body">
                            <h5 class="mb-3" style="color: #00d4ff;">
                                <i class="fas fa-star me-2"></i> Review
                            </h5>
                            <p class="text-muted mb-4">Export semua review yang telah Anda tulis dalam format PDF</p>

                            <form id="reviewForm">
                                <div class="mb-4">
                                    <label class="form-label" style="color: #a0aec0;">Filter (Opsional)</label>
                                    <select name="game_id" class="form-select" style="background: #0f1419; border: 1px solid #00d4ff33; color: #e9d5ff;">
                                        <option value="">Semua Game</option>
                                        <option value="1">Game 1</option>
                                        <option value="2">Game 2</option>
                                    </select>
                                </div>

                                <div class="d-grid">
                                    <button type="button" onclick="exportReviews()" class="btn" style="background: linear-gradient(135deg, #00d4ff 0%, #a855f7 100%); color: #0f1419; border: none; font-weight: 600;">
                                        <i class="fas fa-download me-2"></i> Export PDF
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Export Wishlist -->
                <div class="col-md-6">
                    <div class="card" style="background: linear-gradient(135deg, #1a1f2e 0%, #242d3d 100%); border: 1px solid #00d4ff33;">
                        <div class="card-body">
                            <h5 class="mb-3" style="color: #00d4ff;">
                                <i class="fas fa-heart me-2"></i> Wishlist
                            </h5>
                            <p class="text-muted mb-4">Export wishlist game favorit Anda dalam format PDF</p>

                            <div class="d-grid">
                                <button type="button" onclick="exportWishlist()" class="btn" style="background: linear-gradient(135deg, #00d4ff 0%, #a855f7 100%); color: #0f1419; border: none; font-weight: 600;">
                                    <i class="fas fa-download me-2"></i> Export PDF
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="col-md-6">
                    <div class="card" style="background: linear-gradient(135deg, #1a1f2e 0%, #242d3d 100%); border: 1px solid #00d4ff33;">
                        <div class="card-body">
                            <h5 class="mb-3" style="color: #00d4ff;">
                                <i class="fas fa-chart-bar me-2"></i> Statistik
                            </h5>
                            <div id="statsContent" style="color: #a0aec0;">
                                <p class="text-muted">Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function exportTransaction(format) {
    const formData = new FormData(document.getElementById('transactionForm'));
    const url = format === 'pdf' ? '/export/transactions/pdf' : '/export/transactions/csv';
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = url;
    form.innerHTML = `
        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
        <input type="hidden" name="start_date" value="${formData.get('start_date') || ''}">
        <input type="hidden" name="end_date" value="${formData.get('end_date') || ''}">
        <input type="hidden" name="status" value="${formData.get('status') || ''}">
    `;
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}

function exportReviews() {
    const formData = new FormData(document.getElementById('reviewForm'));
    const params = new URLSearchParams(formData);
    window.location.href = `/export/reviews?${params.toString()}`;
}

function exportWishlist() {
    window.location.href = '/export/wishlist';
}

// Load statistics
fetch('/export/stats', {
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    }
})
.then(response => response.json())
.then(data => {
    const statsHtml = `
        <div class="mb-3">
            <small class="text-muted">Total Pengeluaran</small>
            <h6 style="color: #a855f7;">Rp ${data.total_spent.toLocaleString('id-ID')}</h6>
        </div>
        <div class="mb-3">
            <small class="text-muted">Total Transaksi</small>
            <h6 style="color: #00d4ff;">${data.total_transactions}</h6>
        </div>
        <div class="mb-3">
            <small class="text-muted">Transaksi Berhasil</small>
            <h6 style="color: #4ade80;">${data.completed_transactions}</h6>
        </div>
        <div>
            <small class="text-muted">Rata-rata Transaksi</small>
            <h6 style="color: #a0aec0;">Rp ${data.average_transaction.toLocaleString('id-ID')}</h6>
        </div>
    `;
    document.getElementById('statsContent').innerHTML = statsHtml;
})
.catch(error => {
    console.error('Error:', error);
    document.getElementById('statsContent').innerHTML = '<p class="text-danger">Gagal memuat statistik</p>';
});
</script>
@endsection
