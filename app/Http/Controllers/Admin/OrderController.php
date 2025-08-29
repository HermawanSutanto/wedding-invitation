<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan undangan.
     */
    public function index()
    {
        // Ambil semua undangan dengan relasi user dan package, urutkan dari yang terbaru
        $invitations = Invitation::with(['user', 'package'])
            ->latest()
            ->paginate(15); // Gunakan paginate untuk data yang banyak

        return view('admin.orders.index', compact('invitations'));
    }

    /**
     * Mengubah status sebuah undangan.
     */
    public function updateStatus(Request $request, Invitation $invitation)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
        ]);

        $invitation->update(['status' => $validated['status']]);

        return back()->with('success', 'Status undangan berhasil diperbarui.');
    }
}