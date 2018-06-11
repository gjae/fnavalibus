<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Plantacion extends Model
{
    use SoftDeletes;
    protected $table = 'plantacions';
    protected $fillable = [
		'fecha_inicio',
		'fecha_aprox_fin',
		'reserva_id',
		'observacion',
		'etiqueta',
		'produce_aprox',
		'unidad_medida_id'
    ];

    protected $dates = ['deleted_at', 'fecha_inicio', 'fecha_aprox_fin'];
    protected $casts = [
    	'fecha_inicio' => 'date',
    	'fecha_aprox_fin' => 'date'
    ];

    public function reserva(){
    	return $this->belongsTo('App\Reserva');
    }

    public function medida(){
    	return $this->belongsTo('App\UnidadMedida');
    }

    public function detalles(){
    	return $this->hasMany('App\DetalleEstructura');
    }
}
