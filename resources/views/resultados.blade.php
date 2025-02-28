@extends('app')

@section('content')
    <!-- Spinner de carga -->
    <div id="loading-screen">
        <div class="spinner"></div>
    </div>

    <!-- Contenido principal -->
    <div id="main-content" style="display: none;">
        <div class="text-center m-4">
            <h1>Coincidencias encontradas</h1>
        </div>

        <div class="results-container">
            @forelse ($resultados as $resultado)
                <div class="result-card">
                    @php
                        if ($showfotos) {
                            $imagen = DB::table('v_imagen')
                                ->where('Folio', $resultado->Folio)
                                ->value('Foto');
                        }
                    @endphp

                    <!-- Sección de la imagen -->
                    <div class="image-box">
                        @if ($showfotos)
                            @if ($imagen)
                                <img src="data:image/jpeg;base64,{{ base64_encode($imagen) }}" alt="Imagen del resultado">
                            @else
                                <img src="{{ asset('default.png') }}" alt="Imagen no disponible">
                            @endif
                        @else
                            <img src="{{ asset('ícono.png') }}" alt="Imagen no disponible">
                        @endif
                    </div>

                    <!-- Sección de la información -->
                    <div class="info-box">
                        <p><strong>Número de folio:</strong> <span class="blue-text">{{ $resultado->nombre }}</span></p>
                        <p><strong>Edad:</strong> <span class="blue-text">{{ $resultado->Edad }}</span></p>
                        <p><strong>Sexo:</strong> <span class="blue-text">{{ $resultado->nomSexo }}</span></p>
                        <p><strong>Fecha de hallazgo:</strong> <span class="blue-text">{{ $resultado->Fecha }}</span></p>
                        <a href="{{ route('cni', ['showfotos' => $showfotos,'id' => $resultado->Folio]) }}" class="btn-completa">Ver ficha completa</a>
                    </div>
                </div>
            @empty
                <p style="grid-column: 1 / -1; text-align:center;">No se encontraron resultados</p>
            @endforelse
        </div>

        <!-- Paginación -->
        <div class="pagination-links">
            {{ $resultados->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Oculta el spinner y muestra el contenido cuando la página ha cargado completamente
            document.getElementById("loading-screen").style.display = "none";
            document.getElementById("main-content").style.display = "block";
        });
    </script>

    <style>
        /* Contenedor principal en formato grid 2x2 */
        .results-container {
            display: grid;
            grid-template-columns: 1fr 1fr; /* 2 columnas */
            gap: 50px;                      /* Espacio entre tarjetas */
            max-width: 1200px;             /* Ancho máximo del contenedor */
            margin: 20px auto;             /* Centrado horizontal */
        }

        /* Tarjeta individual */
        .result-card {
            display: flex;         /* Imagen e info en la misma fila */
            align-items: stretch;  /* Ambos lados se estiren a la misma altura */
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        /* Sección de la imagen */
        .image-box {
            flex: 0 0 150px;       /* Ancho fijo de 150px */
            background-color: #efefef;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;            /* Sin padding para evitar brechas */
        }

        .image-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;     /* Cubre el área, recortando si es necesario */
        }

        /* Sección de la información textual */
        .info-box {
            flex: 1;
            padding: 15px;
        }

        .info-box p {
            margin: 0 0 6px 0;
            font-size: 0.95rem;
        }

        .info-box p strong {
            color: #333;
        }

        .blue-text {
            color: #324E75; /* Azul estándar */
        }

        /* Botón de ver ficha completa */
        .btn-completa {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            background-color: #334d75;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .btn-completa:hover {
            background-color: #2b3f5b;
        }

        /* Contenedor de la paginación */
        .pagination-links {
            display: flex;
            position: relative;
            justify-content: flex-end; /* Alinea a la derecha */
            margin-top: 20px;
            padding-right: 10px;
            margin-right: 10px;
            z-index: 1;
        }

        .pagination-links .pagination {
            position: relative;
            z-index: 20;
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            .results-container {
                grid-template-columns: 1fr; /* Una sola columna */
            }

            .result-card {
                flex-direction: column; /* Imagen encima del texto */
                align-items: flex-start;
            }

            .image-box {
                width: 100%;
                flex: none;
                height: auto;
            }

            .image-box img {
                width: 100%;
                height: auto;
                object-fit: contain; /* Para que se vea completa en pantallas pequeñas */
            }
        }

        /* Spinner de carga */
        #loading-screen {
            position: fixed;
            width: 100%;
            height: calc(100vh - 130px);
            background-color: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Animación del Spinner */
        .spinner {
            border: 5px solid #ccc;
            border-top: 5px solid #334d75;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .text-muted{
            margin-right: 10px;
        }
    </style>
@endsection
