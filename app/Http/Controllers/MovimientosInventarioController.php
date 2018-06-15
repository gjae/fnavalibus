<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventario;
use App\MovimientoInventario as MI;
use Auth;
class MovimientosInventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if( $user->tipo_usuario == 'ADMIN' || $user->tipo_usuario == 'INVENTARIO' ){
            $item = Inventario::find($request->item);
            if($item)
                return view('paginas.almacen.movimientos', ['item' => $item]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        if( $user->tipo_usuario == 'ADMIN' || $user->tipo_usuario == 'INVENTARIO' ){
            $item = Inventario::find($request->item);
            if($item)
                return view('paginas.almacen.crear_movimiento', ['item' => $item]);
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
        if( $user->tipo_usuario == 'ADMIN' || $user->tipo_usuario == 'INVENTARIO' ){    
            $movimiento = MI::create($request->except(['_token', '_method', 'item']));
            if( $movimiento )
                return redirect()->to( url('dashboard/movimientos?item='.$request->inventario_id) )
                    ->with('success','El movimiento ha sido guardado correctamente');
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
}
