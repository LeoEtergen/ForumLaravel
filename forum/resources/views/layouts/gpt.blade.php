<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fórum</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #2b6cb0;
            padding: 20px;
            text-align: center;
            color: white;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
            flex: 1;
        }

        footer {
            background-color: #2b6cb0;
            padding: 10px;
            text-align: center;
            margin-top: auto;
        }

        .login-buttons {
            position: absolute;
            right: 20vh;
            top: 20px;
            border-radius: 10px;
            background-color: darkblue;
            font-weight: bold;
            cursor: pointer;
        }

        .login-buttons button:hover {
            background-color: #0056b2;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropbtn {
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            background-color: darkblue;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #0056b2;
        }

        .home-button {
            margin-right: 20px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .home-button:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <header>
        <h1>Fórum</h1>
        <a href="{{ route('home') }}" class="home-button">Ir para o Início</a>
        @yield('header')
        <div class="login-buttons">
            @if(Auth::check())
            <div class="dropdown">
                <button class="dropbtn">Olá, {{ Auth::user()->name }}</button>
                <div class="dropdown-content">
                    <a href="{{ route('listUser', ['uid' => Auth::user()->id]) }}">Editar</a>
                    <a href="{{ route('logout') }}">Sair</a>
                </div>
            </div>
            @else
            <a href="{{ route('register') }}"><button class="register-button">Registrar</button></a>
            <a href="{{ route('login') }}"><button class="register-button">Login</button></a>
            @endif
        </div>
    </header>

    @yield('content')

    <footer>
        <p>&copy; 2024 Meu Fórum. Todos os direitos reservados.</p>
    </footer>

</body>

</html>
