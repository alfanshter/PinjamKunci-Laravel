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
        Schema::create('fasilitas_rfids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rfid'); // Kolom untuk kunci asing
            $table->foreign('id_rfid')->references('id')->on('rfids')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_fasilitas');
            $table->foreign('id_fasilitas')->references('id')->on('fasilitas_ruangans')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas_rfids');
    }
};
