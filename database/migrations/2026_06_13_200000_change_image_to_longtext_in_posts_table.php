<?php
// database/migrations/2026_06_13_200000_change_image_to_longtext_in_posts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Ubah kolom image dari string (path) ke longText (base64 data URI)
            $table->longText('image')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
        });
    }
};
