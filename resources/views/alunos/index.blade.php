<!DOCTYPE html>
<html lang="pt-PT">
<head><title>SCA - Alunos</title></head>
<body style="font-family: Arial; padding: 20px;">
    <h1>Gestão de Alunos</h1>
    
    @if(session('sucesso'))
        <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px;">{{ session('sucesso') }}</div>
    @endif

    <a href="{{ route('alunos.create') }}" style="padding: 10px; background: #007bff; color: white; text-decoration: none;">+ Novo Aluno</a>
    
    <table border="1" style="width: 100%; margin-top: 20px; border-collapse: collapse; text-align: left;">
        <tr>
            <th style="padding: 10px;">ID</th>
            <th style="padding: 10px;">Matrícula</th>
            <th style="padding: 10px;">Nome do Aluno</th>
        </tr>
        @foreach($alunos as $aluno)
        <tr>
            <td style="padding: 10px;">{{ $aluno->id }}</td>
            <td style="padding: 10px;">{{ $aluno->matricula_aluno }}</td>
            <td style="padding: 10px;">{{ $aluno->nome_aluno }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>