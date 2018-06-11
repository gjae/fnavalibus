<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnidadMedida;
use Auth;
class UnidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::user()->tipo_usuario == 'ADMIN' )
            return view('paginas.unidades.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if( $user->tipo_usuario == 'ADMIN' )
            return view('paginas.unidades.crear');
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
        if( $user->tipo_usuario == 'ADMIN' )
        {
            $unidad = UnidadMedida::create($request->except(['_token', '_method']));
            if( $unidad )
                return redirect()->to( url('dashboard/unidades') )->with('success', 'Registro guardado correctamente');
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
        //
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
        if( $user->tipo_usuario == 'ADMIN' ){
            $unidad = UnidadMedida::find($id);
            if( $unidad )
                return view('paginas.unidades.actualizar', ['unidad' => $unidad]);
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
        if( $user->tipo_usuario == 'ADMIN' ){
            $unidad = UnidadMedida::find($id);
            $datos = $request->except(['_method', '_token']);
            foreach ($datos as $key => $value) {
                $unidad->$key = $value;
            }

            if( $unidad->save() )
                return redirect()->to( url( 'dashboard/unidades' ) )->with('success', 'Se ha actualizado el registro correctamente');
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
        if( $user->tipo_usuario == 'ADMIN' ){
            $unidad = UnidadMedida::find($id);
            if( $unidad->delete() )
                return response(['error' => false, 'message' => 'Registro eliminado correctamente'])
                    ->header('Content-Type', 'application/json');
        }
    }
}
