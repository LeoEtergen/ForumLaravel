<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            /* Tom de azul claro */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-container h2 {
            color: #4a90e2;
            /* Azul claro */
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #4a90e2;
            /* Azul claro */
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #357ebd;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Perfil</h2>
        <span>{{ session('message') }}</span>
        @if($user != null)
        <form action="{{ route('updateUser', [$user->id]) }}" method="post">
            @csrf
            @method('put')
            <div class="input-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" required>
                @error('name') <span>{{ $message }}</span> @enderror
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="{{ $user->email }}" required>
                @error('email') <span>{{ $message }}</span> @enderror
            </div>
            <div class="input-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password">
                @error('password') <span>{{ $message }}</span> @enderror
            </div>
            <button type="submit">Atualizar</button>
        </form>
        @endif
    </div>
</body>

</html>