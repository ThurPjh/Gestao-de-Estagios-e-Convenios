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
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('documento_id')->constrained('documentos');
            $table->foreignId('user_id')->constrained('users'); // Relaciona com a tabela de utilizadores nativa do Laravel
            $table->date('data_emprestimo');
            $table->date('data_devolucao')->nullable();
            $table->string('status')->default('Emprestado'); // Emprestado ou Devolvido
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprestimos');
    }
};
