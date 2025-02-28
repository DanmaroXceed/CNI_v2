@extends('app')

@section('content')
    <!-- Spinner de carga -->
    <div id="loading-screen">
        <div class="spinner"></div>
    </div>

    <div class="main-container" id="main-content">
        <!-- Imágenes fijas en la esquina superior derecha -->
        <div class="header-logos">
            <img src="{{ asset('Logo de la DGSP.png') }}" alt="Logo 1">
            <img src="{{ asset('Logo de la FGJEZ.png') }}" alt="Logo 2">
        </div>

        <div class="columns-container">
            <!-- Columna 1: Carrusel de imágenes -->
            <div class="column">
                <div class="column-1-title text-center">Cédula de CNI</div>

                <div class="carousel-container">
                    <!-- Sección de imágenes -->
                    @php
                        $imagenes = [];
                        if ($showfotos) {
                            $imagenes = DB::table('SEMEFOIMAGENES')->where('Folio', $id)->pluck('Foto');
                        }
                    @endphp

                    <div class="carousel-images">
                        @if ($showfotos && count($imagenes) > 0)
                            @foreach ($imagenes as $index => $img)
                                <img src="data:image/jpeg;base64,{{ base64_encode($img) }}" alt="Foto CNI"
                                    class="carousel-img" style="{{ $index === 0 ? 'display: block;' : 'display: none;' }}">
                            @endforeach
                        @else
                            <img src="{{ asset('ícono.png') }}" alt="Imagen no disponible">
                        @endif
                    </div>

                    <!-- Botones de navegación -->
                    @if ($showfotos && count($imagenes) > 1)
                        <div class="carousel-buttons">
                            <button id="prevBtn" class="btn-prev">
                                <span class="arrow-left">‹</span> Previa
                            </button>
                            <button id="nextBtn" class="btn-next">
                                Siguiente <span class="arrow-right">›</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Columna 2: Folio y datos -->
            <div class="column">
                <div class="column-2-header text-center">
                    <h1><strong>FOLIO: <span>{{ $folio ?? 'CNI 312 ZAC 2024 N N' }}</span></strong></h1>
                </div>

                <div class="column-2-body">
                    <p><strong>Fecha de levantamiento:</strong> {{ $datos[0]->fecha ?? 'no especificado' }}</p>
                    <p><strong>Hora de levantamiento:</strong> {{ $datos[0]->hora ?? 'no especificado' }}</p>
                    <p><strong>Expediente:</strong> {{ $datos[0]->expediente ?? 'no especificado' }}</p>
                    <p><strong>Lugar de intervención:</strong> {{ $datos[0]->intervencion ?? 'no especificado' }}</p>
                    <p><strong>Municipio:</strong> {{ $datos[0]->municipio ?? 'no especificado' }}</p>
                    <p><strong>Estado que reportó:</strong> Zacatecas</p>
                    <p><strong>Señas particulares:</strong> {{ $datos[0]->señas ?? 'no especificado' }}</p>
                    <p><strong>Observaciones:</strong> {{ $datos[0]->observaciones ?? 'no especificado' }}</p>
                    <p><strong>Pertenencias y accesorios:</strong> {{ $datos[0]->pertenencias ?? 'no especificado' }}</p>
                </div>

                <div class="column-2-footer">
                    <p>En caso de encontrar alguna similitud con la persona que busca en la base de datos, favor de
                        presentarse en la <strong>Fiscalía Especializada para la Atención de Desaparición Forzada de
                            Personas y
                            Desaparición Cometida por Particulares</strong> o comunicarse al número de teléfono: <strong>492
                            345 29 96</strong> ext.
                        <strong>37704, 37708</strong> y <strong>37709</strong>.
                    </p>
                </div>
            </div>

            <!-- Columna 3: Más texto y leyenda azul al final -->
            <div class="column">
                <div class="column-3-body">
                    <h2 style="color: #142355; margin-bottom: 10px"><strong>Señales particulares</strong></h2>
                    <div class="two-columns">
                        <div class="column-left">
                            <p>
                                <strong>PESO:</strong>
                                <span style="color: {{ !empty($senas[0]->peso) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->peso ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>ESTATURA:</strong>
                                <span style="color: {{ !empty($senas[0]->estatura) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->estatura ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>TEZ/PIEL:</strong>
                                <span style="color: {{ !empty($senas[0]->tez) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->tez ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>COMPLEXIÓN:</strong>
                                <span style="color: {{ !empty($senas[0]->complexion) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->complexion ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>FORMA CARA:</strong>
                                <span style="color: {{ !empty($senas[0]->formacara) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->formacara ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>FRENTE:</strong>
                                <span style="color: {{ !empty($senas[0]->frente) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->frente ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>BARBA:</strong>
                                <span style="color: {{ !empty($senas[0]->barba) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->barba ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>ANTEOJOS:</strong>
                                <span style="color: {{ !empty($senas[0]->anteojos) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->anteojos ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>MENTÓN:</strong>
                                <span style="color: {{ !empty($senas[0]->menton) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->menton ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>MENTÓN FORMA:</strong>
                                <span style="color: {{ !empty($senas[0]->mentonforma) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->mentonforma ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>NARIZ:</strong>
                                <span style="color: {{ !empty($senas[0]->nariz) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->nariz ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>TAMAÑO NARIZ:</strong>
                                <span style="color: {{ !empty($senas[0]->tamnariz) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->tamnariz ?? 'no especificado' }}
                                </span>
                            </p>
                        </div>
                        <div class="column-right">
                            <p>
                                <strong>BOCA TAMAÑO:</strong>
                                <span style="color: {{ !empty($senas[0]->tamboca) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->tamboca ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>GROSOR LABIOS:</strong>
                                <span style="color: {{ !empty($senas[0]->grosorlabios) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->grosorlabios ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>TIPO CEJAS:</strong>
                                <span style="color: {{ !empty($senas[0]->tipocejas) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->tipocejas ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>TAMAÑO CEJAS:</strong>
                                <span style="color: {{ !empty($senas[0]->tamcejas) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->tamcejas ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>FORMA OREJAS:</strong>
                                <span style="color: {{ !empty($senas[0]->formorejas) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->formorejas ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>TAMAÑO OREJAS:</strong>
                                <span style="color: {{ !empty($senas[0]->tamorejas) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->tamorejas ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>COLOR CABELLO:</strong>
                                <span style="color: {{ !empty($senas[0]->colorcabello) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->colorcabello ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>FORMA CABELLO:</strong>
                                <span style="color: {{ !empty($senas[0]->formacabello) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->formacabello ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>LARGO CABELLO:</strong>
                                <span style="color: {{ !empty($senas[0]->largocabello) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->largocabello ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>COLOR OJOS:</strong>
                                <span style="color: {{ !empty($senas[0]->colorojos) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->colorojos ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>TAMAÑO OJOS:</strong>
                                <span style="color: {{ !empty($senas[0]->tamojos) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->tamojos ?? 'no especificado' }}
                                </span>
                            </p>
                            <p>
                                <strong>SEÑAS PARTICULARES:</strong>
                                <span style="color: {{ !empty($senas[0]->señas) ? '#324E75' : '#8C8C8C' }}">
                                    {{ $senas[0]->señas ?? 'no especificado' }}
                                </span>
                            </p>
                        </div>

                    </div>
                </div>
                <div class="column-3-footer">
                    <p>La descarga de esta cédula está sujeta al Aviso de Confidencialidad. La difusión
                        de su contenido en fuentes ajenas a la Fiscalía General de Justicia del Estado
                        de Zacatecas será responsabilidad exclusiva de la persona que la comparta.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-buttons">
        <button style="background-color: white; color: black;" onclick="window.history.back()">Regresar</button>
        <button>Descargar</button>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("loading-screen").style.display = "none";
            document.getElementById("main-content").style.display = "block";

            let images = document.querySelectorAll(".carousel-img");
            let currentIndex = 0;

            if (images.length > 0) {
                document.getElementById("prevBtn").addEventListener("click", function() {
                    images[currentIndex].style.display = "none";
                    currentIndex = (currentIndex - 1 + images.length) % images.length;
                    images[currentIndex].style.display = "block";
                });

                document.getElementById("nextBtn").addEventListener("click", function() {
                    images[currentIndex].style.display = "none";
                    currentIndex = (currentIndex + 1) % images.length;
                    images[currentIndex].style.display = "block";
                });
            }
        });
    </script>

    <style>
        /* Contenedor principal */
        .main-container {
            /* ~5% de margen horizontal */
            margin: 2% 2%;
            background-color: #fff;
            /* Para colocar las imágenes en la esquina superior derecha */
            position: relative;
            padding: 20px;
            box-sizing: border-box;
        }

        /* Imágenes fijas en la esquina superior derecha */
        .header-logos {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
        }

        .header-logos img {
            /* Ajusta según necesites */
            width: 100px;
            height: auto;
        }

        /* Contenedor de las 3 columnas */
        .columns-container {
            display: flex;
            /* Hace que todas las columnas tengan la misma altura total */
            align-items: stretch;
            /* Deja espacio para los logos */
            margin-top: 60px;
        }

        /* Cada columna */
        .column {
            /* 3 columnas iguales */
            width: 33.3333%;
            box-sizing: border-box;
            padding: 10px;
            /* Para visualizar, cámbialo a #ccc si gustas */
            border: 1px solid transparent;
            display: flex;
            /* Para poder alinear header/body/footer en la misma altura */
            flex-direction: column;
            justify-content: flex-start;
        }

        /* ==== Columna 1: Carrusel ==== */
        .column-1-title {
            font-size: 3rem;
            font-weight: bold;
            background-color: #142355;
            color: white;
            padding: 20px;
            margin-top: -40px;
            border-radius: 5px;
        }

        .carousel-container {
            /* Ocupará el espacio vertical sobrante de la columna */
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .carousel-images {
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            /* o un ancho fijo si lo prefieres, por ejemplo: 600px; */
            width: 100%;
            height: 350px;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .carousel-images img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .carousel-buttons {
            display: flex;
            justify-content: space-evenly;
        }

        .carousel-buttons button {
            padding: 10px 16px;
            font-size: .8rem;
            font-weight: bold;
            cursor: pointer;
            border-radius: 8px;
            display: flex;
            align-items: center;
            /* Espacio entre el texto y la flecha */
            gap: 6px;
        }

        .btn-prev {
            background-color: white;
            color: black;
            border: 2px solid black;
        }

        .btn-prev:hover {
            background-color: #f0f0f0;
        }

        .btn-next {
            background-color: black;
            color: white;
            border: none;
        }

        .btn-next:hover {
            background-color: #333;
        }

        /* Ajuste para las flechas */
        .arrow-left,
        .arrow-right {
            font-size: 18px;
            font-weight: bold;
        }

        /* ==== Columna 2: Folio y datos ==== */
        .column-2-header {
            font-weight: bold;
            font-size: 1.5rem;
            color: #152659;
        }

        .column-2-body {
            /* Ocupa espacio variable */
            flex: 1;
            padding: 30px;
            /* Espacio para el footer gris */
            margin-bottom: 10px;
            background-color: #f5f5ff;
            border-radius: 20px;
            font-size: .8rem;
        }

        .column-2-body p {
            margin: 2px 0;
        }

        .column-2-footer {
            background-color: #8C8C8C;
            /* Recuadro gris */
            padding: 10px;
            text-align: center;
            color: white;
            font-size: .8rem;
            height: 100px;
            border-radius: 5px;
        }

        /* ==== Columna 3: Más texto y leyenda azul ==== */
        .column-3-body {
            /* Ocupa el espacio disponible */
            flex: 1;
            padding: 50px;
            margin-bottom: 10px;
            background-color: #f5f5ff;
            border-radius: 20px;
        }

        .two-columns {
            display: flex;
            gap: 20px;
        }

        .column-left,
        .column-right {
            flex: 1;
            font-size: .8rem;
        }

        .column-left p,
        .column-right p {
            margin: 2px 0;
            color: #606060;
        }

        .column-3-footer {
            /* Azul */
            background-color: #152659;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-size: .8rem;
            height: 100px;
            border-radius: 5px;
        }

        /* Botones de "Regresar" y "Descargar" (si fueran necesarios) */
        .bottom-buttons {
            text-align: center;
        }

        .bottom-buttons button {
            margin: 0 10px;
            padding: 8px 12px;
            background-color: #334d75;
            color: #fff;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            width: 200px;
        }

        .bottom-buttons button:hover {
            background-color: #2b3f5b;
        }
    </style>
@endsection
