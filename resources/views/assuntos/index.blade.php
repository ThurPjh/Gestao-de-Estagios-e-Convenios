<!DOCTYPE html>
<html lang="pt-PT">
<head><title>Assuntos</title></head>
<body style="font-family: Arial; padding: 20px;">
    <h1>Gestão de Assuntos</h1>
    <a href="{{ route('assuntos.create') }}" style="padding: 10px; background: #007bff; color: white; text-decoration: none;">+ Novo Assunto</a>
    <table border="1" style="width: 100%; margin-top: 20px; border-collapse: collapse; text-align: left;">
        <tr><th>ID</th><th>Nome do Assunto</th></tr>
        @foreach($assuntos as $assunto)
        <tr><td>{{ $assunto->id }}</td><td>{{ $assunto->nome_assunto }}</td></tr>
        @endforeach
    </table>
</body>
</html>