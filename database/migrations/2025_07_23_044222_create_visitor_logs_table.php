<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorLogsTable extends Migration
{
    public function up()
    {
        Schema::create('visitor_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps(); // ini akan menyimpan created_at untuk pencatatan waktu kunjungan
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitor_logs');
    }
}
