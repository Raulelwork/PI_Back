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
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_fiesta');
            $table->integer('precio');
            $table->integer('consumiciones');
            $table->boolean('eliminado');
            $table->integer('aforo');
            $table->string('tipo',255);
            $table->foreign('id_fiesta')->references('id')->on('fiestas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
