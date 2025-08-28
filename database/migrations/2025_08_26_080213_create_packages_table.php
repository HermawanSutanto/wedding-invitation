<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama paket, contoh: "Paket Gold"
            $table->decimal('price', 10, 2); // Harga jual setelah diskon
            $table->decimal('value', 10, 2)->nullable(); // Harga asli sebelum diskon (opsional)
            $table->unsignedInteger('count_gallery')->default(0); // Jumlah galeri foto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
