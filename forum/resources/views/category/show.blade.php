<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fórum - {{ $category->title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
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

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .btn-secondary {
            font-weight: bold;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="col-12 col-md-8 col-lg-6 container text-center">
            <h1 class="display-4 text-primary">{{ $category->title }}</h1>
            <p class="lead text-muted">{{ $category->description }}</p>

            <form action="{{ route('categories.destroy', $category->id) }}" method="post"
                class="d-flex justify-content-center gap-3 mt-4">
                @csrf
                @method("delete")
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-gradient px-4 py-2 rounded-pill">
                    <i class="bi bi-pencil"></i> Editar
                </a>
                <input type="submit" value="Excluir" class="btn btn-danger px-4 py-2 rounded-pill">
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>