<!DOCTYPE html>
<html lang="pt-PT">
<head><title>Novo Curso</title></head>
<body style="font-family: Arial; padding: 20px;">
    <h1>Cadastrar Curso</h1>
    <form action="{{ route('cursos.store') }}" method="POST">
        @csrf
        <label>Nome do Curso:</label><br><br>
        <input type="text" name="nome_curso" required style="padding: 8px; width: 300px;"><br><br>
        <button type="submit" style="padding: 10px; background: #28a745; color: white; border: none;">Salvar Curso</button>
    </form>
</body>
</html>