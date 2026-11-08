<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>SCA - Gavetas</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        .btn { padding: 8px 12px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; }
        .alert { background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Gestão de Gavetas</h1>
    
    @if(session('sucesso'))
        <div class="alert">{{ session('sucesso') }}</div>
    @endif

    <a href="{{ route('gavetas.create') }}" class="btn">+ Nova Gaveta</a>
    <a href="{{ route('armarios.index') }}" class="btn" style="background: #6c757d;">Ver Armários</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Armário</th>
                <th>Gaveta</th>
                <th>Capacidade</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gavetas as $gaveta)
            <tr>
                <td>{{ $gaveta->id }}</td>
                <td>{{ $gaveta->armario->identificacao ?? 'Sem armário' }}</td>
                <td>{{ $gaveta->identificacao }}</td>
                <td>{{ $gaveta->capacidade_maxima }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>