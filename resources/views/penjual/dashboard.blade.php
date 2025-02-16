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

    <!-- Tambahkan CSS ini di dalam <head> atau file CSS terpisah -->

     /* Untuk browser berbasis Webkit (Chrome, Safari, Opera) */
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    /* Untuk Internet Explorer, Edge dan Firefox */
    .hide-scrollbar {
        -ms-overflow-style: none;  /* IE dan Edge */
        scrollbar-width: none;     /* Firefox */
    }

    .transparent-card {
            background-color: rgba(255, 255, 255, 0.381);
            border-radius: 15px;
            backdrop-filter: blur(5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    * {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }

</style>

</head>

<body class="bg-gradient-to-br from-indigo-200 to-purple-300 min-h-screen overflow-auto hide-scrollbar">

    <!-- Navbar Penjual -->
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
                                                            <a href="{{ route('penjual.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">
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
                                            <a href="{{ route('penjual.profile') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50">Profile</a>
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

    <!-- Main Content -->
    <div class="container mx-auto px-4 pt-24 pb-12">


        <!-- Success Alert -->
        @if (session('success'))
            <div id="success-alert" class="mb-8 bg-green-100 border-l-4 border-green-500 p-4 rounded-lg shadow-sm" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-green-700">{{ session('success') }}</p>
                    </div>
                    <button type="button" onclick="closeAlert()" class="ml-auto">
                        <i class="fas fa-times text-green-700"></i>
                    </button>
                </div>
            </div>
        @endif

        <!-- Create Order Section -->
        <div class="transparent-card rounded-xl shadow-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                <i class="fas fa-plus-circle text-blue-500 mr-2"></i>Buat Order Baru
            </h2>

            <form action="{{ route('penjual.orders.store') }}" method="POST" id="order-form">
                @csrf
                
                <!-- Customer Selection -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="customer_id">
                        Pilih Pembeli
                    </label>
                    <select class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            id="customer_id" name="customer_id" required>
                        <option value="">Pilih Pembeli</option>
                        @foreach ($karyawan as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Laundry Services -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-semibold mb-4">
                        Layanan Laundry
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($laundryItems as $item)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                                <img src="{{ asset('storage/laundry-images/' . $item->image) }}"
                                     onerror="this.src='{{ asset('images/default.jpg') }}'"
                                     alt="{{ $item->name }}"
                                     class="w-full h-48 object-cover rounded-t-xl">
                                
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg text-gray-800 mb-2">{{ $item->name }}</h3>
                                    
                                    <div class="space-y-2 mb-4">
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Per Item:</span> 
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Per Kg:</span> 
                                            Rp {{ number_format($item->price_per_kg, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    <!-- Service Selection -->
                                    <label class="flex items-center space-x-3 mb-4">
                                        <input type="checkbox" 
                                               class="laundry-service form-checkbox h-5 w-5 text-blue-500"
                                               id="item-{{ $item->id }}"
                                               name="services[]"
                                               value="{{ $item->id }}"
                                               data-price="{{ $item->price }}"
                                               data-price-per-kg="{{ $item->price_per_kg }}">
                                        <span class="text-gray-700">Pilih Layanan</span>
                                    </label>

                                    <!-- Quantity Inputs -->
                                    <div class="space-y-3">
                                        <div class="quantity-container d-none" id="quantity-container-{{ $item->id }}">
                                            <label class="block text-sm text-gray-600 mb-1">Jumlah Item</label>
                                            <input type="number"
                                                   class="quantity-input w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500"
                                                   id="quantity-{{ $item->id }}"
                                                   name="quantities[{{ $item->id }}]"
                                                   min="1"
                                                   placeholder="0">
                                        </div>

                                        <div class="kg-container d-none" id="kg-container-{{ $item->id }}">
                                            <label class="block text-sm text-gray-600 mb-1">Berat (Kg)</label>
                                            <input type="number"
                                                   class="kg-input w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500"
                                                   id="kg-{{ $item->id }}"
                                                   name="kg[{{ $item->id }}]"
                                                   min="0"
                                                   step="0.1"
                                                   placeholder="0.0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Total Price -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <div class="flex justify-between items-center">
                        <label class="text-lg font-semibold text-gray-700">Total Harga:</label>
                        <input type="text"
                               class="bg-transparent text-xl font-bold text-blue-600 text-right"
                               id="total_price"
                               name="total_price"
                               value="Rp. 0"
                               readonly>
                    </div>
                </div>

                <button type="submit"
                        id="submit-order"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                    <i class="fas fa-paper-plane mr-2"></i>Buat Order
                </button>
            </form>
        </div>

        <!-- Order List Section -->
        <div class="container mx-auto px-6 py-8 ">
            <header class="mb-10">
                <h2 class="text-4xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-list text-blue-500 mr-3"></i> Daftar Order
                </h2>
                <p class="text-gray-600 mt-2">Kelola dan pantau setiap order dengan mudah</p>
            </header>
        
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($orders as $order)
                    <div class="bg-white rounded-xl shadow-md border-l-4 transition-all duration-300 hover:shadow-xl
                        @if($order->status === 'pending') border-blue-400
                        @elseif($order->status === 'confirmed') border-green-400
                        @elseif($order->status === 'cancelled') border-red-400
                        @endif">
                        
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-xl font-semibold text-gray-700">Order #{{ $order->id }}</span>
                                <span class="px-3 py-1 text-sm font-medium rounded-full
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'confirmed') bg-green-100 text-green-800
                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                    @endif">
                                    <i class="fas fa-circle mr-1"></i> {{ ucfirst($order->status) }}
                                </span>
                            </div>
        
                            <p class="text-gray-600 mb-3">
                                <i class="fas fa-user text-blue-400 mr-2"></i>
                                Pembeli: <span class="font-medium">{{ $order->user?->name ?? 'Tidak ada data' }}</span>
                            </p>
                            
                            <div class="mb-4">
                                <p class="text-gray-600 mb-1">
                                    <i class="fas fa-box text-green-400 mr-2"></i> Layanan:
                                </p>
                                <ul class="ml-6 list-disc text-gray-700">
                                    @foreach ($order->laundryItems as $item)
                                        <li class="text-sm">
                                            <span class="font-medium">{{ $item->name }}</span>
                                            @if($item->pivot->quantity > 0)
                                                ({{ $item->pivot->quantity }} item)
                                            @endif
                                            @if($item->pivot->weight > 0)
                                                ({{ $item->pivot->weight }} kg)
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
        
                            <p class="text-gray-700 mb-6">
                                <i class="fas fa-money-bill text-green-500 mr-2"></i>
                                Total: <span class="font-semibold text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </p>
        
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('penjual.orders.show', $order->id) }}" 
                                   class="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-lg hover:bg-blue-600 transition">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                
                                <form action="{{ route('penjual.orders.cancel', $order->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition">
                                        <i class="fas fa-times-circle"></i> Batal
                                    </button>
                                </form>
                                
                                <form action="{{ route('penjual.orders.confirm', $order->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-green-500 text-white text-sm font-medium rounded-lg hover:bg-green-600 transition">
                                        <i class="fas fa-check-circle"></i> Konfirmasi
                                    </button>
                                </form>
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
        </div>
        
        
          
    </div>

    <!-- Script untuk menghitung total harga secara dinamis -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Fungsi untuk menghitung total harga
            function calculateTotal() {
                let total = 0;
    
                document.querySelectorAll('.laundry-service').forEach(checkbox => {
                    const serviceId = checkbox.id.split('-')[1];
                    const quantityInput = document.getElementById(`quantity-${serviceId}`);
                    const kgInput = document.getElementById(`kg-${serviceId}`);
                    const price = parseInt(checkbox.dataset.price || 0);
                    const pricePerKg = parseInt(checkbox.dataset.pricePerKg || 0);
    
                    const quantity = parseInt(quantityInput.value || 0); // Default ke 0 jika kosong
                    const kg = parseFloat(kgInput.value || 0); // Default ke 0 jika kosong
    
                    // Jika checkbox dipilih
                    if (checkbox.checked) {
                        quantityInput.classList.remove('d-none');
                        kgInput.classList.remove('d-none');
    
                        // Perhitungan untuk harga per item
                        if (quantity > 0) {
                            total += price * quantity;
                        }
    
                        // Perhitungan untuk harga per kg
                        if (kg > 0) {
                            total += pricePerKg * kg;
                        }
                    } else {
                        quantityInput.classList.add('d-none');
                        kgInput.classList.add('d-none');
    
                        // Reset input
                        quantityInput.value = '';
                        kgInput.value = '';
                    }
                });
    
                // Update nilai total harga
                document.getElementById('total_price').value = total > 0 ? `Rp. ${total.toLocaleString('id-ID')}` : '';
            }
    
            // Event listener untuk checkbox
            document.querySelectorAll('.laundry-service').forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const serviceId = this.id.split('-')[1];
                    const quantityContainer = document.getElementById(`quantity-container-${serviceId}`);
                    const kgContainer = document.getElementById(`kg-container-${serviceId}`);
    
                    if (this.checked) {
                        quantityContainer.classList.remove('d-none');
                        kgContainer.classList.remove('d-none');
                    } else {
                        quantityContainer.classList.add('d-none');
                        kgContainer.classList.add('d-none');
                    }
    
                    calculateTotal();
                });
            });
    
            // Event listener untuk input jumlah item dan kg
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('input', calculateTotal);
            });
    
            document.querySelectorAll('.kg-input').forEach(input => {
                input.addEventListener('input', calculateTotal);
            });

            // Event listener for the "Buat Order" button
            document.getElementById('submit-order').addEventListener('click', function (event) {
                event.preventDefault(); // Prevent the default form submission
                document.getElementById('order-form').submit(); // Submit the form programmatically
            });

            // Ensure there are no JavaScript errors
            console.log('JavaScript loaded successfully.');
        });

        function closeAlert() {
            document.getElementById('success-alert').style.display = 'none';
        }
    </script>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endsection