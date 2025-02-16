@extends('layouts.app')

@section('content')

<style>

    body {
        font-family: 'Poppins', sans-serif;
    }
    /* Enhanced Gradient Background */
    .dashboard-container {
        position: relative;
        overflow: hidden;
        padding: 2rem;
        background: linear-gradient(
            135deg, 
            #faf9e0 0%,
            #e3f2fd 50%,
            #f1f5fe 100%
        );
        background-size: 200% 200%;
        animation: gradientBG 15s ease infinite;
        min-height: calc(100vh - 4rem);
        margin-top: 4rem;
        max-width: 1400px;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
    }

    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Enhanced Floating Bubbles */
    .bubble {
        position: absolute;
        background: linear-gradient(
            135deg,
            rgba(99, 102, 241, 0.05) 0%,
            rgba(99, 102, 241, 0.1) 100%
        );
        backdrop-filter: blur(5px);
        border-radius: 50%;
        pointer-events: none;
        animation: float 8s infinite;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.05);
    }

    .bubble:nth-child(1) { width: 100px; height: 100px; left: 10%; animation-delay: 0s; }
    .bubble:nth-child(2) { width: 80px; height: 80px; left: 30%; animation-delay: 2s; }
    .bubble:nth-child(3) { width: 60px; height: 60px; left: 50%; animation-delay: 4s; }
    .bubble:nth-child(4) { width: 120px; height: 120px; left: 70%; animation-delay: 6s; }

    @keyframes float {
        0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
        50% { opacity: 0.8; }
        100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
    }

    /* Enhanced Card Styles */
    .stats-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 
            0 5px 10px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.6);
        border-radius: 16px;
        padding: 1.5rem;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-8px) scale(1.05);
        box-shadow: 
            0 10px 30px rgba(99, 102, 241, 0.2),
            0 6px 12px rgba(99, 102, 241, 0.1);
    }

    .stats-icon {
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: linear-gradient(135deg, #4f46e5, #9333ea);
        color: white;
        margin-bottom: 1rem;
        position: relative;
        overflow: hidden;
        transition: background 0.3s ease;
    }

    .stats-icon i {
        font-size: 1.75rem;
        z-index: 1;
    }

    .stats-icon::after {
        content: '';
        position: absolute;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 10%, transparent 60%);
        top: -50%;
        left: -50%;
        transition: transform 0.5s ease-in-out;
    }

    .stats-card:hover .stats-icon::after {
        transform: rotate(360deg);
    }
    /* Enhanced Order Cards */
    .order-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .order-card:hover {
        transform: translateY(-3px);
        box-shadow: 
            0 12px 20px rgba(99, 102, 241, 0.1),
            0 4px 8px rgba(99, 102, 241, 0.05);
    }

    .order-header {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        position: relative;
        overflow: hidden;
    }

    .order-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 200%;
        height: 100%;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(255, 255, 255, 0.2),
            transparent
        );
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(50%); }
    }

    /* Enhanced Status Badges */
    .status-badge {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .status-badge::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
            transparent,
            rgba(255, 255, 255, 0.3),
            transparent
        );
        transform: rotate(45deg);
        animation: shine 3s infinite;
    }

    @keyframes shine {
        0% { transform: translateX(-100%) rotate(45deg); }
        100% { transform: translateX(100%) rotate(45deg); }
    }

    /* Smooth Loading Transition */
    .fade-in {
        animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Smooth Section Reveal */
    .reveal {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease;
    }

    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }

    .grid {
        display: grid;
        gap: 1.5rem;
    }

    .order-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .order-header {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
        padding: 1.5rem;
    }

    .order-body {
        padding: 1.5rem;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-completed {
        background: #dcfce7;
        color: #166534;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #1e293b;
    }

    @media (min-width: 768px) {
        .grid-cols-3 {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .lg\:grid-cols-2 {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .welcome-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(99, 102, 241, 0.2);
        box-shadow: 0 5px 15px rgba(99, 102, 241, 0.15);
        border-radius: 16px;
        padding: 1.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .welcome-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.25);
    }

    .welcome-icon {
        background: linear-gradient(135deg, #4f46e5, #9333ea);
        color: white;
        padding: 12px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 56px;
        height: 56px;
        font-size: 1.75rem;
        box-shadow: inset 0 2px 4px rgba(255, 255, 255, 0.3);
    }

    /* Navbar Link Styling */
    .nav-link {
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

    .nav-link:hover {
        box-shadow: 0 6px 15px rgba(0, 123, 255, 0.4);
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    /* Efek animasi link */
    .nav-link::after {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.2);
        top: 0;
        left: -100%;
        transition: all 0.4s ease-in-out;
    }

    .nav-link:hover::after {
        left: 100%;
    }

    /* User Menu Button Styling */
    .user-menu-button {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
    }

    .user-menu-button:hover {
        box-shadow: 0 6px 15px rgba(0, 123, 255, 0.4);
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

        /* Hide scrollbar for Chrome, Safari and Opera */
        ::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    * {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }

</style>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ALV Laundry</title>
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!-- Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body style="background: linear-gradient(135deg, #f2e3fa, #e3f2fd); min-height: 100vh; background-attachment: fixed;">

    <nav class="bg-gradient-to-r from-blue-300 to-purple-700 shadow-xl fixed w-full top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo dan Brand -->
                <div class="flex items-center">
                    <a href="{{ route('welcome') }}" class="flex items-center space-x-3 group">
                        <div class="p-2 bg-white rounded-lg shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <style>
                                .tshirt-icon {
                                    transition: color 0.3s;
                                }
                                .tshirt-icon:hover {
                                    animation: colorChange 2s infinite;
                                }
                                @keyframes colorChange {
                                    0% { color: #4f46e5; }
                                    25% { color: #ef4444; }
                                    50% { color: #22c55e; }
                                    75% { color: #eab308; }
                                    100% { color: #4f46e5; }
                                }
                            </style>
                            <i class="fas fa-tshirt text-2xl tshirt-icon"></i>
                        </div>


                        <span class="text-2xl font-bold text-white group-hover:text-blue-200 transition duration-300">
                            ALV Laundry
                        </span>

                        
                    </a>
                </div>

                <!-- Menu Navigasi -->
                <div class="hidden md:flex items-center space-x-6">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                <i class="fas fa-chart-line mr-2"></i>
                                <span>Dashboard</span>
                            </a>
                        @elseif(Auth::user()->role === 'penjual')
                            <a href="{{ route('penjual.dashboard') }}" class="nav-link">
                                <i class="fas fa-home mr-2"></i>
                                <span>Dashboard</span>
                            </a>
                        @elseif(Auth::user()->role === 'pembeli')
                            <a href="{{ route('pembeli.dashboard') }}" class="nav-link">
                                <i class="fas fa-home mr-2"></i>
                                <span>Dashboard</span>
                            </a>
                        @endif

                        <!-- User Menu -->
                        <div class="relative ml-3" x-data="{ open: false }">
                            @php
                                $user = Auth::user();
                            @endphp
                            <button @click="open = !open" 
                                    class="user-menu-button flex items-center space-x-3 px-4 py-2">
                                <style>
                                    @keyframes borderAnimation {
                                        0% { border-color: #0084ff; }  /* Biru */
                                        50% { border-color: #00ffea; } /* Ungu */
                                        100% { border-color: #ff3f9c; } /* Pink */
                                    }
                        
                                    .custom-border {
                                        border: 2px solid;
                                        animation: borderAnimation 3s infinite alternate ease-in-out;
                                        transition: border-color 0.5s ease-in-out;
                                    }
                        
                                    .custom-border:hover {
                                        border-color: #ff8800; /* Saat hover jadi orange */
                                    }
                                </style>
                        
                                <img class="h-10 w-10 rounded-lg object-cover custom-border" 
                                     src="{{ asset('storage/profile-photos/' . $user->photo) }}" 
                                     alt="{{ Auth::user()->name }}">
                        
                                <span class="text-sm font-medium text-white">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs text-white/70"></i>
                            </button>
                             <div x-show="open" 
                        @click.away="open = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-2xl py-2 z-50">
                        
                        <a href="{{ route('pembeli.profile') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-300">
                            <i class="fas fa-user mr-2"></i>
                            <span>Profile</span>
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50 transition duration-300">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                        
                        
                    @else
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                        <a href="{{ route('register') }}" class="nav-link bg-white text-blue-600">
                            <i class="fas fa-user-plus mr-2"></i>Register
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button class="mobile-menu-button p-2 rounded-lg hover:bg-white/20 text-white">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
                    
        <!-- Mobile Menu -->
        <div class="md:hidden hidden mobile-menu bg-white">
            <div class="px-4 pt-4 pb-6 space-y-3">
                @auth
                    <a href="{{ route('penjual.profile') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-lg transition duration-300">
                        <i class="fas fa-user mr-2"></i>
                        <span>Profile</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-lg transition duration-300">
                        <i class="fas fa-cog mr-2"></i>
                        <span>Settings</span>
                    </a>
                    <div class="border-t border-gray-100 my-2"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition duration-300">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-lg transition duration-300">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                    <a href="{{ route('register') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-lg transition duration-300">
                        <i class="fas fa-user-plus mr-2"></i>Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

<div class="dashboard-container font-poppins">
    <!-- Animated Background Bubbles -->
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>

    <!-- Success Message Notification -->
    @if(session('success'))
    <div x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 3000)"
         class="mb-4 rounded-lg bg-green-100 p-4 shadow-sm transition-all duration-500"
         role="alert">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
            <p class="text-green-700">{{ session('success') }}</p>
            <button @click="show = false" class="ml-auto">
                <i class="fas fa-times text-green-600 hover:text-green-800"></i>
            </button>
        </div>
    </div>
    @endif

    <!-- Welcome Message -->
    <div class="mb-8 welcome-card">
        <div class="flex items-center space-x-4">
            <div class="welcome-icon">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Selamat Datang, {{ Auth::user()->name }}!</h2>
                <p class="text-gray-600">Kelola semua pesanan laundry Anda di satu tempat dengan mudah.</p>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 font-poppins">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <h3 class="text-gray-600 font-medium mb-1">Total Pesanan</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $historyOrders->count() }}</p>
        </div>
        
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3 class="text-gray-600 font-medium mb-1">Pesanan Selesai</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $historyOrders->count() }}</p>
        </div>
        
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-clock"></i>
            </div>
            <h3 class="text-gray-600 font-medium mb-1">Pesanan Aktif</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $orders->count() }}</p>
        </div>
    </div>

    <!-- Pesanan Aktif -->
    <h2 class="section-title">Pesanan Aktif</h2>
    @if($orders->isEmpty())
        <div class="bg-white rounded-lg p-6 text-center">
            <i class="fas fa-box-open text-4xl text-gray-400 mb-4"></i>
            <p class="text-gray-600">Belum ada pesanan aktif saat ini</p>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            @foreach($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <p class="text-sm opacity-75">Order ID</p>
                                <p class="text-lg font-bold">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <span class="status-badge {{ $order->status == 'pending' ? 'status-pending' : 'status-completed' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="opacity-75">Tanggal Order</p>
                                <p class="font-medium">{{ $order->created_at->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="opacity-75">Waktu Order</p>
                                <p class="font-medium">{{ $order->created_at->format('H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>

                    <div class="order-body">
                        <h4 class="font-semibold mb-4">Detail Layanan</h4>
                        @foreach($order->laundryItems as $item)
                            <div class="bg-gray-50 rounded-lg p-4 mb-3 last:mb-0">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ asset('storage/laundry-images/' . $item->image) }}" 
                                        alt="{{ $item->name }}"
                                        class="w-16 h-16 object-cover rounded-lg"
                                        onerror="this.src='{{ asset('images/default-laundry.jpg') }}'">
                                        <div>
                                        <p class="font-medium">{{ $item->name }}</p>
                                        @if($item->pivot->weight > 0)
                                            <p class="text-sm text-gray-600 mt-1">
                                                {{ $item->pivot->weight }} kg × Rp {{ number_format($item->price_per_kg, 0, ',', '.') }}
                                            </p>
                                        @endif
                                        @if($item->pivot->quantity > 0)
                                            <p class="text-sm text-gray-600 mt-1">
                                                {{ $item->pivot->quantity }} item × Rp {{ number_format($item->price, 0, ',', '.') }}
                                            </p>
                                        @endif
                                        </div>
                                    </div>
                                    <p class="font-semibold text-indigo-600">
                                        Rp {{ number_format(($item->pivot->weight * $item->price_per_kg) + ($item->pivot->quantity * $item->price), 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="border-t mt-4 pt-4">
                            <div class="flex justify-between items-center">
                                <p class="font-medium">Total Pembayaran</p>
                                <p class="text-xl font-bold text-indigo-600">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif


    <br>

    <!-- Riwayat Pesanan -->
    <h2 class="section-title">Riwayat Pesanan</h2>
    @if($historyOrders->isEmpty())
        <div class="bg-white rounded-lg p-6 text-center">
            <i class="fas fa-history text-4xl text-gray-400 mb-4"></i>
            <p class="text-gray-600">Belum ada riwayat pesanan</p>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($historyOrders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <p class="text-sm opacity-75">Order ID</p>
                                <p class="text-lg font-bold">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <span class="status-badge status-completed">Completed</span>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="opacity-75">Tanggal Order</p>
                                <p class="font-medium">{{ $order->created_at->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="opacity-75">Waktu Order</p>
                                <p class="font-medium">{{ $order->created_at->format('H:i') }} WIB</p>
                            </div>
                            <div>
                                <p class="opacity-75">Tanggal Selesai</p>
                                <p class="font-medium">{{ $order->updated_at->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="opacity-75">Waktu Selesai</p>
                                <p class="font-medium">{{ $order->updated_at->format('H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>

                    <div class="order-body">
                        <h4 class="font-semibold mb-4">Detail Layanan</h4>
                        @foreach($order->laundryItems as $item)
                            <div class="bg-gray-50 rounded-lg p-4 mb-3 last:mb-0">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ asset('storage/laundry-images/' . $item->image) }}" 
                                             alt="{{ $item->name }}"
                                             class="w-16 h-16 object-cover rounded-lg"
                                             onerror="this.src='{{ asset('images/default-laundry.jpg') }}'"
                                        >
                                        <div>
                                            <p class="font-medium">{{ $item->name }}</p>
                                            @if($item->pivot->weight > 0)
                                                <p class="text-sm text-gray-600 mt-1">
                                                    {{ $item->pivot->weight }} kg × Rp {{ number_format($item->price_per_kg, 0, ',', '.') }}
                                                </p>
                                            @endif
                                            @if($item->pivot->quantity > 0)
                                                <p class="text-sm text-gray-600 mt-1">
                                                    {{ $item->pivot->quantity }} item × Rp {{ number_format($item->price, 0, ',', '.') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="font-semibold text-indigo-600">
                                        Rp {{ number_format(($item->pivot->weight * $item->price_per_kg) + ($item->pivot->quantity * $item->price), 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="border-t mt-4 pt-4">
                            <div class="flex justify-between items-center">
                                <p class="font-medium">Total Pembayaran</p>
                                <p class="text-xl font-bold text-indigo-600">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('invoice.download', $order->id) }}" class="block text-center px-4 py-2 bg-indigo-500 text-white text-sm font-medium rounded-lg hover:bg-indigo-600 transition">
                                <i class="fas fa-download mr-2"></i> Download Invoice
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Loading Spinner -->
<div x-data="{ loading: false }"
     x-show="loading"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
     style="display: none;">
    <div class="bg-white p-5 rounded-lg flex items-center space-x-3">
        <div class="animate-spin rounded-full h-8 w-8 border-4 border-indigo-600 border-t-transparent"></div>
        <p class="text-gray-700">Memuat...</p>
    </div>
</div>

<!-- Scroll to Top Button -->
<button id="scrollToTop" 
        class="fixed bottom-8 right-8 bg-indigo-600 text-white rounded-full p-3 hidden shadow-lg hover:bg-indigo-700 transition duration-300"
        onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
    // Enhanced scroll reveal
    const observerOptions = {
        root: null,
        threshold: 0.1,
        rootMargin: '0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active', 'fade-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.reveal').forEach((element) => {
        observer.observe(element);
    });

    // Enhanced parallax effect
    document.addEventListener('mousemove', function(e) {
        const bubbles = document.querySelectorAll('.bubble');
        const cards = document.querySelectorAll('.stats-card');
        
        const mouseX = e.clientX / window.innerWidth;
        const mouseY = e.clientY / window.innerHeight;

        bubbles.forEach((bubble, index) => {
            const speed = 0.05 - (index * 0.01);
            const x = (window.innerWidth - e.pageX * speed) / 100;
            const y = (window.innerHeight - e.pageY * speed) / 100;
            
            bubble.style.transform = `translate(${x}px, ${y}px)`;
        });

        cards.forEach((card, index) => {
            const rect = card.getBoundingClientRect();
            const cardX = rect.left + rect.width / 2;
            const cardY = rect.top + rect.height / 2;
            
            const angleX = (cardY - e.clientY) / 30;
            const angleY = (e.clientX - cardX) / 30;
            
            card.style.transform = `perspective(1000px) rotateX(${angleX}deg) rotateY(${angleY}deg) translateY(-5px)`;
        });
    });

    // Reset card rotation when mouse leaves
    document.addEventListener('mouseleave', function() {
        document.querySelectorAll('.stats-card').forEach(card => {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(-5px)';
        });
    });
</script>
</body>
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@endsection
