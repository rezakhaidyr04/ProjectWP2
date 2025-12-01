@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="mb-5">
        <h1 class="display-4 mb-2" style="background: linear-gradient(135deg, #00f5ff, #39ff14); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
            Pilih Game
        </h1>
        <p class="lead" style="color: #a0a0c0;">Pilih game favorit Anda untuk melakukan top-up</p>
    </div>

    <!-- Search Bar -->
    <div class="mb-4">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Cari game..." 
                   value="{{ request('search') }}" style="background: rgba(30, 30, 30, 0.8); border: 2px solid rgba(0, 245, 255, 0.3);">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i> Cari
            </button>
            @if(request('search'))
                <a href="{{ route('topup.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times"></i>
                </a>
            @endif
        </form>
    </div>

    <!-- Games Grid -->
    <div class="row g-4">
        @forelse($games as $game)
        <div class="col-12 col-md-6 col-lg-4">
            <a href="{{ route('topup.game', $game->game_name) }}" class="text-decoration-none">
                <div class="card h-100" style="
                    background: rgba(30, 30, 30, 0.8);
                    border: 2px solid rgba(0, 245, 255, 0.3);
                    border-radius: 15px;
                    backdrop-filter: blur(20px);
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    cursor: pointer;
                    overflow: hidden;
                ">
                    @php
                        $firstPackage = \App\Models\GamePackage::where('game_name', $game->game_name)->first();
                    @endphp
                    
                    <div style="
                        height: 300px;
                        background: linear-gradient(135deg, rgba(0, 245, 255, 0.1), rgba(57, 255, 20, 0.1));
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        overflow: hidden;
                        border-bottom: 2px solid rgba(0, 245, 255, 0.3);
                    ">
                        @if($firstPackage && $firstPackage->image)
                            <img src="{{ asset('images/games/' . $firstPackage->image) }}" alt="{{ $game->game_name }}" style="
                                width: 100%;
                                height: 100%;
                                object-fit: contain;
                                padding: 10px;
                                transition: transform 0.3s ease;
                            " class="game-image">
                        @else
                            <i class="fas fa-gamepad" style="font-size: 3rem; color: #00f5ff;"></i>
                        @endif
                    </div>
                    
                    <div class="card-body text-center">
                        <h5 style="color: #ffffff; font-weight: 600; margin: 0;">{{ $game->game_name }}</h5>
                        <p class="card-text mt-2" style="color: #a0a0c0; margin: 0;">Lihat paket tersedia</p>
                    </div>
                </div>
            </a>
        </div>
        @empty
        <div class="col-12">
            <div class="alert" style="background: rgba(255, 59, 48, 0.1); border: 2px solid #ff3b30; color: #ff3b30; border-radius: 10px;">
                <i class="fas fa-exclamation-circle"></i> 
                @if(request('search'))
                    Tidak ada game dengan nama "{{ request('search') }}"
                @else
                    Tidak ada game tersedia
                @endif
            </div>
        </div>
        @endforelse
    </div>
</div>

<style>
    .card:hover {
        border-color: #00f5ff !important;
        box-shadow: 0 0 30px rgba(0, 245, 255, 0.3) !important;
        transform: translateY(-5px);
    }
    
    .game-image {
        transition: transform 0.3s ease !important;
    }
    
    .card:hover .game-image {
        transform: scale(1.05);
    }
</style>
@endsection
