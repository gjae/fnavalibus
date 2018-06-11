<?php

use Illuminate\Database\Seeder;
use App\Persona;
use App\User;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$persona = Persona::create([
    		'nombre' => 'Admin',
			'apellido' => 'Del Sistema',
			'cedula' => '0000000',
			'telefono_movil' => 'N/A',
			'telefono_habitacion' => 'N/A',
			'fecha_nacimiento' => Carbon::now()->format('Y-m-d')
    	]);
    	if( $persona ){
    		
    		User::create([
    			'password' => '123456',
    			'email' => 'admin@admin.com',
                'persona_id' => $persona->id
    	   ]);
    	}

    }
}
