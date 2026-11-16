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
        Schema::create('gavetas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('armario_id')->constrained('armarios'); // Chave Estrangeira
            $table->string('identificacao')->default('20');
            $table->integer('capacidade_maxima')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gavetas');
    }
};
