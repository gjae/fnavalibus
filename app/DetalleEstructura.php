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

	public function inventario(){
		return $this->belongsTo('App\Inventario', 'inventario_id');
	}

	public function medida(){
		return $this->belongsTo('App\UnidadMedida', 'unidad_medida_id');
	}

}
