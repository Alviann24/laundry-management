@extends('layouts.app')

@section('content')
<style>
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

/* Updated profile card styling */
.profile-card {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    transform-style: preserve-3d;
    perspective: 1500px;
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.profile-card:hover {
    transform: translateY(-10px) rotateX(3deg);
    box-shadow: 
        0 30px 60px rgba(0, 0, 0, 0.12),
        0 0 0 2px rgba(255, 255, 255, 0.3);
}

/* Glowing effect for profile photo */
.photo-container {
    position: relative;
}

.photo-container::after {
    content: '';
    position: absolute;
    inset: -5px;
    background: linear-gradient(45deg, #ff3d00, #00c853, #2196f3, #9c27b0);
    border-radius: 50%;
    filter: blur(15px);
    opacity: 0;
    transition: opacity 0.3s;
    z-index: -1;
}

.photo-container:hover::after {
    opacity: 0.7;
}

/* Enhanced photo container effects */
.rainbow-border::before {
    background: linear-gradient(
        45deg,
        #ff3d00, #00c853, #2196f3, #9c27b0,
        #ff3d00, #00c853, #2196f3, #9c27b0
    );
    background-size: 200% 200%;
    animation: gradientBorder 3s linear infinite;
}

@keyframes gradientBorder {
    0% { background-position: 0% 0%; }
    100% { background-position: 200% 200%; }
}

/* Modern button styling */
.edit-button {
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    border: none;
    padding: 1rem 2.5rem;
    color: white;
    font-weight: 600;
    border-radius: 12px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 
        0 4px 15px rgba(59, 130, 246, 0.3),
        0 0 0 2px rgba(255, 255, 255, 0.1) inset;
    position: relative;
    overflow: hidden;
}

.edit-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(255, 255, 255, 0.2),
        transparent
    );
    transition: 0.5s;
}

.edit-button:hover {
    transform: translateY(-3px);
    box-shadow: 
        0 8px 25px rgba(59, 130, 246, 0.4),
        0 0 0 2px rgba(255, 255, 255, 0.2) inset;
    color: #00ffea
}

.edit-button:hover::before {
    left: 100%;
}

