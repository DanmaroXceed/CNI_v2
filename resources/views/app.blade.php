<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>CNI - Semefo</title>
</head>
<body class="bg-custom">
    <nav class="navbar">
        <img src="{{ asset('logo.png') }}" alt="Logo" class="navbar-logo">
        <div class="navbar-menu" style="margin-right: 10%;">
            <button>☰</button>
        </div>
    </nav>

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
        min-height: calc(100vh - 130px); /* Altura total menos el navbar y el footer */
        padding-bottom: 100px; /* Espacio extra para evitar que el botón se oculte */
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
            position: relative; /* Evita que se superponga en pantallas pequeñas */
            height: auto;
            padding: 15px;
            text-align: center;
        }
    }

    /* ESTILOS PARA EL BOTÓN */
    .btn-custom {
        display: block;
        margin: 20px auto; /* Centra el botón */
        padding: 10px 20px;
        border-radius: 20px;
        font-size: 16px;
        background-color: #334d75;
        color: white;
        border: none;
        cursor: pointer;
        width: 200px; /* Tamaño adecuado */
    }

    .btn-custom:hover {
        background-color: #0056b3;
    }

    @media (max-width: 600px) {
        .btn-custom {
            width: 80%; /* Ocupa más espacio en móviles */
        }
    }

</style>
</html>
