<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;
use App\Traits\ImageUploadTrait; // <-- 1. IMPORT TRAIT DI SINI

class TemplateController extends Controller
{
    use ImageUploadTrait; // <-- 2. PASTIKAN ANDA MENAMBAHKAN BARIS INI

    /**
     * Tampilkan semua template.
     */
    public function index()
    {
        $templates = Template::all();
        return view('templates.index', compact('templates'));
    }

    /**
     * Form tambah template baru.
     */
    public function create()
    {
        return view('templates.create');
    }

    /**
     * Simpan template baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'path_preview' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            'url' => 'required|string|max:255',

        ]);

        if ($request->hasFile('path_preview')) {
            // 3. GANTI SEMUA LOGIKA LAMA DENGAN SATU BARIS INI
            $path = $this->processImage(
                file: $request->file('path_preview'),
                directory: 'images/templates',
                prefix: 'template_',
                width: 1920,
                height: 1080,
                targetSizeKB: 300
            );
            $validated['path_preview'] = $path;
        }

        $template = Template::create($validated);
        Log::info('Template baru berhasil dibuat: ' . $template->name . ' (ID: ' . $template->id . ')');

        return redirect()->route('templates.index')
                         ->with('success', 'Template baru berhasil ditambahkan dan dikompres!');
    }

    public function destroy(Template $template)
    {
        $templateName = $template->name;
        $templateId = $template->id;

        // 1. Hapus file gambar dari storage jika ada
        if ($template->path_preview && Storage::disk('public')->exists($template->path_preview)) {
            Storage::disk('public')->delete($template->path_preview);
        }

        // 2. Hapus record dari database
        $template->delete();

        // 3. Catat log
        Log::info('Template berhasil dihapus: ' . $templateName . ' (ID: ' . $templateId . ')');

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->route('templates.index')
                        ->with('success', 'Template berhasil dihapus!');
    }
}
