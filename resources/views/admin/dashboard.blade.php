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


        <div class="min-h-screen bg-gradient-to-br from-blue-300 to-purple-200">
            <div class="container mx-auto px-4 py-8">
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg">
                        <h3 class="text-lg font-semibold opacity-80">Total Transaksi</h3>
                        <p class="text-2xl font-bold mt-2">Rp. {{ number_format($totalTransactions, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-2xl p-6 text-white shadow-lg">
                        <h3 class="text-lg font-semibold opacity-80">Jumlah Pesanan</h3>
                        <p class="text-2xl font-bold mt-2">{{ $totalOrders }}</p>
                    </div>
                </div>

                <!-- Main Content Sections -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Users Section -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-bold text-gray-800">Kelola Pengguna</h2>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                                + Tambah User
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">ID</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Nama</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Email</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Role</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($users as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 text-sm text-gray-600">{{ $user->id }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600">{{ $user->name }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600">{{ $user->email }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600">
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm space-x-2">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" 
                                            class="text-blue-500 hover:text-blue-600">Edit</a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-600">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Laundry Services Section -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-bold text-gray-800">Layanan Laundry</h2>
                            <a href="{{ route('admin.laundry.create') }}" 
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                                + Tambah Layanan
                            </a>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($laundryItems as $item)
                            <div class="bg-gray-50 rounded-xl p-4">
                                <div class="flex items-center space-x-4">
                                    @if ($item->image)
                                    <img src="{{ asset('storage/laundry-images/' . $item->image) }}" 
                                        class="w-20 h-20 object-cover rounded-lg"
                                        alt="{{ $item->name }}"
                                        onerror="this.src='{{ asset('images/no-image.png') }}'">
                                    @else
                                    <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <span class="text-gray-400">No Image</span>
                                    </div>
                                    @endif
                                    <div>
                                        <h3 class="font-semibold text-gray-800">{{ $item->name }}</h3>
                                        <p class="text-sm text-gray-600">Rp. {{ number_format($item->price, 0, ',', '.') }}/item</p>
                                        @if ($item->price_per_kg)
                                        <p class="text-sm text-gray-600">Rp. {{ number_format($item->price_per_kg, 0, ',', '.') }}/kg</p>
                                        @endif
                                        <div class="mt-2 space-x-2">
                                            <a href="{{ route('admin.laundry.edit', $item->id) }}" 
                                            class="text-blue-500 hover:text-blue-600 text-sm">Edit</a>
                                            <form action="{{ route('admin.laundry.destroy', $item->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-600 text-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Orders Section -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 lg:col-span-2">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Pesanan Terbaru</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">ID</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Pelanggan</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Layanan</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Total</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($orders as $order)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 text-sm text-gray-600">#{{ $order->id }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600">{{ $order->user->name }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600">
                                            @foreach ($order->laundryItems as $item)
                                            <div class="text-sm">
                                                {{ $item->name }} 
                                                @if($item->pivot->quantity)
                                                <span class="text-gray-500">({{ $item->pivot->quantity }} item)</span>
                                                @endif
                                                @if($item->pivot->weight)
                                                <span class="text-gray-500">({{ $item->pivot->weight }} kg)</span>
                                                @endif
                                            </div>
                                            @endforeach
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-600">
                                            Rp. {{ number_format($order->total_price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                                @csrf 
                                                @method('PUT')
                                                <select name="status" 
                                                        onchange="this.form.submit()" 
                                                        class="rounded-full px-3 py-1 text-sm
                                                            @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                                            @else bg-green-100 text-green-800 @endif">
                                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>
                                                        Pending
                                                    </option>
                                                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>
                                                        Completed
                                                    </option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>

</body>

<!-- Tambahkan CSS Tailwind dan Alpine.js -->
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    // Mobile menu toggle
    document.querySelector('.mobile-menu-button').addEventListener('click', function() {
        document.querySelector('.mobile-menu').classList.toggle('hidden');
    });
</script>
@endsection
