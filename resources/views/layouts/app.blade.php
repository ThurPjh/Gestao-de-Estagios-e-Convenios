<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCA · Setor de Estágios e Convênios</title>
    
    <!-- Fonte técnica padrão para sistemas administrativos -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 e Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 250px;
            --navy-institucional: #0d2140;
            --navy-border: #17325c;
            --accent-blue: #1a56db;
            --bg-app: #f4f5f7;
            --border-subtle: #dfe1e6;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--bg-app);
            color: #1f2937;
            font-size: 0.925rem;
            margin: 0;
        }

        /* Estrutura Principal */
        .app-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Institucional */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--navy-institucional);
            color: #e2e8f0;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            border-right: 1px solid #081529;
        }

        .sidebar-brand {
            padding: 1.25rem 1.25rem;
            border-bottom: 1px solid var(--navy-border);
        }

        .sidebar-brand .sigla {
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            color: #ffffff;
            display: block;
            line-height: 1.2;
        }

        .sidebar-brand .subtitulo {
            font-size: 0.75rem;
            color: #94a3b8;
            display: block;
            margin-top: 2px;
        }

        .sidebar-nav {
            padding: 1rem 0.75rem;
            flex-grow: 1;
            overflow-y: auto;
        }

        .nav-section-label {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #64748b;
            padding: 0.75rem 0.75rem 0.35rem;
        }

        .sidebar .nav-link {
            color: #cbd5e1;
            font-weight: 500;
            font-size: 0.88rem;
            padding: 0.55rem 0.75rem;
            border-radius: 4px;
            margin-bottom: 2px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background-color 0.15s ease, color 0.15s ease;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.07);
            color: #ffffff;
        }

        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.12);
            color: #ffffff;
            font-weight: 600;
            border-left: 3px solid #60a5fa;
            padding-left: calc(0.75rem - 3px);
        }

        .sidebar-foot {
            padding: 0.9rem 1.1rem;
            border-top: 1px solid var(--navy-border);
            background-color: #091830;
            font-size: 0.78rem;
            color: #94a3b8;
        }

        /* Área de Conteúdo */
        .main-content {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .topbar {
            background-color: #ffffff;
            border-bottom: 1px solid var(--border-subtle);
            padding: 0.75rem 1.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.82rem;
            color: #6b7280;
        }

        .content-container {
            padding: 1.75rem;
            max-width: 1400px;
            width: 100%;
        }

        /* Sobrescrita Global do Bootstrap para Visual Corporativo Sóbrio */
        .card {
            border: 1px solid var(--border-subtle) !important;
            box-shadow: none !important;
            border-radius: 6px !important;
            background-color: #ffffff;
        }

        .card-header {
            background-color: #fafbfc !important;
            border-bottom: 1px solid var(--border-subtle) !important;
            padding: 0.9rem 1.25rem;
        }

        .card-footer {
            background-color: #fafbfc !important;
            border-top: 1px solid var(--border-subtle) !important;
        }

        .btn, .form-control, .form-select, .input-group-text {
            border-radius: 5px !important;
            font-size: 0.88rem;
        }

        .form-control, .form-select {
            border-color: #cbd5e1;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 2px rgba(26, 86, 219, 0.15);
        }

        .btn-primary {
            background-color: var(--accent-blue);
            border-color: var(--accent-blue);
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #1648b8;
            border-color: #1648b8;
        }

        /* Tabelas Técnicas */
        .table thead th {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #4b5563;
            background-color: #f8fafc !important;
            border-bottom: 1px solid var(--border-subtle);
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        .table tbody td {
            border-bottom: 1px solid #edf0f3;
            padding-top: 0.7rem;
            padding-bottom: 0.7rem;
        }

        .badge {
            font-weight: 600;
            font-size: 0.75rem;
            padding: 0.32em 0.55em;
            border-radius: 4px;
        }

        .alert {
            border-radius: 5px !important;
            box-shadow: none !important;
            border-width: 1px;
        }

        /* Responsividade Mobile */
        @media (max-width: 768px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }
            .main-content {
                margin-left: 0;
            }
            .app-wrapper {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="app-wrapper">
        <!-- Menu Lateral -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <span class="sigla">SCA · UniAtenas</span>
                <span class="subtitulo">Controle de Arquivo Físico</span>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section-label">Principal</div>
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Painel Geral
                </a>
                <a href="{{ route('documentos.index') }}" class="nav-link {{ request()->routeIs('documentos.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text"></i> Documentos
                </a>
                <a href="{{ route('emprestimos.index') }}" class="nav-link {{ request()->routeIs('emprestimos.*') ? 'active' : '' }}">
                    <i class="bi bi-arrow-left-right"></i> Empréstimos
                </a>

                <div class="nav-section-label mt-2">Cadastros Base</div>
                <a href="{{ route('alunos.index') }}" class="nav-link {{ request()->routeIs('alunos.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Alunos
                </a>
                <a href="{{ route('cursos.index') }}" class="nav-link {{ request()->routeIs('cursos.*') ? 'active' : '' }}">
                    <i class="bi bi-mortarboard"></i> Cursos
                </a>
                <a href="{{ route('assuntos.index') }}" class="nav-link {{ request()->routeIs('assuntos.*') ? 'active' : '' }}">
                    <i class="bi bi-tag"></i> Assuntos
                </a>

                <div class="nav-section-label mt-2">Estrutura Física</div>
                <a href="{{ route('armarios.index') }}" class="nav-link {{ request()->routeIs('armarios.*') ? 'active' : '' }}">
                    <i class="bi bi-archive"></i> Armários
                </a>
                <a href="{{ route('gavetas.index') }}" class="nav-link {{ request()->routeIs('gavetas.*') ? 'active' : '' }}">
                    <i class="bi bi-inboxes"></i> Gavetas
                </a>
            </nav>

            <div class="sidebar-foot">
                <div class="d-flex align-items-center justify-content-between mb-1">
                    <div class="text-truncate pe-2" title="{{ auth()->user()->email ?? '' }}">
                        <i class="bi bi-person-fill me-1 text-secondary"></i>
                        <span class="text-white fw-medium">{{ auth()->user()->name ?? 'Operador' }}</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-secondary text-light border-secondary py-0 px-2" title="Encerrar sessão">
                            Sair
                        </button>
                    </form>
                </div>
                <div style="font-size: 0.7rem; color: #64748b;">Setor de Estágios e Convênios</div>
            </div>
        </aside>

        <!-- Conteúdo Principal -->
        <div class="main-content">
            <header class="topbar">
                <div>
                    Sistema de Controle de Arquivos · <strong>UniAtenas</strong>
                </div>
                <div>
                    {{ now()->format('d/m/Y') }}
                </div>
            </header>

            <main class="content-container">
                @if(session('sucesso'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('sucesso') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                @endif

                @if(session('erro'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('erro') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>