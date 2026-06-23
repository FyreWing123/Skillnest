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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama_usaha')->nullable()->after('skills');
            $table->string('kategori_usaha')->nullable()->after('nama_usaha');
            $table->string('no_whatsapp')->nullable()->after('kategori_usaha');
            $table->string('alamat_usaha')->nullable()->after('no_whatsapp');
            $table->text('deskripsi_usaha')->nullable()->after('alamat_usaha');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nama_usaha', 'kategori_usaha', 'no_whatsapp', 'alamat_usaha', 'deskripsi_usaha']);
        });
    }
};
