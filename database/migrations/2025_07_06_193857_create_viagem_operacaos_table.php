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
        Schema::create('viagem_operacaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('viagem_id')->constrained()->onDelete('cascade');
            $table->foreignId('trem_id')->constrained()->onDelete('cascade');
            $table->foreignId('maquinista_id')->constrained()->onDelete('cascade');
            $table->string('turno');
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viagem_operacaos');
    }
};