/* Enhanced info cards */
.flex.items-center.p-4 {
    background: rgba(255, 255, 255, 0.527);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.flex.items-center.p-4:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 
        0 20px 40px rgba(0, 0, 0, 0.1),
        0 0 0 1px rgba(255, 255, 255, 0.4);
    background: rgba(255, 255, 255, 0.9);
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

<body>
    @if(Auth::user()->role === 'pembeli')
        <!-- Navbar untuk role pembeli -->
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

                    <!-- Menu Navigasi untuk pembeli -->
                    <div class="hidden md:flex items-center space-x-6">
                        <a href="{{ route('pembeli.dashboard') }}" class="nav-link">
                            <i class="fas fa-home mr-2"></i>
                            <span>Dashboard</span>
                        </a>

                        <!-- User Menu -->
                        <div class="relative ml-3" x-data="{ open: false }">
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
                                     src="{{ asset('storage/profile-photos/' . Auth::user()->photo) }}" 
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
                        </div>
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
                    <a href="{{ route('pembeli.profile') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-lg transition duration-300">
                        <i class="fas fa-user mr-2"></i>
                        <span>Profile</span>
                    </a>
                    <div class="border-t border-gray-100 my-2"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition duration-300">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    @else
        <!-- Navbar untuk role selain pembeli -->
        <nav class="bg-white shadow-lg fixed w-full top-0 left-0 right-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo dan Brand -->
                    <div class="flex items-center">
                        <a href="{{ route('welcome') }}" class="flex items-center space-x-3">
                            <i class="fas fa-tshirt text-blue-500 text-2xl"></i>
                            <span class="text-xl font-bold text-gray-800 hover:text-blue-600 transition duration-300">
                                ALV Laundry
                            </span>
                        </a>
                    </div>

                    <!-- Menu Navigasi -->
                    <div class="hidden md:flex items-center space-x-4">
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="nav-link-hover px-3 py-2 text-gray-700 hover:text-blue-600 transition duration-300">
                                <i class="fas fa-chart-line mr-2"></i>Dashboard
                            </a>
                        @elseif(Auth::user()->role === 'penjual')
                            <a href="{{ route('penjual.dashboard') }}" class="nav-link-hover px-3 py-2 text-gray-700 hover:text-blue-600 transition duration-300">
                                <i class="fas fa-home mr-2"></i>Dashboard
                            </a>
                        @endif

                        <!-- User Menu -->
                        <div class="relative ml-3" x-data="{ open: false }">
                            @php
                                $user = Auth::user();
                            @endphp
                            <button @click="open = !open" class="flex items-center space-x-2 bg-white hover:bg-gray-50 px-4 py-2 rounded-full border transition duration-300">
                                <img class="h-8 w-8 rounded-full object-cover border-2 border-blue-500" 
                                    src="{{ asset('storage/profile-photos/' . $user->photo) }}" 
                                    alt="{{ Auth::user()->name }}">
                                <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                            </button>
                            <div x-show="open" 
                                @click.away="open = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2">
                                <a href="{{ route(Auth::user()->role . '.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-user mr-2"></i>Profile
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="md:hidden flex items-center">
                        <button class="mobile-menu-button p-2 rounded-md hover:bg-gray-100">
                            <i class="fas fa-bars text-gray-600"></i>
                        </button>
                    </div>
                </div>
            </div>
                            
            <!-- Mobile Menu -->
            <div class="md:hidden mobile-menu hidden">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route(Auth::user()->role . '.profile') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50">Profile</a>
                    <div class="border-t border-gray-200 my-2"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 text-base font-medium text-red-600 hover:bg-red-50">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    @endif

    @if (session('success'))
        <div class="fixed top-24 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-sm">
            <div class="bg-white/80 backdrop-blur-lg border border-green-500/50 rounded-xl shadow-lg shadow-green-500/30 p-4 animate-fade-in-down">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500 text-xl"></i>
                    </div>
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <main class="pt-16 absolute inset-0 bg-gradient-to-t from-blue-500/50 to-transparent">
        <!-- Tambahkan 10 bubble -->
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
        
        <div class="container mx-auto px-4 py-12">

            <div class="max-w-4xl mx-auto">
                <!-- Profile Card -->
                <div class="profile-card rounded-3xl shadow-2xl overflow-hidden transition-all duration-500">
                    <!-- Header with background -->
                    <div class="bg-cover bg-center h-48 relative"
                    style="background-image: url('{{ asset('img/Screenshot 2025-02-04 141635.png') }}');">
                   <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                   <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2 group">
               
                            <style>
                                .rainbow-border {
                                    position: relative;
                                    display: inline-block;
                                    padding: 3px; /* Border lebih kecil */
                                    border-radius: 50%;
                                }
                        
                                .rainbow-border::before {
                                    content: "";
                                    position: absolute;
                                    top: -3px; /* Ukuran border dikurangi */
                                    left: -3px;
                                    right: -3px;
                                    bottom: -3px;
                                    border-radius: 50%;
                                    background: conic-gradient(
                                        #ff0000, #ff8800, #ffff00, #00ff00, #00ffff, #0000ff, #ff00ff, #ff0000
                                    );
                                    animation: rotateBorder 2s linear infinite;
                                    z-index: -1;
                                    filter: brightness(1.3) saturate(1.5); /* Bikin warna lebih hidup */
                                }
                        
                                @keyframes rotateBorder {
                                    0% { transform: rotate(0deg); }
                                    100% { transform: rotate(360deg); }
                                }
                            </style>
                            @if($user->photo)
                                <div class="rainbow-border">
                                    <img src="{{ asset('storage/profile-photos/' . $user->photo) }}" 
                                        alt="Profile Photo" 
                                        class="w-40 h-40 rounded-full object-cover shadow-lg transform transition-transform duration-300 group-hover:scale-110">
                                </div>
                            @else
                                <div class="rainbow-border">
                                    <img src="{{ asset('images/default-avatar.png') }}" 
                                        alt="Default Profile" 
                                        class="w-40 h-40 rounded-full object-cover shadow-lg transform transition-transform duration-300 group-hover:scale-110">
                                </div>
                            @endif
                        </div>
                        
                        
                    </div>

                    <!-- Profile Content -->
                    <div class="pt-20 pb-8 px-8  bg-black/5">
                        <!-- User Name and Role Badge -->
                        <div class="text-center mb-8">
                            <h1 class="text-2xl font-bold text-gray-800 hover:text-blue-600 transition-colors duration-300">{{ $user->name }}</h1>
                            <span class="inline-block px-4 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-600 mt-2 hover:bg-blue-200 transition-colors duration-300">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>

                        <!-- Profile Information -->
                        <div class="grid gap-6 max-w-2xl mx-auto">
                            <!-- Email -->
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-blue-50 transform hover:-translate-y-1 transition-all duration-300">
                                <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-lg bg-blue-100">
                                    <i class="fas fa-envelope text-blue-500 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Email</p>
                                    <p class="text-gray-800">{{ $user->email }}</p>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-blue-50 transform hover:-translate-y-1 transition-all duration-300">
                                <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-lg bg-blue-100">
                                    <i class="fas fa-map-marker-alt text-blue-500 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Alamat</p>
                                    <p class="text-gray-800">{{ $user->address ?: 'Belum diatur' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Button -->
                        <div class="mt-8 text-center">
                            <a href="{{ route(Auth::user()->role . '.profile.edit') }}" 
                               class="edit-button inline-flex items-center group">
                                <i class="fas fa-edit mr-2 group-hover:rotate-12 transition-transform"></i>
                                <span>Edit Profile</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
<script>
    // Mobile menu toggle
    document.querySelector('.mobile-menu-button').addEventListener('click', function() {
        document.querySelector('.mobile-menu').classList.toggle('hidden');
    });
</script>

<style>
    @keyframes fade-in-down {
        0% {
            opacity: 0;
            transform: translateY(-10px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in-down {
        animation: fade-in-down 0.5s ease-out;
    }
</style>
@endsection 