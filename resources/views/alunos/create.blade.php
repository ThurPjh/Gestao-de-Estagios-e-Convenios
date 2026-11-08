<!DOCTYPE html>
<html lang="pt-PT">
<head><title>Novo Aluno</title></head>
<body style="font-family: Arial; padding: 20px;">
    <h1>Cadastrar Aluno</h1>
    
    <form action="{{ route('alunos.store') }}" method="POST" style="display: flex; flex-direction: column; max-width: 300px; gap: 15px;">
        @csrf
        
        <div>
            <label>Matrícula do Aluno:</label><br>
            <input type="text" name="matricula_aluno" placeholder="Ex: 20231005" required style="padding: 8px; width: 100%;">
        </div>

        <div>
            <label>Nome Completo:</label><br>
            <input type="text" name="nome_aluno" placeholder="Ex: João Silva" required style="padding: 8px; width: 100%;">
        </div>
        
        <button type="submit" style="padding: 10px; background: #28a745; color: white; border: none; cursor: pointer;">Salvar Aluno</button>
    </form>
    <br>
    <a href="{{ route('alunos.index') }}">Voltar à lista</a>
</body>
</html>