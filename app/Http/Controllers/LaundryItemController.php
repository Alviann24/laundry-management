<?php

namespace App\Http\Controllers;

use App\Models\LaundryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaundryItemController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan data
        return view('laundry_items.index'); // Pastikan file blade ada di resources/views/laundry_items/index.blade.php
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'price_per_kg' => 'nullable|numeric|min:0', // Validasi harga per kg
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar
        ]);
    
        $data = $request->only('name', 'price', 'price_per_kg');
    
        // Cek apakah ada gambar yang diupload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('laundry-images', 'public');
            $data['image'] = basename($imagePath); // Simpan nama gambar
        }
    
        LaundryItem::create($data);
    
        return redirect()->route('admin.dashboard')->with('success', 'Layanan laundry berhasil ditambahkan!');
    }
    

    // Controller
    public function create()
    {
        return view('admin.laundry.create'); // Kembali ke view untuk membuat laundry
    }


    public function edit($id)
    {
        $laundryItem = LaundryItem::findOrFail($id);
        return view('admin.laundry.edit', compact('laundryItem'));
    } 


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|numeric|min:0',
            'price_per_kg' => 'nullable|numeric|min:0',
        ]);

        $laundryItem = LaundryItem::findOrFail($id);
        
        // Siapkan data untuk update
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'price_per_kg' => $request->price_per_kg,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($laundryItem->image) {
                Storage::disk('public')->delete('laundry-images/' . $laundryItem->image);
            }

            // Upload gambar baru
            $imagePath = $request->file('image')->store('laundry-images', 'public');
            $data['image'] = basename($imagePath);
        }

        $laundryItem->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Layanan berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $laundryItem = LaundryItem::findOrFail($id);
        $laundryItem->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Layanan Laundry berhasil dihapus.');
    }
}
