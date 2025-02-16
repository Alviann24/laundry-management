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
                                        .bubble {
                                            position: absolute;
                                            background: linear-gradient(
                                                135deg,
                                                rgba(255, 255, 255, 0.1) 0%,
                                                rgba(255, 255, 255, 0.4) 30%,
                                                rgba(255, 255, 255, 0.1) 50%,
                                                rgba(255, 255, 255, 0.2) 70%,
                                                rgba(147, 51, 234, 0.1) 100%
                                            );
                                            backdrop-filter: blur(5px);
                                            border-radius: 50%;
                                            pointer-events: none;
                                            border: 1px solid rgba(255, 255, 255, 0.3);
                                            box-shadow: 
                                                inset -5px -5px 15px rgba(255, 255, 255, 0.3),
                                                inset 5px 5px 15px rgba(255, 255, 255, 0.3),
                                                0 0 20px rgba(255, 255, 255, 0.2);
                                        }
                    
                                        .bubble::before {
                                            content: '';
                                            position: absolute;
                                            top: 15%;
                                            left: 15%;
                                            width: 20%;
                                            height: 20%;
                                            border-radius: 50%;
                                            background: radial-gradient(
                                                circle at center,
                                                rgba(255, 255, 255, 0.8) 0%,
                                                rgba(255, 255, 255, 0.2) 100%
                                            );
                                            filter: blur(1px);
                                        }
                    
                                        .bubble::after {
                                            content: '';
                                            position: absolute;
                                            top: 25%;
                                            left: 25%;
                                            width: 10%;
                                            height: 10%;
                                            border-radius: 50%;
                                            background: rgba(255, 255, 255, 0.8);
                                        }
                    
                                        .bubble:nth-child(1) { 
                                            width: 180px; height: 180px; left: 5%; 
                                            animation: float1 18s infinite;
                                        }
                                        .bubble:nth-child(2) { 
                                            width: 120px; height: 120px; left: 25%; 
                                            animation: float2 22s infinite;
                                        }
                                        .bubble:nth-child(3) { 
                                            width: 150px; height: 150px; left: 45%; 
                                            animation: float1 25s infinite;
                                        }
                                        .bubble:nth-child(4) { 
                                            width: 100px; height: 100px; left: 65%; 
                                            animation: float2 20s infinite;
                                        }
                                        .bubble:nth-child(5) { 
                                            width: 130px; height: 130px; left: 85%; 
                                            animation: float1 23s infinite;
                                        }
                                        .bubble:nth-child(6) { 
                                            width: 160px; height: 160px; left: 15%; 
                                            animation: float2 19s infinite;
                                        }
                                        .bubble:nth-child(7) { 
                                            width: 110px; height: 110px; left: 35%; 
                                            animation: float1 21s infinite;
                                        }
                                        .bubble:nth-child(8) { 
                                            width: 140px; height: 140px; left: 55%; 
                                            animation: float2 24s infinite;
                                        }
                                        .bubble:nth-child(9) { 
                                            width: 90px; height: 90px; left: 75%; 
                                            animation: float1 17s infinite;
                                        }
                                        .bubble:nth-child(10) { 
                                            width: 170px; height: 170px; left: 95%; 
                                            animation: float2 26s infinite;
                                        }
                    
                                        @keyframes float1 {
                                            0% {
                                                transform: translateY(100vh) rotate(0deg) scale(1);
                                                opacity: 0;
                                            }
                                            10% {
                                                opacity: 0.5;
                                            }
                                            50% {
                                                transform: translateY(50vh) rotate(180deg) scale(1.2);
                                                opacity: 0.8;
                                            }
                                            90% {
                                                opacity: 0.5;
                                            }
                                            100% {
                                                transform: translateY(-100px) rotate(360deg) scale(1);
                                                opacity: 0;
                                            }
                                        }
                    
                                        @keyframes float2 {
                                            0% {
                                                transform: translateY(100vh) rotate(0deg) scale(0.8);
                                                opacity: 0;
                                            }
                                            20% {
                                                opacity: 0.4;
                                            }
                                            60% {
                                                transform: translateY(40vh) rotate(-180deg) scale(1.1);
                                                opacity: 0.7;
                                            }
                                            85% {
                                                opacity: 0.4;
                                            }
                                            100% {
                                                transform: translateY(-100px) rotate(-360deg) scale(0.8);
                                                opacity: 0;
                                            }
                                        }
    </style>
</head>
                    


