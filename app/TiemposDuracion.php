<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TiemposDuracion extends Model
{
    use SoftDeletes;
    protected $table = 'tiempos_duracions';
    protected $fillable = [
    	'descripcion', 'semanas_inicial', 'semanas_final'
    ];

    protected $dates = ['deleted_at'];


    public function reservas(){
    	return  $this->hasMany('App\Reserva');
    }
}
