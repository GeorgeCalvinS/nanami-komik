<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chapter_pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_chapter');
            $table->integer('page_number')->default(1);
            $table->string('file_path');
            $table->timestamps();

            $table->foreign('id_chapter')->references('id_chapter')->on('chapters')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chapter_pages');
    }
};
