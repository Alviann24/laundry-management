<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan form untuk mengedit pengguna
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Menyimpan perubahan pengguna
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,penjual,pembeli',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'role' => $request->role,
        ]);

         // Flash message untuk sukses
         session()->flash('success', 'Pengguna berhasil diperbarui!');

        return redirect()->route('admin.dashboard')->with('success', 'Pengguna berhasil diupdate');
    }

    // Menghapus pengguna
    public function destroy(User $user)
    {
        $user->delete();

         // Flash message untuk sukses
         session()->flash('success', 'Pengguna berhasil dihapus!');

        return redirect()->route('admin.dashboard')->with('success', 'Pengguna berhasil dihapus');
    }
}
