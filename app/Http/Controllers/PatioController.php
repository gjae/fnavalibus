<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserva;
use Auth;

class PatioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if( $user->tipo_usuario == 'ADMIN' || $user->tipo_usuario == 'PATIO' ){
            return view('paginas.patios.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if( $user->tipo_usuario == 'ADMIN' || $user->tipo_usuario == 'PATIO' ){
            return view('paginas.patios.crear_reserva');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if( $user->tipo_usuario == 'ADMIN' || $user->tipo_usuario == 'PATIO' ){
            $datos = $request->except(['_token', '_method']);
            $datos['costo_rubro_mercado'] = str_replace(',', '.',  str_replace('.', '', $datos['costo_rubro_mercado']) );
            $reserva = Reserva::create($datos);
            if( $reserva )
                return redirect()->to( url('dashboard/patios') )->with('success', 'El registro ha sido guardado correctamente');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        if( $user->tipo_usuario == 'ADMIN' || $user->tipo_usuario == 'PATIO' ){
            $reserva = Reserva::find($id);
            if( $reserva )
                return view('paginas.patios.editar_reserva', ['reserva' => $reserva]);
        }
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
        $user = Auth::user();
        if( $user->tipo_usuario == 'ADMIN' || $user->tipo_usuario == 'PATIO' ){
            $reserva = Reserva::find($id);
            if( $reserva ){
                $datos = $request->except(['_token', '_method']);
                $datos['costo_rubro_mercado'] = str_replace(',', '.',  str_replace('.', '', $datos['costo_rubro_mercado']) );
                foreach ($datos as $key => $value) {
                    $reserva->$key = $value;
                }
                if($reserva->save()){
                    return redirect()->to( url('dashboard/patios') )
                        ->with('success', 'El registro ha sido actualizado correctamente');
                }
                
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if( $user->tipo_usuario == 'ADMIN' || $user->tipo_usuario == 'PATIO' ){
            $reserva = Reserva::find($id);
            if( $reserva->plantaciones->isEmpty() ){
                if( $reserva->delete() )
                    return response(['error' => false, 'message' => 'El registro ha sido borrado satisfactoriamente'], 200)
                        ->header('Content-Type', 'application/json');
            }else{
                return response(['error' => true, 'message' => 'Este item tiene registrado producciones, por lo tanto no puede ser eliminado del sistema'], 200)
                        ->header('Content-Type', 'application/json');
            }
        }
    }
}
