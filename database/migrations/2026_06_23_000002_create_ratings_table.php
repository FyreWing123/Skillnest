<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained()->cascadeOnDelete();
            $table->foreignId('umkm_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('mahasiswa_id')->constrained('users')->cascadeOnDelete();
            $table->tinyInteger('stars')->unsigned();
            $table->text('ulasan')->nullable();
            $table->timestamps();

            $table->unique('pesanan_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
