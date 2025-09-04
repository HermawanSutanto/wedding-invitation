<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class GuestbookController extends Controller
{
    public function store(Request $request, Invitation $invitation)
    {
        try {
            $validated = $request->validate([
                'name'              => 'required|string|max:255',
                'attendance_status' => ['required', Rule::in(['Hadir', 'Tidak Hadir'])],
                'message'           => 'required|string|max:500',
            ]);

            $guestbookEntry = $invitation->guestbooks()->create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Ucapan berhasil dikirim!',
                'entry'   => $guestbookEntry // Kirim kembali data yang baru dibuat
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('RSVP submission failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan, silakan coba lagi.'], 500);
        }
    }
}