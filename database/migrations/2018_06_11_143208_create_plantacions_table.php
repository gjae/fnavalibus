<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantacions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();

            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_aprox_fin')->nullable();
            $table->integer('reserva_id')->unsigned();
            $table->string('observacion')->nullable();

            // LA ETIQUETA SE USA PARA IDENTIFICAR EL ESPACIO DONDE
            // FUE PLANTADO, UN IDENTIFICADOR UNICO PARA CADA PLANTACION
            $table->string('etiqueta', 18)->index('ET_INDx');
            $table->decimal('produce_aprox', 12,2)->default(1.00);
            $table->integer('unidad_medida_id')->unsigned();


            $table->foreign('unidad_medida_id')->references('id')->on('unidad_medidas');
            $table->foreign('reserva_id')->references('id')->on('reservas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plantacions');
    }
}
