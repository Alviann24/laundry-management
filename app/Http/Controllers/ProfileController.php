<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        \Log::info('Update Profile Request:', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'address' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = Auth::user();
        $data = $request->only(['name', 'email', 'address']);

        if ($request->hasFile('photo')) {
            \Log::info('Ada file foto yang diupload');
            
            // Hapus foto lama jika ada
            if ($user->photo && Storage::exists('public/profile-photos/' . $user->photo)) {
                \Log::info('Menghapus foto lama: ' . $user->photo);
                Storage::delete('public/profile-photos/' . $user->photo);
            }

            // Upload foto baru
            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            \Log::info('Nama file foto baru: ' . $photoName);
            
            // Pastikan folder exists
            if (!Storage::exists('public/profile-photos')) {
                Storage::makeDirectory('public/profile-photos');
            }

            try {
                // Simpan file dengan cara yang lebih eksplisit
                $photo->move(storage_path('app/public/profile-photos'), $photoName);
                \Log::info('Foto berhasil disimpan ke: ' . storage_path('app/public/profile-photos/' . $photoName));
                
                // Verifikasi file tersimpan
                if (file_exists(storage_path('app/public/profile-photos/' . $photoName))) {
                    \Log::info('File terverifikasi ada di storage');
                    $data['photo'] = $photoName;
                } else {
                    \Log::error('File tidak ditemukan setelah upload');
                }
            } catch (\Exception $e) {
                \Log::error('Error saat menyimpan foto: ' . $e->getMessage());
            }
        }

        \Log::info('Data yang akan diupdate:', $data);
        $updated = $user->update($data);
        \Log::info('Status update:', ['success' => $updated]);
        \Log::info('User setelah update:', $user->toArray());

        return redirect()->route(Auth::user()->role . '.profile')->with('success', 'Profile berhasil diperbarui');
    }
}