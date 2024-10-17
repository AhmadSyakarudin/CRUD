<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan semua data pengguna.
     */
    public function index()
    {
        // Mengambil semua data pengguna
        $users = User::all();

        // Mengirim data ke view akun.index
        return view('akun.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form untuk membuat pengguna baru.
     */
    public function create()
    {
        // Mengarahkan ke view untuk membuat pengguna baru
        return view('akun.create');
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan data pengguna baru ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Email harus unik di tabel users
            'role' => 'required|in:admin,user', // Role hanya boleh 'admin' atau 'user'
            'password' => 'required|min:8', // Password minimal 8 karakter
        ]);

        // Proses penyimpanan pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role, // Mengambil role dari input form
            'password' => Hash::make($request->password), // Hash password sebelum disimpan
        ]);

        // Redirect kembali ke halaman form dengan pesan sukses
        return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form untuk mengedit data pengguna berdasarkan ID.
     */
    public function edit(string $id)
    {
        // Mengambil data pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Mengarahkan ke halaman edit dengan data pengguna yang ditemukan
        return view('akun.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * Mengupdate data pengguna yang sudah ada di database.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input dari form edit
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Email unik, tetapi abaikan email milik user saat ini
            'role' => 'required|in:admin,user', // Validasi role (admin atau user)
            'password' => 'nullable|min:8', // Password opsional, hanya jika ingin diubah
        ]);

        // Mengambil data pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Update data pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Cek apakah password diisi (jika diisi, lakukan hash)
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Simpan perubahan
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('akun.home')->with('success', 'Pengguna berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus pengguna berdasarkan ID.
     */
    public function destroy(string $id)
    {
        // Hapus pengguna berdasarkan ID
        User::where('id', $id)->delete();

        // Redirect kembali dengan pesan berhasil dihapus
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}

