<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Nova Gaveta</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        form { max-width: 400px; display: flex; flex-direction: column; gap: 10px; }
        input, select, button { padding: 10px; font-size: 16px; }
        button { background: #28a745; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Cadastrar Nova Gaveta</h1>

    <form action="{{ route('gavetas.store') }}" method="POST">
        @csrf
        
        <label for="armario_id">Selecione o Armário:</label>
        <select name="armario_id" id="armario_id" required>
            <option value="">-- Escolha um armário --</option>
            @foreach($armarios as $armario)
                <option value="{{ $armario->id }}">{{ $armario->identificacao }}</option>
            @endforeach
        </select>

        <label for="identificacao">Identificação da Gaveta:</label>
        <input type="text" name="identificacao" id="identificacao" placeholder="Ex: Gaveta 01" required>

        <label for="capacidade_maxima">Capacidade Máxima (Qtd. Documentos):</label>
        <input type="number" name="capacidade_maxima" id="capacidade_maxima" placeholder="Ex: 50">
        
        <button type="submit">Salvar Gaveta</button>
    </form>
    <br>
    <a href="{{ route('gavetas.index') }}">Voltar</a>
</body>
</html>