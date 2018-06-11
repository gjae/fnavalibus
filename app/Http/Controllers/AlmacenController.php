<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventario;
use Auth;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if( $user->tipo_usuario == 'ADMIN' || $user->tipo_usuario == 'INVENTARIO' )
            return view('paginas.almacen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if( $user->tipo_usuario == 'ADMIN' || $user->tipo_usuario == 'INVENTARIO' )
            return view('paginas.almacen.crear');
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
        if( $user->tipo_usuario == 'ADMIN' || $user->tipo_usuario == 'INVENTARIO' ){
            $item = Inventario::create($request->except(['_token', '_method']));
            if( $item )
                return redirect()->to( url('dashboard/almacen') )->with('success', 'El registro ha sido creado correctamente');
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
        if( $user->tipo_usuario == 'ADMIN' || $user->tipo_usuario == 'INVENTARIO' ){
            $item = Inventario::find($id);
            //(return dd($item);
            if($item){
                return view('paginas.almacen.editar', [ 'item' => $item ]);
            }
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
        if( $user->tipo_usuario == 'ADMIN' || $user->tipo_usuario == 'INVENTARIO' ){
            $item = Inventario::find($id);
            if($item){
                foreach ($request->except(['_token', '_method']) as $key => $value) {
                    $item->$key = $value;
                }
                if( $item->save() ){
                    return redirect()->to( url( 'dashboard/almacen' ) )
                    ->with('success', 'Registro actualizado correctamente');
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
        if( $user->tipo_usuario == 'ADMIN' ){
            $item = Inventario::find($id);
            if( $item ){
                if( $item->delete() ){
                    return response(['error' => false, 'message' => 'El registro ha sido eliminado correctamente'], 200)
                        ->header('Content-Type', 'application/json');
                }
            }
        }

    }
}
