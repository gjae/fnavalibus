<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoMaterial extends Model
{
	use SoftDeletes;
    protected $table = 'tipo_materials';
    protected $fillable = [
    	'codigo', 'nombre_tipo', 'descripcion'
    ];

    protected $dates = [
    	'deleted_at'
    ];

    public function reservas(){
    	return $this->hasMany('App\Reserva');
    }
}
