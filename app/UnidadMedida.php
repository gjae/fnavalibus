<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnidadMedida extends Model
{
	use SoftDeletes;
    protected $table = 'unidad_medidas';
    protected $fillable = [
    	'codigo', 'descripcion'
    ];



    public function equipos(){
    	return $this->hasMany('App\Inventario', 'unidad_medidas');
    }

    public function plantaciones(){
    	return $this->hasMany('App\Plantacion');
    }
}
