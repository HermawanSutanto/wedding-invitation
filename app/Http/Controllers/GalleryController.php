<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    
    public function destroy(Gallery $gallery)
    {
        if ($gallery->invitation->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        try {
            if (Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $gallery->delete();

            Log::info('Foto galeri (ID: ' . $gallery->id . ') berhasil dihapus.');
            
            // GANTI REDIRECT DENGAN RESPONSE JSON
            return response()->json(['success' => true, 'message' => 'Foto berhasil dihapus!']);

        } catch (\Exception $e) {
            Log::error('Gagal menghapus foto galeri (ID: '. $gallery->id .'): ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal menghapus foto.'], 500);
        }
    }
}
