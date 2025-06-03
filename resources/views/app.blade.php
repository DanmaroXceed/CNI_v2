<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <!-- Ícono clásico del navegador -->
    <link rel="icon" type="image/png" href="{{ asset('/logoweb-1.png') }}" sizes="32x32">

    <!-- Ícono para dispositivos móviles / apps -->
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('/logoweb-1.png') }}">

    <!-- Apple touch icon (opcional si se requiere para iOS) -->
    <link rel="apple-touch-icon" href="{{ asset('/logoweb-1.png') }}">

    <title>CNI - Semefo</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        .bg-custom {
            background-color: #efefef;
        }

        /* NAVBAR */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            width: 100%;
            height: 60px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 0 20px;
            margin-top: 20px;
        }

        .navbar-menu button {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .navbar-logo {
            height: 50px;
            margin-left: 10%;
        }

        /* CONTENIDO */
        #contenido {
            /* Altura total menos el navbar y el footer */
            min-height: calc(100vh - 130px);
            /* Espacio extra para evitar que el botón se oculte */
            padding-bottom: 100px;
        }

        /* FOOTER RESPONSIVO */
        .footer {
            background-color: white;
            border-top: 3px solid #334d75;
            color: #969ba0;
            width: 100%;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            z-index: 10;
        }

        @media (max-width: 768px) {
            .footer {
                /* Evita que se superponga en pantallas pequeñas */
                position: relative;
                height: auto;
                padding: 15px;
                text-align: center;
            }
        }

        /* ESTILOS PARA EL BOTÓN */
        .btn-custom {
            display: block;
            /* Centra el botón */
            margin: 20px auto;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 16px;
            background-color: #334d75;
            color: white;
            border: none;
            cursor: pointer;
            /* Tamaño adecuado */
            width: 200px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            .btn-custom {
                /* Ocupa más espacio en móviles */
                width: 80%;
            }
        }

        .breadcrumb {
            margin-top: 20px;
            margin-left: 40px;
            border-radius: 5px;
        }

        .breadcrumb a {
            /* Color negro */
            color: black !important;
            /* Quitar subrayado */
            text-decoration: none;
        }

        .breadcrumb a:hover {
            /* Color gris oscuro al pasar el mouse */
            color: #555;
            /* Subrayado solo en hover (opcional) */
            text-decoration: underline;
        }

        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000;
        }

        /* Contenido principal oculto inicialmente */
        #main-content {
            display: none;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(0, 0, 0, 0.1);
            border-top-color: #000;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="bg-custom">
    <nav class="navbar">
        <img src="{{ asset('logo.png') }}" alt="Logo" class="navbar-logo">
        <div class="navbar-menu" style="margin-right: 10%;">
            <div class="d-none d-md-flex"> <!-- Ocultar en móviles y mostrar en desktop -->
                <a href="https://www.fiscaliazacatecas.gob.mx/" class="btn btn-outline-primary me-2">Página Principal FGJEZ</a>
                <a href="https://accesosemefo.fiscaliazacatecas.gob.mx/" class="btn btn-outline-success me-2">Acceso a SEMEFO</a>
            </div>
        </div>
    </nav>

    @if (request()->routeIs('resultados') || request()->routeIs('cni'))
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('buscar') }}">Búsqueda</a></li>

                @if (request()->routeIs('resultados'))
                    <li class="breadcrumb-item active" aria-current="page">Resultados</li>
                @endif

                @if (request()->routeIs('cni'))
                    <li class="breadcrumb-item"><a href="{{ redirect()->getUrlGenerator()->previous() }}">Resultados</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Cédula</li>
                @endif
            </ol>
        </nav>
    @endif

    <div id="contenido">
        @yield('content')
    </div>

    <!-- Footer fijo -->
    <div class="footer">
        <div class="footer-text">
            <p>&copy; Copyright 2019 - 2024 | Fiscalía General de Justicia del Estado de Zacatecas</p>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>

<script>
    document.addEventListener('contextmenu', function(event) {
        if (event.target.tagName === 'IMG') {
            event.preventDefault();
        }
    });
</script>

</html>
