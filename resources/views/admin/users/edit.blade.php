@extends('layouts.app')

@section('content')
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

    <style>
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(71, 118, 230, 0.25) !important;
            background: #fff !important;
        }
        
        .form-control, .form-select {
            transition: all 0.3s ease;
        }
        
        .form-control:hover, .form-select:hover {
            transform: translateY(-1px);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(71, 118, 230, 0.4) !important;
        }
        
        .btn-primary {
            transition: all 0.3s ease;
        }
    
        body {
                font-family: 'Poppins', sans-serif;
            }
            
            .nav-link-hover {
                position: relative;
            }
            
            .nav-link-hover::after {
                content: '';
                position: absolute;
                width: 0;
                height: 2px;
                bottom: -2px;
                left: 0;
                background-color: #3b82f6;
                transition: width 0.3s ease-in-out;
            }
            
            .nav-link-hover:hover::after {
                width: 100%;
            }
    
            .dropdown-animation {
                transition: all 0.2s ease-in-out;
                transform-origin: top right;
            }
    
            .dropdown-animation[x-cloak] {
                opacity: 0;
                transform: scale(0.95);
            }
    </style>
</head>
<body>
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
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="nav-link-hover px-3 py-2 text-gray-700 hover:text-blue-600 transition duration-300">
                                    <i class="fas fa-chart-line mr-2"></i>Dashboard
                                </a>
                            @elseif(Auth::user()->role === 'penjual')
                                <a href="{{ route('penjual.dashboard') }}" class="nav-link-hover px-3 py-2 text-gray-700 hover:text-blue-600 transition duration-300">
                                    <i class="fas fa-home mr-2"></i>Dashboard
                                </a>
                                <a href="#" class="nav-link-hover px-3 py-2 text-gray-700 hover:text-blue-600 transition duration-300">
                                    <i class="fas fa-clipboard-list mr-2"></i>Pesanan
                                </a>
                            @else
                                <a href="{{ route('pembeli.dashboard') }}" class="nav-link-hover px-3 py-2 text-gray-700 hover:text-blue-600 transition duration-300">
                                    <i class="fas fa-home mr-2"></i>Dashboard
                                </a>
                                <a href="#" class="nav-link-hover px-3 py-2 text-gray-700 hover:text-blue-600 transition duration-300">
                                    <i class="fas fa-shopping-bag mr-2"></i>Pesanan Saya
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
                                                            <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">
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
                                @else
                                    <a href="{{ route('login') }}" class="nav-link-hover px-4 py-2 text-gray-700 hover:text-blue-600 transition duration-300">
                                                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                                    </a>


                                    <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition duration-300">
                                                        <i class="fas fa-user-plus mr-2"></i>Register
                                    </a>
                                @endauth
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
                    <div class="md:hidden hidden mobile-menu">
                        <div class="px-2 pt-2 pb-3 space-y-1">
                                        @auth
                                            <a href="{{ route('admin.profile') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50">Profile</a>
                                            <div class="border-t border-gray-200 my-2"></div>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="w-full text-left px-3 py-2 text-base font-medium text-red-600 hover:bg-red-50">
                                                    Logout
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50">Login</a>
                                            <a href="{{ route('register') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50">Register</a>
                                        @endauth
                            </div>
                        </div>
    </nav>

    <main class="pt-16">
        @yield('content')
    </main>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg" style="background: rgba(207, 249, 255, 0.95); border-radius: 20px;">
                    <div class="card-body p-5">
                        <h1 class="text-center mb-4">
                            <span class="position-relative">
                                Edit Pengguna
                                <div class="position-absolute w-100" style="height: 4px; background: linear-gradient(90deg, #4776E6 0%, #8E54E9 100%); bottom: -10px; left: 0; border-radius: 2px;"></div>
                            </span>
                        </h1>

                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="mt-5">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold text-secondary">Nama</label>
                                <input type="text" class="form-control form-control-lg border-0 shadow-sm" 
                                    id="name" name="name" value="{{ $user->name }}" required
                                    style="border-radius: 12px; background: #f8f9fa;">
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold text-secondary">Email</label>
                                <input type="email" class="form-control form-control-lg border-0 shadow-sm" 
                                    id="email" name="email" value="{{ $user->email }}" required
                                    style="border-radius: 12px; background: #f8f9fa;">
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold text-secondary">Password</label>
                                <input type="password" class="form-control form-control-lg border-0 shadow-sm" 
                                    id="password" name="password"
                                    style="border-radius: 12px; background: #f8f9fa;">
                                <small class="form-text text-muted mt-2 d-block">Kosongkan jika tidak ingin mengganti password.</small>
                            </div>

                            <div class="mb-4">
                                <label for="role" class="form-label fw-bold text-secondary">Role</label>
                                <select class="form-select form-select-lg border-0 shadow-sm" 
                                    id="role" name="role" required
                                    style="border-radius: 12px; background: #f8f9fa;">
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="penjual" {{ $user->role == 'penjual' ? 'selected' : '' }}>Penjual</option>
                                    <option value="pembeli" {{ $user->role == 'pembeli' ? 'selected' : '' }}>Pembeli</option>
                                </select>
                            </div>

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary btn-lg px-5 py-3 fw-bold"
                                    style="border-radius: 12px; background: linear-gradient(90deg, #4776E6 0%, #8E54E9 100%); border: none;">
                                    Update Pengguna
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    // Mobile menu toggle
    document.querySelector('.mobile-menu-button').addEventListener('click', function() {
        document.querySelector('.mobile-menu').classList.toggle('hidden');
    });
</script>

@endsection
