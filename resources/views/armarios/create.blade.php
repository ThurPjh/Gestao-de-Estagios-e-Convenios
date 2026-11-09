<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Novo Armário</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        form { max-width: 400px; display: flex; flex-direction: column; gap: 10px; }
        input, button { padding: 10px; font-size: 16px; }
        button { background: #28a745; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Cadastrar Novo Armário</h1>

    <form action="{{ route('armarios.store') }}" method="POST">
        @csrf <!-- Proteção obrigatória do Laravel -->

        <label for="identificacao">Identificação do Armário:</label>
        <input type="text" name="identificacao" id="identificacao" placeholder="Ex: Armário A - Sala 2" required>

        <button type="submit">Salvar Armário</button>
    </form>
    <br>
    <a href="{{ route('armarios.index') }}">Voltar</a>
</body>
</html>
