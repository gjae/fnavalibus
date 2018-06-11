<?php

use Illuminate\Database\Seeder;

class TiemposDuracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiempos = [
        	'CORTO PLAZO' => [
        		'semanas_inicial' => 4,
        		'semanas_final' => 12
        	],
        	'MEDIANO PLAZO' => [
        		'semanas_inicial' => 13,
        		'semanas_final' => 22

        	],
        	'LARGO PLAZO' => [
        		'semanas_inicial' => 23,
        		'semanas_final' => 56

        	]
        ];

        foreach ($tiempos as $key => $value) {
        	$value['descripcion'] = $key;
        	\DB::table('tiempos_duracions')->insert($value);
        }
    }
}
