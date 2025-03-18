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
            $table->foreignId('user_id')->constrained('users'); // Tambahkan kolom user_id dengan foreign key ke tabel users
            $table->string('kategori');
            $table->enum('prioritas', ['Normal', 'Urgent', 'High']);
            $table->string('nomor_surat');
            $table->string('instansi')->default('Siber TNI AD');
            $table->string('surat_permintaan')->nullable();
            $table->json('dokumen_pendukung')->nullable();
            $table->text('catatan_tambahan')->nullable();
            $table->json('url_data')->nullable();
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