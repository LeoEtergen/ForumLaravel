<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fórum - Categorias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        /* Estilos gerais */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fa;
        }

        /* Centralizar o formulário */
        .d-flex {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Estilos para a coluna que contém o formulário */
        .col-6 {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Estilo para o título do formulário */
        h1 {
            font-weight: 600;
            color: #2575fc;
            /* Usando a cor azul do estilo original */
            margin-bottom: 30px;
        }

        /* Estilos para os rótulos dos campos de entrada */
        .form-label {
            font-size: 1rem;
            color: #6c757d;
            /* Cor suave para os rótulos */
        }

        /* Estilos para os campos de entrada (input) */
        .form-control {
            margin-top: 8px;
            padding: 10px;
            font-size: 1rem;
            border-radius: 8px;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease-in-out;
        }

        /* Efeito ao passar o mouse sobre os campos de entrada */
        .form-control:focus {
            border-color: #2575fc;
            box-shadow: 0 0 5px rgba(37, 117, 252, 0.5);
        }

        /* Estilos para mensagens de erro */
        span {
            color: #e74c3c;
            /* Cor vermelha para as mensagens de erro */
            font-size: 0.875rem;
        }

        /* Estilo para o botão de envio */
        .btn-secondary {
            background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 50px;
            /* Bordas arredondadas */
            padding: 10px 20px;
            cursor: pointer;
            transition: background 0.3s ease-in-out, box-shadow 0.3s ease;
            margin-top: 20px;
        }

        /* Efeito no botão ao passar o mouse */
        .btn-secondary:hover {
            background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Estilos para o formulário responsivo */
        @media (max-width: 767px) {
            .col-6 {
                width: 90%;
                padding: 20px;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center">
        <div class="col-6 p-5">
            <h1>Cadastro de Categorias</h1>
            <form action="{{ route('categories.store') }}" method="post">
                @csrf
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" id="title" class="form-control" />
                @error('title') <span>{{ $message }}</span> <br /> @enderror

                <label for="description" class="form-label">Descrição</label>
                <input type="text" name="description" id="description" class="form-control" />
                @error('description') <span>{{ $message }}</span> <br /> @enderror

                <input type="submit" value="Cadastrar" class="mt-4 btn btn-secondary">
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>