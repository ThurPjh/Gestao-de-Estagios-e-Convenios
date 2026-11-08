<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCA - UniAtenas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; color: #fff !important; }
    </style>
</head>
<body>

    <!-- Menu de Navegação -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('documentos.index') }}">SCA UniAtenas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('documentos.index') }}">Documentos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('emprestimos.index') }}">Empréstimos</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Cadastros Base</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('armarios.index') }}">Armários</a></li>
                            <li><a class="dropdown-item" href="{{ route('gavetas.index') }}">Gavetas</a></li>
                            <li><a class="dropdown-item" href="{{ route('cursos.index') }}">Cursos</a></li>
                            <li><a class="dropdown-item" href="{{ route('assuntos.index') }}">Assuntos</a></li>
                            <li><a class="dropdown-item" href="{{ route('alunos.index') }}">Alunos</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Área Central de Conteúdo -->
    <div class="container">
        @if(session('sucesso'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('sucesso') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>