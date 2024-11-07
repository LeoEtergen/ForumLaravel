<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fórum - Categorias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .btn-gradient {
            background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
            color: #fff;
            font-weight: bold;
            transition: background 0.3s ease-in-out;
        }

        .btn-gradient:hover {
            background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .list-group-item {
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .list-group-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .list-group-item .badge {
            font-size: 0.85rem;
        }

        .hover-item:hover {
            background-color: #f7f7f7;
        }

        .text-primary {
            color: #2575fc;
        }

        h1 {
            font-weight: 600;
        }

        .text-muted {
            color: #6c757d;
        }

        .lead {
            font-size: 1.25rem;
        }

        .vh-100 {
            min-height: 100vh;
        }

        .rounded-pill {
            border-radius: 50px;
        }

        .sticky-header {
            position: flex;
            top: 0;
            z-index: 10;
            background-color: #f8f9fa;
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
    </style>
</head>

<body class="bg-light">
    <div class="d-flex justify-content-center align-items-start vh-100">
        <div class="col-12 col-md-8 col-lg-6 p-4">
            <!-- Cabeçalho fixo com position: sticky -->
            <div class="text-center mb-4 sticky-header">
                <h1 class="display-4 text-primary">Categorias</h1>
                <p class="lead text-muted">Organize suas categorias de forma simples e eficiente.</p>
                <a href="{{ route('categories.create') }}" class="btn btn-gradient mb-4 px-5 py-3 rounded-pill">
                    <i class="bi bi-plus-circle"></i> Adicionar Categoria
                </a>
            </div>

            <!-- Lista de categorias -->
            <ul class="list-group list-group-flush">
                @foreach ($categories as $category)
                    <li class="list-group-item bg-white shadow-sm rounded-lg mb-3 hover-item">
                        <a href="{{ route('categories.show', $category->id) }}"
                            class="text-decoration-none text-dark d-flex justify-content-between align-items-center">
                            <span class="fs-5"><strong>{{ $category->title }}</strong></span>
                            <span class="badge bg-primary text-white">{{ $category->id }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>

</html>