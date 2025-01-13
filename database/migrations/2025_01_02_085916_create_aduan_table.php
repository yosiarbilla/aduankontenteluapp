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
        Schema::create('aduan', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_id')->unique();
            $table->string('kategori');
            $table->enum('prioritas', ['Normal', 'Urgent', 'High']);
            $table->string('nomor_surat');
            $table->string('instansi')->default('Siber TNI AD');
            $table->string('surat_permintaan')->nullable();
            $table->text('dokumen_pendukung')->nullable();
            $table->text('catatan_tambahan')->nullable();
            $table->string('platform')->nullable();
            $table->string('url_link')->nullable();
            $table->string('screenshot')->nullable();
            $table->text('deskripsi_konten')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aduan');
    }
};
