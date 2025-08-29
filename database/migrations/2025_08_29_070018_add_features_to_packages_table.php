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
        Schema::table('packages', function (Blueprint $table) {
            $table->unsignedInteger('max_guests')->default(50)->after('count_gallery');
            $table->boolean('has_love_story')->default(false)->after('max_guests');
            $table->boolean('has_music')->default(false)->after('has_love_story');
            $table->boolean('has_rsvp')->default(false)->after('has_music');
            $table->boolean('has_live_streaming')->default(false)->after('has_rsvp');
            $table->boolean('is_featured')->default(false)->after('has_live_streaming');
            $table->boolean('is_active')->default(true)->after('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            //
        });
    }
};
