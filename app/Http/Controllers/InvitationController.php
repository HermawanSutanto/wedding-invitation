<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Invitation;
use App\Models\Template;
use App\Traits\ImageUploadTrait; // <-- 1. IMPORT TRAIT DI SINI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage; // <-- DITAMBAHKAN
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Drivers\Gd\Driver; // <-- DITAMBAHKAN
use Intervention\Image\Encoders\WebpEncoder; // <-- DITAMBAHKAN
use Intervention\Image\ImageManager; // <-- DITAMBAHKAN

class InvitationController extends Controller
{
    use ImageUploadTrait; // <-- 2. PASTIKAN ANDA MENAMBAHKAN BARIS INI

    /**
     * Menampilkan daftar semua undangan milik pengguna.
     */
    public function index()
    {
        $invitations = Auth::user()->invitations()->latest()->get();
        // dd($invitations);
        return view('invitations.index', compact('invitations'));
    }
    public function show()
    {
        // Ambil undangan milik user yang sedang login
        // Untuk saat ini, kita asumsikan satu user hanya punya satu undangan
        $invitation = Auth::user()->invitations()->first();

        // Jika user belum punya undangan, arahkan ke halaman pilih template
        if (!$invitation) {
            // Logika untuk membuat undangan baru setelah pilih template
            // akan kita buat di langkah selanjutnya.
            // Untuk sekarang, kita arahkan saja.
            return redirect()->route('templates.index')
                ->with('info', 'Anda belum membuat undangan. Silakan pilih template terlebih dahulu.');
        }

        return view('invitations.form', compact('invitation'));
    }

    /**
     * Membuat draft undangan baru dari template.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'template_id' => 'required|exists:templates,id',
            'groom_name'  => 'required|string|max:255',
            'groom_info'  => 'required|string|max:255',
            'bride_name'  => 'required|string|max:255',
            'bride_info'  => 'required|string|max:255',
            'quote'       => 'nullable|string',
            'quote_source'=> 'nullable|string',
        ]);

        DB::transaction(function () use ($validated) {
            $invitation = Invitation::create([
                'user_id'     => Auth::id(),
                'template_id' => $validated['template_id'],
                'slug'        => 'undangan-' . Str::random(10),
                'groom_name'  => $validated['groom_name'],
                'groom_info'  => $validated['groom_info'],
                'bride_name'  => $validated['bride_name'],
                'bride_info'  => $validated['bride_info'],
                'quote'       => $validated['quote'] ?? null,
                'quote_source'=> $validated['quote_source'] ?? null,
            ]);

            // Bisa tambahkan default event
            $invitation->events()->create([
                'title'         => 'Akad Nikah',
                'event_date'    => now()->addMonth(),
                'start_time'    => '09:00',
                'venue_name'    => 'Lokasi',
                'venue_address' => 'Alamat lengkap',
            ]);
        });

        return redirect()->route('invitations.index')
                         ->with('success', 'Undangan baru berhasil dibuat!');
    }

       
    
    public function createFromTemplate(Template $template)
    {
        $invitation = Invitation::create([
            'user_id' => Auth::id(),
            'template_id' => $template->id,
            'slug' => 'undangan-' . Str::random(10),
            'groom_name' => 'Nama Mempelai Pria',
            'groom_info' => 'Putra dari Bpk. ... & Ibu. ...',
            'bride_name' => 'Nama Mempelai Wanita',
            'bride_info' => 'Putri dari Bpk. ... & Ibu. ...',
            'quote' => '"Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri..."',
            'quote_source' => 'QS. Ar-Rum: 21',
        ]);

        $invitation->events()->create([
            'title' => 'Akad Nikah',
            'event_date' => now()->addMonth(),
            'start_time' => '09:00',
            'venue_name' => 'Nama Lokasi',
            'venue_address' => 'Alamat Lengkap Lokasi',
        ]);

        $invitation->stories()->createMany([
        [
            'title' => 'Pertama Bertemu',
            'story_date' => 'Juni 2022',
            'description' => 'Kami bertemu di sebuah acara komunitas, sebuah awal yang tak terduga dari sebuah cerita indah.',
            'order' => 1
        ],
        [
            'title' => 'Lamaran',
            'story_date' => 'Desember 2024',
            'description' => 'Sebuah momen spesial saat sebuah pertanyaan dijawab dengan "Ya", mengikat janji untuk selamanya.',
            'order' => 2
        ],
    ]);
        
        return redirect()->route('invitation.edit', $invitation)
                         ->with('success', 'Draft undangan berhasil dibuat! Silakan lengkapi detailnya.');
    }

    /**
     * Menampilkan form untuk mengedit undangan.
     */
    public function edit(Invitation $invitation)
    {
        if ($invitation->user_id !== Auth::id()) {
            abort(403);
        }
        
        $invitation->load(['events', 'stories', 'galleries', 'gifts']);
        $storiesForAlpine = $invitation->stories->map(fn ($story) => $story->toArray())->values();

        // return view('invitations.edit', compact('invitation'));
        return view('invitations.edit', [
        'invitation' => $invitation,
        'stories' => $storiesForAlpine
    ]);
    }

