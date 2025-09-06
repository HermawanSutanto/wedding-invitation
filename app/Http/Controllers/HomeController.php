<?php

namespace App\Http\Controllers;

use App\Models\Package;
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
        // Ambil semua paket yang aktif, urutkan berdasarkan harga
        $packages = Package::where('is_active', true)->orderBy('price')->get();
        // 2. Cari paket yang featured
        $featuredPackage = $packages->firstWhere('is_featured', true);

        // 3. Jika ada paket featured, atur ulang urutannya
        if ($featuredPackage) {
            // Ambil semua paket yang TIDAK featured
            // ->values() digunakan untuk mereset key array setelah filter
            $nonFeaturedPackages = $packages->where('is_featured', false)->values();
            
            // Tentukan titik tengah untuk membagi paket non-featured
            $splitPoint = floor($nonFeaturedPackages->count() / 2);

            // Bagi paket non-featured menjadi dua bagian
            $firstHalf = $nonFeaturedPackages->slice(0, $splitPoint);
            $secondHalf = $nonFeaturedPackages->slice($splitPoint);

            // 4. Gabungkan kembali dengan paket featured di tengah
            $sortedPackages = $firstHalf->push($featuredPackage)->concat($secondHalf);

        } else {
            // Jika tidak ada yang featured, gunakan urutan asli
            $sortedPackages = $packages;
        }
        return view('home', ['packages' => $sortedPackages]);
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