<body>
    @if(Auth::user()->role === 'pembeli')
        <nav class="bg-gradient-to-r from-blue-300 to-purple-700 shadow-xl fixed w-full top-0 left-0 right-0 z-[60]">
            
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

    <main class="pt-16 bg-gradient-to-br from-slate-50 via-purple-500 to-slate-50 min-h-screen">
        <!-- Bubbles Background -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none z-[40]">
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

        <div class="container mx-auto px-4 py-12 z-[30]">
            <div class="max-w-5xl mx-auto">
                <!-- Form Card -->
                <div class=" backdrop-blur-xl rounded-[2.5rem] shadow-2xl overflow-hidden border border-white/30">

                    <!-- Header -->
                    <div class="bg-gradient-to-r from-violet-600 via-purple-600 to-indigo-600 px-12 py-12 relative overflow-hidden">
                        <div class="absolute inset-0">
                            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"30\" height=\"30\" viewBox=\"0 0 30 30\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cpath d=\"M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z\" fill=\"rgba(255,255,255,0.1)\"%3E%3C/path%3E%3C/svg%3E')] opacity-20"></div>
                        </div>
                        <div class="relative z-10 flex items-center justify-between">
                            <div>
                                <h1 class="text-4xl font-bold text-white mb-3">Edit Profile</h1>
                                <p class="text-purple-100 text-lg">Personalize your account information</p>
                            </div>
                            <div class="hidden md:block">
                                <i class="fas fa-user-edit text-6xl text-white/30"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-12">
                        <form action="{{ route(Auth::user()->role . '.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                                <!-- Left Column - Profile Photo -->
                                <div class="lg:col-span-1">
                                    <div class="text-center">
                                        <div class="relative group mx-auto w-48">
                                            @if($user->photo)
                                                <img src="{{ asset('storage/profile-photos/' . $user->photo) }}" 
                                                    alt="Current Profile Photo" 
                                                    class="w-48 h-48 rounded-2xl object-cover shadow-2xl group-hover:scale-105 transition-all duration-300 border-4 border-white">
                                            @else
                                                <img src="{{ asset('images/default-avatar.png') }}" 
                                                    alt="Default Profile" 
                                                    class="w-48 h-48 rounded-2xl object-cover shadow-2xl group-hover:scale-105 transition-all duration-300 border-4 border-white">
                                            @endif
                                            <label class="absolute bottom-4 right-4 bg-purple-600 hover:bg-purple-700 rounded-xl p-3 cursor-pointer shadow-lg transition-all duration-300 group-hover:scale-110">
                                                <i class="fas fa-camera text-white"></i>
                                                <input type="file" name="photo" class="hidden" onchange="showFileName(this)"/>
                                            </label>
                                        </div>
                                        <p id="fileName" class="mt-4 text-sm text-gray-500 font-medium"></p>
                                        @error('photo')
                                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Right Column - Form Fields -->
                                <div class="lg:col-span-2 space-y-8">
                                    <!-- Personal Information Section -->
                                    <div class="bg-gray-50/50 rounded-2xl p-6 backdrop-blur-sm border border-gray-100">
                                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Personal Information</h3>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <!-- Name -->
                                            <div class="relative">
                                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                                <div class="relative">
                                                    <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-purple-500"></i>
                                                    <input type="text" name="name" id="name" 
                                                        value="{{ old('name', $user->name) }}"
                                                        class="pl-12 block w-full rounded-xl border-0 bg-white/70 shadow-sm ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-purple-500 transition-all duration-300 py-3">
                                                </div>
                                                @error('name')
                                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Email -->
                                            <div class="relative">
                                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                                <div class="relative">
                                                    <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-purple-500"></i>
                                                    <input type="email" name="email" id="email" 
                                                        value="{{ old('email', $user->email) }}"
                                                        class="pl-12 block w-full rounded-xl border-0 bg-white/70 shadow-sm ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-purple-500 transition-all duration-300 py-3">
                                                </div>
                                                @error('email')
                                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Security Section -->
                                    <div class="bg-gray-50/50 rounded-2xl p-6 backdrop-blur-sm border border-gray-100">
                                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Security</h3>
                                        <p class="text-sm text-gray-500 mb-4">Leave password fields empty if you don't want to change it</p>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <!-- Password -->
                                            <div class="relative">
                                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password (Optional)</label>
                                                <div class="relative">
                                                    <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-purple-500"></i>
                                                    <input type="password" name="password" id="password"
                                                        class="pl-12 block w-full rounded-xl border-0 bg-white/70 shadow-sm ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-purple-500 transition-all duration-300 py-3">
                                                </div>
                                                @error('password')
                                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Password Confirmation -->
                                            <div class="relative">
                                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                                                <div class="relative">
                                                    <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-purple-500"></i>
                                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                                        class="pl-12 block w-full rounded-xl border-0 bg-white/70 shadow-sm ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-purple-500 transition-all duration-300 py-3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Address Section -->
                                    <div class="bg-gray-50/50 rounded-2xl p-6 backdrop-blur-sm border border-gray-100">
                                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Contact Details</h3>
                                        <div class="relative">
                                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                            <div class="relative">
                                                <i class="fas fa-home absolute left-4 top-4 text-purple-500"></i>
                                                <textarea name="address" id="address" rows="3" 
                                                    class="pl-12 block w-full rounded-xl border-0 bg-white/70 shadow-sm ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-purple-500 transition-all duration-300">{{ old('address', $user->address) }}</textarea>
                                            </div>
                                            @error('address')
                                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-12 flex justify-end space-x-4">
                                <a href="{{ route(Auth::user()->role . '.dashboard') }}" 
                                   class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-300 shadow-sm">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Back
                                </a>
                                <button type="submit" 
                                    class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-300 shadow-lg hover:shadow-xl"
                                    onclick="event.preventDefault(); 
                                            if(document.getElementById('password').value || document.getElementById('password_confirmation').value) {
                                                if(document.getElementById('password').value != document.getElementById('password_confirmation').value) {
                                                    alert('Password confirmation does not match!');
                                                    return false;
                                                }
                                                if(document.getElementById('password').value.length > 0 && document.getElementById('password').value.length < 8) {
                                                    alert('Password must be at least 8 characters!');
                                                    return false;
                                                }
                                            }
                                            this.closest('form').submit();">
                                    <i class="fas fa-save mr-2"></i>
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="mt-6">
                        <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-xl backdrop-blur-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-emerald-500 text-xl"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-emerald-700 font-medium">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
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