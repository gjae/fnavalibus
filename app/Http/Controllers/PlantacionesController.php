<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserva;
use App\Plantacion;
use App\DetalleEstructura;
use App\UnidadMedida;

use DB;

class PlantacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('paginas.plantaciones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('paginas.plantaciones.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $plantacion = $request->only([
                'reserva_id', 'fecha_inicio', 'fecha_aprox_fin', 'unidad_medida_id', 'etiqueta', 'produce_aprox'
            ]);

            $planta = Plantacion::create($plantacion);
            if( $planta ){
                $rows = count( $request->costo_material );
                for ($i=0; $i < $rows ; $i++) { 
                    $medida = UnidadMedida::find($request->inventario_id[$i]);
                    $planta->detalles()->save( 
                        new DetalleEstructura([
                            'inventario_id' => $request->inventario_id[$i],
                            'costo_material' => $request->costo_material[$i],
                            'cantidad_usada' => $request->cantidad_usada[$i],
                            'unidad_medida_id' => $medida->id,
                            'monto_total' => $request->monto_total[$i],
                            'observacion' => '--'
                        ])
                    );
                }
            }
            DB::commit();


            return dd($plantacion);
        } catch (\Exception $e) {
            DB::rollback();
            return dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plantacion = Plantacion::find($id);
        $vista = \View::make('paginas.plantaciones.reportes.detalle_plantacion', [
            'plantacion' => $plantacion
        ]);

        return $vista;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function nuevaFila(){
        return "hola";
        $vista = \View::make('paginas.plantaciones.fila')->render();
        return response(['vista' => $vista], 200)->header('Content-Type', 'application/json');
    }
}
