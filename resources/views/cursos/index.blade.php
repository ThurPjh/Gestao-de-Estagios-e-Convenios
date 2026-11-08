<!DOCTYPE html>
<html lang="pt-PT">
<head><title>Cursos</title></head>
<body style="font-family: Arial; padding: 20px;">
    <h1>Gestão de Cursos</h1>
    <a href="{{ route('cursos.create') }}" style="padding: 10px; background: #007bff; color: white; text-decoration: none;">+ Novo Curso</a>
    <table border="1" style="width: 100%; margin-top: 20px; border-collapse: collapse; text-align: left;">
        <tr><th>ID</th><th>Nome do Curso</th></tr>
        @foreach($cursos as $curso)
        <tr><td>{{ $curso->id }}</td><td>{{ $curso->nome_curso }}</td></tr>
        @endforeach
    </table>
</body>
</html>