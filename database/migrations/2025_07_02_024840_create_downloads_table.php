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
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('title');
            $table->text('content');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    public function down():void 
    {
        Schema::dropIfExists('downloads');
    }

};