    /**
     * Mengupdate detail undangan.
     */
    public function update(Request $request, Invitation $invitation)
    {
        if ($invitation->user_id !== Auth::id()) {
            abort(403);
        }

        try {
            // --- LANGKAH 1: VALIDASI SEMUA DATA SEKALIGUS ---
            $validated = $request->validate([
                'groom_name' => 'required|string|max:255',
                'groom_info' => 'required|string|max:255',
                'bride_name' => 'required|string|max:255',
                'bride_info' => 'required|string|max:255',
                'quote'      => 'nullable|string',
                'quote_source' => 'nullable|string',
                'slug'       => ['required', 'string', 'max:255', Rule::unique('invitations')->ignore($invitation->id)],
                'groom_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp',
                'bride_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
                'hero_image'  => 'nullable|image|mimes:jpeg,png,jpg,webp',
                'events'            => 'required|array',
                'events.*.title'    => 'required|string|max:255',
                'events.*.event_date' => 'required|date',
                'events.*.start_time' => 'required',
                'events.*.venue_name' => 'required|string|max:255',
                'events.*.venue_address' => 'required|string',
                'stories'                 => 'nullable|array',
                'stories.*.title'         => 'required_with:stories|string|max:255',
                'stories.*.story_date'    => 'required_with:stories|string|max:255',
                'stories.*.description'   => 'required_with:stories|string',
                'stories.*.order'         => 'required_with:stories|integer', // <-- TAMBAHKAN VALIDASI INI
                'gallery_images'   => 'nullable|array',
                'gallery_images.*' => 'image|mimes:jpeg,png,jpg,webp',
                'gifts'                       => 'nullable|array',
                'gifts.*.bank_name'           => 'required|string|max:255',
                'gifts.*.account_number'      => 'required|string|max:255',
                'gifts.*.account_holder_name'   => 'required|string|max:255',
                // Validasi untuk amplop baru
                'new_gift.bank_name'        => 'nullable|required_with:new_gift.account_number,new_gift.account_holder_name|string|max:255',
                'new_gift.account_number'     => 'nullable|required_with:new_gift.bank_name,new_gift.account_holder_name|string|max:255',
                'new_gift.account_holder_name'  => 'nullable|required_with:new_gift.bank_name,new_gift.account_number|string|max:255',

            ]);
        
        // --- LANGKAH 2: PROSES GAMBAR DAN TAMBAHKAN PATH KE ARRAY $validated ---

        if ($request->hasFile('groom_photo')) {
            if ($invitation->groom_photo_path) Storage::disk('public')->delete($invitation->groom_photo_path);
            $validated['groom_photo_path'] = $this->processImage($request->file('groom_photo'), 'images/invitations', 'groom_', 800, 800);
        }
        
        if ($request->hasFile('bride_photo')) {
            if ($invitation->bride_photo_path) Storage::disk('public')->delete($invitation->bride_photo_path);
            $validated['bride_photo_path'] = $this->processImage($request->file('bride_photo'), 'images/invitations', 'bride_', 800, 800);
        }
        if ($request->hasFile('cover_image')) {
            if ($invitation->cover_image) Storage::disk('public')->delete($invitation->cover_image);
            $validated['cover_image'] = $this->processImage($request->file('cover_image'), 'images/invitations', 'cover_', 1080, 1920);
        }
        if ($request->hasFile('hero_image')) {
            if ($invitation->hero_image) Storage::disk('public')->delete($invitation->hero_image);
            $validated['hero_image'] = $this->processImage($request->file('hero_image'), 'images/invitations', 'hero_', 1920, 1080);
        }

        // --- LANGKAH 3: UPDATE DATA UTAMA UNDANGAN ---
        // Menggunakan trik `getFillable()` untuk mengambil hanya data yang relevan untuk model Invitation
           DB::transaction(function () use ($invitation, $validated, $request) {
                // Update data utama undangan
                $invitation->update(
                    collect($validated)->only($invitation->getFillable())->all()
                );

                // Update setiap acara terkait
                if (isset($validated['events'])) {
                    foreach ($validated['events'] as $index => $eventData) {
                        if (isset($invitation->events[$index])) {
                            $invitation->events[$index]->update($eventData);
                        }
                    }
                }

                // Update setiap kisah cinta
                // if (isset($validated['stories'])) {
                //     foreach ($validated['stories'] as $storyId => $storyData) {
                //         $story = $invitation->stories()->find($storyId);
                //         if ($story) $story->update($storyData);
                //     }
                // }
                $storyDataFromRequest = $request->input('stories', []);
                $submittedStoryIds = [];

                foreach ($storyDataFromRequest as $storyData) {
                    if (!empty($storyData['id'])) {
                        // Jika ID ada, UPDATE cerita yang sudah ada
                        $story = $invitation->stories()->find($storyData['id']);
                        if ($story) {
                            $story->update($storyData);
                            $submittedStoryIds[] = $story->id;
                        }
                    } else {
                        // Jika ID tidak ada, CREATE cerita baru
                        $newStory = $invitation->stories()->create($storyData);
                        $submittedStoryIds[] = $newStory->id;
                    }
                }
                
                // Hapus cerita yang tidak ada dalam request (dihapus oleh user di form)
                $invitation->stories()->whereNotIn('id', $submittedStoryIds)->delete();
                // UPDATE BARU UNTUK AMPLOP DIGITAL
                if (isset($validated['gifts'])) {
                    foreach ($validated['gifts'] as $giftId => $giftData) {
                        $gift = $invitation->gifts()->find($giftId);
                        if ($gift) $gift->update($giftData);
                    }
                }
                
                // BUAT AMPLOP BARU JIKA DIISI
                if (!empty($validated['new_gift']['bank_name'])) {
                    $invitation->gifts()->create($validated['new_gift']);
                }

                // Proses upload foto galeri baru
                if ($request->hasFile('gallery_images')) {
                    foreach ($request->file('gallery_images') as $file) {
                        $path = $this->processImage($file, 'images/galleries', 'gallery_', 1280, 720);
                        $invitation->galleries()->create(['image_path' => $path, 'type' => 'gallery']);
                    }
                }
            });

            return back()->with('success', 'Detail undangan berhasil diperbarui!');
            dd($validated);
        } catch (\Exception $e) {
            // Catat error ke log untuk debugging
            Log::error('Gagal memperbarui undangan (ID: ' . $invitation->id . '): ' . $e->getMessage());

            // Kirim pesan error ke pengguna
            return back()->with('error', 'Terjadi kesalahan. Gagal memperbarui undangan. Silakan coba lagi.')
                         ->withInput(); // ->withInput() agar data yang sudah diisi tidak hilang
        }
    }

    public function destroy(Invitation $invitation)
    {
        // Keamanan: Pastikan user hanya bisa menghapus undangannya sendiri
        if ($invitation->user_id !== Auth::id()) {
            abort(403);
        }

        try {
            // 1. Hapus foto mempelai
            if ($invitation->groom_photo_path) {
                Storage::disk('public')->delete($invitation->groom_photo_path);
            }
            if ($invitation->bride_photo_path) {
                Storage::disk('public')->delete($invitation->bride_photo_path);
            }

            // 2. Hapus semua foto di galeri terkait
            foreach ($invitation->galleries as $galleryImage) {
                Storage::disk('public')->delete($galleryImage->image_path);
            }

            // 3. Hapus record undangan dari database
            // (Relasi lain seperti events, stories, dll akan terhapus otomatis karena onDelete('cascade'))
            $invitation->delete();

            Log::info('Undangan (ID: ' . $invitation->id . ') berhasil dihapus oleh user (ID: ' . Auth::id() . ')');

            return redirect()->route('invitation.index')
                             ->with('success', 'Undangan berhasil dihapus secara permanen.');

        } catch (\Exception $e) {
            Log::error('Gagal menghapus undangan (ID: ' . $invitation->id . '): ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus undangan.');
        }
    }
}