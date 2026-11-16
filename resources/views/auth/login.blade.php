<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login · Controle de Arquivos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background: #f3f6fb;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border: 0;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(10, 47, 99, 0.08);
            overflow: hidden;
        }
        .login-header {
            background: #0a2f63;
            color: #fff;
            padding: 28px 32px;
            text-align: center;
        }
        .btn-primary {
            --bs-btn-bg: #1565e0;
            --bs-btn-border-color: #1565e0;
            --bs-btn-hover-bg: #0f54bd;
            --bs-btn-hover-border-color: #0f54bd;
            font-weight: 600;
            padding: 10px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="card login-card mx-3">
        <div class="login-header">
            <i class="bi bi-folder2-open fs-1 d-block mb-2"></i>
            <h5 class="fw-bold mb-1">Controle de Arquivos</h5>
            <small class="text-white-50">Estágios e Convênios · UniAtenas</small>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">E-mail Institucional</label>
                    <input type="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           placeholder="email@uniatenas.br"
                           required
                           autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Senha</label>
                    <input type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Senha"
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label text-muted small" for="remember">
                        Manter conectado
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Entrar no Sistema
                </button>
            </form>
        </div>
    </div>
</body>
</html>