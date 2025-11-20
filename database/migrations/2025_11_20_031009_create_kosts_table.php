<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kosts', function (Blueprint $table) {
            $table->id('id_kost');
            $table->unsignedBigInteger('id_user');
            $table->string('nama_kost', 150);
            $table->text('alamat_kost');
            $table->enum('jenis_kost', ['putra', 'putri', 'campur']);
            $table->text('deskripsi_kost')->nullable();
            $table->string('foto_kost')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kosts');
    }
};