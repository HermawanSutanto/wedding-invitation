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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke user
            $table->foreignId('template_id')->constrained(); // Relasi ke template
            $table->string('groom_name'); // Nama mempelai pria
            $table->string('groom_info');
            $table->string('bride_name'); // Nama mempelai wanita
            $table->string('bride_info');
            $table->string('groom_photo_path')->nullable();
            $table->string('bride_photo_path')->nullable();
            $table->text('quote')->nullable();//ganti dari quran_quote
            $table->string('quote_source')->nullable();//ganti dari quran_surah
            $table->string('slug')->unique(); // URL unik, cth: "budi-dan-wati"
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->string('cover_image')->nullable();
            $table->string('hero_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
