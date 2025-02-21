@extends('app')

@section('content')
    <div class="text-center m-4 titulo-busqueda">
        Cuerpos en calidad de no identificados
    </div>

    <div class="container">
        <!-- Lado Izquierdo -->
        <div class="left-box">
            <p class="left-box-message">
                Consulta la Base de Datos de
                Occisos No Identificados y/o
                sin Reclamar de la Dirección
                General de Servicios Periciales
                de Fiscalía General de Justicia
                del Estado de Zacatecas
            </p>
        </div>

        <!-- Lado Derecho: Formulario -->
        <div class="right-box">
            <form id="searchForm" action="{{ route('resultados') }}" method="GET">
                @csrf
                <!-- Mensaje principal -->
                <p class="form-header">
                    Los registros se muestran ordenados por la fecha del hallazgo
                </p>
                <p class="form-subheader">
                    (De los más recientes a los más antiguos)
                </p>

                <!-- Mensaje secundario -->
                <p class="form-header">
                    Por favor seleccione datos mínimos para iniciar la búsqueda
                </p>
                <p class="form-subheader">
                    (Edad aproximada y sexo)
                </p>

                <!-- Fila: Folio y Edad -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="folio">Folio</label>
                        <input type="text" id="folio" name="folio" />
                    </div>
                    <div class="form-group">
                        <label for="edad">Edad <span style="color: red">*<span></label>
                        <input type="number" id="edad" name="edad" required />
                        <span class="error-message" id="edadError">Este campo es obligatorio</span>
                    </div>
                </div>

                <!-- Fila: Género (Radio) -->
                <div class="form-row">
                    <div class="radio-group left-align">
                        <input type="radio" id="femenino" name="genero" value="Femenino" required />
                        <label for="femenino">Femenino</label>
                    </div>
                    <div class="radio-group center-align">
                        <input type="radio" id="masculino" name="genero" value="Masculino" />
                        <label for="masculino">Masculino</label>
                    </div>
                </div>

                <!-- Fila: Nombre -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre">Nombre(s)</label>
                        <input type="text" id="nombre" name="nombre" />
                    </div>
                </div>

                <!-- Fila: Apellidos -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="paterno">Apellido Paterno</label>
                        <input type="text" id="paterno" name="paterno" />
                    </div>
                    <div class="form-group">
                        <label for="materno">Apellido Materno</label>
                        <input type="text" id="materno" name="materno" />
                    </div>
                </div>

                <!-- Selección de Año y Mes -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="anio">Año del hallazgo</label>
                        <select id="anio" name="anio" class="custom-select">
                            <option value="" selected disabled></option>
                            <script>
                                const currentYear = new Date().getFullYear();
                                for (let i = currentYear; i >= currentYear - 100; i--) {
                                    document.write(`<option value="${i}">${i}</option>`);
                                }
                            </script>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mes">Mes del hallazgo</label>
                        <select id="mes" name="mes" class="custom-select">
                            <option value="" selected disabled></option>
                            <option value="01">Enero</option>
                            <option value="02">Febrero</option>
                            <option value="03">Marzo</option>
                            <option value="04">Abril</option>
                            <option value="05">Mayo</option>
                            <option value="06">Junio</option>
                            <option value="07">Julio</option>
                            <option value="08">Agosto</option>
                            <option value="09">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>
                </div>

                <!-- Fila: Checkboxes -->
                <strong>Mostrar fotografías</strong>
                <div class="form-row">
                    <div class="checkbox-group left-align">
                        <input type="checkbox" id="mostrar-fotos-si" name="mostrar-fotos" value="1"
                            onclick="toggleCheckbox(this)" />
                        <label for="mostrar-fotos-si">Sí</label>
                    </div>
                    <div class="checkbox-group center-align">
                        <input type="checkbox" id="mostrar-fotos-no" name="mostrar-fotos" value="0"
                            onclick="toggleCheckbox(this)" checked />
                        <label for="mostrar-fotos-no">No</label>
                    </div>
                </div>

                <button type="submit" class="btn-buscar">BUSCAR</button>
            </form>
        </div>
    </div>

    <style>
        .titulo-busqueda {
            color: #a5a5a5;
            font-size: 1.5rem;
        }

        /* Contenedor principal */
        .container {
            display: flex;
            flex-wrap: wrap;
            /* Para que se adapte en pantallas pequeñas */
            margin: 20px auto;
            max-width: 1200px;
            /* Ajusta el ancho máximo al gusto */
            gap: 20px;
            /* Espacio entre la caja izquierda y la derecha */
        }

        /* Lado Izquierdo */
        .left-box {
            flex: 1 1 300px;
            /* Crece y se encoge, con ancho mínimo de 300px */
            background-color: #a5a5a5;
            min-height: 400px;
            /* Altura mínima para ver el recuadro gris */
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .left-box-message {
            font-size: 1.2rem;
            font-weight: bold;
            color: white;
        }

        /* Lado Derecho */
        .right-box {
            flex: 1 1 400px;
            /* Crece y se encoge, con ancho mínimo de 400px */
            padding: 20px;
        }

        /* Encabezados del formulario */
        .form-header {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .form-subheader {
            font-size: 0.95rem;
            margin-bottom: 20px;
            color: #555;
            margin-top: -10px;
        }

        /* Estructura de filas */
        .form-row {
            display: flex;
            flex-wrap: wrap;
            /* Permite que los campos salten de línea en pantallas pequeñas */
            gap: 20px;
            margin-bottom: 15px;
            align-items: center;
            /* Centra verticalmente los elementos */
        }

        /* Agrupación de inputs con su label */
        .form-group {
            display: flex;
            flex-direction: column;
            /* Label encima del input */
            flex: 1;
            /* Se expanden para llenar el espacio disponible */
            min-width: 120px;
            /* Ancho mínimo */
        }

        /* Labels para radio buttons */
        .label-group {
            font-weight: 600;
            margin-right: 10px;
        }

        /* Estilos base para cada grupo de checkbox */
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 5px;
            /* Espacio entre el checkbox y la etiqueta */
            flex: 1;
            /* Cada grupo ocupa la mitad del ancho */
        }

        /* Estilos base para cada grupo de radio */
        .radio-group {
            display: flex;
            align-items: center;
            gap: 5px;
            /* Espacio entre el radio y la etiqueta */
            flex: 1;
            /* Cada grupo ocupa la mitad del espacio disponible */
        }

        /* Ajusta los inputs */
        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Pequeñas mejoras en pantallas muy pequeñas */
        @media (max-width: 600px) {
            .left-box {
                min-height: 200px;
            }

            .left-box-message {
                font-size: 1rem;
            }
        }

        .btn-buscar {
            background-color: #334d75;
            color: #fff;
            text-transform: uppercase;
            /* Tamaño mediano */
            padding: 10px 20px;
            border: none;
            /* Bordes redondeados */
            border-radius: 20px;
            font-size: 16px;
            cursor: pointer;
            display: block;
            /* Centrado horizontalmente */
            margin: 20px auto;
            cursor: pointer;
        }

        .btn-buscar:hover {
            /* Oscurece el azul al pasar el mouse */
            background-color: #0056b3;
            color: white;
        }

        .error-message {
            color: red;
            font-size: 12px;
            display: none;
        }

        input[type="checkbox"] {
            accent-color: black;
        }
    </style>

    <script>
        document.getElementById("searchForm").addEventListener("submit", function(event) {
            let edad = document.getElementById("edad");
            let edadError = document.getElementById("edadError");

            if (!edad.value) {
                edadError.style.display = "block";
                event.preventDefault(); // Evita el envío del formulario
            } else {
                edadError.style.display = "none";
            }
        });

        function toggleCheckbox(clicked) {
            document.querySelectorAll("input[name='mostrar-fotos']").forEach(cb => {
                if (cb !== clicked) cb.checked = false;
            });
        }
    </script>
@endsection
