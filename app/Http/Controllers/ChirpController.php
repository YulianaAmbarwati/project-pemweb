<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Penting untuk fungsi authorize

class ChirpController extends Controller
{
    use AuthorizesRequests; // Tambahkan trait ini jika Laravel versi terbaru kamu memintanya

    /**
     * Menampilkan daftar chirp.
     */
    public function index()
    {
        $chirps = Chirp::with('user')
            ->latest()
            ->take(50) 
            ->get();

        return view('home', ['chirps' => $chirps]);
    }

    /**
     * Menyimpan chirp baru ke database menggunakan user yang login.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ], [
            'message.required' => 'Please write something to chirp!',
            'message.max' => 'Chirps must be 255 characters or less.',
        ]);

        // SEBELUMNYA: Chirp::create(['user_id' => null])
        // SEKARANG: Otomatis mengisi user_id dari akun yang sedang login
        auth()->user()->chirps()->create($validated);

        return redirect('/')->with('success', 'Your chirp has been posted!');
    }

    /**
     * Menampilkan halaman edit dengan proteksi keamanan.
     */
    public function edit(Chirp $chirp)
    {
        // Cek apakah user yang login punya hak akses untuk edit chirp ini
        $this->authorize('update', $chirp);

        return view('chirps.edit', compact('chirp'));
    }

    /**
     * Menyimpan perubahan ke database dengan proteksi keamanan.
     */
    public function update(Request $request, Chirp $chirp)
    {
        // Proteksi agar user lain tidak bisa asal nembak request update via URL/Postman
        $this->authorize('update', $chirp);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $chirp->update($validated);

        return redirect('/')->with('success', 'Chirp updated!');
    }

    /**
     * Menghapus chirp dari database dengan proteksi keamanan.
     */
    public function destroy(Chirp $chirp)
    {
        // Proteksi agar user hanya bisa hapus miliknya sendiri
        $this->authorize('delete', $chirp);

        $chirp->delete();

        return redirect('/')->with('success', 'Chirp deleted!');
    }

    public function create() {}
    public function show(string $id) {}
}