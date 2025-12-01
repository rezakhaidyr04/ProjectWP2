@extends('layouts.app')

@section('title', 'Masuk - Kelompok 2')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card" style="
                background: rgba(30, 30, 30, 0.8);
                border: 2px solid rgba(0, 245, 255, 0.3);
                border-radius: 15px;
                backdrop-filter: blur(20px);
                overflow: hidden;
            ">
                <div style="
                    background: linear-gradient(135deg, #00f5ff, #39ff14);
                    padding: 25px;
                    color: #000;
                ">
                    <h4 style="margin: 0; font-weight: 700;">
                        <i class="fas fa-sign-in-alt me-2"></i>Masuk ke Kelompok 2
                    </h4>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div style="background: rgba(255, 59, 48, 0.1); border: 2px solid #ff3b30; color: #ff3b30; border-radius: 10px; padding: 12px; margin-bottom: 20px;">
                            <strong><i class="fas fa-exclamation-circle me-2"></i>Kesalahan Login</strong>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" style="color: #a0a0c0; font-weight: 500; margin-bottom: 8px; display: block;">
                                Email <span style="color: #ff006e;">*</span>
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" 
                                   placeholder="Masukkan email Anda" required autofocus
                                   style="
                                       background: rgba(18, 18, 18, 0.8);
                                       border: 2px solid rgba(0, 245, 255, 0.3);
                                       color: #ffffff;
                                       border-radius: 8px;
                                       padding: 12px 15px;
                                   "
                            >
                            @error('email')
                                <div style="color: #ff3b30; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" style="color: #a0a0c0; font-weight: 500; margin-bottom: 8px; display: block;">
                                Password <span style="color: #ff006e;">*</span>
                            </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" 
                                   placeholder="Masukkan password Anda" required
                                   style="
                                       background: rgba(18, 18, 18, 0.8);
                                       border: 2px solid rgba(0, 245, 255, 0.3);
                                       color: #ffffff;
                                       border-radius: 8px;
                                       padding: 12px 15px;
                                   "
                            >
                            @error('password')
                                <div style="color: #ff3b30; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div style="display: flex; align-items: center;">
                                <input type="checkbox" id="remember" name="remember" style="width: 18px; height: 18px; cursor: pointer;">
                                <label for="remember" style="color: #a0a0c0; margin-left: 8px; margin-bottom: 0; cursor: pointer;">
                                    Ingat saya
                                </label>
                            </div>
                        </div>

                        <div style="background: rgba(0, 245, 255, 0.1); border-left: 4px solid #00f5ff; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                            <p style="color: #00f5ff; font-weight: 600; margin: 0 0 8px 0; font-size: 0.9rem;">
                                <i class="fas fa-info-circle me-2"></i>Pengguna Uji Coba
                            </p>
                            <p style="color: #a0a0c0; margin: 5px 0; font-size: 0.85rem;">
                                <strong>Email:</strong> test@example.com
                            </p>
                            <p style="color: #a0a0c0; margin: 0; font-size: 0.85rem;">
                                <strong>Password:</strong> password
                            </p>
                        </div>

                        <button type="submit" class="btn w-100" style="
                            background: linear-gradient(135deg, #00f5ff, #39ff14);
                            color: #000;
                            font-weight: 600;
                            border: none;
                            border-radius: 8px;
                            padding: 12px;
                            font-size: 1rem;
                            transition: all 0.3s;
                        ">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk
                        </button>
                    </form>

                    <hr style="border-color: rgba(0, 245, 255, 0.2); margin: 25px 0;">

                    <div style="text-align: center;">
                        <p style="color: #a0a0c0; margin-bottom: 10px; font-size: 0.9rem;">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" style="color: #00f5ff; text-decoration: none; font-weight: 600;">
                                Daftar di sini
                            </a>
                        </p>
                        <a href="{{ route('password.request') }}" style="color: #39ff14; text-decoration: none; font-size: 0.9rem;">
                            Lupa password?
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        background-color: rgba(18, 18, 18, 0.9) !important;
        border-color: #00f5ff !important;
        box-shadow: 0 0 15px rgba(0, 245, 255, 0.3) !important;
        color: #ffffff !important;
    }

    .form-control {
        color: #ffffff !important;
    }

    .form-control::placeholder {
        color: #708fa0 !important;
    }

    .btn:hover {
        box-shadow: 0 0 20px rgba(0, 245, 255, 0.5) !important;
        transform: translateY(-2px);
    }
</style>
@endsection
