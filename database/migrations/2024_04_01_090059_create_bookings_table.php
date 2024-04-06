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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user'); // Kolom untuk kunci asing
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_ruangan');
            $table->foreign('id_ruangan')->references('id')->on('ruangans')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_fasilitas');
            $table->foreign('id_fasilitas')->references('id')->on('fasilitas_ruangans')->onDelete('cascade')->onUpdate('cascade');
            $table->string('status',25)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
