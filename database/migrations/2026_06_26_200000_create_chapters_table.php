<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id('id_chapter');
            $table->unsignedBigInteger('id_komik');
            $table->string('judul_chapter');
            $table->integer('nomor_chapter')->default(1);
            $table->text('deskripsi_chapter')->nullable();
            $table->timestamps();

            $table->foreign('id_komik')->references('id_komik')->on('komik')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
