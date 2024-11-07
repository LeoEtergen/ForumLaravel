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

        .btn-secondary,
        .btn-gradient {
            font-weight: bold;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="col-12 col-md-8 col-lg-6 container">
            <h1 class="display-4 text-primary">Editar Categoria</h1>
            <form action="{{ route('categories.update', $category->id) }}" method="post">
                @csrf
                @method('put')
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" id="title" value="{{ $category->title }}" class="form-control" />

                <label for="description" class="form-label mt-3">Descrição</label>
                <input type="text" name="description" id="description" value="{{ $category->description }}"
                    class="form-control" />

                <input type="submit" value="Alterar" class="mt-4 btn btn-gradient px-5 py-2 rounded-pill">
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>