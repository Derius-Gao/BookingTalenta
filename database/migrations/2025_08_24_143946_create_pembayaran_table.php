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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->foreignId('id_booking')->constrained('booking', 'id_booking')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users', 'id')->onDelete('cascade');
            $table->decimal('jumlah_harga', 10, 0);
            $table->enum('metode_pembayaran', ['cash', 'qris', 'gopay']);
            $table->enum('status_pembayaran', ['menunggu pembayaran', 'selesai', 'batal', 'menunggu verifikasi']);
            $table->string('bukti_pembayaran');
            $table->datetime('tanggal_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
