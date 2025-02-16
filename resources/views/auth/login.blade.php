@extends('layouts.app')

@section('content')
<head>
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .bg-image {
            background-image: url('{{ asset('img/bg-img2.avif') }}');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .transparent-card {
            background-color: rgba(130, 228, 255, 0.613);
            border-radius: 15px;
            backdrop-filter: blur(5px);
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 30px 30px ;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            padding: 15px;
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-primary {
            width: 100%;
            border-radius: 10px;
            padding: 10px;
        }
        .btn-link {
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        .bubble {
        position: absolute;
        background: linear-gradient(
            135deg,
            rgba(59, 130, 246, 0.3) 0%,
            rgba(147, 51, 234, 0.2) 100%
        );
        backdrop-filter: blur(12px);
        border-radius: 50%;
        pointer-events: none;
        animation: float 8s infinite;
        box-shadow: 
            0 8px 32px rgba(31, 38, 135, 0.2),
            inset 0 4px 8px rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .bubble:nth-child(1) { width: 120px; height: 120px; left: 5%; animation-delay: 0s; }
    .bubble:nth-child(2) { width: 90px; height: 90px; left: 15%; animation-delay: 1s; }
    .bubble:nth-child(3) { width: 150px; height: 150px; left: 25%; animation-delay: 2s; }
    .bubble:nth-child(4) { width: 80px; height: 80px; left: 35%; animation-delay: 3s; }
    .bubble:nth-child(5) { width: 110px; height: 110px; left: 45%; animation-delay: 4s; }
    .bubble:nth-child(6) { width: 130px; height: 130px; left: 55%; animation-delay: 5s; }
    .bubble:nth-child(7) { width: 70px; height: 70px; left: 65%; animation-delay: 6s; }
    .bubble:nth-child(8) { width: 140px; height: 140px; left: 75%; animation-delay: 7s; }
    .bubble:nth-child(9) { width: 100px; height: 100px; left: 85%; animation-delay: 8s; }
    .bubble:nth-child(10) { width: 160px; height: 160px; left: 95%; animation-delay: 9s; }

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg) scale(1); opacity: 0; }
            50% { opacity: 0.6; transform: translateY(50vh) rotate(180deg) scale(1.1); }
            100% { transform: translateY(-100px) rotate(360deg) scale(1); opacity: 0; }
        }   

        main {
        max-height: 100vh; /* Membatasi tinggi agar tidak lebih besar dari layar */
        overflow: hidden;  /* Menyembunyikan scroll bar yang tidak diinginkan */
    }

        /* ===== LOGO STYLE ===== */
        .sitename {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            transition: color 0.3s ease-in-out;
        }

        .sitename:hover {
            color: #0056b3;
        }

        /* ===== AUTH BUTTONS STYLE ===== */
        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Tombol Login */
        .btn-custom {
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            letter-spacing: 0.5px;
            transition: all 0.3s ease-in-out;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .btn-custom:hover {
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.997);
            background: #6db3ff75;
            transform: translateY(-2px);
        }

        .btn-custom-outline:hover {
            background: #007bff;
            color: rgb(0, 0, 0);
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.4);
            transform: translateY(-2px);
        }

        /* Efek animasi tombol */
        .btn-custom::after,
        .btn-custom-outline::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(255, 85, 238, 0.422);
            top: 0;
            left: -100%;
            transition: all 0.4s ease-in-out;
        }

        .btn-custom:hover::after,
        .btn-custom-outline:hover::after {
            left: 100%;
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 768px) {
            .header {
                height: auto;
                padding: 15px 0;
            }

            .header-container {
                flex-direction: column;
                text-align: center;
            }

            .auth-buttons {
                margin-top: 10px;
            }
        }
</style>

</head>

<div>
    
</div>
<header id="header" class="header fixed-top">
    <div class="bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <div class="header-container container-fluid container-xl d-flex align-items-center justify-content-between">

        <!-- Logo -->
        <a href="{{ route('welcome') }}" class="logo d-flex align-items-center">
            <h1 class="sitename m-0">ALV Laundry</h1>
        </a>

        <!-- Menu Navigasi -->
        <nav id="navmenu" class="navmenu d-flex align-items-center">
            <div class="d-flex gap-3 auth-buttons">
                <a class="btn btn-custom" href="{{ route('login') }}">Login</a>
                <a class="btn btn-custom" href="{{ route('register') }}">Register</a>
            </div>
        </nav>

    </div>
</header> 

<div class="bg-image">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card transparent-card">
            <div class="card-header">{{ __('Login') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
