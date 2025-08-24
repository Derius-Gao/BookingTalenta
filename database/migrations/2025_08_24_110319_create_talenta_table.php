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
        Schema::create('talenta', function (Blueprint $table) {
            $table->id('id_talenta');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('no_hp', 15);
            $table->string('spesialisasi');
            $table->string('portfolio')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talenta');
    }
};
