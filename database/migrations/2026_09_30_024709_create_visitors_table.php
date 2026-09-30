<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
      Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('email')->nullable();
            $table->text('keperluan');
            $table->string('divisi_tujuan');
            $table->date('tanggal_kunjungan');
            $table->time('jam_kunjungan'); // Kolom Baru: Jam
            $table->enum('temu_janji', ['Sudah Janji', 'Belum Janji'])->default('Belum Janji'); // Kolom Baru: Janji
            $table->enum('status', ['Menunggu', 'Selesai'])->default('Menunggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};