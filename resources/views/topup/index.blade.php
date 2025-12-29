@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="mb-5 text-center" data-aos="fade-up">
        <span class="badge mb-3" style="background: var(--gradient-primary); padding: 0.5rem 1rem; border-radius: 50px;">
            <i class="fas fa-gamepad me-1"></i>Katalog Game
        </span>
        <h1 class="display-5 fw-bold text-gradient mb-3">Pilih Game Favorit</h1>
        <p class="lead text-muted">Temukan game favorit Anda dan mulai top up dengan harga terbaik</p>
    </div>

    <!-- Search Bar -->
    <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
        <form method="GET" class="search-form">
            <div class="card p-3" style="border-radius: 16px;">
                <div class="d-flex gap-3 align-items-center flex-wrap">
                    <div class="flex-grow-1">
                        <div class="input-group">
                            <span class="input-group-text" style="background: transparent; border: none; color: var(--text-muted);">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control" placeholder="Cari game favorit Anda..." 
                                   value="{{ request('search') }}" style="border: none; box-shadow: none;">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-search me-2"></i>Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('topup.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Games Grid -->
    <div class="row g-4">
        @forelse($games as $game)
        <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
            <a href="{{ route('topup.game', $game->game_name) }}" class="text-decoration-none">
                <div class="game-card card h-100" style="border-radius: 24px; overflow: hidden;">
                    @php
                        $firstPackage = \App\Models\GamePackage::where('game_name', $game->game_name)->first();
                    @endphp
                    
                    <div class="game-image-wrapper" style="
                        height: 280px;
                        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(168, 85, 247, 0.1));
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        overflow: hidden;
                        position: relative;
                    ">
                        @if($firstPackage && $firstPackage->image)
                            <img src="{{ asset('images/games/' . $firstPackage->image) }}" alt="{{ $game->game_name }}" style="
                                width: 100%;
                                height: 100%;
                                object-fit: contain;
                                padding: 20px;
                                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                            " class="game-image">
                        @else
                            <div class="text-center">
                                <i class="fas fa-gamepad fa-4x" style="color: var(--accent-primary); opacity: 0.8;"></i>
                            </div>
                        @endif
                        
                        <!-- Overlay on hover -->
                        <div class="game-overlay" style="
                            position: absolute;
                            inset: 0;
                            background: linear-gradient(180deg, transparent 50%, rgba(0, 0, 0, 0.8) 100%);
                            opacity: 0;
                            transition: opacity 0.3s ease;
                        "></div>
                    </div>
                    
                    <div class="card-body text-center p-4">
                        <h4 class="fw-bold mb-2" style="color: var(--text-primary);">{{ $game->game_name }}</h4>
                        <p class="text-muted mb-3">
                            <i class="fas fa-box me-1"></i> Lihat paket tersedia
                        </p>
                        <div class="d-flex justify-content-center">
                            <span class="badge" style="background: rgba(99, 102, 241, 0.15); color: var(--accent-primary); padding: 0.5rem 1rem; border-radius: 50px;">
                                <i class="fas fa-arrow-right me-1"></i>Top Up Sekarang
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @empty
        <div class="col-12" data-aos="fade-up">
            <div class="card p-5 text-center" style="border-radius: 24px;">
                <div class="mb-4">
                    <i class="fas fa-search fa-4x" style="color: var(--accent-rose); opacity: 0.5;"></i>
                </div>
                <h4 class="fw-bold mb-2">Game Tidak Ditemukan</h4>
                <p class="text-muted mb-4">
                    @if(request('search'))
                        Tidak ada game dengan nama "{{ request('search') }}"
                    @else
                        Tidak ada game tersedia saat ini
                    @endif
                </p>
                @if(request('search'))
                    <div>
                        <a href="{{ route('topup.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>Lihat Semua Game
                        </a>
                    </div>
                @endif
            </div>
        </div>
        @endforelse
    </div>
</div>

@section('styles')
<style>
    .text-gradient {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .game-card:hover .game-image {
        transform: scale(1.1);
    }
    
    .game-card:hover .game-overlay {
        opacity: 1 !important;
    }
    
    .input-group-text {
        background: transparent;
        border-right: none;
    }
    
    .search-form .form-control {
        background: transparent !important;
    }
    
    .search-form .form-control:focus {
        box-shadow: none !important;
        border: none !important;
    }
</style>
@endsection
@endsection
