<?php

namespace App\Http\Controllers;

use \stdClass;
use App\Models\Invitation;
use App\Models\Template;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicInvitationController extends Controller
{
    public function show(Request $request, Invitation $invitation)
    {
        // 1. Ambil data yang dibutuhkan sekali saja di awal.
        $invitation->load(['template', 'package', 'events', 'stories', 'galleries', 'gifts', 'guestbooks']);
        $guestName = $request->query('to', 'Tamu Undangan');
        $viewPath = 'templates.preview-' . $invitation->template->url;
        $isPreview = false;
        // 2. Cek apakah view template ada. Jika tidak, langsung 404.
        if (!view()->exists($viewPath)) {
            abort(404, 'Template view not found.');
        }

        // 3. Tentukan apakah pengguna boleh melihat undangan ini.
        $canView = false;
        if ($invitation->status === 'published') {
            $canView = true; // Siapapun boleh lihat jika sudah publish
        } elseif ($invitation->status === 'draft' && Auth::check() && Auth::id() === $invitation->user_id) {
            $canView = true; // Pemilik boleh lihat jika masih draft (untuk preview)
        }

        // 4. Jika boleh melihat, tampilkan undangannya.
        if ($canView) {
            return view($viewPath, compact('invitation', 'guestName','isPreview'));
        }

        // 5. Jika masih draft dan diakses orang lain, tampilkan halaman peringatan.
        if ($invitation->status === 'draft') {
            return view('templates.payment-warning', compact('invitation'));
        }

        // 6. Jika tidak ada kondisi yang cocok (misal statusnya 'archived', dll), 404.
        abort(404);
    }

    // Method `preview` tidak perlu diubah, sudah bagus.
    public function preview(Template $template)
    {
        $viewPath = 'templates.preview-' . $template->url;

        if (!view()->exists($viewPath)) {
            abort(404, 'Template not found.');
        }

        // Buat instance Invitation dummy (tidak disimpan ke DB)
        $invitation = new Invitation([
            'groom_name'   => 'Nama Mempelai Pria',
            'groom_info'   => 'Putra dari Bpk. ... & Ibu. ...',
            'bride_name'   => 'Nama Mempelai Wanita',
            'bride_info'   => 'Putri dari Bpk. ... & Ibu. ...',
            'quote'        => '"Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan..."',
            'quote_source' => 'QS. Ar-Rum: 21',
        ]);

        // Dummy relasi events
        $invitation->setRelation('events', collect([
            new \App\Models\Event([
                'title'            => 'Akad Nikah',
                'event_date'       => now()->addMonth(),
                'start_time'       => '09:00',
                'venue_name'       => 'Nama Lokasi',
                'venue_address'    => 'Alamat Lengkap Lokasi',
                'dress_code_colors'=> '#ffffff',
                'google_maps_link' => 'https://maps.app.goo.gl/63BiY7vrDoH53mU9A',
                'livestream_link'  => 'https://www.youtube.com/watch?v=36ggFM3Dju8',
            ])
        ]));

        // Dummy relasi stories
        $invitation->setRelation('stories', collect([
            new \App\Models\Story([
                'title'       => 'Pertama Bertemu',
                'story_date'  => 'Juni 2022',
                'description' => 'Kami bertemu di sebuah acara komunitas...',
                'order'       => 1,
            ]),
            new \App\Models\Story([
                'title'       => 'Lamaran',
                'story_date'  => 'Desember 2024',
                'description' => 'Momen spesial ketika pertanyaan itu dijawab dengan "Ya"...',
                'order'       => 2,
            ]),
        ]));
        $dummyGifts = collect([
                        (object) [
                            'bank_name' => 'Bank Central Asia (BCA)', 
                            'account_number' => '1234567890', 
                            'account_holder_name' => 'Aditya & Kirana'
                        ],
                        (object) [
                            'bank_name' => 'Bank Mandiri', 
                            'account_number' => '0987654321', 
                            'account_holder_name' => 'Aditya & Kirana'
                        ],
                    ]);
                    
      $dummyGuest = collect([
                        (object) [
                            'name'=> 'Budi Santoso', 'attendance_status'=> 'Hadir', 'message'=> 'Selamat menempuh hidup baru! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah. Aamiin.', 'created_at'=> now()->subHours(5)
        
                        ],
                        (object) [
                            'name'=> 'Citra Lestari', 'attendance_status'=> 'Hadir', 'message'=> 'Happy wedding! Semoga cinta kalian abadi selamanya. Turut berbahagia.', 'created_at'=> now()->subHours(5)

                        ],
                    ]);
        // Relasi lain kosong dulu
        $invitation->setRelation('galleries', collect([]));
        $invitation->setRelation('gifts', $dummyGifts);
        $invitation->setRelation('guestbooks', $dummyGuest);
        
        // Package dummy
        $dummyPackage = new \App\Models\Package([
            'has_love_story'    => true,
            'has_rsvp'          => true,
            'has_music'         => true,
            'has_live_streaming'=> true,
            'count_gallery'     => 5,
        ]);
        $invitation->setRelation('package', $dummyPackage);

        // Template relasi
        $invitation->setRelation('template', $template);

        $guestName = "Nama Tamu Undangan";
        $isPreview = true;

        return view($viewPath, compact('invitation', 'guestName','isPreview'));
    }

    
}