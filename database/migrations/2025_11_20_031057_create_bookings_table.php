<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('id_booking');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_kamar');
            $table->date('tanggal_booking');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('durasi_booking');
            $table->decimal('total_harga', 12, 2);
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status_booking', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_kamar')->references('id_kamar')->on('kamars')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};