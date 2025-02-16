<?php

namespace App\Http\Controllers\Penjual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\LaundryItem;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;


class OrderController extends Controller
{
    // Tampilkan detail order berdasarkan ID
    public function show($id)
    {
        // Cari order berdasarkan ID dengan relasi laundryItems dan user
        $order = Order::with('laundryItems', 'customer')->findOrFail($id);

        return view('penjual.orders.show', compact('order'));
    }

    // Halaman dashboard untuk penjual
    public function index()
    {
        // Mengambil semua pengguna yang berperan sebagai pembeli
        $karyawan = User::where('role', 'pembeli')->get();
    
        // Mengambil semua layanan laundry
        $laundryItems = LaundryItem::all();
    
        // Pesanan aktif (belum dikonfirmasi atau dibatalkan)
        $orders = Order::whereNotIn('status', ['confirmed', 'canceled'])
            ->with(['customer', 'details'])
            ->get();
    
        // Riwayat pesanan (sudah dikonfirmasi)
        $historyOrders = Order::where('status', 'confirmed')
            ->with(['customer', 'details'])
            ->get();
    
        // Kirimkan semua data ke view
        return view('penjual.dashboard', compact('karyawan', 'orders', 'historyOrders', 'laundryItems'));
    }
    

    // Membuat pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'services' => 'required|array',
            'services.*' => 'exists:laundry_items,id',
        ]);

        // Buat order baru
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'total_price' => 0, // Akan dihitung ulang
            'status' => 'pending',
            'is_history' => false,
        ]);

        $totalPrice = 0;

        // Menambahkan setiap layanan ke order
        foreach ($request->services as $serviceId) {
            $quantity = $request->input("quantities.$serviceId", 0);
            $kg = $request->input("kg.$serviceId", 0);

            $laundryItem = LaundryItem::find($serviceId);
            $subtotal = ($laundryItem->price * $quantity) + ($laundryItem->price_per_kg * $kg);
            $totalPrice += $subtotal;

            // Menyimpan data di tabel pivot dengan menggunakan relasi 'details()'
            $order->details()->attach($serviceId, [
                'quantity' => $quantity,
                'weight' => $kg,
            ]);
        }

        // Update total harga di order
        $order->update(['total_price' => $totalPrice]);

        return redirect()->route('penjual.dashboard')->with('success', 'Order berhasil dibuat!');
    }

    // Konfirmasi pesanan
    public function confirm($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'confirmed';
        $order->save();
    
        return redirect()->route('penjual.dashboard')->with('success', 'Order berhasil dikonfirmasi');
    }
    

    // Membatalkan order
    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'canceled';
        $order->save();
    
        return redirect()->route('penjual.dashboard')->with('success', 'Order berhasil dibatalkan');
    }

    public function generateInvoice($id)
{
    $order = Order::with(['customer', 'details.laundryItem'])->findOrFail($id);

    $pdf = app('dompdf.wrapper')->loadView('invoice', compact('order'));

    return $pdf->download("invoice_{$order->id}.pdf");
}

    
}
