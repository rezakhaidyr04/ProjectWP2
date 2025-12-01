@extends('layouts.app')

@section('title', 'Kesalahan Server - GameCredit')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center py-5">
                <h1 class="display-1 fw-bold mb-3" style="color: var(--neon-pink);">
                    500
                </h1>
                <h2 class="h3 mb-3">Kesalahan Server</h2>
                <p class="text-muted mb-4 lead">
                    Maaf, terjadi kesalahan pada server kami. Tim kami sedang menangani masalah ini.
                </p>
                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ url('/') }}" class="btn btn-primary">
                        <i class="fas fa-home"></i> Kembali ke Beranda
                    </a>
                    <a href="javascript:window.history.back()" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="text-center mt-5">
                <i class="fas fa-exclamation-triangle" style="font-size: 8rem; color: var(--neon-pink); opacity: 0.3;"></i>
            </div>

            <div class="alert alert-info mt-4" role="alert">
                <i class="fas fa-info-circle"></i> Jika masalah terus berlanjut, silakan hubungi tim support kami.
            </div>
        </div>
    </div>
</div>
@endsection
