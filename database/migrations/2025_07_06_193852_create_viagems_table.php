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
        Schema::create('viagems', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data_partida');
            $table->dateTime('data_chegada');
            $table->foreignId('estacao_origem_id')->constrained('estacaos')->onDelete('cascade');
            $table->foreignId('estacao_destino_id')->constrained('estacaos')->onDelete('cascade');
            $table->foreignId('trem_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viagems');
    }
};
