<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Crimen;
use Illuminate\Support\Facades\DB;

class CrimenController extends Controller
{
    public function getCrimenes() {
    $consulta = DB::table('crimens')
        ->select('zona')
        ->distinct();
    
    $subconsulta = DB::table('crimens')
        ->select('zona', 'tipo_crimen', DB::raw('COUNT(*) as total'))
        ->groupBy('zona', 'tipo_crimen');
    
    $resultado = DB::table(DB::raw("({$consulta->toSql()}) as zonas"))
        ->mergeBindings($consulta)
        ->leftJoinSub($subconsulta, 'subconsulta', function ($join) {
            $join->on('zonas.zona', '=', 'subconsulta.zona');
        })
        ->select('zonas.zona', 'subconsulta.tipo_crimen', 'subconsulta.total')
        ->get();

        return response()->json($resultado);
    }
  
    public function getCrimenesPorAno() {
        $resultados = DB::table('crimens')
    ->select(DB::raw('EXTRACT(YEAR FROM fecha_ocurrida) as año'), 'tipo_crimen', DB::raw('COUNT(*) as cantidad'))
    ->groupBy(DB::raw('EXTRACT(YEAR FROM fecha_ocurrida)'), 'tipo_crimen')
    ->get();   

    return response()->json($resultados);
    }
    
    public function getCrimenesPorModus() {
        $resultados = DB::table('crimens')
            ->select('modus_operandi', 'tipo_crimen', DB::raw('COUNT(*) as cantidad'))
            ->groupBy('modus_operandi', 'tipo_crimen')
            ->get();

        return response()->json($resultados);
    }

    public function getCrimenesDelincuentes() {      

            $crimenesDelincuentes = Crimen::withCount([
                'delincuentes as masculinos' => function ($query) {
                    $query->where('genero', 'masculino');
                },
                'delincuentes as femeninos' => function ($query) {
                    $query->where('genero', 'femenino');
                },
                'delincuentes as con_antecedentes' => function ($query) {
                    $query->where('antecedentes', 'si');
                },
                'delincuentes as sin_antecedentes' => function ($query) {
                    $query->where('antecedentes', 'no');
                },
                'delincuentes as sin_relacion' => function ($query) {
                    $query->where('relacion_victima', 'no');
                },
                'delincuentes as con_relacion' => function ($query) {
                    $query->where('relacion_victima', 'si');
                }
            ])->get(['id', 'tipo_crimen', 'masculinos', 'femeninos', 'con_antecedentes', 'sin_antecedentes', 'sin_relacion', 'con_relacion']);
        

        return response()->json($crimenesDelincuentes);
    }

    public function getCrimenesVictimas() {
        $crimenVictima = Crimen::with('victimas')->get();

    return response()->json($crimenVictima);
    }
}