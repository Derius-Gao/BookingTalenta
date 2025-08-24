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
        Schema::create('booking', function (Blueprint $table) {
            $table->id('id_booking');
            $table->foreignId('id_user')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('id_talenta')->constrained('talenta', 'id_talenta')->onDelete('cascade');
            $table->foreignId('id_portfolio')->constrained('portfolio', 'id_portfolio')->onDelete('cascade');
            $table->string('deskripsi_acara');
            $table->string('lokasi_acara');
            $table->decimal('jumlah_harga', 10, 0);
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
