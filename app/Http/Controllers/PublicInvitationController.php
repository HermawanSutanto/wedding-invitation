<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicInvitationController extends Controller
{
   

      public function show(Request $request, Invitation $invitation)
    {
        $guestName = $request->query('to', 'Tamu Undangan');
        $invitation->load(['package', 'events', 'stories', 'galleries', 'gifts', 'guestbooks']);
       // Kondisi 1: Jika undangan sudah dipublikasikan, semua orang bisa lihat.
        if ($invitation->status === 'published') {
            $invitation->load(['events', 'stories', 'galleries', 'gifts', 'guestbooks']);
            return view('templates.preview-classic-elegant', compact('invitation','guestName')); // Pastikan path view benar
        }

        // Kondisi 2: Jika undangan masih draft, hanya pemilik yang bisa lihat (untuk pratinjau).
        if ($invitation->status === 'draft' && Auth::check() && Auth::id() === $invitation->user_id) {
            $invitation->load(['events', 'stories', 'galleries', 'gifts', 'guestbooks']);
            return view('templates.preview-classic-elegant', compact('invitation','guestName')); 
            
        }
        
        // Kondisi 3 (BARU): Jika undangan masih draft dan diakses oleh tamu,
        // tampilkan halaman peringatan pembayaran/aktivasi.
        if ($invitation->status === 'draft') {
            return view('templates.payment-warning', compact('invitation'));
        }
        // Jika salah satu kondisi di atas terpenuhi, tampilkan halaman
        
        
        abort(404);
    }
}