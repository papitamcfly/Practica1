<style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        main {
            flex-grow: 1;
        }

        footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            margin-top: auto;
        }
    </style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!-- Agregar enlaces a hojas de estilo CSS, scripts JavaScript, etc. -->
</head>
<body>
    
<div class="wrapper">
        <header>
            <!-- Encabezado de la página -->
            <h1>@yield('encabezado')</h1>
        </header>
        <main>
            <!-- Contenido dinámico de la vista -->
            @yield('content')
        </main>
    </div>
    <footer>
        <!-- Pie de página -->
        <p>&copy; {{ date('Y') }} Todos los derechos reservados juasjuas. cuchau</p>


    </footer>
</body>
</html>
