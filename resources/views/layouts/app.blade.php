<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SCA') · Controle de Arquivos</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --navy: #0a2f63;
            --blue: #1565e0;
            --blue-soft: #e8f0fd;
            --bg: #f3f6fb;
            --surface: #ffffff;
            --line: #e3e9f3;
            --ink: #18263c;
            --muted: #6a7a92;
            --ok: #1565e0;
            --warn: #f0a020;
            --danger: #e5484d;
            --sidebar-w: 248px;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', sans-serif;
            background: var(--bg);
            color: var(--ink);
        }

        .app { display: grid; grid-template-columns: var(--sidebar-w) 1fr; min-height: 100vh; }

        /* ---------- Sidebar ---------- */
        .sidebar {
            background: var(--navy);
            color: #cfdcf2;
            padding: 20px 14px;
            position: sticky;
            top: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }
        .brand {
            display: flex; gap: 12px; align-items: center;
            padding: 4px 10px 22px; color: #fff; text-decoration: none;
        }
        .brand i { font-size: 1.7rem; }
        .brand strong { display: block; font-size: .95rem; line-height: 1.25; font-weight: 700; }
        .brand span { font-size: .78rem; color: #9db6dd; }

        .nav-group { margin: 20px 12px 6px; font-size: .78rem; color: #7f9bc9; }

        .side-link {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 12px; margin-bottom: 2px;
            border-radius: 8px; color: #cfdcf2;
            text-decoration: none; font-size: .92rem; font-weight: 500;
        }
        .side-link i { font-size: 1.05rem; }
        .side-link:hover { background: rgba(255, 255, 255, .08); color: #fff; }
        .side-link.active { background: var(--blue); color: #fff; }
        .side-link:focus-visible { outline: 2px solid #fff; outline-offset: 2px; }

        .sidebar-foot {
            margin-top: auto; padding: 16px 12px 0;
            font-size: .78rem; color: #7f9bc9;
            border-top: 1px solid rgba(255, 255, 255, .1);
        }

        /* ---------- Conteúdo ---------- */
        .main { padding: 28px 36px; min-width: 0; }

        .page-head {
            display: flex; justify-content: space-between; align-items: flex-start;
            gap: 16px; flex-wrap: wrap; margin-bottom: 24px;
        }
        .page-head h1 { font-size: 1.6rem; font-weight: 700; margin: 0; }
        .page-head p { margin: 4px 0 0; color: var(--muted); font-size: .92rem; }

        .btn-primary { --bs-btn-bg: var(--blue); --bs-btn-border-color: var(--blue);
            --bs-btn-hover-bg: #0f54bd; --bs-btn-hover-border-color: #0f54bd;
            --bs-btn-active-bg: #0d4aa8; --bs-btn-active-border-color: #0d4aa8;
            font-weight: 600; border-radius: 8px; padding: 9px 16px; }

        @media (max-width: 991.98px) {
            .app { display: block; }
            .sidebar { position: static; height: auto; }
            .sidebar-foot { display: none; }
            .main { padding: 20px 16px; }
        }
    </style>
    @stack('styles')
</head>
<body>
@php
    $principal = [
        ['Dashboard', 'dashboard', 'dashboard', 'bi-grid-1x2'], // <-- Adicionado aqui
        ['Documentos', 'documentos.index', 'documentos.*', 'bi-file-earmark-text'],
        ['Empréstimos', 'emprestimos.index', 'emprestimos.*', 'bi-arrow-left-right'],
        ['Armários', 'armarios.index', 'armarios.*', 'bi-archive'],
        ['Gavetas', 'gavetas.index', 'gavetas.*', 'bi-inboxes'],
    ];
    $cadastros = [
        ['Cursos', 'cursos.index', 'cursos.*', 'bi-mortarboard'],
        ['Assuntos', 'assuntos.index', 'assuntos.*', 'bi-tags'],
        ['Alunos', 'alunos.index', 'alunos.*', 'bi-people'],
    ];
@endphp

<div class="app">
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="brand">
            <i class="bi bi-folder2-open"></i>
            <div>
                <strong>Controle de Arquivos</strong>
                <span>Estágios e Convênios</span>
            </div>
        </a>

        <nav>
            @foreach($principal as [$label, $rota, $padrao, $icone])
                <a href="{{ route($rota) }}" class="side-link {{ request()->routeIs($padrao) ? 'active' : '' }}">
                    <i class="bi {{ $icone }}"></i> {{ $label }}
                </a>
            @endforeach

            <div class="nav-group">Cadastros base</div>

            @foreach($cadastros as [$label, $rota, $padrao, $icone])
                <a href="{{ route($rota) }}" class="side-link {{ request()->routeIs($padrao) ? 'active' : '' }}">
                    <i class="bi {{ $icone }}"></i> {{ $label }}
                </a>
            @endforeach
        </nav>

        <div class="sidebar-foot">Centro Universitário Atenas</div>
    </aside>

    <main class="main">
        @if(session('sucesso'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                {{ session('sucesso') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        @endif

        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>