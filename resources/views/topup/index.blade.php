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
                    <div style="
                        background: linear-gradient(135deg, rgba(0, 245, 255, 0.1), rgba(57, 255, 20, 0.1));
                        padding: 40px;
                        text-align: center;
                        min-height: 200px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    ">
                        <div>
                            <i class="fas fa-gamepad" style="font-size: 3rem; color: #00f5ff; margin-bottom: 15px;"></i>
                            <h5 style="color: #ffffff; font-weight: 600; margin: 0;">{{ $game->game_name }}</h5>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <p class="card-text" style="color: #a0a0c0;">Lihat paket tersedia</p>
                    </div>
                </div>
            </a>
        </div>
        @empty
        <div class="col-12">
            <div class="alert" style="background: rgba(255, 59, 48, 0.1); border: 2px solid #ff3b30; color: #ff3b30; border-radius: 10px;">
                <i class="fas fa-exclamation-circle"></i> Tidak ada game tersedia
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
</style>
@endsection
