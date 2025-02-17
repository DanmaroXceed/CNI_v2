@extends('app')

@section('content')
    <div class="text-center">
        <strong>La publicación de las presentes fichas es con el fin de localizar a sus familiares y reintegrar a las personas a casa.</strong>
    </div>

    <div class="pdf-container">
        <iframe src="{{ asset('Aviso-de-confidencialidad-Cedulas-CNI.pdf') }}#toolbar=0" class="pdf-viewer" ></iframe>
        <iframe src="{{ asset('Aviso-de-Privacidad-Integral-DGSP.pdf') }}#toolbar=0" class="pdf-viewer" ></iframe>
    </div>

    <div>
        <button class="btn-custom" onclick="window.location.href='{{ route('buscar') }}'">ACEPTAR</button>
    </div>
    
    <style>
        /* Clase para centrar texto y hacerlo responsivo */
        .text-center {
            text-align: center;
            width: 90%;
            max-width: 800px;
            margin: 2% auto;
            font-size: 1.6rem;
            color: #909090;
        }

        @media (max-width: 600px) {
            .text-center {
                font-size: 1rem;
                width: 100%;
            }
        }

        .pdf-container {
            display: flex;
            justify-content: center;
            gap: 20px; /* Espacio entre los iframes */
            margin: 20px auto;
            flex-wrap: wrap;
        }

        .pdf-viewer {
            width: 30%;
            height: 550px;
            border: 10px solid rgba(128, 128, 128, 0.3); /* Marco gris transparente */
            background-color: rgba(128, 128, 128, 0.1); /* Fondo gris muy tenue */#toolbar=0
        }

        @media (max-width: 768px) {
            .pdf-viewer {
                width: 100%; /* Ajusta el ancho en pantallas pequeñas */
                height: 400px;
            }
        }

        /* Estilo para navegadores basados en WebKit (Chrome, Edge, Safari) */
        .pdf-viewer::-webkit-scrollbar {
            width: 5px; /* Ancho del scrollbar */
        }

        .pdf-viewer::-webkit-scrollbar-track {
            background: rgba(128, 128, 128, 0.1); /* Color de fondo del track */
            border-radius: 10px; /* Bordes redondeados */
        }

        .pdf-viewer::-webkit-scrollbar-thumb {
            background: rgba(100, 100, 100, 0.5); /* Color del thumb (la parte que se mueve) */
            border-radius: 10px;
        }

        .pdf-viewer::-webkit-scrollbar-thumb:hover {
            background: rgba(100, 100, 100, 0.7); /* Oscurecer un poco al pasar el mouse */
        }

        .btn-custom {
            display: block; /* Lo convierte en un bloque para facilitar el centrado */
            margin: 0 auto; /* Centra horizontalmente */
            padding: 8px 20px; /* Reduce la altura */
            border-radius: 20px; /* Hace los bordes redondeados */
            font-size: 16px; /* Tamaño del texto */
            background-color: #334d75; /* Color azul de Bootstrap */
            color: white; /* Texto blanco */
            border: none; /* Quita el borde */
            cursor: pointer;
            width: 10%;
        }

        .btn-custom:hover {
            background-color: #0056b3; /* Oscurece el azul al pasar el mouse */
        }

    </style>
@endsection