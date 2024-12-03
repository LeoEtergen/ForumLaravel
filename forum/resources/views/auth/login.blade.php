<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
</head>

<body>
    @if(session('success'))
        <div id="message-alert" class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-patch-check"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <a href="/" class="button-back">
        <span>Voltar</span>
    </a>

    <div class="wrapper">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <h1>Login</h1>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <i class='bx bx-user-circle'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Senha" required>
                <i class='bx bx-lock-alt'></i>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Não possui uma conta?
                    <a href="{{ route('register') }}">Criar conta</a>
                </p>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
