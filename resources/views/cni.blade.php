@extends('app')

@section('content')
    <div class="main-container">
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
                        if ($showfotos) {
                            $imagenes = DB::table('v_imagen')->where('Folio', $id)->pluck('Foto');
                        }
                    @endphp

                    <div class="carousel-images">
                        @if ($showfotos)
                            @forelse ($imagenes as $img)
                                <!-- Si tienes que mostrar varbinary base64, haz: -->
                                <img src="data:image/jpeg;base64,{{ base64_encode($img) }}" alt="Foto CNI">
                            @empty
                                <p>No hay fotografías</p>
                            @endforelse
                        @else
                            <img src="{{ asset('ícono.png') }}" alt="Imagen no disponible">
                        @endif
                    </div>

                    <!-- Botones de navegación -->
                    <div class="carousel-buttons">
                        <button>Anterior</button>
                        <button>Siguiente</button>
                    </div>
                </div>
            </div>

            <!-- Columna 2: Folio y datos -->
            <div class="column">
                <div class="column-2-header text-center">
                    <h1><strong>FOLIO: <span>{{ $folio ?? 'CNI 312 ZAC 2024 N N' }}</span></strong></h1>
                </div>

                <div class="column-2-body">
                    <p><strong>Fecha de levantamiento:</strong> {{ $fechaLevantamiento ?? '1 Noviembre 2024' }}</p>
                    <p><strong>Hora de levantamiento:</strong> </p>
                    <p><strong>Expediente:</strong> </p>
                    <p><strong>Lugar de intervención:</strong> </p>
                    <p><strong>Municipio:</strong> </p>
                    <p><strong>Estado que reportó:</strong> </p>
                    <p><strong>Señas particulares:</strong> </p>
                    <p><strong>Observaciones:</strong> </p>
                    <p><strong>Pertenencias y accesorios:</strong> </p>
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
                            <p><strong>PESO:</strong> </p>
                            <p><strong>ESTATURA:</strong> </p>
                            <p><strong>TEZ/PIEL:</strong> </p>
                            <p><strong>COMPLEXIÓN:</strong> </p>
                            <p><strong>FORMA CARA:</strong> </p>
                            <p><strong>FRENTE:</strong> </p>
                            <p><strong>BARBA:</strong> </p>
                            <p><strong>ANTEOJOS:</strong> </p>
                            <p><strong>MENTÓN:</strong> </p>
                            <p><strong>MENTÓN FORMA:</strong> </p>
                            <p><strong>NARIZ:</strong> </p>
                            <p><strong>TAMAÑO NARIZ:</strong> </p>
                        </div>
                        <div class="column-right">
                            <p><strong>BOCA TAMAÑO:</strong> </p>
                            <p><strong>GROSOR LABIOS:</strong> </p>
                            <p><strong>TIPO CEJAS:</strong> </p>
                            <p><strong>TAMAÑO CEJAS:</strong> </p>
                            <p><strong>FORMA OREJAS:</strong> </p>
                            <p><strong>TAMAÑO OREJAS:</strong> </p>
                            <p><strong>COLOR CABELLO:</strong> </p>
                            <p><strong>FORMA CABELLO:</strong> </p>
                            <p><strong>COLOR OJOS:</strong> </p>
                            <p><strong>TAMAÑO OJOS:</strong> </p>
                            <p><strong>LARGO CABELLO:</strong> </p>
                            <p><strong>SEÑAS PARTICULARES:</strong> </p>
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

    <!-- Ejemplo de botones en la parte inferior (Opcional) -->
    <div class="bottom-buttons">
        <button style="background-color: white; color: black;">Regresar</button>
        <button>Descargar</button>
    </div>

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
            justify-content: space-between;
            margin-top: 10px;
        }

        .carousel-buttons button {
            padding: 8px 12px;
            background-color: #334d75;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .carousel-buttons button:hover {
            background-color: #2b3f5b;
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
