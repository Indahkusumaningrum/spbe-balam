<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
    Schema::table('indikators', function (Blueprint $table) {
        $table->year('tahun')->after('penjelasan');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('indikators', function (Blueprint $table) {
            //
        });
    }
};
