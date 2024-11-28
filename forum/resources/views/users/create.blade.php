<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
    <a href="/" class="button-back">
        <span>Voltar</span>
    </a>

    <div class="wrapper">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <h1>Registrar</h1>

            <div class="input-box">
                <input type="text" name="name" placeholder="Nome" value="{{ old('name') }}" required>
                <i class='bx bx-user-circle'></i>
                @error('name') <span class="text-danger">{{$message}}</span> @enderror
            </div>

            <div class="input-box">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <i class='bx bx-envelope'></i>
                @error('email') <span class="text-danger">{{$message}}</span> @enderror
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Senha" required>
                <i class='bx bx-lock-alt'></i>
                @error('password') <span class="text-danger">{{$message}}</span> @enderror
            </div>

            <button type="submit" class="btn">Registrar</button>

            <div class="register-link">
                <p>Já possui uma conta?
                    <a href="{{ route('login') }}">Entre aqui</a>
                </p>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
