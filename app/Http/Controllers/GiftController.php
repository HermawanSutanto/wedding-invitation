<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GiftController extends Controller
{
    //
    public function destroy(Gift $gift)
    {
        // Keamanan: Pastikan user hanya bisa menghapus dari undangannya sendiri
        if ($gift->invitation->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        try {
            $gift->delete();
            Log::info('Gift (ID: ' . $gift->id . ') berhasil dihapus.');
            return response()->json(['success' => true, 'message' => 'Amplop digital berhasil dihapus!']);

        } catch (\Exception $e) {
            Log::error('Gagal menghapus gift (ID: '. $gift->id .'): ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal menghapus amplop.'], 500);
        }
    }
}
