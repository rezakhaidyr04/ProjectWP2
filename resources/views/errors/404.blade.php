@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan - Kelompo 2')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center py-5">
                <h1 class="display-1 fw-bold mb-3" style="color: var(--neon-cyan);">
                    404
                </h1>
                <h2 class="h3 mb-3">Halaman Tidak Ditemukan</h2>
                <p class="text-muted mb-4 lead">
                    Maaf, halaman yang Anda cari tidak ditemukan atau sudah dihapus.
                </p>
                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ url('/') }}" class="btn btn-primary">
                        <i class="fas fa-home"></i> Kembali ke Beranda
                    </a>
                    <a href="{{ route('topup.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-gamepad"></i> Lihat Game
                    </a>
                </div>
            </div>

            <div class="text-center mt-5">
                <i class="fas fa-search" style="font-size: 8rem; color: var(--text-muted); opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</div>
@endsection
