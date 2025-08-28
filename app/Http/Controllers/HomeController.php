<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman beranda.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Tampilkan halaman dashboard (memerlukan otentikasi).
     *
     * @return \Illuminate\View\View
     */
     public function dashboard()
    {
        // 1. Ambil pengguna yang sedang login
        $user = Auth::user();

        // 2. Ambil undangan TERBARU milik pengguna, beserta relasi guestbooks
        $invitation = $user->invitations()->with('guestbooks', 'events')->latest()->first();
        
        // 3. Siapkan variabel untuk dikirim ke view
        $data = [
            'invitation' => $invitation,
        ];

        // 4. Jika undangan ada, hitung statistik RSVP
        if ($invitation) {
            $guestbooks = $invitation->guestbooks;
            $data['totalRsvp'] = $guestbooks->count();
            $data['attendingCount'] = $guestbooks->where('attendance_status', 'Hadir')->count();
            $data['notAttendingCount'] = $guestbooks->where('attendance_status', 'Tidak Hadir')->count();
        }
        
        // 5. Kirim semua data ke view
        return view('dashboard', $data);
    }
}