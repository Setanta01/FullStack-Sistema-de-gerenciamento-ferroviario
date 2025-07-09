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
        Schema::create('trems', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('tipo');
            $table->integer('ano_fabricacao')->nullable();
            $table->float('velocidade_maxima')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trems');
    }
};
