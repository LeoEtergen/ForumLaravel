<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('images/masterIcon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    @stack('styles')

    <title>Fórum TAP</title>
</head>

<body>
    <header id="header">
        <section class="profile">
            <div class="profile-text">
                <h2>Fórum de TAP</h2>
            </div>
            <nav class="nav-menu">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">
                            <i class="bi bi-house"></i> Início
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('listAllUsers') }}"><i class="bi bi-table"></i> Tabela
                            Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('listAllTopics') }}"><i class="bi bi-chat"></i>
                            Tópicos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('listAllTags') }}"><i class="bi bi-tags"></i> Tags</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('listAllCategories') }}"><i class="bi bi-list"></i>
                            Categorias</a>
                    </li>
                </ul>
            </nav>
        </section>

        <div class="auth-section">
            @if(Auth::check())
            <div class="dropdown">
                <button class="dropbtn" onclick="toggleDropdown()">
                    <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('storage/photos/default.jpg') }}"
                        class="user-photo">
                    Bem-vindo, {{ Auth::user()->name }}!
                </button>
                <div class="dropdown-content" id="myDropdown">
                    <a href="{{ route('listUserById', [Auth::user()->id]) }}">Minha Conta</a>
                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            @else
            <nav class="nav-menu auth-menu">
                <ul class="nav">
                    <li class="nav-item">
                        <div class="login-button">
                            <a href="{{ route('register') }}" class="btn-register btn-log-reg">Registrar</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="login-button">
                            <a href="{{ route('login') }}" class="btn-login btn-log-reg">Login</a>
                        </div>
                    </li>
                </ul>
            </nav>
            @endif
        </div>


    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>