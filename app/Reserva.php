<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserva extends Model
{
    use SoftDeletes;
    protected $table = 'reservas';
    protected $fillable = [
		'descripcion',
		'tipo_material_id',
		'total_gasto',
		'costo_rubro_mercado',
		'unidad_medida_id',
		'tipo_rubro',
		'finalidad',
        'tiempos_duracion_id'
    ];

    protected $dates = ['deleted_at'];

    ## RELACIONES
    public function plantaciones(){
    	return $this->hasMany('App\Plantacion', 'reserva_id');
    }

    public function tipo(){
        return $this->belongsTo('App\TipoMaterial', 'tipo_material_id');
    }

    public function duracion(){
        return $this->belongsTo('App\TiemposDuracion', 'tiempos_duracion_id');
    }

    public function medida(){
        return $this->belongsTo('App\UnidadMedida', 'unidad_medida_id');
    }

    ## GETTERS
    
    public function getFinalidadAttribute($old){
        switch ($old) {
            case 'CONSUMO_INTERNO':
                return 'PARA CONSUMO INTERNO';
                break;
            case 'CONSUMO_COMUNIDAD':
                return 'PARA LA COMUNIDAD';
                break;
            default:
                return 'PARA '.$old;
                break;
        }
    }
}
