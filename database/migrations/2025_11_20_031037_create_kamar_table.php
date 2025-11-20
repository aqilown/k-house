<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kamars', function (Blueprint $table) {
            $table->id('id_kamar');
            $table->unsignedBigInteger('id_kost');
            $table->string('tipe_kamar', 100);
            $table->integer('jumlah_kamar')->default(1);
            $table->decimal('harga_kamar', 12, 2);
            $table->enum('status_kamar', ['tersedia', 'terisi']);
            $table->text('deskripsi_kamar')->nullable();
            $table->string('foto_kamar')->nullable();
            $table->timestamps();

            $table->foreign('id_kost')->references('id_kost')->on('kosts')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};