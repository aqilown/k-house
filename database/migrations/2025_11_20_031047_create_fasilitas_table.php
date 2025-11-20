<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id('id_fasilitas');
            $table->unsignedBigInteger('id_kost');
            $table->string('nama_fasilitas', 100);
            $table->string('icon', 50)->nullable();
            $table->text('deskripsi_fasilitas')->nullable();
            $table->string('foto_fasilitas')->nullable();
            $table->timestamps();

            $table->foreign('id_kost')->references('id_kost')->on('kosts')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};