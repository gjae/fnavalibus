<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('nombre_equipo', 110);
            $table->string('observacion')->nullable();
            $table->integer('unidad_medidas')->unsigned();
            $table->enum('tipo_equipo', [
                'SEMOVIENTE',
                'MUEBLE',
                'INMUEBLE',
                'MATERIAL_MEDICO',
                'COMBUSTIBLES',
                'ALIMENTO'
            ]);

            $table->enum('uso_en', [
                'PATIO',
                'OTROS'
            ])->default('PATIO');

            $table->decimal('costo_inicial', 12,2)->default(0.00);
            $table->string('documento_adquisicion', 100)->nullable();
            $table->enum('tipo_adquisicion', [
                'COMPRA',
                'DONACION',
                'COMODATO'
            ])->default('DONACION');
            $table->enum('fuente_adquisicion', [
                'PUBLICA',
                'PRIVADA',
                'MIXTA',
                'INTERNACIONAL'
            ])->default('PUBLICA');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventarios');
    }
}
