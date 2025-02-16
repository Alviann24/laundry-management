<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Model untuk data pesanan
use App\Models\LaundryItem; // Model untuk layanan laundry
use App\Models\User; // Model untuk data pengguna

class PenjualOrderController extends Controller
{
    /**
     * Fungsi untuk menampilkan halaman dashboard penjual.
     */
    public function index()
    {
        // Ambil semua pembeli (role: customer)
        $karyawan = User::where('role', 'customer')->get();

        // Ambil semua layanan laundry yang tersedia
        $laundryItems = LaundryItem::all();

        // Ambil semua pesanan yang dibuat oleh penjual yang sedang login
        $orders = Order::where('created_by', auth()->id())->get();

        // Kirim data ke tampilan dashboard penjual
        return view('penjual.dashboard', compact('karyawan', 'laundryItems', 'orders'));
    }

    /**
     * Fungsi untuk menyimpan pesanan baru.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'customer_id' => 'required|exists:users,id', // ID pembeli harus ada di tabel users
            'services' => 'required|array', // Layanan laundry harus berupa array
            'services.*' => 'exists:laundry_items,id', // Setiap ID layanan harus valid
            'quantities' => 'nullable|array', // Kuantitas opsional
            'quantities.*' => 'nullable|integer|min:1', // Harus angka minimal 1
            'kg' => 'nullable|array', // Berat opsional
            'kg.*' => 'nullable|numeric|min:0', // Harus angka minimal 0
        ]);

        // Hitung total harga
        $totalPrice = 0;
        $services = $request->input('services'); // Ambil layanan dari input

        foreach ($services as $serviceId) {
            $quantity = $request->input("quantities.$serviceId", 0); // Kuantitas
            $kg = $request->input("kg.$serviceId", 0); // Berat (kg)

            // Ambil detail layanan dari database
            $item = LaundryItem::find($serviceId);
            if ($item) {
                // Tambahkan harga berdasarkan kuantitas dan berat
                $totalPrice += ($item->price * $quantity) + ($item->price_per_kg * $kg);
            }
        }

        // Simpan pesanan ke database
        $order = Order::create([
            'customer_id' => $request->customer_id, // ID pembeli
            'created_by' => auth()->id(), // ID penjual yang sedang login
            'total_price' => $totalPrice, // Total harga pesanan
            'status' => 'pending', // Status awal pesanan
        ]);

        // Tambahkan layanan ke pesanan
        foreach ($services as $serviceId) {
            $quantity = $request->input("quantities.$serviceId", 0);
            $kg = $request->input("kg.$serviceId", 0);

            // Simpan detail layanan terkait pesanan
            $order->laundryItems()->attach($serviceId, [
                'quantity' => $quantity,
                'kg' => $kg,
            ]);
        }

        // Redirect ke halaman dashboard penjual dengan pesan sukses
        return redirect()->route('penjual.dashboard')->with('success', 'Pesanan berhasil dibuat.');
    }
}
