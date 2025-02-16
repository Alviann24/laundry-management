<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\LaundryItem;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all(); // Ambil semua data pengguna
        $laundryItems = LaundryItem::all(); // Ambil semua layanan laundry
        $orders = Order::with('user', 'laundryItems')->get(); // Ambil semua pesanan beserta pengguna dan layanan laundry
        $totalTransactions = Order::sum('total_price'); // Jumlah total transaksi
        $totalOrders = Order::count(); // Jumlah pesanan

        return view('admin.dashboard', compact('users', 'laundryItems', 'orders', 'totalTransactions', 'totalOrders'));
    }


    public function dashboard()
    {
        $orders = Order::with(['details.laundryItem', 'user'])->get();
        $totalTransactions = Order::sum('total_price');
        $totalOrders = Order::count();

        return view('admin.dashboard', compact('orders', 'totalTransactions', 'totalOrders'));
    }

    
    public function showUsers()
    {
        $users = User::all();
        dd($users); // Cek apakah role ada di dalam data
        return view('admin.dashboard', compact('users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'price_per_kg' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        LaundryItem::create([
            'name' => $request->name,
            'price' => $request->price,
            'price_per_kg' => $request->price_per_kg,
            'image' => $request->file('image') ? $request->file('image')->store('laundry-images') : null,
        ]);
    
        return redirect()->route('laundry.index')->with('success', 'Layanan berhasil ditambahkan.');
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'price_per_kg' => 'nullable|numeric|min:0',
        ]);
    
        $laundryItem = LaundryItem::findOrFail($id);
        $laundryItem->update([
            'name' => $request->name,
            'price' => $request->price,
            'price_per_kg' => $request->price_per_kg,
        ]);
    
        return redirect()->route('laundry.index')->with('success', 'Layanan berhasil diperbarui.');
    }
    

    public function manageOrders()
    {
        $orders = Order::with('user', 'laundryItems')->get();
        return view('admin.manage-orders', compact('orders'));
    }


    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);
        return redirect()->route('admin.orders.index')->with('success', 'Status pesanan diperbarui.');
    }

}