<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaundryItem;
use App\Models\Order;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class PenjualController extends Controller
{
    public function index()
    {
        $karyawan = User::where('role', 'pembeli')->get(); // Menarik semua pembeli
        $laundryItems = LaundryItem::all(); // Semua layanan laundry
        $orders = Order::with('laundryItems')->get(); // Semua order
     
        return view('penjual.dashboard', compact('karyawan', 'laundryItems', 'orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'services' => 'required|array',
            'services.*' => 'exists:laundry_items,id',
            'quantities' => 'array',
            'weights' => 'array',
            'total_price' => 'required|numeric|min:0',
        ]);
    
        // Simpan order baru
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'total_price' => $request->total_price,
        ]);
    
        // Tambahkan layanan ke order
        foreach ($request->services as $serviceId) {
            $laundryItem = LaundryItem::findOrFail($serviceId);
    
            $quantity = $request->quantities[$serviceId] ?? 0;
            $weight = $request->weights[$serviceId] ?? 0;
    
            $price = $laundryItem->price;
            if ($laundryItem->price_per_kg && $weight > 0) {
                $price = $laundryItem->price_per_kg * $weight;
            }
    
            $order->laundryItems()->attach($serviceId, [
                'quantity' => $quantity,
                'weight' => $weight,
                'price' => $price,
            ]);
        }
    
        return redirect()->route('penjual.dashboard')->with('success', 'Pesanan berhasil dibuat.');
    }    
    
    public function edit($id)
    {
        $laundryItem = LaundryItem::findOrFail($id);
        return view('penjual.edit-laundry', compact('laundryItem'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $laundryItem = LaundryItem::findOrFail($id);
        $laundryItem->update($request->all());
        return redirect()->route('penjual.dashboard')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $laundryItem = LaundryItem::findOrFail($id);
        $laundryItem->delete();
        return redirect()->route('penjual.dashboard')->with('success', 'Layanan berhasil dihapus.');
    }

    public function createOrder()
    {
        // Ambil data pengguna dengan role 'pembeli'
        $karyawan = User::where('role', 'pembeli')->get(); // Sesuaikan dengan nama kolom 'role' Anda
        $laundryItems = LaundryItem::all();
    
        return view('penjual.create-order', compact('karyawan', 'laundryItems'));
    }       

    public function storeOrder(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'services' => 'required|array',
            'services.*' => 'exists:laundry_items,id',
            'total_price' => 'required|numeric',
        ]);
    
        try {
            $order = Order::create([
                'created_by' => Auth::id(),
                'customer_id' => $request->customer_id,
                'status' => 'diproses',
                'total_price' => $request->total_price,
            ]);
    
            foreach ($request->services as $serviceId) {
                $order->laundryItems()->attach($serviceId, [
                    'quantity' => $request->quantities[$serviceId] ?? 0,
                    'weight' => $request->kg[$serviceId] ?? 0,
                ]);
            }
    
            return redirect()->back()->with('success', 'Order berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }    

    public function confirmOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'diproses']);
        return redirect()->route('penjual.dashboard')->with('success', 'Pesanan telah diproses.');
    }

    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'batal']);
        return redirect()->route('penjual.dashboard')->with('success', 'Pesanan dibatalkan.');
    }
}