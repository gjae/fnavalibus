<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleEstructura extends Model
{
	use SoftDeletes;
	protected $table = 'detalle_estructuras';
	protected $fillable = [
		'observacion',
		'inventario_id',
		'plantacion_id',
		'unidad_medida_id',
		'costo_material',
		'cantidad_usada',
		'monto_total',
	];


	public function plantacion(){
		return $this->belongsTo('App\Plantacion');
	}

}
