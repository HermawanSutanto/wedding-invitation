<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data paket, urutkan dari yang terbaru
        $packages = Package::latest()->get();
        return view('packages.index', compact('packages'));
    }

    /**
     * Menampilkan form untuk membuat paket baru.
     */
    public function create()
    {
        return view('packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'value' => 'nullable|numeric|gte:price',
            'count_gallery' => 'required|integer|min:0',
            'max_guests' => 'required|integer|min:0',
            'has_love_story' => 'nullable|boolean',
            'has_music' => 'nullable|boolean',
            'has_rsvp' => 'nullable|boolean',
            'has_live_streaming' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        // Menangani checkbox yang tidak dicentang (tidak akan dikirim dalam request)
        $validated['has_love_story'] = $request->has('has_love_story');
        $validated['has_music'] = $request->has('has_music');
        $validated['has_rsvp'] = $request->has('has_rsvp');
        $validated['has_live_streaming'] = $request->has('has_live_streaming');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        Package::create($validated);

        return redirect()->route('packages.index')
                        ->with('success', 'Paket baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        try {
            $packageName = $package->name;
            $package->delete();

            return redirect()->route('packages.index')
                             ->with('success', "Paket '{$packageName}' berhasil dihapus.");

        } catch (\Exception $e) {
            Log::error('Gagal menghapus paket (ID: '. $package->id .'): ' . $e->getMessage());
            
            return back()->with('error', 'Gagal menghapus paket. Terjadi kesalahan.');
        }
    }
}
