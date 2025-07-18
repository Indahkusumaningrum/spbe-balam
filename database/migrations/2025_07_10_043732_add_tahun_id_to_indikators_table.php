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
        Schema::table('indikators', function (Blueprint $table) {
            // $table->unsignedBigInteger('tahun_id')->nullable(); // tambahkan kolom tapi tanpa FK
            $table->foreign('tahun_id')->references('id')->on('tahuns')->onDelete('cascade');

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('indikators', function (Blueprint $table) {
            $table->dropColumn('tahun_id');
        });
    }
};
