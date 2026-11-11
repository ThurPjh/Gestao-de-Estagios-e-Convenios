<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Curso;
use App\Models\Assunto;
use App\Models\Armario;
use App\Models\Gaveta;
use App\Models\Aluno;
use App\Models\Documento;
use App\Models\Emprestimo;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Criar Utilizadores (Users)
        $user1 = User::create(['name' => 'Administrador', 'email' => 'admin@uniatenas.br', 'password' => bcrypt('123456')]);
        $user2 = User::create(['name' => 'João (Secretaria)', 'email' => 'joao@uniatenas.br', 'password' => bcrypt('123456')]);

        // 2. Criar Cursos
        $cursos = [
            Curso::create(['nome_curso' => 'Medicina']),
            Curso::create(['nome_curso' => 'Direito']),
            Curso::create(['nome_curso' => 'Sistemas de Informação']),
            Curso::create(['nome_curso' => 'Administração']),
            Curso::create(['nome_curso' => 'Enfermagem']),
        ];

        // 3. Criar Assuntos
        $assuntos = [
            Assunto::create(['nome_assunto' => 'Termo de Compromisso']),
            Assunto::create(['nome_assunto' => 'Relatório de Estágio']),
            Assunto::create(['nome_assunto' => 'Termo Aditivo']),
            Assunto::create(['nome_assunto' => 'Rescisão de Contrato']),
        ];

        // 4. Criar Armários e Gavetas (3 Armários, cada um com 4 Gavetas)
        $gavetas = [];
        for ($i = 1; $i <= 3; $i++) {
            $armario = Armario::create(['identificacao' => 'Armário ' . chr(64 + $i)]); // Armário A, B, C
            for ($j = 1; $j <= 4; $j++) {
                $gavetas[] = Gaveta::create([
                    'armario_id' => $armario->id,
                    'identificacao' => 'Gaveta 0' . $j
                ]);
            }
        }

        // 5. Criar 15 Alunos Fictícios
        $alunos = [];
        for ($i = 0; $i < 15; $i++) {
            $alunos[] = Aluno::create([
                'matricula_aluno' => fake()->unique()->numerify('2026####'),
                'nome_aluno' => fake()->name()
            ]);
        }

        // 6. Criar 50 Documentos Aleatórios
        $documentos = [];
        for ($i = 0; $i < 50; $i++) {
            $documentos[] = Documento::create([
                'titulo_documento' => 'Processo Estágio ' . fake()->numerify('###/2026'),
                'aluno_id' => fake()->randomElement($alunos)->id,
                'curso_id' => fake()->randomElement($cursos)->id,
                'assunto_id' => fake()->randomElement($assuntos)->id,
                'gaveta_id' => fake()->randomElement($gavetas)->id,
                'observacoes' => fake()->optional()->sentence()
            ]);
        }

        // 7. Criar 15 Empréstimos (Alguns ativos, outros devolvidos)
        for ($i = 0; $i < 15; $i++) {
            $status = fake()->randomElement(['Emprestado', 'Devolvido']);
            $dataEmprestimo = fake()->dateTimeBetween('-2 months', 'now');
            
            Emprestimo::create([
                'documento_id' => fake()->randomElement($documentos)->id,
                'user_id' => fake()->randomElement([$user1->id, $user2->id]),
                'data_emprestimo' => $dataEmprestimo,
                'data_devolucao' => $status === 'Devolvido' ? Carbon::instance($dataEmprestimo)->addDays(rand(1, 10)) : null,
                'status' => $status
            ]);
        }
    }
}