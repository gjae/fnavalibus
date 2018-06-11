<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoMaterial;
use Auth;

class TiposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if( Auth::user()->tipo_usuario != 'ADMIN' )
            return redirect()->to( url('dashboard') );
        return view('paginas.tipos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paginas.tipos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo = TipoMaterial::where('codigo', '=', $request->codigo)->first();
        if( $tipo )
            return redirect()->to( url('dashboard/tipos/create') )->with('error', 'Error: Este codigo esta siendo utilizado por otro registro ya, vuelva a intentar');

        $tipo = TipoMaterial::create( $request->except(['_token', '_method']) );

        if( $tipo )
            return redirect()->to( url('dashboard/tipos') )->with('success', 'Registro guardado exitosamente');
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
        return view('paginas.tipos.editar', [
            'tipo' => TipoMaterial::find($id)
        ]);
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
        $tipo = TipoMaterial::find($id)->update($request->except(['_token', '_method']));
        return redirect()->to( url('dashboard/tipos') )->with('success', 'Registro actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo = TipoMaterial::find($id);

        if( $tipo->delete() )
            return response(['error' => false, 'message' => 'Registro eliminado'], 200)->header('Content-Type', 'application/json');
    }
}
