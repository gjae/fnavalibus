<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
	use SoftDeletes;
    protected $table = 'personas';
    protected $fillable = [
    	'nombre',
		'apellido',
		'cedula',
		'telefono_movil',
		'telefono_habitacion',
		'fecha_nacimiento'
    ];

    public function usuario(){
    	return $this->hasOne('App\User');
    }
}
