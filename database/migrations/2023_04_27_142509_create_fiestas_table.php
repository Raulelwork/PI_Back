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
        Schema::create('fiestas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_tematica');
            $table->unsignedBigInteger('id_musica');
            $table->unsignedBigInteger('id_empresa');
            $table->dateTime('fecha');
            $table->string('foto',255);
            $table->boolean('eliminado');
            $table->foreign('id_tematica')->references('id')->on('tematicas');
            $table->foreign('id_musica')->references('id')->on('musicas');
            $table->foreign('id_empresa')->references('id')->on('empresas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiestas');
    }
};
