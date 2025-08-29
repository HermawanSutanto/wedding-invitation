<?php

use \App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicInvitationController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;








/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Menjadi baris ini
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/classic-elegant', function () {
    return view('templates.preview-classic-elegant');
})->name('templates.classic-elegant');

Route::get('/dashboard', [HomeController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// routes/web.php
Route::get('/undangan/{invitation:slug}', [PublicInvitationController::class, 'show'])
    ->name('invitation.public.show');
Route::get('/undangan/{invitation:slug}', [PublicInvitationController::class, 'show'])
    ->name('invitation.public.show');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/templates', [TemplateController::class, 'index'])->name('templates.index');
    // Route BARU untuk menampilkan FORM tambah template
    Route::get('/templates/create', [TemplateController::class, 'create'])->name('templates.create');

    // Route BARU untuk MENYIMPAN data dari form
    Route::post('/templates', [TemplateController::class, 'store'])->name('templates.store');
    Route::delete('/templates/{template}', [TemplateController::class, 'destroy'])->name('templates.destroy');

    
    Route::get('/invitations', [InvitationController::class, 'index'])->name('invitation.index');

     // Route untuk menampilkan halaman form "Undangan Saya"
    Route::get('/invitations/show', [InvitationController::class, 'show'])->name('invitation.show');
    // Route     menampilkan halaman EDIT satu undangan spesifik
    Route::get('/invitations/{invitation}/edit', [InvitationController::class, 'edit'])->name('invitation.edit');
    // Route untuk memproses update dari form
    Route::put('/invitations/{invitation}', [InvitationController::class, 'update'])->name('invitation.update');
    Route::post('/invitations', [InvitationController::class, 'store'])->name('invitation.store');

    Route::delete('/invitations/{invitation}', [InvitationController::class, 'destroy'])->name('invitation.destroy');

    //package
    Route::post('/invitations/create/{template}', [InvitationController::class, 'createFromTemplate'])->name('invitation.createFromTemplate');

    Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

      // Route BARU untuk menghapus satu amplop digital
    Route::delete('/gifts/{gift}', [GiftController::class, 'destroy'])->name('gift.destroy');

    Route::get('/invitations/create/{template}/packages', [InvitationController::class, 'showPackageSelection'])->name('invitation.packages');


});
Route::middleware(['auth'])->group(function () {
    Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
    Route::get('/packages/create', [PackageController::class, 'create'])->name('packages.create');
    Route::post('/packages/create/store', [PackageController::class, 'store'])->name('packages.store');
    Route::delete('/packages/{package})', [PackageController::class, 'destroy'])->name('packages.destroy');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    
    Route::patch('/orders/{invitation}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

});
    
require __DIR__.'/auth.php';
