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

        // Agregar condiciones dinámicamente solo para los campos que tienen valor
        if ($request->filled('edad')) {
            $query->where('Edad', $request->input('edad'));
        }
        if ($request->filled('folio')) {
            $query->where('Folio', $request->input('folio'));
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
            $query->whereYear('Fecha', 'like', '%' . $request->input('anio'));
        }
        if ($request->filled('mes')) {
            $query->whereMonth('Fecha', 'like', $request->input('mes')) . '%';
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
    
        return view('cni', compact('showfotos', 'id'));
    }
}
