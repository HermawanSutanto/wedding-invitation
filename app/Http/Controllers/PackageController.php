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
        // 1. Validasi data yang masuk dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'value' => 'nullable|numeric|gte:price', // gte:price -> value harus lebih besar atau sama dengan price
            'count_gallery' => 'required|integer|min:0',
        ]);

        // 2. Simpan data yang sudah divalidasi ke database
        Package::create($validated);

        // 3. Redirect ke halaman daftar paket dengan pesan sukses
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
        //
    }
}
