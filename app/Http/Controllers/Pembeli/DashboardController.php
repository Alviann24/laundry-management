<?php

namespace App\Http\Controllers\Pembeli;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::where('customer_id', auth()->id())
        ->where('status', 'pending')
        ->get();

        // $orders = Order::whereNotIn('status', ['confirmed', 'canceled'])
        // ->with(['customer', 'details'])
        // ->get();


        // Ambil data riwayat pesanan untuk pembeli yang sedang login
        $historyOrders = Order::where('customer_id', auth()->id())
            ->where('status', 'confirmed','selesai')
            ->with('details', 'laundryItems')
            ->get();

        return view('pembeli.dashboard', compact('historyOrders', 'orders'));
    }



}
