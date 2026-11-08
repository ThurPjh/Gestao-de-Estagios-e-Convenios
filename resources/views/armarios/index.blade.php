<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>SCA - Armários</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        .btn { padding: 8px 12px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; }
        .alert { background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Gestão de Armários</h1>
    
    @if(session('sucesso'))
        <div class="alert">{{ session('sucesso') }}</div>
    @endif

    <a href="{{ route('armarios.create') }}" class="btn">+ Novo Armário</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Identificação</th>
                <th>Data de Registo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($armarios as $armario)
            <tr>
                <td>{{ $armario->id }}</td>
                <td>{{ $armario->identificacao }}</td>
                <td>{{ $armario->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>