<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookmark', function (Blueprint $table) {
            $table->id('ID_Bookmark');
            $table->unsignedBigInteger('ID_Pengguna');
            $table->unsignedBigInteger('ID_Komik');
            
            $table->foreign('ID_Pengguna')->references('ID_User')->on('pengguna')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookmark');
    }
};