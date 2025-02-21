@extends('app')

@section('content')
    <div>
        <div class="text-center m-4">
            <h1>Coincidencias encontradas</h1>
        </div>
        <div class="results-container">
            @forelse ($resultados as $resultado)
                <div class="result-card">
                    <!-- Imagen / Ícono -->
                    <div class="image-box">
                        <!-- Ajusta la ruta de la imagen a tu preferencia -->
                        @php
                            if ($showfotos) {
                                # code...
                                $imagen = DB::table('v_imagen')->where('Folio', $resultado->Folio)->value('Foto');
                            }
                        @endphp

                        @if ($showfotos)
                            <div class="image-box">
                                @if ($imagen)
                                    <img src="data:image/jpeg;base64,{{ base64_encode($imagen) }}" alt="Imagen del resultado">
                                @else
                                    <img src="{{ asset('default.png') }}" alt="Imagen no disponible">
                                @endif
                            </div>
                        @else
                            <div class="image-box">
                                <img src="{{ asset('ícono.png') }}" alt="Imagen no disponible">
                            </div>
                        @endif
                    </div>
                    <!-- Información -->
                    <div class="info-box">
                        <p><strong>Número de folio:</strong> {{ $resultado->nombre }}</p>
                        <p><strong>Edad:</strong> {{ $resultado->Edad }}</p>
                        <p><strong>Sexo:</strong> {{ $resultado->nomSexo }}</p>
                        <p><strong>Fecha de hallazgo:</strong> {{ $resultado->Fecha }}</p>
                        <!-- Ajusta la ruta del botón "Ver ficha completa" -->
                        <a href="#" class="btn-completa" disabled>Ver ficha completa</a>
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

    <style>
        /* Contenedor principal en formato grid 2x2 */
        .results-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            /* 2 columnas */
            gap: 20px;
            /* Espacio entre tarjetas */
            max-width: 1200px;
            /* Ancho máximo del contenedor */
            margin: 20px auto;
            /* Centrado horizontal */
        }

        /* Tarjeta individual */
        .result-card {
            display: flex;
            /* Imagen y texto lado a lado */
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            /* Para que no sobresalga contenido */
        }

        /* Sección de la imagen / ícono */
        .image-box {
            flex: 0 0 150px;
            /* Fijamos ancho aproximado */
            background-color: #efefef;
            text-align: center;
            padding: 10px;
        }

        .image-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 5px;
        }

        .image-box p {
            font-size: 0.9rem;
            color: #333;
            margin-top: 10px;
        }

        /* Sección de la información textual */
        .info-box {
            flex: 1;
            /* Ocupa el resto del espacio */
            padding: 15px;
        }

        .info-box p {
            margin: 0 0 6px 0;
            font-size: 0.95rem;
        }

        .info-box p strong {
            color: #333;
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
            /* Alinea a la derecha */
            justify-content: flex-end;
            margin-top: 20px;
            /* Ajusta según tu diseño */
            padding-right: 10px;
            margin-right: 10px;
            z-index: 1;
        }

        .pagination-links .pagination {
            position: relative;
            z-index: 20;
            /* Mayor al footer */
        }

        .text-muted {
            margin-right: 10px;
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            .results-container {
                /* Una sola columna en pantallas pequeñas */
                grid-template-columns: 1fr;
            }

            .result-card {
                /* Imagen encima del texto */
                flex-direction: column;
            }

            .image-box {
                width: 100%;
            }
        }
    </style>
@endsection
