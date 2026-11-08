<!DOCTYPE html>
<html lang="pt-PT">
<head><title>Novo Assunto</title></head>
<body style="font-family: Arial; padding: 20px;">
    <h1>Cadastrar Assunto</h1>
    <form action="{{ route('assuntos.store') }}" method="POST">
        @csrf
        <label>Nome do Assunto:</label><br><br>
        <input type="text" name="nome_assunto" required style="padding: 8px; width: 300px;"><br><br>
        <button type="submit" style="padding: 10px; background: #28a745; color: white; border: none;">Salvar Assunto</button>
    </form>
</body>
</html>