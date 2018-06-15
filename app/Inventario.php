<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventario extends Model
{
	use SoftDeletes;
    protected $table = 'inventarios';
    protected $fillable = [
    	'nombre_equipo', 'observacion', 'unidad_medidas', 'tipo_equipo', 'costo_inicial', 'documento_adquisicion',  'tipo_adquisicion', 'fuente_adquisicion'
    ];

    public function medida(){
    	return $this->belongsTo('app\UnidadMedida', 'unidad_medidas');
    }

    public function movimientos(){
    	return $this->hasMany('App\MovimientoInventario');
    }

    public function usados_en_patio(){
        return $this->hasMany('App\DetalleEstructura', 'inventario_id');
    }
}
