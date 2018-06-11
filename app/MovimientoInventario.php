<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientoInventario extends Model
{
    protected $table = 'movimiento_inventarios';
    protected $fillable = [
	    'inventario_id',
		'fecha_movimiento',
		'cantidad',
		'observacion',
		'tipo_movimiento',
		'costo_movimiento'
    ];

    protected $casts = [
    	'fecha_movimiento' => 'date'
    ];

    public function item(){
    	return $this->hasMany('App\Inventario');
    }
}
