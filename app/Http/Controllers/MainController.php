<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function buscar()
    {
        return view('buscar');
    }

    public function busqueda(Request $request)
    {
        // Consulta a la vista (reemplaza 'nombre_de_la_vista' por el nombre real de la vista en tu BD)
        $query = DB::table('BUSCAROCCISO');

        if ($request->filled('edad')) {
            $query->where('Edad', $request->input('edad'));
        }
        if ($request->filled('folio')) {
            $query->where('nombre', 'like', '%' . $request->input('folio') . '%');
        }
        if ($request->filled('genero')) {
            $query->where('nomSexo', $request->input('genero'));
        }
        if ($request->filled('nombre')) {
            $query->where('nom', 'like', '%' . $request->input('nombre') . '%');
        }
        if ($request->filled('paterno')) {
            $query->where('Paterno', 'like', '%' . $request->input('paterno') . '%');
        }
        if ($request->filled('materno')) {
            $query->where('Materno', 'like', '%' . $request->input('materno') . '%');
        }
        if ($request->filled('anio')) {
            $query->whereYear('Fecha', $request->input('anio'));
        }
        if ($request->filled('mes')) {
            $query->whereMonth('Fecha', $request->input('mes'));
        }

        // Lógica para "Mostrar fotografías": si se envía, se filtra por 1 (Sí) o 0 (No)
        if ($request->input('mostrar-fotos') == '1') {
            $showfotos = true;
        } else {
            $showfotos = false;
        }

        // Obtener el conjunto de registros que cumplan con los filtros
        $resultados = $query->paginate(4);

        // Retornar la vista con los registros encontrados
        return view('resultados', compact('resultados', 'showfotos'));

        // dd($resultados);
    }

    public function cni(Request $request)
    {
        $showfotos = $request->query('showfotos');
        $id = $request->query('id');

        $sql1 = "
            SELECT 
                CAST(T0.Fecha AS date) AS fecha,
                CAST(T0.Fecha AS time) AS hora,
                T0.Averiguacion as expediente,
                T0.Calle  as intervencion,
                T1.descripcion as municipio,
                T0.SeñasParticulares as señas,
                T0.Observaciones as observaciones,
                T2.PERTENENCIASYACCESORIOS as pertenencias
            FROM
                SEMEFO T0
                    INNER  JOIN MuniPais T1 on T0.Estado = T1.cod_edo
                        AND T0.Municipio = T1.cod_mun
                    INNER JOIN ROPASYACCESORIOSSEMEFO T2 on T0.Folio = T2.FOLIO
            WHERE
                T0.Folio = {$id}";

        $sql2 = "
            SELECT DISTINCT
                T0.FOLIO as folio,
                T0.PESO as peso,
                T0.ESTATURA as estatura,
                T1.DESCR as tez,
                T2.DESCR as complexion,
                T3.descripcion as formacara,
                T4.DESCR as frente,
                T5.DESCR as barba,
                T6.IdAnteojos as anteojos,
                T7.DESCR as menton,
                (SELECT cm.descripcion 
                    FROM MEDIAFILIACIONSEMEFO m 
                    INNER JOIN CAT_MEDFIL cm on m.MENTONFORMA = cm.LLAVE_TIPO 
                    WHERE cm.LLAVE = 25 and m.FOLIO = {$id}) as mentonforma,
                T8.DESCR as nariz,
                (SELECT cm.descripcion 
                    FROM MEDIAFILIACIONSEMEFO m 
                    INNER JOIN CAT_MEDFIL cm on m.TAMAÑONARIZ = cm.LLAVE_TIPO 
                    WHERE cm.LLAVE = 6 and m.FOLIO = {$id}) as tamnariz,
                T9.DESCR as tamboca,
                T10.DESCR as grosorlabios,
                (SELECT cm.descripcion
                    FROM MEDIAFILIACIONSEMEFO m 
                    INNER JOIN CAT_MEDFIL cm on m.TIPOCEJA = cm.LLAVE_TIPO 
                    WHERE cm.LLAVE = 14 and m.FOLIO = {$id}) as tipocejas,
                T11.DESCR as tamcejas,
                (SELECT cm.descripcion
                    FROM MEDIAFILIACIONSEMEFO m 
                    INNER JOIN CAT_MEDFIL cm on m.TAMAÑOOREJAS = cm.LLAVE_TIPO 
                    WHERE cm.LLAVE = 47 and m.FOLIO = {$id}) as tamorejas,
                T12.DESCR as formorejas,
                T13.DESCR as colorcabello,
                T14.DESCR as formacabello,
                T15.IdTamCabello as largocabello,
                T16.DESCR as colorojos,
                T17.DESCR as tamojos,
                T18.IdSeñasParticulares as señas
            FROM
                MEDIAFILIACIONSEMEFO T0
                LEFT JOIN TEZ T1 on T0.TEZ_PIEL = T1.TEZ
                LEFT JOIN COMPLEXION T2 on T0.COMPLEXION = T2.COMPLEXION
                LEFT JOIN CAT_MEDFIL T3 on T0.FORMACARA = T3.LLAVE_TIPO
                LEFT JOIN FRENTE T4 on T0.FRENTE = T4.FRENTE
                LEFT JOIN BARBA T5 on T0.BARBA = T5.BARBA
                LEFT JOIN Anteojos T6 on T0.ANTEOJOS = T6.CveAnteojos
                LEFT JOIN MENTON T7 on T0.MENTON = T7.MENTON
                LEFT JOIN NARIZ T8 on T0.NARIZ = T8.NARIZ
                LEFT JOIN BOCA T9 on T0.BOCATAMAÑO = T9.BOCA
                LEFT JOIN LABIOS T10 on T0.GROSORLABIOS = T10.LABIOS
                LEFT JOIN CEJAS T11 on T0.CEJASTAMAÑO = T11.CEJAS
                LEFT JOIN OREJAS T12 on T0.FORMAOREJAS = T12.OREJAS
                LEFT JOIN COLOR_CABELLO T13 on T0.COLORCABELLO = T13.COLOR_CAB
                LEFT JOIN CABELLO T14 on T0.FORMACABELLO = T14.CABELLO
                LEFT JOIN Cabello_Tamaño T15 on T0.LARGOCABELLO = T15.CveTamCabello
                LEFT JOIN COLOR_OJOS T16 on T0.COLOROJOS = T16.COLOR_OJOS
                LEFT JOIN OJOS T17 on T0.TAMAÑOOJOS = T17.OJOS 
                LEFT JOIN Señas_Particulares T18 ON T0.SEÑASPARTICULARES = T18.CveSeñasParticulares
            WHERE
                T0.FOLIO = {$id}
        ";

        // Ejecuta la consulta
        $datos = DB::select($sql1);
        $senas = DB::select($sql2);

        return view('cni', compact('showfotos', 'id', 'datos', 'senas'));
    }
}
