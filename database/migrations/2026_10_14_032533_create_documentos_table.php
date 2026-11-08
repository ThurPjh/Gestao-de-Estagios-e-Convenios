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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gaveta_id')->constrained('gavetas');
            $table->foreignId('curso_id')->constrained('cursos');
            $table->foreignId('assunto_id')->constrained('assuntos');
            $table->foreignId('aluno_id')->constrained('alunos');
            $table->string('titulo_documento');
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
