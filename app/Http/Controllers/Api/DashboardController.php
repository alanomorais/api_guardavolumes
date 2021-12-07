<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Armario;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $pacientes = Paciente::count();
        $altas = Paciente::where('dt_alta','<>', null)->count();
        $internados = Paciente::where('dt_alta','=', null)->count();

        $armarios = Armario::where('situacao','=', 'A')->count();

        $data = [
            'totPacientes'=> $pacientes,
            'totAltas' => $altas,
            'totInternados' => $internados,
            'armariosLivres' => $armarios,
        ];

        return response()->json($data, 200);
    }

}

