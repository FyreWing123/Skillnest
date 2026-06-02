<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('universitas')->nullable()->after('nickname');
            $table->string('jurusan')->nullable()->after('universitas');
            $table->string('semester')->nullable()->after('jurusan');
            $table->text('bio')->nullable()->after('semester');
            $table->text('skills')->nullable()->after('bio');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['universitas', 'jurusan', 'semester', 'bio', 'skills']);
        });
    }
};
